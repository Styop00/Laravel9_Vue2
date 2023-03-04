<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {

        $libraries = Library::factory(4)->create();
        User::factory()
            ->count(3)
            ->has(Book::factory()
                    ->count(10)
                    ->hasAttached($libraries, ['existing_count'=>20]), 'books'
                )
            ->create();

        User::create([
            'name' => fake()->name(),
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make(1),
            'remember_token' => Str::random(10),
        ]);
    }
}
