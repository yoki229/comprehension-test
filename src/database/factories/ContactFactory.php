<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;


class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    // 日本語に変更
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('ja_JP');

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail,
            'tel' => $this->faker->numerify('###########'),
            'address' => $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->text(120),
            'category_id' => Category::inRandomOrder()->first()->id,

        ];
    }
}
