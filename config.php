<?php

return [
    'baseUrl'         => 'http://localhost:8000',
    'trailingSlashes' => false,
    'production'      => false,

    'collections' => [
        'pages' => [
            'sort' => '-date',
            'path' => '{filename}'
        ]
    ],

    'active' => function ($page, $section) {
        return \Illuminate\Support\Str::contains($page->getPath(), $section) ? 'active' : '';
    },

    'url' => function ($page, $path) {
        return rtrim($page->baseUrl, '/') . '/' . $path . ($page->trailingSlashes ? '/' : '');
    }
];
