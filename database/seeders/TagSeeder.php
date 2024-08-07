<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(
            [
                'tags' => 'Culture',
            ],
        );
        Tag::create(
            [
                'tags' => 'Civic',
            ],
        );
        Tag::create(
            [
                'tags' => 'Community',
            ],

        );
        Tag::create(
            [
                'tags' => 'Health and Eduction',
            ],

        );
        Tag::create(
            [
                'tags' => 'Hospitality abd Leisure',
            ],

        );
        Tag::create(
            [
                'tags' => 'Industrial and Research',
            ],

        );
        Tag::create(
            [
                'tags' => 'Industrial Design',
            ],

        );
        Tag::create(
            [
                'tags' => 'Mixed Use',
            ],

        );
        Tag::create(
            [
                'tags' => 'Offices and Headquarters',
            ],

        );
        Tag::create(
            [
                'tags' => 'Residential',
            ],

        );
        Tag::create(
            [
                'tags' => 'Retail',
            ],

        );
        Tag::create(
            [
                'tags' => 'Transport and Infrustructure',
            ],

        );
        Tag::create(
            [
                'tags' => 'Urban Design',
            ],

        );
        Tag::create(
            [
                'tags' => 'Recently Completed',
            ],

        );
        Tag::create(
            [
                'tags' => 'Under Construction',
            ],

        );
    }
}
