<?php

return [
    /**
     * Public Key From Paystack Dashboard
     *
     */
    'PUBLIC_KEY' => getenv('PAYSTACK_PUBLIC_KEY'),

    /**
     * Secret Key From Paystack Dashboard
     *
     */
    'SECRET_KEY' => getenv('PAYSTACK_SECRET_KEY'),

    /**
     * Paystack Payment URL
     *
     */
    'PAYMENT_URL' => getenv('PAYSTACK_PAYMENT_URL'),

    /**
     * Optional email address of the merchant
     *
     */
    'MERCHANT_URL' => getenv('MERCHANT_EMAIL'),

     /**
     * callback url
     *
     */
    'CALLBACK_URL' => getenv('PAYSTACK_CALLBACK_URL'),
];
