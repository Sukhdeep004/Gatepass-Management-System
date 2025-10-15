**Gate Pass Management System (GPMS)**

A web-based application to automate and streamline visitor and personnel gate pass management in organizations.
Overview
GPMS replaces traditional manual gate pass systems with a digital solution that reduces pass generation time by 90% (from 30-45 minutes to 2-3 minutes) while providing enhanced security and comprehensive reporting.

**Features**

Admin Registration & Login - Secure authentication with session management
Dashboard - Real-time statistics (Total passes, Today's passes, Weekly passes)
Pass Management - Create, view, edit, and delete gate passes
Multiple Categories - Support for Visitor, Employee, Student, and Vendor passes
Identity Verification - Supports Aadhaar, PAN, Passport, Driving License, Voter Card
Reports Module - Generate Daily, Monthly, Yearly, and Custom date range reports
Print Functionality - Professional print-optimized pass layout
Complete Security - Password encryption, SQL injection prevention, session-based access control

**Technology Stack**
Frontend: HTML5, CSS3, Bootstrap 5.3, JavaScript, Font Awesome
Backend: PHP 7.2+, MySQL 5.7+
Server: Apache/XAMPP

**Installation**

Install XAMPP/WAMP
Clone or download the project to htdocs folder
Create database named getpassdb in phpMyAdmin
Import getpassdb.sql file
Update database credentials in db.php
Start Apache and MySQL services
Access at http://localhost/gpms/

**Default Login**
Username: admin
Password: admin
Note: Change default credentials after first login.
Database Setup
sqlCREATE DATABASE getpassdb;
Then import the provided getpassdb.sql file via phpMyAdmin or command line.
Usage

Register/Login - Create admin account or use default credentials
Add Pass - Fill form with visitor details, system generates unique pass number
Manage Passes - View all passes, edit or delete as needed
Generate Reports - Select report type and date range
Print Pass - Click print button for professional output

**Project Structure**
gpms/
├── includes/          # Header, footer, sidebar files
├── img/              # Images and assets
├── index.html        # Landing page
├── index.php         # Login page
├── register.php      # Admin registration
├── dashboard.php     # Dashboard with statistics
├── add-pass.php      # Create new pass
├── manage-passes.php # View all passes
├── view-pass-detail.php # View single pass
├── edit-pass-detail.php # Edit pass
├── delete-pass.php   # Delete pass
├── reports.php       # Report generation
├── logout.php        # Logout handler
├── db.php           # Database configuration
├── style.css        # Custom styles
└── getpassdb.sql    # Database schema
Security Features

Session-based authentication on all pages
MD5 password hashing
SQL injection prevention
Input validation and sanitization
XSS attack protection
Confirmation dialogs for delete operations


**Future Enhancements**

Mobile application (Android/iOS)
Email/SMS notifications
QR code generation and scanning
Photo capture integration
Advanced analytics with charts
Two-factor authentication
Cloud deployment

**Requirements**
Server: PHP 7.2+, MySQL 5.7+, Apache 2.4+
Client: Modern web browser, 1280x720 resolution minimum
Storage: 500 MB minimum
License
MIT License - Feel free to use and modify for your projects.
Contact
For issues or queries, please contact: sukhdeepsingh0221@gmail.com

**Acknowledgments**
Built with Bootstrap, Font Awesome, and PHP/MySQL. Special thanks to the open-source community.

Made with ❤️ for efficient visitor management
