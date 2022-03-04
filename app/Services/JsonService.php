<?php

namespace App\Services;

class JsonService
{
    public static function getAll(): array
    {
        $files = scandir(resource_path('json'));

        $activities = [];

        foreach ($files as $file) {
            if($file !== "." && $file !== ".." && $file !== basename(__FILE__)) {
                $activity = json_decode(file_get_contents(resource_path("json/$file")));

                $activities[] = [
                    'name' => $activity->name,
                    'unique_key' => $activity->unique_key,
                    'image' => $activity->image
                ];
            }
        }

        return $activities;
    }

    public static function getJson($unique_key): array
    {
        $json = file_get_contents(resource_path("json/$unique_key.json"));

        return json_decode($json);
    }
}
