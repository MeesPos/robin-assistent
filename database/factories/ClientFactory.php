<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Enums\LanguageEnum;
use App\Enums\PanicButtonEnum;
use App\Enums\RelationEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => Carbon::now()->subYears(25),
            'gender' => GenderEnum::FEMALE->value,
            'language' => LanguageEnum::NETHERLANDS->value,
            'panic_button' => PanicButtonEnum::CALL->value,
            'relation' => RelationEnum::PROFESSIONAL->value
        ];
    }
}
