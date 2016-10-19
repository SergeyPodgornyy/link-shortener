<?php

namespace Sessions;

class CreateTest extends \LocalWebTestCase
{
    public function testPositive()
    {
        $params =  [
            'Email'     => 'test@mail.com',
            'Password'  => '12passw0rd34',
        ];

        $this->post('/api/v1/sessions', $params);

        $response = $this->client->response;
        $responseBody = json_decode($response->body(), 1);

        $responseStatus = json_decode($response->status(), 1);
        $this->assertEquals(200, $responseStatus);

        $rules = [
            'status'    => ['required', ['equals' => 1]]
        ];

        $this->assertLIVR($responseBody, $rules);
    }

    public function testNegativeWrongEmail()
    {
        $params =  [
            'Email'     => 'admin@mail.net',
            'Password'  => '12passw0rd34',
        ];

        $this->post('/api/v1/sessions', $params);

        $response = $this->client->response;
        $responseBody = json_decode($response->body(), 1);

        $responseStatus = json_decode($response->status(), 1);
        $this->assertEquals(200, $responseStatus);

        $rules = [
            'Error' => ['required', ['nested_object' => [
                'Type'   => ['required', ['equals' => 'WRONG_EMAIL']],
                'Fields' => ['required', ['nested_object' => [
                    'Email'     => ['required', ['equals' => 'INCORRECT']],
                    'Password'  => ['required', ['equals' => 'INCORRECT']]
                ] ] ]
            ]]]
        ];

        $this->assertLIVR($responseBody, $rules);
    }
}
