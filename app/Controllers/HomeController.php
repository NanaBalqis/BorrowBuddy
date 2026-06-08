<?php

namespace App\Controllers;
use App\Models\BookModel;

class HomeController extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();

        $genres = $bookModel->getUniqueGenre();
        $books  = $bookModel->where('availableCopies >', 0)->findAll(6); // Limit to 6 latest available books

        $data = [
            'genres' => $genres,
            'books'  => $books
        ];

        echo view('includes/header');
        echo view('includes/navbar');
        echo view('pages/home', $data); 
        echo view('includes/footer');
    }
}
