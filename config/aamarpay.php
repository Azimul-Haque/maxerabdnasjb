<?php

return [
    'store_id' => env('AAMARPAY_STORE_ID','bjsexam'),
    'signature_key' => env('AAMARPAY_KEY','24b07a0a021706e13b79880bcf7c4033'),
    'sandbox' => env('AAMARPAY_SANDBOX', false),
    'redirect_url' => [
        'success' => [
            'route' => env('AAMARPAY_SUCCESS_ROUTE','index.payment.success') // payment.success
        ],
        'cancel' => [
            'route' => env('AAMARPAY_SUCCESS_ROUTE','') // payment/cancel or you can use route also
        ],
        'failed' => [
            'route' => env('AAMARPAY_SUCCESS_ROUTE','') // payment/cancel or you can use route also
        ]
    ]
];
