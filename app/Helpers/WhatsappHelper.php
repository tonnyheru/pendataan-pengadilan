<?php

namespace App\Helpers;
use GuzzleHttp\Client as GuzzleClient;

class WhatsappHelper
{
    public static function sendSingleMessage($phone, $message)
    {
        try {
            $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
            $options = [
                'multipart' => [
                    [
                        'name' => 'device_id',
                        'contents' => '93ce715666c4811b544060462e10db8f'
                    ],
                    [
                        'name' => 'number',
                        'contents' => $phone,
                    ],
                    [
                        'name' => 'message',
                        'contents' => $message
                    ]
                ]
            ];
            $response = $client->postAsync('https://app.whacenter.com/api/send', $options)->wait();

            // return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // return ['error' => $e->getMessage()];
        }
    }

    public static function sendMultiMessage(Array $messages)
    {
        try {
            $client = new GuzzleClient([
                            'http_errors' => false
                        ]);
            foreach($messages as $message) {
                $phone = $message['phone'];
                $message = $message['message'];

                if (empty($phone) || empty($message)) {
                    continue; // Skip if phone or message is empty
                }
                $options = [
                    'multipart' => [
                        [
                            'name' => 'device_id',
                            'contents' => '93ce715666c4811b544060462e10db8f'
                        ],
                        [
                            'name' => 'number',
                            'contents' => $phone,
                        ],
                        [
                            'name' => 'message',
                            'contents' => $message
                        ]
                    ]
                ];
                $response = $client->postAsync('https://app.whacenter.com/api/send-multi', $options)->wait();
            }

            // return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // return ['error' => $e->getMessage()];
        }
    }

}
