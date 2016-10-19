<?php

namespace Service\Users;

class Index extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Search'    => [ 'max_length' => 100 ],

            'Limit'     => [ 'integer', ['min_number' => 0] ],
            'Offset'    => [ 'integer', ['min_number' => 0] ],

            'SortField' => [ 'one_of' => ['Id', 'Email'] ],
            'SortOrder' => [ 'one_of' => ['asc', 'desc'] ]
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $params = $this->defaultParams($params, 'Id');

        $searchFields = ['Email', ['FirstName', 'LastName']];

        $query = \Engine\UsersQuery::create()
            ->searchByFields($searchFields, $params['Search'])
            ->orderBy($params['SortField'], $params['SortOrder']);

        $totalCount = \Engine\UsersQuery::create()->count();
        $filteredCount = $query->count();

        $users = $query
            ->limit($params['Limit'])
            ->offset($params['Offset'])
            ->find();

        $rows= [];
        foreach ($users as $user) {
            $row = [
                'Id'          => $user->getId(),
                'FirstName'   => $user->getFirstName(),
                'LastName'    => $user->getLastName(),
                'Email'       => $user->getEmail(),
                'Status'      => $user->getStatus(),
            ];
            array_push($rows, $row);
        }

        return [
            'Status'        => 1,
            'Total'         => $totalCount,
            'FilteredCount' => $filteredCount,
            'Users'         => $rows,
        ];
    }
}
