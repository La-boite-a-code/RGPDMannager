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
        'files'              =>  'nullable|file|max:1024|mimes:pdf,txt,jpg,png,jpeg',
    ],

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