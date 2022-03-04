<?php

namespace App\Services;

class JsonService
{
    public static function getJson($unique_key)
    {
        $json = file_get_contents(resource_path("json/$unique_key.json"));

        return json_decode($json);
    }
}
