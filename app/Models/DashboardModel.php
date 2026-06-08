<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function debugTable($name) {
        if (empty($name)) {
            throw new \Exception('Table name is empty!');
        }
        return $this->db->table($name);
    }


    // --- TOTAL BOOKS ---
    public function getTotalBooks()
    {
        return $this->db->table('book')->countAllResults();
    }

    // --- BOOKS RENTED TODAY ---
    public function getBooksRentedToday()
    {
        $today = date('Y-m-d');
        return $this->db->table('rental')
            ->where('rentalDate', $today)
            ->countAllResults();
    }

    // --- ACTIVE MEMBERS ---
    public function getActiveMembers()
    {
        return $this->db->table('user')
            ->where('userType', 'member')
            ->countAllResults();
    }

    // --- OVERDUE RETURNS ---
    public function getOverdueReturns()
    {
        $today = date('Y-m-d');
        return $this->db->table('rental')
            ->where('dueDate <', $today)
            ->where('status', 'rented')
            ->countAllResults();
    }

    // --- BOOK AVAILABLE ---
    public function getBooksAvailable()
    {
        return $this->db->table('book')
            ->selectSum('availableCopies')
            ->get()
            ->getRow()
            ->availableCopies;
    }

    // --- RENTAL THIS MONTH ---
    public function getRentalThisMonth()
    {
        $month = date('Y-m');
        return $this->db->table('rental')
            ->like('rentalDate', $month, 'after')
            ->countAllResults();
    }


    // --- RENTED STATUS (RENTALS) ---
    public function getRentedStatus($limit = 10)
    {
        return $this->db->table('rental')
            ->select('rental.*, user.fullName as member_name, book.title as book_title')
            ->join('user', 'user.userId = rental.userId')
            ->join('book', 'book.bookId = rental.bookId')
            ->orderBy('rental.rentalDate', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    // --- OVERDUE LIST ---
    public function getOverdueWithoutReminder()
    {
        return $this->db->query("
            SELECT r.rentalId, r.userId, u.email, u.fullName, b.title, r.dueDate
            FROM rental r
            JOIN user u ON u.userId = r.userId
            JOIN book b ON b.bookId = r.bookId
            WHERE r.dueDate < CURDATE()
            AND r.status = 'rented'
            AND r.rentalId NOT IN (SELECT rentalId FROM reminder)
        ")->getResultArray();
    }

    // --- POPULAR BOOKS (most times rented) ---
    public function getPopularBooks($limit = 10)
    {
        return $this->db->table('rental')
            ->select('book.title, COUNT(rental.rentalId) as rented_count')
            ->join('book', 'book.bookId = rental.bookId')
            ->groupBy('rental.bookId')
            ->having('rented_count >', 5)
            ->orderBy('rented_count', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    // --- TOTAL MEMBERS ---
    public function getTotalMembers()
    {
        return $this->db->table('user')->where('userType', 'member')->countAllResults();
    }

    // --- NEW MEMBERS THIS MONTH ---
    public function getNewMembersThisMonth()
    {
        $firstOfMonth = date('Y-m-01');
        return $this->db->table('user')
            ->where('userType', 'member')
            ->where('membershipDate >=', $firstOfMonth)
            ->countAllResults();
    }

    // Get total books rented in a given year
    public function getBooksRentedByYear($year)
    {
        return $this->db->table('rental')
            ->select('COUNT(*) as total_rented')
            ->where('YEAR(rentalDate) =', $year, false)
            ->get()
            ->getRowArray();
    }

    // Get monthly rental activity
    public function getMonthlyRentalActivity($year)
    {
        return $this->db->query("
            SELECT MONTH(rentalDate) AS month, COUNT(*) AS count
            FROM rental
            WHERE YEAR(rentalDate) = ?
            GROUP BY MONTH(rentalDate)
        ", [$year])->getResultArray();
    }

    // book category distribution
    public function getBookCategoryDistribution()
    {
        return $this->db->query("
            SELECT genre, COUNT(*) AS total
            FROM book
            WHERE genre IS NOT NULL AND genre != ''
            GROUP BY genre
        ")->getResultArray();
    }

    //upcoming due date
    public function getUpcomingDueDates($days = 7)
    {
        $today = date('Y-m-d');
        $upcoming = date('Y-m-d', strtotime("+$days days"));

        return $this->db->table('rental')
            ->select('rental.dueDate, user.fullName')
            ->join('user', 'user.userId = rental.userId')
            ->where('rental.dueDate >=', $today)
            ->where('rental.dueDate <=', $upcoming)
            ->where('rental.status', 'rented')
            ->orderBy('rental.dueDate', 'ASC')
            ->get()->getResultArray();
    }
}
