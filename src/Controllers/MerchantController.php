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
use DotEnv\UniPay\Contracts\MerchantRepository;

class MerchantController extends Controller
{
    /**
     * Merchant repository
     *
     * @var MerchantRepository
     */
    protected $repository;

    /**
     * Class constructor
     * 
     * @param MerchantRepository
     */
    public function __construct(MerchantRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $merchants = $this->repository->getAll();

        return view('unipay::merchants.index', compact('merchants'));
    }

    /**
     * Create an application resource
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('unipay::merchants.create');
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

        return redirect(config('unipay.routes.marchant.name', 'merchants'))->with('created', 'Resource was created sucessfully');
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

        return redirect(config('unipay.routes.marchant.name', 'merchants'))->with('updated', 'Resource was updated sucessfully');       
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name'         => 'required|max:100',
            'email'        => 'required|max:150|email|unique:' . config('unipay.databases.merchants', 'merchants') . ',id',
            'phone'        => 'required|max:15',
            'birth'        => 'required|date',
            'cpf'          => 'required|max:15',
            'city'         => 'required|max:50',
            'postal'       => 'required|max:9',
            'neighborhood' => 'required|max:50',
            'address'      => 'required|max:50',
            'number'       => 'required|max:30',
            'complement'   => 'required|max:50',
            'reference'    => 'required|max:50',
            'company'      => 'max:50',
            'social_name'  => 'max:50',
            'cnpj'         => 'max:18',
            'state_id'     => 'required',
            'page_id'      => 'required',
            'company_phone'  => 'max:15',
            'company_city'   => 'max:50',
            'company_postal' => 'max:9',
            'company_neighborhood' => 'max:50',
            'company_address' => 'max:9',
            'company_number' => 'max:30',
            'company_complement' => 'max:50',
            'company_site' => 'max:150',
            'company_state_id' => 'required',
            'opened_at' => 'date',
        ];
        
        return Validator::make($data, $rules);
    }
}