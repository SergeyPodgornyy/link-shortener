<?php

namespace Controller;

class Session extends Base
{
    public function check()
    {
        if (isset($_SESSION['UserId']) && $_SESSION['UserId']) {
            return true;
        } else {
            $this->renderJSON(['error' => [ 'type' => 'ACCESS_DENIED' ] ]);
        }
    }

    public function checkAuthOrToken()
    {
        $config = $this->config();
        $tokenConf = $config['headerAccessToken'];

        if ((isset($_SESSION['UserId']) && $_SESSION['UserId']) ||
            ( in_array($this->request()->headers($tokenConf['name']), $tokenConf['values']) )
           ) {
            return true;
        } else {
            $this->renderJSON(['error' => [ 'type' => 'ACCESS_DENIED' ] ]);
        }
    }

    public function create()
    {
        $self   = $this;

        $params = $self->request()->params();

        return $this->run(function () use ($self, $params) {
            $result = $self->action("Service\Sessions\Create")->run($params);

            if ($result && isset($result['User'])) {
                $_SESSION['UserId'] = $result['User']['Id'];
                return ['status' => 1];
            }
        });
    }

    public function delete()
    {
        unset($_SESSION);

        $this->renderJSON(['status' => 1]);
    }
}
