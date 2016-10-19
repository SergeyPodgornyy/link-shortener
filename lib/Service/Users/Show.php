<?php

namespace Service\Users;

class Show extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Id' => [ 'required', 'positive_integer' ],
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $user = \Engine\UsersQuery::create()
            ->filterById($params['Id'])
            ->findOne();

        if (!$user) {
            throw new \Service\X([
                'Type'    => 'WRONG_ID',
                'Fields'  => [ 'Id' => 'WRONG_ID' ],
                'Message' => 'Cannot find user with id = '.$params['Id']
            ]);
        }

        $row = [
            'Id'        => $user->getId(),
            'Email'     => $user->getEmail(),
            'FirstName' => $user->getFirstName(),
            'LastName'  => $user->getLastName(),
            'Status'    => $user->getStatus(),
            'AddTime'   => $user->getAddTime()
        ];

        return [
            'User'   => $row,
            'Status' => 1
        ];
    }
}
