<?php

use QuantumTecnology\PerPageTrait\Enums\PaginationEnum;

return [
    'default' => env('DEFAULT_PAGINATION', PaginationEnum::PAGINATION_SIMPLE),

    'types' => [
        'simple' => [
            'class' => Illuminate\Pagination\SimplePaginator::class,
        ],
        'length' => [
            'class' => Illuminate\Pagination\LengthAwarePaginator::class,
        ],
        'none' => [
            'class' => Illuminate\Database\Eloquent\Collection::class,
        ],
    ],

    'max_per_page' => env('MAX_PER_PAGE', 50),
    'min_per_page' => env('MIN_PER_PAGE', 1),

    'parameters' => [
        'page'     => env('PAGE_PARAMETER', 'page'),
        'per_page' => env('PER_PAGE_PARAMETER', 'per_page'),
    ],
];
