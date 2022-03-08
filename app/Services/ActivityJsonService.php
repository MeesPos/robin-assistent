<?php

namespace App\Services;

class ActivityJsonService
{
    public static function getAll(): array
    {
        $activities = [];

        foreach (scandir(resource_path('json')) as $file) {
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

    public static function getJson($unique_key)
    {
        return json_decode(
            file_get_contents(
                resource_path("json/$unique_key.json")
            )
        );
    }
}
