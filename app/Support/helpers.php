<?php

if (! function_exists('collect_esi')) {
    function esi_collect(array $data, string $keyBy = 'id') {
        return collect($data)->recursive()->keyBy($keyBy);
    }
}