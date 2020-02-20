<?php

return [
    'required' => ':attribute ist ein Pflichtfeld.',
    'url' => ':attribute enthält keine gültige URL.',
    'image' => ':attribute muss eine Bilddatei sein.',

    'custom' => [
        'in' => [
            'type' => 'Bitte wähle entweder Whitelist oder Blacklist aus.'
        ]
    ],

    'attributes' => [
        'url' => 'Podcast Feed-URL',
        'type' => 'Filter-Typ',
        'filter' => 'Filter',
        'custom_title' => 'Benutzerdefinierter Titel',
        'custom_artwork' => 'Benutzerdefinierte Grafik'
    ]

];
