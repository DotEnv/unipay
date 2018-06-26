<?php

/*
* This file is part of the Dotenv UniPay package.
*
* (c) Tiago Perrelli <tiagoyg@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

return [

    /**
     * Default route names
     */
    'routes' => [

        'gateway' => [
            'name' => 'gateways'
        ],
    
        'marchant' => [
            'name' => 'marchants'
        ]
    ],

    /**
     * Default migrations names
     */
    'databases' => [
        'gateway'  => 'gateways',
        'merchant' => 'merchants',
    ],

    /**
     * Default template name
     */
    'template' => [
        
        'name' => 'adminlte::page'
    ]
];