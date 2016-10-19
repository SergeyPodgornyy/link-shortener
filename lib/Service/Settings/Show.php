<?php

namespace Service\Settings;

class Show extends \Service\Base
{
    public function validate()
    {
    }

    public function execute()
    {
        $user = $this->getUser();

        $settings = [
            'UserId'    => $user->getId(),
            'FirstName' => $user->getFirstName(),
            'LastName'  => $user->getLastName(),
            'Email'     => $user->getEmail()
        ];

        return [
            'Status'   => 1,
            'Settings' => $settings
        ];
    }
}
