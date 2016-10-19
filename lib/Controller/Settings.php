<?php

namespace Controller;

class Settings extends Base
{
    public function show()
    {
        $self = $this;

        $this->run(function () use ($self) {
            return $self->action("Service\Settings\Show")->run();
        });
    }

    public function update()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Settings\Update")->run($data);
        });
    }
}
