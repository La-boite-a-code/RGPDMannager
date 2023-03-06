<?php
return [
    'user_model'    =>  'App\Models\User',

    'pdo_name'      =>  'John Doe',
    'pdo_email'     =>  'john.doe@mysite.com',

    'routes'        =>  [
        'terms_prefix'      =>  'terms',
        'consents_prefix'   =>  'consents',
        'contact_prefix'    =>  'contact',

        'contact'           =>  [
            'pdo'               =>  'pdo',
            'data'              =>  'data-rectification',
            'forgot'            =>  'forgot-data',
            'request'           =>  'request-data',
        ],
    ]
];