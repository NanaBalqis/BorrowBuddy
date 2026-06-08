<?php namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    // 1. Monthly Rental Summary
    public function getMonthlyRentalSummary()
    {
        return $this->db->query("
            SELECT 
                DATE_FORMAT(rentalDate, '%Y-%m') AS month,
                COUNT(*) AS total_rentals,
                SUM(lateFee) AS total_late_fees
            FROM rental
            GROUP BY month
            ORDER BY month ASC
        ")->getResult();
    }

    // 2. Most Rented Books
    public function getMostRentedBooks()
    {
        return $this->db->query("
            SELECT 
                b.title,
                COUNT(*) AS times_rented
            FROM rental r
            JOIN book b ON r.bookId = b.bookId
            GROUP BY r.bookId, b.title
            ORDER BY times_rented DESC
        ")->getResult();
    }

    // 3. Overdue Rentals Report
    public function getOverdueRentals()
    {
        return $this->db->query("
            SELECT 
                r.rentalId,
                u.fullName,
                u.phoneNum,
                u.email,
                b.title,
                r.dueDate,
                r.returnDate,
                r.status,
                r.lateFee
            FROM rental r
            JOIN user u ON r.userId = u.userId
            JOIN book b ON r.bookId = b.bookId 
            AND r.dueDate < CURDATE()
            ORDER BY r.dueDate ASC
        ")->getResult();
    }

    // 4. Favorite Books Ranking
    public function getFavoriteBooks()
    {
        return $this->db->query("
            SELECT 
                b.title,
                COUNT(*) AS total_favorites
            FROM favourite f
            JOIN book b ON f.bookId = b.bookId
            GROUP BY f.bookId, b.title
            ORDER BY total_favorites DESC
        ")->getResult();
    }

    // 5. Return Timeliness
    public function getReturnTimeliness()
    {
        return $this->db->query("
            SELECT 
                r.rentalId,
                u.fullName,
                b.title,
                r.rentalDate,
                r.dueDate,
                r.returnDate,
                DATEDIFF(r.returnDate, r.dueDate) AS days_difference
            FROM rental r
            JOIN user u ON r.userId = u.userId
            JOIN book b ON r.bookId = b.bookId
            WHERE r.status = 'returned' AND r.returnDate IS NOT NULL
            ORDER BY days_difference ASC
        ")->getResult();
    }
}
