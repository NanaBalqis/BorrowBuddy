<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'bookId';
    protected $allowedFields = [
        'title', 
        'author', 
        'isbn', 
        'genre',
        'description', 
        'publishedYear',
        'shelfLocation', 
        'totalCopies', 
        'availableCopies', 
        'book_cover',
        'created_at'
    ];

    public function getBookByISBN($isbn)
    {
        return $this->where('isbn', $isbn)->first();
    }

    public function getBookById($bookId)
    {
        return $this->where('bookId', $bookId)->first();
    }

    public function getUniqueGenre()
    {
        $genres = $this->distinct()->select('genre')->findAll();
        
        return $genres;
    }

    public function getFilteredBooks($genre = null, $publishedYear = null, $author = null, $search = null)
    {
        $builder = $this->builder();

        if ($genre) {
            $builder->where('genre', $genre);
        }

        if ($publishedYear === 'asc' || $publishedYear === 'desc') {
            $builder->orderBy('publishedYear', $publishedYear);
        }

        if ($author) {
            $builder->where('author', $author);
        }

        if ($search) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('author', $search)
                    ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function updateAvailability($primaryKey, $available)
    {
        return $this->update($primaryKey, ['availableCopies' => $available]);
    }
}
