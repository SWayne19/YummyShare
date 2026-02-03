<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Breakfast',
                'slug' => 'breakfast',
                'image' => 'https://www.australianeggs.org.au/assets/recipes/Egg-trout-croissant-0192-prv__ScaleWidthWzEyMDBd.jpg',
                'description' => 'Start your day with energy and taste.'
            ],
            [
                'name' => 'Vegan',
                'slug' => 'vegan',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=800&q=80',
                'description' => 'Plant-based power for a healthy life.'
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'image' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sweet treats to satisfy your cravings.'
            ],
            [
                'name' => 'Seafood',
                'slug' => 'seafood',
                'image' => 'https://www.licious.in/blog/wp-content/uploads/2022/02/shutterstock_1773695441-min-750x750.jpg',
                'description' => 'Fresh catches from the deep blue sea.'
            ],
            [
                'name' => 'Fast Food',
                'slug' => 'fast-food',
                'image' => 'https://healthnewshub.org/wp-content/uploads/2024/03/Fast-Food-Restaurants.jpg',
                'description' => 'Quick, cheesy, and absolutely delicious.'
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
