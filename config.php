<?php

return [
    'baseUrl'    => 'http://jigsaw.test',
    'production' => false,

    'collections' => [
        'pages' => [
            'sort' => '-date',
            'path' => '{filename}'
        ]
    ],

    'active' => function ($page, $section) {
        return \Illuminate\Support\Str::contains($page->getPath(), $section) ? 'active' : '';
    },
];
