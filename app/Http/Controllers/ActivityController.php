<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Task;
use App\Services\ActivityJsonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ActivityController extends Controller
{
    public function create(Request $request): \Inertia\Response
    {
        return Inertia::render('Activities/DateTimeInfo', [
            'activity' => json_decode($request->get('activity')),
            'client_id' => $request->get('client_id')
        ]);
    }

    public function store(CreateActivityRequest $request)
    {
        $validated = $request->validated();

        $activity = Activity::query()
            ->create([
                'client_id' => $validated['client_id'],
                'name' => $validated['activity']['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'start_time' => $validated['start_time'],
                'repeat' => $validated['repeat'],
                'days' => $validated['days']
        ]);

        foreach ($request->get('activity')['steps'] as $key => $step) {
            Task::query()
                ->create([
                    'activity_id' => $activity->getKey(),
                    'position' => $key,
                    'name' => $step['name'],
                    'image' => $step['image'],
                    'duration' => $step['duration'],
                    'sound' => $step['sound'],
                    'repeat' => $step['repeat']
                ]);
        }

        return Redirect::route('dashboard');
    }

    public function steps($unique_key, $client_id)
    {
        return Inertia::render('Activities/Steps', [
            'activity' => ActivityJsonService::getJson($unique_key),
            'client' => Client::query()
                ->find($client_id)
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
            'client' => Client::query()->first()
        ]);
    }
}
