<?php

namespace Service\Links;

class Show extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Hash' => ['required', ['max_length' => 5]],
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $link = \Engine\LinksQuery::create()->findOneByShorted($params['Hash']);

        if (!count($link)) {
            throw new \Service\X([
                'Type'    => 'WRONG_HASH',
                'Fields'  => [ 'Hash' => 'WRONG_HASH' ],
                'Message' => 'Cannot find any link for hash = '.$params['Hash']
            ]);
        }

        $views = new \Engine\LinkViews();
        $linkData = [
            'LinkId'    => $link->getId(),
            'Ip'        => $this->getUserIp(),
            'UserAgent' => $this->getUserAgent(),
        ];
        $views->fromArray($linkData);
        $views->save();

        return [
            'Status' => 1,
            'Link'   => $link->getOriginal(),
        ];
    }
}
