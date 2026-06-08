# BorrowBuddy

BorrowBuddy is a digital borrowing and lending management system that helps users record item details, manage borrower information, track borrowing status, and monitor return dates more efficiently.

## About the Project

BorrowBuddy is developed to help users manage borrowing and lending activities in a simple and organized way. Instead of using manual records or notes, users can use this system to keep track of borrowed items, borrower details, borrowing dates, return dates, and item status.

This system helps reduce common problems such as forgotten borrowed items, unclear borrower information, misplaced records, and late returns. BorrowBuddy is suitable for students, individuals, small communities, clubs, and organizations that frequently lend or borrow items.

## Objectives

The objectives of BorrowBuddy are:

1. To develop a system that records item borrowing and lending information.
2. To help users manage borrower details and item status.
3. To allow users to monitor borrowing dates and return dates.
4. To reduce miscommunication between item owners and borrowers.
5. To provide a more organized method for managing borrowed items.

## Features

- Add and manage item details
- View list of available items
- Record borrower information
- Track borrowed items
- Track returned items
- Update borrowing status
- Manage borrowing date and return date
- Search or view borrowing records
- Organize all borrowing data in one system

## Target Users

BorrowBuddy is suitable for:

- Students
- Personal item owners
- Small communities
- Clubs and societies
- Organizations
- Individuals who often lend or borrow items

## Technologies Used

- Frontend: HTML, CSS, JavaScript
- Backend: PHP (Codeignitor4)
- Database: MySQL
- Tools: Visual Studio Code, XAMPP or Laragon, GitHub

## Project Structure

BorrowBuddy/
│
├── index.html
├── style.css
├── script.js
├── README.md
│
├── assets/
│   ├── images/
│   └── icons/
│
├── database/
│   └── borrowbuddy.sql
│
└── pages/
    ├── add_item.html
    ├── borrower.html
    ├── records.html
    └── status.html

## How to Run the Project

### 1. Clone the Repository

Use the command below to clone this project:

    git clone https://github.com/NanaBalqis/borrowbuddy.git

### 2. Open the Project Folder

    cd borrowbuddy

### 3. Run the Project

If the project is built using only HTML, CSS, and JavaScript, open the index.html file in your browser.

If the project uses PHP and MySQL:

1. Copy the project folder into the htdocs folder if using XAMPP, or the www folder if using Laragon.
2. Start Apache and MySQL.
3. Import the database file from the database folder.
4. Open the project in your browser using:

    http://localhost/borrowbuddy

## Database Setup

If the project uses a database, follow these steps:

1. Open phpMyAdmin.
2. Create a new database named:

    borrowbuddy

3. Import the SQL file from the database folder.
4. Make sure the database connection settings are correct.

Example database configuration:

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "borrowbuddy";

## Main Modules

### 1. Item Management

This module allows users to add, view, edit, and manage item details. Each item can include information such as item name, category, description, and availability status.

### 2. Borrower Management

This module records borrower information such as borrower name, contact number, borrowed item, borrowing date, and return date.

### 3. Borrowing Record Management

This module stores borrowing records, including item details, borrower details, borrowing date, return date, and item status.

### 4. Status Tracking

This module allows users to check whether an item is available, borrowed, or returned.

## System Benefits

- Makes borrowing records easier to manage
- Helps users track borrowed and returned items
- Reduces the risk of losing item information
- Improves responsibility between lender and borrower
- Saves time compared to manual tracking
- Provides organized borrowing history

## Future Improvements

Future improvements for BorrowBuddy may include:

- User login and registration
- Email or notification reminders
- Return date alerts
- Search and filter function
- Borrowing history report
- Admin dashboard
- QR code for item tracking
- Mobile-friendly design
- Export records to PDF or Excel

## Screenshots

Project screenshots can be added here.

Example:

    ![Homepage Screenshot](assets/images/homepage.png)
    ![Borrowing Record Screenshot](assets/images/records.png)

## Project Status

This project is currently developed for academic and project purposes. More features and improvements may be added in the future.

## Author

Developed by:

Your Name

Bachelor of Computer Science  
Universiti Teknologi MARA Kuala Terengganu

## License

This project is for educational purposes only.