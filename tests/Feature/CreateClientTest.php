<?php

namespace Tests\Feature;

use App\Enums\GenderEnum;
use App\Enums\LanguageEnum;
use App\Enums\PanicButtonEnum;
use App\Enums\RelationEnum;
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
            'language' => LanguageEnum::NETHERLANDS->value,
            'panic_button' => PanicButtonEnum::CALL->value,
            'relation' => RelationEnum::PROFESSIONAL->value
        ])->assertCreated();

        $this->assertDatabaseHas('clients', $data);
    }

    /** @test */
    public function it_sends_an_validation_error_when_an_required_input_is_not_sended_with_the_request()
    {
        $this->post('/client', $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'birth_date' => Carbon::today()->subYears(30)->toDateString(),
            'gender' => '',
            'language' => LanguageEnum::NETHERLANDS->value
        ])->assertSessionHasErrors();
    }
}
