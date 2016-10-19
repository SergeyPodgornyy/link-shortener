<?php

namespace Controller;

class CSRFToken extends Base
{
    public function index()
    {
        $token = \Slim\Middleware\CSRFProtection::getToken();
        $_SESSION['csrf_token'] = $token;

        $this->renderJson(array('status' => 1, 'token' => $token));
    }
}
