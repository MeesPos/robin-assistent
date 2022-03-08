<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Services\ActivityJsonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ActivityController extends Controller
{
    public function create(Request $request): \Inertia\Response
    {
        return Inertia::render('Activities/DateTimeInfo', [
            'steps' => json_decode($request->get('activity')),
            'client_id' => $request->get('client_id')
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validated();

        return Activity::query()
            ->create($validated);
    }

    public function steps($unique_key, $client_id)
    {
        return Inertia::render('Activities/Steps', [
            'activity' => ActivityJsonService::getJson($unique_key),
            'client_id' => $client_id
        ]);
    }

    public function dateTimeInfo(Request $request)
    {
        return Redirect::to(route('activity.create', [
            'activity' => json_encode($request->get('activity')),
            'client_id' => $request->get('client_id')
        ]));
    }

    public function selectActivity()
    {
        return Inertia::render('Activities/Create', [
            'activities' => ActivityJsonService::getAll(),
            'client_id' => Client::query()->first()->getKey()
        ]);
    }
}
