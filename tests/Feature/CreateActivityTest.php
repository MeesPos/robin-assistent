<?php

namespace Tests\Feature;

use App\Enums\DaysEnum;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateActivityTest extends TestCase
{
    /** @test */
    public function it_can_make_an_activity()
    {
        $this->actingAs(User::factory()->create());

        $client = Client::factory()->create(['user_id' => Auth::id()]);

        $this->post('/activity', $data = [
            'client_id' => $client->getKey(),
            'name' => 'Test name',
            'start_date' => Carbon::now()->addDay()->toDateString(),
            'end_date' => Carbon::now()->addDays(2)->toDateString(),
            'start_time' => Carbon::now()->addHour()->toTimeString(),
            'end_time' => Carbon::now()->addHours(2)->toTimeString(),
            'days' => json_encode([
                DaysEnum::MONDAY->value,
                DaysEnum::WEDNESDAY->value,
                DaysEnum::SATURDAY->value
            ])
        ])->assertCreated();

        $this->assertDatabaseHas('activities', $data);
    }
}
