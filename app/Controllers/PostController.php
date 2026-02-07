<?php

namespace App\Controllers;

class PostController
{
    public function show()
    {
        $post = db()->query(
            'SELECT * FROM posts WHERE id = :id',
            ['id' => $_GET['id'] ?? null]
        )->firstOrFail();

        echo view('post', [
            'post' => $post,
            'title' => $post['title']
        ]);
    }
}