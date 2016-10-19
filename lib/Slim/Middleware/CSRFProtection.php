<?php

namespace Slim\Middleware;

class CSRFProtection extends \Slim\Middleware
{

    public static function getToken()
    {
        if (isset($_SESSION['csrf_token'])) {
            return $_SESSION['csrf_token'];
        }
        $token = md5(microtime() . rand() . uniqid());
        return $token;
    }

    public function __construct($onerror = false)
    {
        if ($onerror && is_callable($onerror)) {
            $this->_onerror = $onerror;
        }
    }

    public function call()
    {
        $this->next->call();
    }

    public function isTokenValid($usertoken)
    {
        return isset($_SESSION['csrf_token']) && $usertoken === $_SESSION['csrf_token'];
    }

    public function check()
    {
        if (!isset($_SESSION)) {
            $this->app->halt(400, "SlimCSRFProtection: session not started.");
        }

        $env = $this->app->environment();

        $usertoken = $env['HTTP_X_CSRF_TOKEN'] ?: $this->app->request()->post('csrf_token');

        if (in_array($this->app->request()->getMethod(), array('POST', 'PUT', 'DELETE'))) {
            if (!$this->isTokenValid($usertoken)) {
                if (property_exists($this, '_onerror')) {
                    call_user_func($this->_onerror);
                } else {
                    $this->app->halt(400, "CSRF protection: wrong token");
                }
            }
        }

        $token = static::getToken();

        $_SESSION['csrf_token'] = $token;

        $this->app->view()->setData(array(
            'csrf_token' => $token,
            'csrf_protection_input'  => '<input type="hidden" name="csrf_token" value="' . $token . '"/>',
            'csrf_protection_jquery' =>
                '<script type="text/javascript">
                    $(document).ajaxSend(function(e,xhr){xhr.setRequestHeader("X-CSRF-Token","' . $token . '");});
                </script>'
        ));
    }
}
