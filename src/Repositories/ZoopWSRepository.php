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
use DotEnv\UniPay\Exceptions\UniPayException;

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
     * List all merchants
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

            // dd($response);

            $result = json_decode($response->getBody(), true);

            if (isset($result['error'])) throw new \Exception($result['error']['message']);

            dd($response, $result);
            

        } catch (ClientException $e) {

            $message = json_decode($e->getResponse()->getBody(), true);

            dd($message, 'ce');

        } catch (ZoopException $e) {

            $message = $e->getMessage();

            dd($message);
            
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

        } catch (UniPayException $e) {

            dd('update exception ', $e);
        }

    }

    /**
     * Set data
     *
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
}