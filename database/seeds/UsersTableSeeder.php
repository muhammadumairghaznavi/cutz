<?php

use App\Setting;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'Cutz@marketing-dragon.com',
            'password' => bcrypt('123456'),
        ]);
        $user->attachRole('super_admin');
        $Inbox = \App\Inbox::create(
            [
                'name' => 'tarek ',
                'phone' => '456789321',
                'email' => 'info@Gamil.com',
                'message' => 'Your message',
                'status' => 'active',
            ]
        );

        //////sociall Media seed
        $social = \App\SocailMedia::create(
            [
                'name' => 'facebook',
                'link' => '#',
                'icon' => 'fab fa-facebook-f',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'twitter',
                'link' => '#',
                'icon' => 'fab fa-twitter',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'instagram',
                'link' => '#',
                'icon' => 'fab fa-instagram',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'snapchat',
                'link' => '#',
                'icon' => 'fab fa-snapchat',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'linkedin',
                'link' => '#',
                'icon' => 'fab fa-linkedin-in',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'youtube',
                'link' => '#',
                'icon' => 'fab fa-youtube',
            ]
        );
        $social = \App\SocailMedia::create(
            [
                'name' => 'google',
                'link' => '#',
                'icon' => 'fab  fa-google-plus-g',
            ]
        );
    } //end of run
} //end of seeder
