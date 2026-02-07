<?php

namespace App\Controllers;

use Framework\Validator;
use Framework\SessionManager;

class LinkController
{
    public function index()
    {
        $links = db()->query('SELECT * FROM links ORDER BY id DESC')->get();

        echo view('links.index', [
            'links' => $links,
            'title' => 'Proyectos'
        ]);
    }

    public function create()
    {
        echo view('links.create', [
            'title' => 'Registrar Proyecto'
        ]);
    }

    public function store()
    {
        $validator = Validator::make($_POST, [
            'title' => 'required|min:3',
            'url' => 'required|url',
            'description' => 'required',
        ]);

        $validator->validate();

        db()->query(
            'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
            [
                'title' => $_POST['title'],
                'url' => $_POST['url'],
                'description' => $_POST['description']
            ]
        );

        SessionManager::flash('alert', 'Proyecto creado correctamente.');

        return redirect('/links');
    }
}