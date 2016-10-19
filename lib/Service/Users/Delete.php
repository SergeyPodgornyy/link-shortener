<?php

namespace Service\Users;

class Delete extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Id' => [ 'required', 'positive_integer' ],
        ];

        $result = \Service\Validator::validate($params, $rules);

        if ($this->getUser()->getId() == $params['Id']) {
            throw new \Service\X([
                'Type'    => 'SELF_DELETE',
                'Fields'  => [ 'Id' => 'WRONG_ID' ],
                'Message' => 'Cannot delete himself'
            ]);
        }

        return $result;
    }

    public function execute($params)
    {
        $self = $this;
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

        $user->delete();

        return [
            'Status' => 1
        ];
    }
}
