<?php

namespace Controller;

class Users extends Base
{
    public function index()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Index")->run($data);
        });
    }

    public function delete($userId)
    {
        $self = $this;
        $data = [ 'Id' => $userId ];

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Delete")->run($data);
        });
    }

    public function show($userId)
    {
        $self = $this;
        $data = [ 'Id' => $userId ];

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Show")->run($data);
        });
    }

    public function update($userId)
    {
        $self = $this;

        $data = $self->request()->params();
        $data['Id'] = $userId;

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Update")->run($data);
        });
    }

    public function create()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Users\Create")->run($data);
        });
    }
}
