<?php

namespace Tests\Feature;

use App\Enums\DaysEnum;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CreateActivityTest extends TestCase
{
    /** @test */
    public function it_can_make_an_activity()
    {
        $client = Client::factory()->create();

        $this->post('/activity', $data = [
            'client_id' => $client->getKey(),
            'name' => 'Test name',
            'start_date' => Carbon::now()->addDay()->toDateString(),
            'end_date' => Carbon::now()->addDays(2)->toDateString(),
            'start_time' => Carbon::now()->addHour()->toTimeString(),
            'end_time' => Carbon::now()->addHours(2)->toTimeString(),
            'days' => [
                DaysEnum::MONDAY->value,
                DaysEnum::WEDNESDAY->value,
                DaysEnum::SATURDAY->value
            ]
        ])->assertCreated();

        $this->assertDatabaseHas('activities', $data);
    }
}
