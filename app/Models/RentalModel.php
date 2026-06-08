<?php

namespace App\Models;

use CodeIgniter\Model;

class RentalModel extends Model
{
    protected $table = 'rental';
    protected $primaryKey = 'rentalId';
    protected $allowedFields = [
        'userId', 
        'bookId', 
        'rentalDate', 
        'dueDate',
        'returnDate', 
        'lateFee', 
        'status'
    ];

    public function getRentalByUser($userId)
    {
        return $this->where('userId', $userId)->findAll();
    }

    public function getActiveRental($userId, $bookId)
    {
        return $this->where([
            'userId' => $userId,
            'bookId' => $bookId,
            'status' => 'rented'
        ])->first();
    }

    public function markAsReturned($rentalId)
    {
        $rental = $this->find($rentalId);
        $today = date('Y-m-d');

        $dueDate = $rental['dueDate'];
        $daysLate = max(0, (strtotime($today) - strtotime($dueDate)) / 86400); // 1 day = 86400 seconds
        $lateFee = $daysLate * 5; // RM5 per day

        return $this->update($rentalId, [
            'returnDate' => $today,
            'lateFee' => $lateFee,
            'status' => 'returned'
        ]);
    }

    public function getOverdueRentals()
    {
        return $this->where('dueDate <', date('Y-m-d'))
                    ->where('status', 'rented')
                    ->findAll();
    }
}
