<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        $posts = db()->query('SELECT * FROM posts ORDER BY id DESC LIMIT 6')->get();

        echo view('home', [
            'posts' => $posts,
            'title' => 'Inicio'
        ]);
    }

    public function about()
    {
        echo view('about', [
            'title' => 'Sobre Nosotros'
        ]);
    }
}