<?php

namespace Service\Users;

class Create extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'FirstName' => ['required', 'not_empty'],
            'Email'     => ['required', 'email', 'to_lc'],
            'Status'    => ['required', 'not_empty', ['max_length' => 32]]
        ];

        $result = \Service\Validator::validate($params, $rules);
        $user = \Engine\UsersQuery::create()->findOneByEmail($params['Email']);
        if ($user) {
            throw new \Service\X(array(
                'Type'   => 'EMAIL_EXISTS',
                'Fields' => [ 'Email' => 'WRONG' ],
                'Message' => 'Email already exists'
            ));
        }
        return $result;
    }

    public function execute($params)
    {
        $newUser = new \Engine\Users();
        $newUser->fromArray($params);
        $newUser->save();

        return [
            'Status' => 1,
            'User'   => $params['Name']
        ];
    }
}
