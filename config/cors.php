<?php

return [
    'paths' => ['api/*'], // Zezwól na dostęp do API
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Możesz ograniczyć do swojej domeny
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
