<?php

/**
 * List of api paths considered deprecated and shut down at specific time.
 * You may provide any Carbon-compatible datetime format,
 * but timezone always considered UTC+0 (GMT) [RFC7231]
 *
 * @link https://datatracker.ietf.org/doc/html/rfc8594
 */

// e.g. 'api/v1/products/create-product' - Concrete path
// e.g. '*/last-uri-unit'                - All uri's that end on '/last-uri-unit';
// e.g. 'api/v1/*'                       - All uri's that begin with 'api/v1/'
// e.g. 'api/v1/products/*/update'       - Paths with parameter: 'api/v1/products/1234/update'

return [
    'paths' => [
        //'api/v1/*' => '02 Feb 2022',
    ]
];