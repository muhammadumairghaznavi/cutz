<?php

use App\Category;
use App\Plan;
use App\Section;
use App\Service;
use App\Setting;
use App\SubCategory;
use App\Tag;
use Illuminate\Database\Seeder;

class SeparatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Customer::create([
            'full_name' => 'Tarek customer',
            'phone' => '01142117402',

            'email' => 'customer@app.com',
            'password' => bcrypt('123456'),
        ]);
        \App\Customer::create([
            'full_name' => 'Medo customer',
            'phone' => '01542117402',
            'email' => 'Medo@app.com',
            'password' => bcrypt('123456'),
        ]);
        \App\Customer::create([
            'full_name' => 'Ali customer',
            'phone' => '01242117402',
            'email' => 'Ali@app.com',
            'password' => bcrypt('123456'),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Tag::create(['ar' => ['title' => 'وسم' . $i], 'en' => ['title' => 'Tag' . $i]]);

            Section::create([
                'image' =>  'default.png',
                'ar' => [
                    'title' => 'عنوان  السكشن ' . $i,
                    'description'  => 'وصف  السكشن ' . $i,
                    'short_description' => 'وصف قصير ' . $i,
                ],
                'en' => [
                    'title' => 'title  ' . $i,
                    'description'  => 'description' . $i,
                    'short_description' => 'short_description' . $i,
                ],
            ]);/* end create Section */
            Category::create([
                'section_id' => 1,
                'image' =>  'default.png',
                'ar' => [
                    'title' => 'عنوان التصنيف ' . $i,
                    'description'  => 'وصف التصنيف ' . $i,
                    'short_description' => 'وصف قصير ' . $i,
                ],
                'en' => [
                    'title' => 'title  ' . $i,
                    'description'  => 'description' . $i,
                    'short_description' => 'short_description' . $i,
                ],
            ]);/* end create Category */

            SubCategory::create([
                'category_id' =>  1,
                'image' =>  'default.png',
                'ar' => [
                    'title' => 'عنوان  الكاتيجوري ' . $i,
                    'description'  => 'وصف  الكاتيجوري ' . $i,
                    'short_description' => 'وصف قصير ' . $i,
                ],
                'en' => [
                    'title' => 'title  ' . $i,
                    'description'  => 'description' . $i,
                    'short_description' => 'short_description' . $i,
                ],
            ]);/* end create SubCategory */
        }/* end for loop */

        Setting::create([
            'logo' =>  'default.png',
            'icon' =>  'default.png',
            'footer_logo' =>  'default.png',
            'num1' =>  '01023456789',
            'email' =>  'info@domain.com',
            'seo_google_analatic' =>  'https://www.google.com/maps',
            'map' =>  '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7286615.899145397!2d30.8768375!3d26.906099949999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1601994116144!5m2!1sen!2seg" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
            'ar' => [
                'seo_title' => 'seo_title ar',
                'seo_key' => 'seo_key ar',
                'address' => 'address ar',
                'title' => 'title ar',
                'seo_des' => 'seo_des ar',
            ],
            'en' => [
                'seo_title' => 'seo_title en ',
                'seo_key' => 'seo_key en ',
                'address' => 'address en',
                'title' => 'title en',
                'seo_des' => 'seo_des en',
            ],
        ]);/* end setting tbl */
    }
}
