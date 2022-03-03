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
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());

        $this->client = Client::factory()->create(['user_id' => Auth::id()]);
    }

    /** @test */
    public function it_can_make_an_activity()
    {
        $this->post('/activity', $data = [
            'client_id' => $this->client->getKey(),
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

    /** @test */
    public function it_sends_an_validation_error_when_an_required_input_is_not_sended_with_the_request()
    {
        $this->post('/activity', [
            'client_id' => $this->client->getKey(),
            'name' => 'Test name',
            'start_date' => Carbon::now()->addDay()->toDateString(),
            'end_date' => Carbon::now()->addDays(2)->toDateString(),
            'start_time' => Carbon::now()->addHour()->toTimeString(),
            'end_time' => '',
            'days' => json_encode([
                DaysEnum::MONDAY->value,
                DaysEnum::WEDNESDAY->value,
                DaysEnum::SATURDAY->value
            ])
        ])->assertSessionHasErrors();
    }

    /** @test */
    public function it_sends_an_validation_error_when_an_date_input_is_not_an_date()
    {
        $this->post('/activity', [
            'client_id' => $this->client->getKey(),
            'name' => 'Test name',
            'start_date' => Carbon::now()->addDay()->toDateString(),
            'end_date' => Carbon::now()->addDays(2)->toTimeString(), // Time, not date
            'start_time' => Carbon::now()->addHour()->toTimeString(),
            'end_time' => Carbon::now()->addHours(2)->toTimeString(),
            'days' => json_encode([
                DaysEnum::MONDAY->value,
                DaysEnum::WEDNESDAY->value,
                DaysEnum::SATURDAY->value
            ])
        ])->assertSessionHasErrors();
    }
}
