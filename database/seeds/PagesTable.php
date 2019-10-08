<?php

use Illuminate\Database\Seeder;

class PagesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert(
            [
                [
                    'title' => 'Home Page',
                    'titleH1' => 'Home Page',
                    'description' => 'Home Page',
                    'text' => 'Home Page',
                    'alias' => 'home',
                    'related_entity' => 'home',
                ],
                [
                    'title' => 'About Page',
                    'titleH1' => 'About Page',
                    'description' => 'About Page',
                    'text' => 'About Page',
                    'alias' => 'about',
                    'related_entity' => 'about',
                ],
                [
                    'title' => 'Contact Page',
                    'titleH1' => 'Contact Page',
                    'description' => 'Contact Page',
                    'text' => 'Contact Page',
                    'alias' => 'contact',
                    'related_entity' => 'contact',
                ],
                [
                    'title' => 'Blog',
                    'titleH1' => 'Blog',
                    'description' => 'Blog',
                    'text' => 'Blog',
                    'alias' => 'blog',
                    'related_entity' => 'blog',
                ],
                [
                    'title' => 'Faq',
                    'titleH1' => 'Faq',
                    'description' => 'Faq',
                    'text' => 'Faq',
                    'alias' => 'faq',
                    'related_entity' => 'faq',
                ],
            ]
        );
    }
}
