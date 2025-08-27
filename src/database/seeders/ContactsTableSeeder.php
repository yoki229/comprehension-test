<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('contacts')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    Contact::factory()->count(35)->create();
    }
}
