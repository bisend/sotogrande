<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Category;
use App\Models\Admin\CategoryContent;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        CategoryContent::truncate();
        \DB::beginTransaction();
        $categories = [
            'House',
            'Villa',
            'Hostel',
            'Restaurant',
            'Bar',
            'Night Club',
            'Commercial'
        ];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->order = 0;
            $newCategory->alias = str_slug($category);
            $newCategory->save();
            $newCategoryContent = new CategoryContent();
            $newCategoryContent->category_id = $newCategory->id;
            $newCategoryContent->language_id = 1;
            $newCategoryContent->name = $category;
            $newCategoryContent->save();
        }
        \DB::commit();
    }
}
