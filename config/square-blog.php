<?php

return [
    'api_url' => env('SQUARE_API_URL', 'https://candidate-test.sq1.io'),
    'use_mocks' => env('SQUARE_USE_TEST_MOCKS', true),
    'per-page' => env('SQUARE_POSTS_PER_PAGE', 6),
    'system_admin_email' => env('SQUARE_ADMIN_EMAIL', 'admin@admin.com')
];
