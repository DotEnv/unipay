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
use DotEnv\UniPay\Models\Gateway;

class Seller extends Model
{
    use SoftDeletes;

    /**
     * Model attributes
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'fields', 'type', 'reference', 'gateway_id'
    ];

    /**
     * Date attributes
     *
     * @var array
     */
    protected $dates = [
        'opened_at', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Casteable attributes
     * 
     * @var array
     */
    protected $casts = [
        'fields' => 'array'
    ];

    /**
     * Appendeable fields
     *
     * @var array
     */
    protected $appends = [
        'seeFields'
    ];

    /**
     * Belongs to relationship
     *
     * @return Illuminate\Database\Eloquent\BelongsTo
     */
    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
   
    /**
     * See fields attribute
     *
     * @return void
     */
    public function getSeeFieldsAttribute()
    {
        return json_decode($this->attributes['fields']);    
    }
}