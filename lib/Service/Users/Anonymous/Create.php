<?php

namespace Service\Users\Anonymous;

class Create extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'FirstName'      => ['required', ['max_length' => 255]],
            'LastName'       => ['required', ['max_length' => 255]],
            'Email'          => ['required', 'email', 'to_lc'],
            'Password'       => ['required', ['min_length' => 6]],
            'PasswordRepeat' => ['required', ['equal_to_field' => 'Password', 'min_length' => 6]],
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $user = \Engine\UsersQuery::create()->findOneByEmail($params['Email']);

        if ($user) {
            throw new \Service\X\WrongAuthorization([
                'Type'      => 'EMAIL_EXISTS',
                'Fields'    => ['Email' => 'WRONG']
            ]);
        }

        $newUser = new \Engine\Users();
        $newUser->setFirstName($params['FirstName']);
        $newUser->setLastName($params['LastName']);
        $newUser->setEmail($params['Email']);
        $newUser->setPassword(password_hash($params['Password'], PASSWORD_BCRYPT));
        $newUser->save();

        return [
            'Status' => 1,
        ];
    }
}
