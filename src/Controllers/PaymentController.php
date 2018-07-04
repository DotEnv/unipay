<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DotEnv\UniPay\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use DotEnv\UniPay\Contracts\SellerRepository;
use DotEnv\UniPay\Contracts\GatewayRepository;
use DotEnv\UniPay\Contracts\GatewayWSRepository;

class PaymentController extends Controller
{
    /**
     * Gateway repository
     *
     * @var GatewayRepository
     */
    protected $repository;

    /**
     * Seller repository
     *
     * @var SellerRepository
     */
    protected $sellerRepository;

    /**
     * Gateway WS repository
     *
     * @var GatewayWsRepository
     */
    protected $gatewayWsRepository;

    /**
     * Class constructor
     * 
     * @param GatewayRepository
     */
    public function __construct(
        GatewayRepository $repository,
        SellerRepository $sellerRepository,
        GatewayWSRepository $gatewayWsRepository
        )
    {
        $this->repository          = $repository;
        $this->sellerRepository    = $sellerRepository;
        $this->gatewayWsRepository = $gatewayWsRepository;
    }

    /**
     * Display an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       
        // $gateways = $this->repository->getAll();

        $seller2 = $this->sellerRepository->findByID(2);
        $seller3 = $this->sellerRepository->findByID(3);

        $data = [
            'amount'       => 100,
            'currency'     => 'BRL',
            'description'  => 'PHP Zoop Payment',
            'payment_type' => 'credit',
            'holder_name'      => 'Tiago Perrelli',
            'expiration_month' => '03',
            'expiration_year'  => '2020',
            'security_code'    => '876',
            'card_number'      => '5577270004286630',
            'recipient'        => $seller2->reference,
            'split' => [
                [
                    'amount'            => 0,
                    'percentage'        => 50,
                    'seller_id'         => 1,
                    'charge_fee'        => 0,
                    'chargeback_liable' => 1,
                    'recipient'         => $seller3->reference
                ]
            ]
        ];

        $this->gatewayWsRepository->createSplitPayment($data);

        return view('unipay::gateways.index', compact('gateways'));
    }

    /**
     * Create an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('unipay::gateways.create');
    }

    /**
     * Store an application resource
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->repository->create($request->all());

        return redirect(config('unipay.routes.gateway.name', 'gateways'))->with('created', 'Resource was created sucessfully');
    }

    /**
     * Show an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $gateway = $this->repository->findByID($id);

        return view('unipay::gateways.edit', compact('gateway'));
    }
    
    /**
     * Create an application resource
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gateway = $this->repository->findByID($id);

        $this->validator($request->all())->validate();

        $this->repository->update($gateway, $request->all());

        return redirect(config('unipay.routes.gateway.name', 'gateways'))->with('updated', 'Resource was updated sucessfully');       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $tbName = config('unipay.databases.seller', 'sellers');

        $rules = [
            'amount'         => 'required|max:50',
            'description'    => 'max:100',
            'currency'       => 'required|max:3',
            'payment_type'   => 'required|max:20',
            'transaction_id' => 'required|max:100',
            'seller_id'      => 'required|exists:' . $tbName . ',id'
        ];
        
        return Validator::make($data, $rules);
    }
}