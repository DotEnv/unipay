<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DotEnv\UniPay\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;

    /**
     * Model attributes
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'birth', 'cpf',
        'state_id', 'city', 'postal', 'neighborhood', 'address', 'number', 'complement', 'reference',
        'company', 'social_name', 'cnpj', 'opened_at', 'company_phone', 
        'company_state_id', 'company_city', 'company_cep', 'company_neighborhood', 'company_address', 'company_number',
        'company_complement', 'company_site',
    ];

    /**
     * Date attributes
     *
     * @var array
     */
    protected $dates = [
        'opened_at', 'created_at', 'updated_at', 'deleted_at'
    ];
}