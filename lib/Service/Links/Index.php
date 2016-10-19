<?php

namespace Service\Links;

class Index extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Search'    => [ 'max_length' => 100 ],

            'Limit'     => [ 'integer', ['min_number' => 0] ],
            'Offset'    => [ 'integer', ['min_number' => 0] ],

            'SortField' => [ 'one_of' => ['Id', 'Original', 'AddTime'] ],
            'SortOrder' => [ 'one_of' => ['asc', 'desc'] ]
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $params = $this->defaultParams($params, 'Id');

        $searchFields = ['Original', 'Shorted'];

        $query = \Engine\LinksQuery::create()
            ->searchByFields($searchFields, $params['Search'])
                ->filterByAccessibility('public')
                ->_or()
                ->filterByUserId($this->getUserId())
            ->orderBy($params['SortField'], $params['SortOrder']);

        $totalCount = \Engine\LinksQuery::create()->count();
        $filteredCount = $query->count();

        $links = $query
            ->limit($params['Limit'])
            ->offset($params['Offset'])
            ->find();

        $rows= [];
        foreach ($links as $link) {
            $row = [
                'Id'            => $link->getId(),
                'Origin'        => $link->getOriginal(),
                'ShortLink'     => $this->config()['shortLinkAccessRoute'] . '/' . $link->getShorted(),
                'DomainLink'    => $this->config()['baseUrl']
                    . $this->config()['shortLinkAccessRoute'] . '/' . $link->getShorted(),
                'CreatedBy'     => $link->getUsers()->getFirstName() . ' ' . $link->getUsers()->getLastName(),
                'Accessibility' => $link->getAccessibility(),
                'AddTime'       => $link->getAddTime(),
                'Views'         => count($link->getLinkViewss()),
            ];
            array_push($rows, $row);
        }

        return [
            'Status'        => 1,
            'Total'         => $totalCount,
            'FilteredCount' => $filteredCount,
            'Links'         => $rows,
        ];
    }
}
