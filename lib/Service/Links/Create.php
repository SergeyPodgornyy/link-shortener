<?php

namespace Service\Links;

class Create extends \Service\Base
{
    public function validate($params)
    {
        $rules = [
            'Link'  => ['required', 'url'],
            'Type'  => ['required', 'latin_string', ['one_of' => ['public', 'private']]],
        ];

        return \Service\Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        do {
            $shortLink = $this->generateRandomString();
        } while (!\Engine\LinksQuery::create()->findByShorted($shortLink));

        $data = [
            'Original'      => $params['Link'],
            'Shorted'       => $shortLink,
            'Accessibility' => $params['Type'],
            'UserId'        => $this->getUserId()
        ];

        $newLink = new \Engine\Links();
        $newLink->fromArray($data);
        $newLink->save();

        return [
            'Status' => 1,
            'Data'      => [
                'ShortLink'  => $this->config()['shortLinkAccessRoute'] . '/' . $shortLink,
                'DomainLink' => $this->config()['baseUrl'] . $this->config()['shortLinkAccessRoute'] . '/' . $shortLink
            ]
        ];
    }

    private function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
