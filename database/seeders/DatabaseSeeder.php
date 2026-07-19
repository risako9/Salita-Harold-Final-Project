<?php

namespace Database\Seeders;

use App\Models\HomepageFeature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => config('admin.email'),
        ], [
            'name' => config('admin.name'),
            'password' => Hash::make(config('admin.password')),
        ]);

        $features = [
            [
                'slug' => 'birria-favorites',
                'title' => 'Birria favorites',
                'default_image' => 'assets/Food/1.jpg',
            ],
            [
                'slug' => 'loaded-classics',
                'title' => 'Loaded classics',
                'default_image' => 'assets/Food/item-400000005201719302_1687995743.jpg',
            ],
            [
                'slug' => 'rice-meals',
                'title' => 'Rice meals',
                'default_image' => 'assets/Food/2.jpg',
            ],
        ];

        foreach ($features as $feature) {
            HomepageFeature::query()->updateOrCreate(
                ['slug' => $feature['slug']],
                $feature
            );
        }
    }
}
