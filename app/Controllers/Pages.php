<?php

namespace App\Controllers;



class Pages extends BaseController
{
    public function index()
    {

        $faker = \Faker\Factory::create();

        $data = [
            'title' => 'Home | Ardien'
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | Ardien'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'jalan' => 'jl .in aja dulu',
                    'kota' => 'Bandung'
                ],
                [
                    'tipe' => 'Kantor',
                    'jalan' => 'Gamau Jln dulu',
                    'kota' => 'Kircon'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
