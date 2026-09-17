<?php

declare(strict_types=1);

return [
    'enabled' => env('BOOST_ENABLED', true),
    'enforce_tests' => false,
    'rules' => [
        'enabled' => env('BOOST_RULES_ENABLED', true),
        'scoped_guidelines' => env('BOOST_RULES_SCOPED_GUIDELINES', false),
    ],
    'guidelines' => [
        'exclude' => [],
    ],
    'skills' => [
        'exclude' => [],
    ],
];
