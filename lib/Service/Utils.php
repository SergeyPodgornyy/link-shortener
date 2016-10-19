<?php

namespace Service;

trait Utils
{
    public function defaultParams($params, $field)
    {
        $defaults = [
            'Search' => '',

            'Limit'  => 10,
            'Offset' => 0,

            'SortField' => $field,
            'SortOrder' => 'asc'
        ];
        return array_merge($defaults, $params);
    }
}
