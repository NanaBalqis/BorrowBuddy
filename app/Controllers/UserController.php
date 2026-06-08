<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookModel;
use App\Models\RentalModel;
use App\Models\ReminderModel;
//use App\Models\AdminActivityLogModel;
use App\Models\FavModel;
use App\Models\DashboardModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class UserController extends BaseController
{
    protected $userModel;
    protected $bookModel;
    protected $rentalModel;
    protected $reminderModel;
    //protected $activityLogModel;
    protected $favModel;
    protected $dashboardModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookModel = new BookModel();
        $this->rentalModel = new RentalModel();
        $this->reminderModel = new ReminderModel();
        //$this->activityLogModel = new AdminActivityLogModel();
        $this->favModel = new FavModel();
        $this->dashboardModel = new DashboardModel();
    }

    // Show register page
    public function register()
    {
        echo view('includes/header');
        echo view('includes/navbar');
        echo view('pages/register');
        echo view('includes/footer');
    }

    // Show login page
    public function login()
    {
        echo view('includes/header');
        echo view('includes/navbar');
        echo view('pages/login');
        echo view('includes/footer');
    }

    // Handle registration form submission
   public function registerProcess()
    {
        $validationRules = [
            'fullName' => 'required',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'phoneNum' => 'required|regex_match[/^[0-9]{10,11}$/]|is_unique[user.phoneNum]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        $data = [
            'fullName' => $this->request->getPost('fullName'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phoneNum' => $this->request->getPost('phoneNum'),
            'userType' => 'member', 
            'membershipDate' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('login')->with('success', 'Registration successful. Please log in.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Registration failed.');
        }
    }

    // Handle login form submission
    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'userId'   => $user['userId'],
                'fullName'      => $user['fullName'],
                'email'     => $user['email'],
                'userType'      => $user['userType'],
                'profile_picture' => $user['profile_picture'] ?? '/assets/images/single-author.jpg',
                'isLoggedIn'=> true
            ]);

            // Redirect to dashboard with user data
            if (in_array($user['userType'], ['admin'])) {
                return redirect()->to('main');
            } else if(in_array($user['userType'], ['member'])) {
                return redirect()->to('menu');
            } else {
                return redirect()->to('login')->with('error', 'Unknown user role.');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
    }

    //Member

    public function dashboardM()
    {
        $email= session()->get('email');
        $bookId= session()->get('bookId');

        $userData = $this->userModel->getUserByEmail($email);
        $bookData = $this->bookModel->getBookById($bookId);

        // Get filter and sort parameters
        $genre = $this->request->getGet('genre');
        $publishedYear = $this->request->getGet('publishedYear');
        $author = $this->request->getGet('author');

        // Fetch filtered and sorted Books
        $search = $this->request->getGet('search');
        $books = $this->bookModel->getFilteredBooks($genre, $publishedYear, $author, $search);
        $genres = $this->bookModel->getUniqueGenre();

        $data = [
            'userData' => $userData,
            'bookData' => $bookData,
            'books' => $books,
            'genres' => $genres,
            'selectedGenre' => $genre,
            'selectedPublishedYearOrder' => $publishedYear,
            'selectedAuthor' => $author,
            'searchQuery' => $search
        ];

        return view('dashboard/menu', $data);
    }

    public function dashboard()
    {
        // Authentication check
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $fullName = session()->get('fullName');
        $dashboardModel = new DashboardModel();

        // Books rented this year and last year for growth %
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        $booksRentedThisYearResult = $dashboardModel->getBooksRentedByYear($currentYear);
        $booksRentedLastYearResult = $dashboardModel->getBooksRentedByYear($lastYear);

        $totalBooks = $dashboardModel->getTotalBooks();

        $booksRentedThisYear = isset($booksRentedThisYearResult['total_rented'])
            ? $booksRentedThisYearResult['total_rented']
            : 0;
        $booksRentedLastYear = isset($booksRentedLastYearResult['total_rented'])
            ? $booksRentedLastYearResult['total_rented']
            : 0;

        $growthPercentage = $booksRentedLastYear > 0
            ? (($booksRentedThisYear - $booksRentedLastYear) / $booksRentedLastYear) * 100
            : 0;

        $totalBooks         = $dashboardModel->getTotalBooks();
        $booksRentedToday   = $dashboardModel->getBooksRentedToday();
        $activeMembers      = $dashboardModel->getActiveMembers();
        $overdueReturns     = $dashboardModel->getOverdueReturns();
        $booksAvailable     = $dashboardModel->getBooksAvailable();
        $loansThisMonth     = $dashboardModel->getRentalThisMonth();    
        $rentedStatus       = $dashboardModel->getRentedStatus(10);
        $overdueReminder    = $dashboardModel->getOverdueWithoutReminder();
        $popularBooks       = $dashboardModel->getPopularBooks(10);
        $totalMembers       = $dashboardModel->getTotalMembers();
        $newMembersMonth    = $dashboardModel->getNewMembersThisMonth();
        $monthlyRentalData  = $dashboardModel->getMonthlyRentalActivity($currentYear);
        $upcomingDueDates   = $dashboardModel->getUpcomingDueDates();
        $bookCategories     = $dashboardModel->getBookCategoryDistribution();

        return view('dashboard/main', [
            'fullName'           => $fullName,
            'totalBooks'         => $totalBooks,
            'booksRentedToday'   => $booksRentedToday,
            'activeMembers'      => $activeMembers,
            'overdueReturns'     => $overdueReturns,
            'booksAvailable'     => $booksAvailable,
            'loansThisMonth'     => $loansThisMonth,
            'rentedStatus'       => $rentedStatus,
            'overdueReminder'    => $overdueReminder,
            'popularBooks'       => $popularBooks,
            'totalMembers'       => $totalMembers,
            'monthlyRentalData'  => $monthlyRentalData,
            'bookCategories'     => $bookCategories,
            'upcomingDueDates'   => $upcomingDueDates,
            'newMembersMonth'    => $newMembersMonth,
            'booksRentedThisYear' => $booksRentedThisYear,
            'booksRentedLastYear' => $booksRentedLastYear,
            'growthPercentage'    => $growthPercentage,
        ]);
    }

    public function sendReminder()
    {
        $dashboardModel = new DashboardModel();
        $db = \Config\Database::connect();
        $emailService = \Config\Services::email();

        $overdueList = $dashboardModel->getOverdueWithoutReminder();

        if (empty($overdueList)) {
            return redirect()->to('/dashboard')->with('error', 'No overdue reminders to send.');
        }

        foreach ($overdueList as $item) {
            // Insert into reminder table
            $db->table('reminder')->insert([
                'rentalId'     => $item['rentalId'],
                'userId'       => $item['userId'],
                'message'      => "You have an overdue rental: " . $item['title'],
                'type'         => 'overdue',
                'reminderDate' => date('Y-m-d H:i:s'),
            ]);

            // Send email
            $emailService->setTo($item['email']);
            $emailService->setSubject('📚 Overdue Book Reminder - BorrowBuddy');
            $emailService->setMessage("
                Dear {$item['fullName']},<br><br>
                This is a reminder that the book <strong>{$item['title']}</strong> was due on <strong>{$item['dueDate']}</strong> and is now overdue.<br>
                Kindly return it as soon as possible to avoid penalties.<br><br>
                Regards,<br>
                <strong>BorrowBuddy Library</strong>
            ");
            $emailService->setMailType('html');

            // Send email and log if failed
            if (!$emailService->send()) {
                log_message('error', 'Failed to send reminder to ' . $item['email']);
                log_message('error', print_r($emailService->printDebugger(['headers', 'subject', 'body']), true));
            }
        }

        return redirect()->to('main')->with('success', 'Reminders sent successfully.');
    }

    public function myRental()
    {
        $email = session()->get('email');
        $userId = session()->get('userId');
        $search = $this->request->getGet('search');

        $userData = $this->userModel->getUserByEmail($email);

        $builder = $this->rentalModel
            ->select('rental.*, book.*')
            ->join('book', 'book.bookId = rental.bookId')
            ->where('rental.userId', $userId);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('book.title', $search)
                ->orLike('rental.rentalId', $search)
                ->orLike('rental.status', $search)
                ->groupEnd();
        }

        $rentalClasses = $builder->findAll();

        $data = [
            'userData' => $userData,
            'rentalClasses' => $rentalClasses,
            'searchQuery' => $search
        ];

        return view('dashboard/myrental', $data);
    }

    public function rentNow($bookId)
    {
        $userId = session()->get('userId');
        $email = session()->get('email');

        $book = $this->bookModel->find($bookId);
        $user = $this->userModel->getUserByEmail($email);

        if (!$book || $book['availableCopies'] <= 0) {
            return redirect()->back()->with('error', 'Book not available for rent.');
        }

        $rentalDate = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime('+5 days'));

        $rentalData = [
            'userId' => $userId,
            'bookId' => $bookId,
            'rentalDate' => $rentalDate,
            'dueDate' => $dueDate,
            'status' => 'rented',
            'lateFee' => 0,
            'returnDate' => null
        ];

        $rentalId = $this->rentalModel->insert($rentalData);
        if ($rentalId) {
            // Update available copies
            $newAvailable = $book['availableCopies'] - 1;
            $this->bookModel->updateAvailability($bookId, $newAvailable);

            // Generate PDF
            $pdfContent = $this->generateRentalPDF([
                'user' => $user,
                'book' => $book,
                'rental' => ['rentalId' => $rentalId],
                'rentalDate' => $rentalDate,
                'dueDate' => $dueDate
            ]);

            $tempPdf = WRITEPATH . 'rental_ticket_' . time() . '.pdf';
            file_put_contents($tempPdf, $pdfContent);

            $emailService = \Config\Services::email();
            $emailService->setTo($user['email']);
            $emailService->setSubject('BorrowBuddy: Book Rental Ticket');
            $emailService->setMessage('Hi ' . $user['fullName'] . ',<br><br>Please bring the attached rental ticket to collect your book.<br><br>Thank you!');
            $emailService->setMailType('html');
            $emailService->attach($tempPdf);

            $emailService->send();
            @unlink($tempPdf);

            return redirect()->to('myRental')->with('success', 'Book rented! Rental ticket has been emailed to you.');
        } else {
            return redirect()->back()->with('error', 'Failed to rent the book. Try again.');
        }
    }

    private function generateRentalPDF($data)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('emails/rental_ticket', ['data' => $data]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }

    public function returnBook($rentalId)
    {
        $rental = $this->rentalModel->find($rentalId);
        if (!$rental || $rental['status'] === 'returned') {
            return redirect()->back()->with('error', 'Invalid rental or already returned.');
        }

        $returnDate = date('Y-m-d');
        $dueDate = $rental['dueDate'];
        $daysLate = max(0, (strtotime($returnDate) - strtotime($dueDate)) / (60 * 60 * 24));
        $lateFee = $daysLate * 5;

        // Update rental
        $this->rentalModel->update($rentalId, [
            'status' => 'returned',
            'returnDate' => $returnDate,
            'lateFee' => $lateFee
        ]);

        // Update book stock
        $book = $this->bookModel->find($rental['bookId']);
        $newAvailable = $book['availableCopies'] + 1;
        $this->bookModel->updateAvailability($book['bookId'], $newAvailable);

        return redirect()->to('myRental')->with('success', 'Book returned. Late fee: RM' . $lateFee);
    }

    //favBook --jauza punya
    public function favBook()
    {
        $userId = session()->get('userId');
        $favModel = new FavModel();

        $data['favBooks'] = $favModel->getFavoritesByUser($userId);

        return view('dashboard/favBook', $data);
    }

    public function addFavorite()
    {
        $userId = session()->get('userId');
        $bookId = $this->request->getPost('bookId');
        $title = $this->request->getPost('title');

        $favModel = new FavModel();

        if (!$favModel->isFavorite($userId, $bookId)) {
            $favModel->save([
                'userId' => $userId,
                'bookId' => $bookId,
                'title'  => $title
            ]);
        }

        return $this->request->isAJAX()
            ? $this->response->setStatusCode(200)->setJSON(['status' => 'added'])
            : redirect()->to('dashboard/fav-book');
    }

    public function removeFavorite($bookId)
    {
        $userId = session()->get('userId');
        $favModel = new FavModel();
        $favModel->removeFavorite($userId, $bookId);

        return redirect()->to('favBook');
    }

    //Admin

    //rentalHistory (Adlina)
    public function rentalHistory()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rental');
        $builder->select('rental.*, user.fullName');
        $builder->join('user', 'user.userId = rental.userId', 'left');

        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('rental.rentalId', $search)
                ->orLike('rental.userId', $search)
                ->orLike('rental.bookId', $search)
                ->orLike('rental.status', $search)
                ->orLike('rental.rentalDate', $search)
                ->orLike('user.fullName', $search)
            ->groupEnd();
        }

        // Sort by latest rentalDate
        $builder->orderBy('rental.rentalDate', 'DESC');

        $rentals = $builder->get()->getResultArray();

        // Calculate late fee dynamically
        foreach ($rentals as &$rental) {
            $dueDate = new \DateTime($rental['dueDate']);

            $returnDate = (!empty($rental['returnDate']) && $rental['returnDate'] !== '0000-00-00')
                ? new \DateTime($rental['returnDate'])
                : new \DateTime(); // Use current date if not returned

            if ($returnDate > $dueDate) {
                $interval = $dueDate->diff($returnDate);
                $lateDays = $interval->days;
                $rental['lateFee'] = number_format($lateDays * 5.00, 2);
            } else {
                $rental['lateFee'] = '0.00';
            }
        }

        return view('dashboard/rentalHistory', [
            'rentals' => $rentals,
            'search' => $search
        ]);
    }

    public function delete($id)
    {
        $rentalModel = new RentalModel();

        // Check if rental exists
        $rental = $rentalModel->find($id);
        if (!$rental) {
            return redirect()->back()->with('error', 'Rental record not found.');
        }

        // Delete the rental if it exists
        if ($rentalModel->delete($id)) {
            return redirect()->back()->with('success', 'Rental record deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete rental record.');
        }
    }

    public function edit($id)
    {
        $rental = $this->rentalModel->find($id);

        if (!$rental) {
            return redirect()->back()->with('error', 'Rental record not found.');
        }

        // Handle empty/invalid return date
        $hasReturnDate = !empty($rental['returnDate']) && $rental['returnDate'] !== '0000-00-00' && $rental['returnDate'] !== null;

        $dueDate = new \DateTime($rental['dueDate']);
        $returnDate = $hasReturnDate ? new \DateTime($rental['returnDate']) : new \DateTime(); // fallback to today

        if ($returnDate > $dueDate) {
            $daysLate = $dueDate->diff($returnDate)->days;
            $rental['lateFee'] = number_format($daysLate * 5.00, 2);
        } else {
            $rental['lateFee'] = '0.00';
        }

        return view('dashboard/editRentalHistory', ['rental' => $rental]);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');
        $rentalDate = $this->request->getPost('rentalDate');
        $dueDate = $this->request->getPost('dueDate');

        $rental = $this->rentalModel->find($id);
        if (!$rental) {
            return redirect()->back()->with('error', 'Rental record not found.');
        }

        $returnDate = null;

        // If marked as returned, set return date to today
        if ($status === 'returned') {
            $returnDate = date('Y-m-d');
        }

        // Calculate late fee if current date > due date
        $today = new \DateTime();
        $due = new \DateTime($dueDate);
        $lateFee = 0.00;

        if ($today > $due) {
            $daysLate = $due->diff($today)->days;
            $lateFee = $daysLate * 5.00;
        }

        $data = [
            'rentalDate' => $rentalDate,
            'dueDate' => $dueDate,
            'returnDate' => $returnDate,
            'lateFee' => number_format($lateFee, 2, '.', ''),
            'status' => $status
        ];

        if ($this->rentalModel->update($id, $data)) {
            //increase available copies if rental was NOT returned before and now is
            if ($rental['status'] !== 'returned' && $status === 'returned') {
                $bookModel = new BookModel();
                $bookModel->where('bookId', $rental['bookId'])
                        ->set('availableCopies', 'availableCopies + 1', false)
                        ->update();
            }

            return redirect()->to('rentalHistory')->with('success', 'Rental info updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update rental info.');
        }
    }

    //User(zahwa)

    public function userList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');

        // Filter: only members
        $builder->where('userType', 'member');

        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('userId', $search)
                ->orLike('fullName', $search)
                ->orLike('email', $search)
                ->orLike('phoneNum', $search)
                ->orLike('position', $search)
                ->orLike('membershipDate', $search)
            ->groupEnd();
        }

        $builder->orderBy('userId', 'ASC');

        $users = $builder->get()->getResultArray();
        return view('dashboard/userList', [
            'users' => $users,
            'search' => $search
        ]);
    }

    public function addUserPage()
    {
        return view('dashboard/addUser');
    }

    public function addUser()
    {
        $request = \Config\Services::request();
        $db = \Config\Database::connect();

        $email = $request->getPost('email');
        $phoneNum = $request->getPost('phoneNum');
        $userType = $request->getPost('userType');

        $exists = $db->table('user')
            ->groupStart()
                ->where('email', $email)
                ->orWhere('phoneNum', $phoneNum)
            ->groupEnd()
            ->get()
            ->getRow();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Email or phone number already exists.');
        }

        $defaultPassword = 'WelcomeMember';
        $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

        $userData = [
            'fullName'        => $request->getPost('fullName'),
            'email'           => $email,
            'password'        => $hashedPassword,
            'phoneNum'        => $phoneNum,
            'userType'        => $userType,
            'profile_picture' => '/assets/images/single-author.jpg',
        ];

        if ($userType === 'admin') {
            $userData['position'] = $request->getPost('position');
            $userData['staffSince'] = $request->getPost('staffSince');
        } else {
            $userData['position'] = null;
            $userData['staffSince'] = null;
            $userData['membershipDate'] = date('Y-m-d');
        }

        if (empty($userData['fullName'])) {
            return redirect()->back()->withInput()->with('error', 'Full Name is required.');
        }

        if (!$db->table('user')->insert($userData)) {
            return redirect()->back()->withInput()->with('error', 'Failed to add user.');
        }

        return redirect()->to('userList')->with('success', 'New user added successfully!');
    }

    public function editUser($userId)
    {
        $db = \Config\Database::connect();

        // Fetch user by ID
        $user = $db->table('user')->where('userId', $userId)->get()->getRowArray();

        if (!$user) {
            return redirect()->to('userList')->with('error', 'User not found.');
        }

        return view('dashboard/editUser', ['user' => $user]);
    }

    public function updateUser($userId)
    {
        $request = \Config\Services::request();
        $db = \Config\Database::connect();

        $email = $request->getPost('email');
        $phoneNum = $request->getPost('phoneNum');
        $userType = $request->getPost('userType');

        $existingUser = $db->table('user')->where('userId', $userId)->get()->getRowArray();
        if (!$existingUser) {
            return redirect()->to('userList')->with('error', 'User not found.');
        }

        $exists = $db->table('user')
            ->where('userId !=', $userId)
            ->groupStart()
                ->where('email', $email)
                ->orWhere('phoneNum', $phoneNum)
            ->groupEnd()
            ->get()
            ->getRow();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Email or phone number already used by another user.');
        }

        $userData = [
            'fullName'       => $request->getPost('fullName'),
            'email'          => $email,
            'phoneNum'       => $phoneNum,
            'userType'       => $userType,
            'membershipDate' => $existingUser['membershipDate'],
        ];

        if ($userType === 'admin') {
            $userData['position'] = $request->getPost('position');
            $userData['staffSince'] = $request->getPost('staffSince');
        } else {
            $userData['position'] = null;
            $userData['staffSince'] = null;
        }

        if (!$db->table('user')->where('userId', $userId)->update($userData)) {
            return redirect()->back()->with('error', 'Failed to update user.');
        }

        return redirect()->to('userList')->with('success', 'User updated successfully!');
    }

    public function deleteUser($userId)
    {
        $db = \Config\Database::connect();

        $user = $db->table('user')->where('userId', $userId)->get()->getRow();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($db->table('user')->where('userId', $userId)->delete()) {
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }

    //Book (Asma)
    public function bookList()
    {
        $genre = $this->request->getGet('genre');
        $author = $this->request->getGet('author');
        $search = $this->request->getGet('search');
        $publishedYear = $this->request->getGet('publishedYear');

        $books = $this->bookModel->getFilteredBooks($genre, $publishedYear, $author, $search);
        $genres = $this->bookModel->getUniqueGenre();
        $authors = $this->bookModel->distinct()->select('author')->findAll();

        $data = [
            'books' => $books,
            'genres' => $genres,
            'authors' => $authors,
            'selectedGenre' => $genre,
            'selectedAuthor' => $author,
            'searchQuery' => $search,
            'selectedPublishedYearOrder' => $publishedYear
        ];
        return view('dashboard/bookList', $data);
    }

    public function editBook($bookId)
    {
        $book = $this->bookModel->getBookById($bookId);
        if (!$book) {
            return redirect()->to('book')->with('error', 'Book not found.');
        }

        $dbGenres = $this->bookModel->getUniqueGenre();
        $existingGenres = array_column($dbGenres, 'genre');

        $extraGenres = ['Fantasy', 'Sci-Fi', 'Horror', 'Mystery', 'Romance', 'Adventure', 'Biography', 'Children', 'Thriller', 'Documentary', 'Poetary', 'Young Adult', 'Philosophy', 'Education'];

        $allGenres = array_unique(array_merge($existingGenres, $extraGenres));

        return view('dashboard/editBook', [
            'book' => $book,
            'genres' => $allGenres
        ]);
    }

    public function updateBook($bookId)
    {
        $book = $this->bookModel->getBookById($bookId);
        if (!$book) {
            return redirect()->to('book')->with('error', 'Book not found.');
        }
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'genre' => 'required',
            'publishedYear' => 'required|numeric',
            'shelfLocation' => 'required',
            'totalCopies' => 'required|numeric|min_length[1]',
            'description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Handle image upload
        $file = $this->request->getFile('book_cover');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $bookCoverPath = '/uploads/' . $newName;
        } else {
            $bookCoverPath = $book['book_cover'];
        }

        $totalCopies = $this->request->getPost('totalCopies');
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'isbn' => $this->request->getPost('isbn'),
            'genre' => $this->request->getPost('genre'),
            'publishedYear' => $this->request->getPost('publishedYear'),
            'shelfLocation' => $this->request->getPost('shelfLocation'),
            'totalCopies' => $totalCopies,
            'description' => $this->request->getPost('description'),
            'book_cover' => $bookCoverPath
        ];
        $this->bookModel->update($bookId, $data);
        return redirect()->to('book')->with('success', 'Book updated successfully.');
    }

    public function addBookPage()
    {
        $dbGenres = $this->bookModel->getUniqueGenre(); 
        $existingGenres = array_column($dbGenres, 'genre'); 

        $extraGenres = ['Fantasy', 'Sci-Fi', 'Horror', 'Mystery', 'Romance', 'Adventure', 'Biography', 'Children', 'Thriller', 'Documentary', 'Poetary', 'Young Adult', 'Philosophy', 'Education'];

        $allGenres = array_unique(array_merge($existingGenres, $extraGenres));

        return view('dashboard/addBook', ['genres' => $allGenres]);
    }

    public function saveBook()
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'genre' => 'required',
            'publishedYear' => 'required|numeric',
            'shelfLocation' => 'required',
            'totalCopies' => 'required|numeric|min_length[1]',
            'description' => 'required',
            'book_cover' => 'uploaded[book_cover]|is_image[book_cover]|mime_in[book_cover,image/png,image/jpg,image/jpeg]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $file = $this->request->getFile('book_cover');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $bookCoverPath = '/uploads/' . $newName;
        } else {
            $bookCoverPath = null;
        }
        $totalCopies = $this->request->getPost('totalCopies');
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'isbn' => $this->request->getPost('isbn'),
            'genre' => $this->request->getPost('genre'),
            'publishedYear' => $this->request->getPost('publishedYear'),
            'shelfLocation' => $this->request->getPost('shelfLocation'),
            'totalCopies' => $totalCopies,
            'availableCopies' => $totalCopies,
            'description' => $this->request->getPost('description'),
            'book_cover' => $bookCoverPath,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->bookModel->insert($data);
        return redirect()->to('book')->with('success', 'Book added successfully.');
    }

    public function deleteBook($bookId)
    {
        $db = \Config\Database::connect();

        $book = $db->table('book')->where('bookId', $bookId)->get()->getRow();
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        if ($db->table('book')->where('bookId', $bookId)->delete()) {
            return redirect()->back()->with('success', 'Book deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Book.');
        }
    }

    //Admin&Member

    //profile (che) 
    public function profile()
    {
        $userModel = new UserModel();

        $userType = session()->get('userType'); 
        $userId = session()->get('userId'); 

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        return view('dashboard/profile', [
            'userData' => $user,
            'userType' => $userType
        ]);
    }

    public function updateProfile()
    {
        $userType = session()->get('userType');
        $userId = session()->get('userId');

        $userModel = new UserModel();

        $data = [
            'fullName' => $this->request->getPost('fullName'),
            'email'    => $this->request->getPost('email'),
            'phoneNum' => $this->request->getPost('phoneNum')
        ];

        if ($userType === 'admin') {
            $data['position'] = $this->request->getPost('position');
        }

        $file = $this->request->getFile('profile_picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile_pictures', $newName);
            $data['profile_picture'] = '/uploads/profile_pictures/' . $newName;
        }

        $userModel->update($userId, $data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $userId = session()->get('userId');
        $userModel = new UserModel();

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'New password and confirmation do not match.');
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $userModel->update($userId, ['password' => $hashedPassword]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    // Handle logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'You successfully log out.');
    }

    public function forgotPassword()
    {
        echo view('includes/header');
        echo view('includes/navbar');
        echo view('pages/forgotpassword');
        echo view('includes/footer');
    }

    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->getUserByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(50));
            $this->userModel->setResetToken($email, $token);
            $resetLink = site_url('resetpassword/' . $token);

            $emailService = \Config\Services::email();
            $emailService->setTo($user['email']);
            $emailService->setFrom('nurainaabalqis83@gmail.com', 'Borrow Buddy');
            $emailService->setSubject('Password Reset Request');
            $emailService->setMessage("Hi {$user['fullName']},<br><br>Click the link below to reset your password:<br><a href='{$resetLink}'>{$resetLink}</a>");

            if ($emailService->send()) {
                return redirect()->to('login')->with('success', 'Password reset instructions have been sent to your email.');
            } else {
                return redirect()->to('forgotpassword')->with('error', 'Failed to send email. Please try again.');
            }
        } else {
            return redirect()->to('forgotpassword')->with('error', 'Email not found.');
        }
    }

    public function resetPassword($token)
    {
        $user = $this->userModel->verifyResetToken($token);

        if (!$user) {
            return redirect()->to('login')->with('error', 'Invalid or expired reset token.');
        }

        echo view('includes/header');
        echo view('includes/navbar');
        echo view('pages/resetpassword', ['token' => $token]);
        echo view('includes/footer');
    }


    public function processResetPassword()
    {
        $token = $this->request->getPost('reset_token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        $user = $this->userModel->verifyResetToken($token);

        if (!$user) {
            return redirect()->to('login')->with('error', 'Invalid or expired reset token.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->update($user['userId'], [
            'password' => $hashedPassword,
            'reset_token' => null,
            'reset_expires_at' => null
        ]);

        return redirect()->to('login')->with('success', 'Password has been reset. You can now log in.');
    }

    protected function setRememberMe($user)
    {
        $expire = 60 * 60 * 24 * 30; // 30 days
        $token = bin2hex(random_bytes(16));

        // Store the token in the database
        $this->userModel->setRememberToken($user['userId'], $token);

        // Set the cookie
        setcookie('remember_me', $user['email'] . ':' . $token, time() + $expire, '/', '', false, true);
    }

    protected function checkRememberMe()
    {
        if (isset($_COOKIE['remember_me'])) {
            list($email, $token) = explode(':', $_COOKIE['remember_me']);

            $user = $this->userModel->where('email', $email)->first();

            if ($user && $user['remember_token'] === $token) {
                $data = [
                    'log' => TRUE,
                    'email' => $user['email'],
                    'userType' => $user['userType'],
                ];
                session()->set($data);
            }
        }
    }
}
