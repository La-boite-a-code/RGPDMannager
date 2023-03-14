<?php
return [
    'user_model'        =>  'App\Models\User',

    /**
     * PDO Informations
     */
    'pdo_name'          =>  'John Doe',
    'pdo_email'         =>  'john.doe@mysite.com',

    /**
     * Enable Global Contact Form
     */
    'enable_contact'    =>  true,

    /**
     * Enable Global Contact Form
     * ------------
     * To enable Google Recaptcha, you need to add your site key and secret key in .env file
     * with the following keys : RECAPTCHA_SITE_KEY and RECAPTCHA_SECRET_KEY
     * ------------
     * Don't forget to enable Google Recaptcha in your Google Account
     * ------------
     * Don't forget to add this lines in your config/services.php file :
     *  'recaptcha' =>  [
     *      'key'       =>  env('RECAPTCHA_SITE_KEY'),
     *      'secret'    =>  env('RECAPTCHA_SECRET_KEY'),
     *  ]
     */
    'enable_recaptcha'  =>  true,

    /**
     * Use Markdown for Terms and Conditions
     */
    'use_markdown'      =>  true,

    /**
     * Contact fields
     * ------------
     * Available Fields : name, topic, email, phone_number, message, file
     */
    'contact_fields'    =>  [
        'name',
        'topic',
        'email',
        'phone_number',
        'message',
        'files',
    ],

    /**
     * Contact Rules
     * ------------
     * Available Fields : name, topic, email, phone_number, message
     */
    'contact_rules'   =>  [
        'name'              =>  'required|string',
        'topic'             =>  'nullable|string',
        'email'             =>  'required|string|email',
        'phone_number'      =>  'string|nullable|max:10',
        'message'           =>  'required|string',
        'files.*'            =>  'nullable|file|max:1024|mimes:pdf,txt,jpg,png,jpeg',
    ],

    /**
     * Field to order Terms page
     */
    'order_terms_field' => 'id',

    /**
     * Direction to order Terms page
     */
    'order_terms_direction' => 'asc',

    /**
     * Routes
     */
    'routes'            =>  [
        'terms_prefix'      =>  'terms',
        'consents_prefix'   =>  'consents',
        'contact_prefix'    =>  'contact',
        'contact_route'    =>  'contact',

        'contact'           =>  [
            'pdo'               =>  'pdo',
            'data'              =>  'data-rectification',
            'forgot'            =>  'forgot-data',
            'request'           =>  'request-data',
        ],
    ]
];