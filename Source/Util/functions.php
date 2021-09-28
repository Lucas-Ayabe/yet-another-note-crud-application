<?php

namespace Source\Util;

function mapRequestMultipleDataToArray(array $input): array
{
    $keys = array_keys($input);
    $fields = array_map(fn ($key) => $input[$key], $keys);

    return array_map(
        fn ($_, ...$args) => array_combine($keys, $args),
        $keys,
        ...$fields
    );
}
