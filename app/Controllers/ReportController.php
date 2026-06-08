<?php namespace App\Controllers;

use App\Models\ReportModel;

class ReportController extends BaseController
{
    public function index()
    {
        return view('dashboard/reportList');
    }

    public function monthlyRental()
    {
        $data = (new ReportModel())->getMonthlyRentalSummary();
        return view('reports/monthly_rental', ['data' => $data]);
    }

    public function mostRented()
    {
        $data = (new ReportModel())->getMostRentedBooks();
        return view('reports/most_rented', ['data' => $data]);
    }

    public function overdueRentals()
    {
        $data = (new ReportModel())->getOverdueRentals();
        return view('reports/overdue', ['data' => $data]);
    }

    public function favoriteBooks()
    {
        $data = (new ReportModel())->getFavoriteBooks();
        return view('reports/favorites', ['data' => $data]);
    }

    public function returnTimeliness()
    {
        $data = (new ReportModel())->getReturnTimeliness();
        return view('reports/return_timeliness', ['data' => $data]);
    }
}
