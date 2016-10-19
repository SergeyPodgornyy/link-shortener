<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Propel\Runtime\Propel;

class AppFactory
{
    public static $slimInstance;

    public static function create($config)
    {
        // Create monolog logger and store logger in container as singleton
        // (Singleton resources retrieve the same log resource definition each time)
        // Prepare app
        $app = new \Slim\Slim($config['slimOptions']);
        $app->config = $config;

        $app->container->singleton('log', function () use ($app) {
            $log = new \Monolog\Logger($app->config['loggerOptions']['name']);

            $log->pushHandler(
                new \Monolog\Handler\StreamHandler($app->config['loggerOptions']['filepath'], \Monolog\Logger::DEBUG)
            );

            return $log;
        });

        $logger = new Logger('propel');
        $logger->pushHandler(new StreamHandler(
            $app->config['loggerOptions']['propelpath'],
            Logger::DEBUG
        ));
        Propel::getServiceContainer()->setLogger('defaultLogger', $logger);

        // Prepare middleware

        // Catch Errors
        $app->notFound(function () use ($app) {
            $res['Error'] = true;
            $app->render('404.php', $res);
        });

        $app->error(function (\Exception $e) use ($app) {
            $res['Error'] = true;
            $app->log->error($e);
            $app->render('500.php', $res);
        });

        // Define routes
        $app->get('/welcome', function () use ($app) {
            $app->render('welcome.php');
        });
        $app->get('/links', function () use ($app) {
            $app->render('stat.php');
        });

        $app->get('/r/:linkHash', [new \Controller\Links($app), 'show'])->name('links_show');

        $app->get('/:path*', function () use ($app) {
            if (isset($_SESSION['UserId']) && $_SESSION['UserId']) {
                $app->render('index.php');
            } else {
                $app->redirect('/welcome');
            }
        });

        // Define API routes
        $app->group('/api/v1', function () use ($app) {

            $sessions = new \Controller\Session($app);
            $isAuth = [$sessions, 'check'];
            $isAuthOrTokenPermission = [$sessions, 'checkAuthOrToken'];
            $token = new \Controller\Token($app);
            $hasPermission = [$token, 'check'];

            $app->group('/sessions', function () use ($app) {
                $sessions = new \Controller\Session($app);

                $app->post('/', [$sessions, 'create'])->name('sessions_create');
                $app->delete('/', [$sessions, 'delete'])->name('sessions_delete');
            });

            $app->group('/csrf_token', function () use ($app, $isAuth) {
                $token = new \Controller\CSRFToken($app);

                $app->get('/', [$token, 'index'])->name('csrf_token_index');
            });

            $app->group('/settings', function () use ($app, $isAuth) {
                $settings = new \Controller\Settings($app);
                $app->get('/', $isAuth, [$settings, 'show'])->name('settings_show');
            });

            $app->group('/users', function () use ($app, $isAuth) {
                $app->group('/anonymous', function () use ($app) {
                    $anonymous = new \Controller\Users\Anonymous($app);
                    $app->post('', [$anonymous, 'create']);
                });

                $users = new \Controller\Users($app);
                $app->get('/', $isAuth, [$users, 'index' ])->name('users_index');
                $app->get('/:UserId', $isAuth, [$users, 'show'  ])->name('users_show');
                $app->post('/', $isAuth, [$users, 'create'])->name('users_create');
                $app->post('/:UserId', $isAuth, [$users, 'update'])->name('users_update');
                $app->delete('/:UserId', $isAuth, [$users, 'delete'])->name('users_delete');
            });

            $app->group('/link', function () use ($app, $isAuth) {
                $links = new \Controller\Links($app);
                $app->get('/', $isAuth, [$links, 'index' ])->name('links_index');
                $app->post('/', $isAuth, [$links, 'create'])->name('links_create');
            });
        });

        $app->add(new \Slim\Middleware\CSRFProtection());

        return self::$slimInstance = $app;
    }
}
