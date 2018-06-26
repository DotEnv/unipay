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
use DotEnv\UniPay\Contracts\GatewayRepository;

class GatewayController extends Controller
{
    /**
     * Gateway repository
     *
     * @var GatewayRepository
     */
    protected $repository;

    /**
     * Class constructor
     * 
     * @param GatewayRepository
     */
    public function __construct(GatewayRepository $repository)
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
        $gateways = $this->repository->getAll();

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
        $rules = [
            'name'       => 'required|max:50',
            'account_id' => 'max:70'
        ];
        
        return Validator::make($data, $rules);
    }
}