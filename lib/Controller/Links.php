<?php

namespace Controller;

class Links extends Base
{
    public function index()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Links\Index")->run($data);
        });
    }

    public function show($linkHash)
    {
        $self = $this;
        $data = $self->request()->params();
        $data['Hash'] = $linkHash;

        $res = $this->run(function () use ($self, $data) {
            return $self->action("Service\Links\Show")->run($data);
        }, true);

        if (isset($res['Status']) && $res['Status'] === 1) {
            $this->app->redirect($res['Link']);
        }

        return $res;
    }

    public function create()
    {
        $self = $this;
        $data = $self->request()->params();

        $this->run(function () use ($self, $data) {
            return $self->action("Service\Links\Create")->run($data);
        });
    }
}
