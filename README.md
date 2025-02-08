# Laravel User Management System

A robust Laravel application featuring user authentication, CRUD operations, and asynchronous email notifications.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP >= 8.2
- Composer installed
- Node.js and npm installed
- MySQL installed and running
- Mailtrap account for email testing

## Quick Installation

1. **Clone and Setup**
```bash
# Clone repository
git clone https://github.com/musavirchukkan/user-managment.git
cd user-management

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env
```

2. **Configure Environment**
```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

# Mailtrap Configuration
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration
QUEUE_CONNECTION=database
```

3. **Application Setup**
```bash
# Generate key and setup storage
php artisan key:generate
php artisan storage:link

# Setup database
php artisan migrate

# Setup queue
php artisan queue:table
php artisan migrate

# Compile assets
npm run dev

# Start servers
php artisan serve
php artisan queue:work
```

## Features

- **User Authentication**
  - Registration with email verification
  - Secure login/logout functionality
  - Password reset capabilities

- **User Management**
  - Create new users with validation
  - View user details in a paginated list
  - Update user information
  - Delete users with confirmation

- **Email Notifications**
  - Asynchronous welcome emails using Laravel Queue
  - Queue worker implementation for better performance

## Testing the Application

1. **Access Points**
- Main Application: `http://localhost:8000`
- Registration: `http://localhost:8000/register`
- Login: `http://localhost:8000/login`
- Users Management: `http://localhost:8000/users`

2. **Test User Flow**
- Register a new account
- Login with credentials
- Create, view, edit, and delete users
- Check Mailtrap for welcome emails

## Technical Details

### Stack
- PHP 8.2+
- Laravel 11
- MySQL 8.0+
- Bootstrap 5
- jQuery
- SweetAlert2

### Code Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   └── UserController.php
│   ├── Requests/
│   │   └── UserRequest.php
│   └── Resources/
│       └── UserResource.php
├── Jobs/
│   └── SendWelcomeEmail.php
├── Mail/
│   └── WelcomeEmail.php
└── Models/
    └── User.php
```

### Security Features
- CSRF protection
- Form validation
- Secure password hashing
- XSS protection
- SQL injection prevention

## Troubleshooting

If you encounter issues:

1. **Permission Issues**
```bash
chmod -R 777 storage bootstrap/cache
```

2. **Cache Issues**
```bash
php artisan optimize:clear
php artisan config:clear
composer dump-autoload
```

3. **Queue Issues**
```bash
php artisan queue:restart
php artisan queue:retry all
```

## Additional Notes
- Queue worker must be running for emails (`php artisan queue:work`)
- Check Mailtrap inbox for sent emails
- Monitor `storage/logs/laravel.log` for errors
- All forms use AJAX for better UX
- Responsive design for all devices

## Contact

For questions or clarification:
Abdul Musavir - abdulmusavirc17@gmail.com
