<?php

namespace App\Models;

use CodeIgniter\Model;

class FavModel extends Model
{
    protected $table = 'favourite';         // Table name
    protected $primaryKey = 'favId';        // Primary key

    protected $allowedFields = [
        'userId',
        'bookId',
        'title',
        'created_at'
    ];

    protected $useTimestamps = false;       // Since you are using MySQL timestamp
    protected $returnType = 'array';        // Return results as array

    // Get all favorite books for a specific user, with book details
    public function getFavoritesByUser($userId)
    {
        return $this->select('favourite.*, book.title, book.author, book.genre, book.book_cover, book.totalCopies, book.availableCopies, book.description, book.bookId')
                    ->join('book', 'favourite.bookId = book.bookId')
                    ->where('favourite.userId', $userId)
                    ->findAll();
    }

    // Check if a book is already in favorites for a user
    public function isFavorite($userId, $bookId)
    {
        return $this->where('userId', $userId)
                    ->where('bookId', $bookId)
                    ->first();
    }

    // Remove favorite
    public function removeFavorite($userId, $bookId)
    {
        return $this->where('userId', $userId)
                    ->where('bookId', $bookId)
                    ->delete();
    }
}
