<?php

return [
    'settings' => [

        // set to false in production
        'displayErrorDetails' => IS_DEVELOPMENT,

        'site' =>[
            'name'          => 'SlimGAE',
        ],

        // template settings
        'view' => [
          'template_path' => __DIR__ . '/../Views',
          'twig' => [
            'cache' => FALSE,
            'debug' => IS_DEVELOPMENT,
          ],
        ],
    ],
];
