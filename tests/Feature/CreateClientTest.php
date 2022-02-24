<?php

namespace Tests\Feature;

use App\Enums\GenderEnum;
use App\Enums\LanguageEnum;
use Carbon\Carbon;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    /** @test */
    public function it_can_create_an_client()
    {
        $this->withoutExceptionHandling();

        $this->post('/client', $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => Carbon::today()->subYears(30)->toDateString(),
            'gender' => \App\Enums\GenderEnum::MALE->value,
            'language' => LanguageEnum::NETHERLANDS->value
        ])->assertCreated();

        $this->assertDatabaseHas('clients', $data);
    }
}
