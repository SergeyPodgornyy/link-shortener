<?php

namespace Controller\Users;

class Anonymous extends \Controller\Base
{
    public function create()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Anonymous\Create")->run($data);
        });
    }
}
