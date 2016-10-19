<?php

namespace Settings;

class ShowTest extends \LocalWebTestCase
{
    public function testPositive()
    {
        $this->get('/api/v1/settings');

        $response = $this->client->response;
        $responseBody = json_decode($response->body(), 1);

        $responseStatus = json_decode($response->status(), 1);
        $this->assertEquals(200, $responseStatus);

        $rules = [
            'Status'    => ['required', ['equals' => 1]],
            'Settings'  => ['required', ['nested_object' => [
                    'UserId'    => ['required', 'not_empty', 'positive_integer', [ 'min_number' => 1 ]],
                    'Email'     => ['required', 'not_empty', 'email', ['max_length' => 64]],
                    'FirstName' => ['required', 'not_empty', ['max_length' => 64]],
                    'LastName'  => ['required', 'not_empty', ['max_length' => 64]]
                ] ] ]
        ];

        $this->assertLIVR($responseBody, $rules);
    }
}
