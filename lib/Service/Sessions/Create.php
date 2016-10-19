<?php

namespace Service\Sessions;

class Create extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Email'     => [ 'required', 'email', 'to_lc' ],
            'Password'  => [ 'required', ['min_length' => 6] ]
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $user = \Engine\UsersQuery::create()->findOneByEmail($params['Email']);

        if (!$user) {
            throw new \Service\X\WrongAuthorization(['Type' => 'WRONG_EMAIL']);
        }

        $data = $user->toArray();
        unset($data['Password']);
        unset($data['TempPswd']);

        return [
            'User'   => $data,
            'Status' => 1,
        ];
    }
}
