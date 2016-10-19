<?php

namespace Service\Users;

class Update extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Id'        => ['required', 'positive_integer'],
            'FirstName' => ['required', 'trim', ['max_length' => 255]],
            'LastName'  => ['required', 'trim', ['max_length' => 255]],
            'Email'     => ['required', 'email', ['max_length' => 64]],
            'Status'    => ['not_empty', ['one_of' => ['active', 'deleted', 'not_confirmed']]]
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
                'Message' => 'Cannot find user with id = ' . $params['Id']
            ]);
        }

        $user->fromArray($params);
        $user->save();

        return [
            'Status'        => 1,
            'UserStatus'    => $user->getStatus(),
            'Email'         => $params['Email'],
        ];
    }
}
