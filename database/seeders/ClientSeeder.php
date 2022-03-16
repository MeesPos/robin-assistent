<?php

namespace Database\Seeders;

use App\Enums\GenderEnum;
use App\Enums\LanguageEnum;
use App\Enums\PanicButtonEnum;
use App\Enums\RelationEnum;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::query()
            ->updateOrCreate([
                'user_id' => (User::query()->first())->getKey(),
                'first_name' => 'Elise',
                'last_name' => 'Schaap',
                'birth_date' => Carbon::now()->subYears(21)->toDateString(),
                'gender' => 'Women',
                'language' => LanguageEnum::NETHERLANDS->value,
                'panic_button' => PanicButtonEnum::CALL->value,
                'relation' => RelationEnum::PROFESSIONAL->value
            ]);
    }
}
