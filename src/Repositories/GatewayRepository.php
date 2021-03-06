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

use DotEnv\UniPay\Repositories\BaseRepository;
use DotEnv\UniPay\Contracts\GatewayRepository as GatewayRepositoryContract;

use DotEnv\UniPay\Models\Gateway;

class GatewayRepository extends BaseRepository implements GatewayRepositoryContract
{
    protected $model = Gateway::class;
}