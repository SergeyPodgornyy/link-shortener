<?php

namespace Controller;

class Token extends Base
{
    public function check()
    {
        $config = $this->config();
        $tokenConf = $config['headerAccessToken'];

        if (in_array($this->request()->headers($tokenConf['name']), $tokenConf['values'])) {
            return true;
        } else {
            $this->renderJSON(['Error' => [ 'Type' => 'ACCESS_DENIED' ] ]);
        }
    }
}
