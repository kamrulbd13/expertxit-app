<?php

return [

    // Optionally disable CAPTCHA entirely via .env
    'disable' => env('CAPTCHA_DISABLE', false),

    // Characters used in CAPTCHA
    'characters' => [
        '2', '3', '4', '6', '7', '8', '9',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'
    ],

    // Default preset config (simple classic)
    'default' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => false,
        'lines' => 0,
        'contrast' => -5,
        'angle' => 0,
    ],

    'flat' => [
        'length' => 5, // ← Make sure it's 5
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'lines' => 4,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => [
            '#2c3e50', '#c0392b', '#16a085', '#8e44ad', '#303f9f', '#f57c00', '#795548'
        ],
        'contrast' => -5,
    ],

    'math' => [
        'length' => 5, // ← Set to 5
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'math' => true,
        'lines' => 4,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => [
            '#2c3e50', '#c0392b', '#16a085', '#8e44ad', '#303f9f', '#f57c00', '#795548'
        ],
        'contrast' => -5,
    ],
    // Easy-to-read "flat" CAPTCHA (text-based, same style as math)
    'flat' => [
        'length' => 6,
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'lines' => 4,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => [
            '#2c3e50', '#c0392b', '#16a085', '#8e44ad', '#303f9f', '#f57c00', '#795548'
        ],
        'contrast' => -5,
    ],

    // Minimal size version (not recommended for forms)
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],

    // Inverted color version (for dark UIs)
    'inverse' => [
        'length' => 6,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ]
];
