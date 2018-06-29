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

class SellerController extends Controller
{
    /**
     * Seller repository
     *
     * @var SellerRepository
     */
    protected $repository;

    /**
     * Gateway repository
     *
     * @var GatewayRepository
     */
    protected $gatewayRepository;

    /**
     * Gateway Web Service Repository
     *
     * @var GatewayWsRepository
     */
    protected $gatewayWsRepository;

    /**
     * Class constructor
     * 
     * @param SellerRepository $repository
     * @param GatewayRepository $gatewayRepository
     * @param SellerRepoGatewayWSRepositorysitory $gatewayWsRepository
     */
    public function __construct(
        SellerRepository $repository,
        GatewayRepository $gatewayRepository,
        GatewayWSRepository $gatewayWsRepository
        )
    {
        $this->repository          = $repository;
        $this->gatewayRepository   = $gatewayRepository;
        $this->gatewayWsRepository = $gatewayWsRepository;
    }

    /**
     * Display an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sellers = $this->repository->getAll();

        // $this->gatewayWsRepository->getAllSellers();

        return view('unipay::sellers.index', compact('sellers'));
    }

    /**
     * Create an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $gateways = $this->gatewayRepository->getAll(false, false);
        
        return view('unipay::sellers.create', compact('gateways'));
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

        //ZOOP - type - individual,business
        //MOIP - type - CONSUMER,MERCHANT

        $request['first_name'] = isset($request['person']['first_name']) ? $request['person']['first_name'] : null;
        $request['last_name']  = isset($request['person']['last_name']) ? $request['person']['last_name'] : null;
        $request['email']      = isset($request['person']['email']) ? $request['person']['email'] : null;
        $request['type']       = 'business';
        $request['fields'] = [
            'person'  => $request->get('person'),
            'company' => $request->get('company'),
        ];

        $seller = $this->gatewayWsRepository->createSeller($request->all());

        $request['reference'] = isset($seller['id']) ? $seller['id'] : null;
        
        $this->repository->create($request->all());

        return redirect(config('unipay.routes.merchant.name', 'sellers'))->with('created', 'Resource was created sucessfully');
    }

    /**
     * Show an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $merchant = $this->repository->findByID($id);
        $gateways = $this->gatewayRepository->getAll(false, false);

        return view('unipay::sellers.edit', compact('merchant', 'gateways'));
    }
    
    /**
     * Create an application resource
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //ZOOP - type - individual,business
        //MOIP - type - CONSUMER,MERCHANT

        $merchant = $this->repository->findByID($id);

        $request['id'] = $id;

        $this->validator($request->all())->validate();

        $request['first_name'] = isset($request['person']['first_name']) ? $request['person']['first_name'] : null;
        $request['last_name']  = isset($request['person']['last_name']) ? $request['person']['last_name'] : null;
        $request['email']      = isset($request['person']['email']) ? $request['person']['email'] : null;
        $request['type']       = 'business';
        $request['fields'] = [
            'person'  => $request->get('person'),
            'company' => $request->get('company'),
        ];

        $this->repository->update($merchant, $request->all());

        if (!is_null($merchant->reference)) {

            $request['id'] = $merchant->reference;
            $seller = $this->gatewayWsRepository->updateSeller($request->all());
        }

        return redirect(config('unipay.routes.merchant.name', 'sellers'))->with('updated', 'Resource was updated sucessfully');       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $tbName    = config('unipay.databases.merchant', 'sellers');
        $tbGateway = config('unipay.databases.gateway', 'gateways');

        $id = isset($data['id']) ? $data['id'] : null;

        $rules = [
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'email'      => 'required|max:150|email|unique:' . $tbName . ',email,' . $id,
                        
            'person.cpf'          => 'required|max:15',
            'person.email'        => 'required|max:150|email|unique:' . $tbName . ',email,' . $id,
            'person.first_name'   => 'required|max:100',
            'person.last_name'    => 'required|max:100',
            'person.phone'        => 'required|max:15',
            'person.birth'        => 'required|date',
            'person.state'        => 'required|max:2',
            'person.city'         => 'required|max:50',
            'person.postal'       => 'required|max:9',
            'person.neighborhood' => 'required|max:50',
            'person.address'      => 'required|max:50',
            'person.number'       => 'required|max:30',
            'person.complement'   => 'required|max:50',
            'person.reference'    => 'required|max:50',
        
            'company.cnpj'         => 'max:18',
            'company.name'         => 'max:50',
            'company.social_name'  => 'max:50',
            'company.phone'        => 'max:15',
            'company.city'         => 'max:2',
            'company.city'         => 'max:50',
            'company.postal'       => 'max:9',
            'company.neighborhood' => 'max:50',
            'company.address'      => 'max:50',
            'company.number'       => 'max:30',
            'company.complement'   => 'max:50',
            'company.site'         => 'max:150',
            
            'gateway_id' => 'required|exists:' . $tbGateway . ',id'
        ];
        

        $data['first_name'] = isset($data['person']['first_name']) ? $data['person']['first_name'] : null;
        $data['last_name']  = isset($data['person']['last_name']) ? $data['person']['last_name'] : null;
        $data['email']      = isset($data['person']['email']) ? $data['person']['email'] : null;
        
        if (isset($data['company']['opened_at']) && !empty($data['company']['opened_at'])) {
            $rules['company.opened_at'] = 'date';
        }        
        
        return Validator::make($data, $rules);
    }
}