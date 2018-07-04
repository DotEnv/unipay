<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DotEnv\UniPay\Repositories;

use DotEnv\UniPay\Contracts\GatewayWSRepository;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use DotEnv\UniPay\Exceptions\ZoopException;

class ZoopWSRepository implements GatewayWSRepository
{
    /**
     * Cliebt
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Auth username
     *
     * @param string
     */
    protected $username;

    /**
     * Class constructor
     *
     * @param GuzzleHttp\Client $client
     * @param string $username
     */
    public function __construct(Client $client, $username)
    {
        $this->client   = $client;
        $this->username = $username;
    }

    /**
     * List all customers
     * 
     * @return
     */
    public function getAllCustomers()
    {
        $response = $this->client->get('buyers', [
            'auth' => [
                $this->username, null
            ]
        ]);

        return $response;
    }

    /**
     * Create a customer
     *
     * @param $array $data
     * @return void
     */
    public function createCustomer($data)
    {

    }    

    /**
     * List all sellers
     * 
     * @return
     */
    public function getAllSellers()
    {
        $response = $this->client->get('sellers', [
            'auth' => [
                $this->username, null
            ]
        ]);

        $result = [];

        if ($response->getStatusCode() == 200) {
            
            $result = json_decode($response->getBody());

            dd($result->total);

        }

        dd($response->getBody()->getData());

        return $response;
    }

    /**
     * Create a seller
     *
     * @param $array $data
     * @return string|null
     */
    public function createSeller($data)
    {
        $data = $this->setSellerData($data);
        
        try {
            
            $response = $this->client->post('sellers/businesses', [
                'form_params' => $data,
                'auth' => [
                    $this->username, null
                ]
            ]);
    
            if ($response->getStatusCode() == 201) {

                $result = json_decode($response->getBody(), true);

                return $result['id'];
            }

            return null;

            // $result = json_decode($response->getBody(), true);
            // if (isset($result['error'])) throw new \Exception($result['error']['message']);
            // dd($response, $result);
        
        } catch (ClientException $e) {

            $message = json_decode($e->getResponse()->getBody());

            throw new ZoopException($message->error->message, $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Update seller
     *
     * @param array $data
     * @return void
     */
    public function updateSeller($data)
    {
        $id   = $data['id'];
        $data = $this->setSellerData($data);

        try {

            $response = $this->client->post('sellers/businesses/' . $id, [
                'form_params' => $data,
                'auth' => [
                    $this->username, null
                ]
            ]);

            $r = json_decode($response->getBody(), true);

            dd($r);

        } catch (ZoopException $e) {

            dd('update exception ', $e);
        }
    }

    /**
     * Create a split payment
     *
     * @param array $data
     * @return void
     */
    public function createSplitPayment($data)
    {
        $orderData = $this->setOrderData($data);
        $splitData = $this->setSplitData($data);

        try {

            $response = $this->client->post('cards/tokens', [
                'form_params' => $orderData,
                'auth' => [
                    $this->username, null
                ]
            ]);

            if ($response->getStatusCode() == 201) {

                $responseData       = json_decode($response->getBody(), true);
                $splitData['token'] = $responseData['id'];

                $responseSplit = $this->client->post('transactions', [
                    'form_params' => $splitData,
                    'auth' => [
                        $this->username, null
                    ]
                ]);

                if ($responseSplit->getStatusCode() == 201) {

                    $result = json_decode($responseSplit->getBody(), true);

                    return $result['id'];
                }
            }

            return null;

            dd($response->getStatusCode());

            $r = json_decode($response->getBody(), true);

            dd($r);

        } catch (ClientException $e) {
            
            $message = json_decode($e->getResponse()->getBody());

            throw new ZoopException($message->error->message, $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Create a payment
     *
     * @param array $data
     * @return void
     */
    public function createPayment($data)
    {
        // $response = $this->client->post('');
    }

    /**
     * Create an order
     *
     * @param array $data
     * @return void
     */
    private function createOrder($data)
    {


        
    }

    /**
     * Set seller data
     * 
     * @param array $data
     * @return void
     */
    private function setSellerData($data)
    {
        return [
            'owner' => [
                'first_name'   => $data['person']['first_name'],
                'last_name'    => $data['person']['last_name'],
                'email'        => $data['person']['email'],
                'phone_number' => $data['person']['phone'],
                'birthdate'    => $data['person']['birth'],
            ],
            'owner_address' => [
                'line1'        => $data['person']['address'],
                'neighborhood' => $data['person']['neighborhood'],
                'city'         => $data['person']['city'],
                'state'        => $data['person']['state'],
                'postal_code'  => $data['person']['postal'],
            ],
            'business_name'    => $data['company']['name'],
            'business_phone'   => $data['company']['phone'],
            'business_website' => $data['company']['site'],
            'business_address' => [
                'line1'        => $data['company']['address'],
                'neighborhood' => $data['company']['neighborhood'],
                'city'         => $data['company']['city'],
                'state'        => $data['company']['state'],
                'postal_code'  => $data['company']['postal'],
                'opening_date' => $data['company']['opened_at']
            ],
            'ein'        => $data['company']['cnpj'],
            'status'     => 'pending', 
            'created_at' => now()
        ];
    }

    /**
     * Set order data
     *
     * @param array $data
     * @return array
     */
    private function setOrderData($data)
    {
        return [
            'holder_name'      => $data['holder_name'],
            'expiration_month' => $data['expiration_month'],
            'expiration_year'  => $data['expiration_year'],
            'security_code'    => $data['security_code'],
            'card_number'      => $data['card_number'],
        ];
    }

    /**
     * Set split data
     *
     * @param array  $data
     * @return array $split
     */
    private function setSplitData($data)
    {
        $split = [
            'amount'       => $data['amount'],
            'currency'     => $data['currency'],
            'description'  => $data['description'],
            'payment_type' => $data['payment_type'],
            'on_behalf_of' => $data['recipient'],
        ];

        foreach ($data['split'] as $dt)
        {
            $split['split_rules'][] = [
                'amount'                => $dt['amount'],
                'percentage'            => $dt['percentage'],
                'liable'                => $dt['chargeback_liable'],
                'recipient'             => $dt['recipient'],
                'charge_processing_fee' => $dt['charge_fee'],
            ];
        }

        return $split;
    }
}