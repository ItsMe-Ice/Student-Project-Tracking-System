# Student Project Tracking System

![Laravel](https://img.shields.io/badge/Laravel-10.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![MySQL](https://img.shields.io/badge/Database-MySQL-green.svg)
![Bootstrap](https://img.shields.io/badge/UI-Bootstrap-red.svg)

A comprehensive web-based application designed to help educational institutions manage and track student projects throughout their academic journey. This system provides role-based access for administrators, teachers, and students to efficiently manage project assignments, deadlines, and progress.

## 🎯 Features

### 🏗️ **Admin Features**
- **User Management**: Create, edit, and manage student and teacher accounts
- **Role Promotion**: Promote students to teachers with a single click
- **Teacher Assignment**: Assign teachers to specific students for project supervision
- **System Overview**: Monitor overall system statistics and user activity

### 👨‍🏫 **Teacher Features**
- **Student Management**: View and manage assigned students
- **Project Oversight**: Monitor project progress and deadlines for all assigned students
- **Progress Tracking**: Review student progress reports and provide feedback
- **Deadline Management**: Track project end dates and submission deadlines

### 👨‍🎓 **Student Features**
- **Project Management**: Create, edit, and manage personal projects
- **Document Upload**: Upload project documents and supporting materials
- **Progress Reporting**: Submit progress reports to track project development
- **Personal Dashboard**: View personal project deadlines and status updates

### 📅 **Calendar System**
- **Role-Based Filtering**: Each user sees only relevant project deadlines
  - **Admins**: View all project deadlines across the system
  - **Teachers**: View only deadlines for assigned students' projects
  - **Students**: View only their personal project deadlines
- **Visual Indicators**: Color-coded status indicators (Due, Completed, In Progress)
- **Interactive Interface**: Hover tooltips with project details and student names
- **Multi-Project Support**: Handles multiple projects with same deadline dates

## 🏗️ Architecture

This application follows Laravel's MVC (Model-View-Controller) architecture:

- **Models**: User, Project, Document, ProgressReport, Comment
- **Controllers**: Handle business logic and HTTP requests
- **Views**: Blade templates with Bootstrap 5 for responsive UI
- **Database**: MySQL with Eloquent ORM for data management
- **Authentication**: Laravel's built-in authentication system

## 🚀 Quick Start

### Prerequisites

- **PHP** 8.1 or higher
- **MySQL** 5.7 or higher
- **Composer** (PHP dependency manager)
- **Node.js** 16+ (for frontend assets)
- **Web Server** (Apache/Nginx with mod_rewrite enabled)

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/ItsMe-Ice/Student-Project-Tracking-System.git
   cd Student-Project-Tracking-System
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   # Copy environment configuration
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Database Configuration**
   Edit your `.env` file with your database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

5. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

6. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

7. **Build Frontend Assets**
   ```bash
   npm run build
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

9. **Access the Application**
   Open your browser and navigate to `http://127.0.0.1:8000`

## 📋 Detailed Setup Guide

### Step 1: System Requirements

Ensure you have the following installed:

- **PHP 8.1+** with extensions:
  - `pdo_mysql`
  - `mbstring`
  - `xml`
  - `ctype`
  - `json`
  - `tokenizer`
  - `bcmath`
  - `fileinfo`
  - `openssl`

- **MySQL 5.7+** or MariaDB 10.3+

- **Composer** for PHP package management

- **Node.js 16+** with npm for frontend dependencies

### Step 2: Project Setup

1. **Download/Clone the Project**
   ```bash
   # If using Git
   git clone https://github.com/ItsMe-Ice/Student-Project-Tracking-System.git
   cd Student-Project-Tracking-System
   
   # Or download as ZIP and extract to your web server directory
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```
   This installs all required PHP packages including Laravel framework.

3. **Configure Environment**
   ```bash
   # Copy the example environment file
   cp .env.example .env
   
   # Generate a unique application key
   php artisan key:generate
   ```

4. **Set Up Database**
   - Create a new MySQL database:
     ```sql
     CREATE DATABASE student_project_tracking;
     ```
   - Update `.env` file with your database credentials:
     ```env
     DB_DATABASE=student_project_tracking
     DB_USERNAME=your_mysql_username
     DB_PASSWORD=your_mysql_password
     ```

5. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```
   This creates all necessary database tables.

6. **Install Frontend Dependencies**
   ```bash
   npm install
   ```
   Installs Bootstrap, Tailwind CSS, and other frontend packages.

7. **Build Frontend Assets**
   ```bash
   npm run build
   ```
   Compiles and optimizes CSS and JavaScript files.

### Step 3: Web Server Configuration

#### Option A: Using Built-in PHP Server (Development)
```bash
php artisan serve
```
Access at `http://127.0.0.1:8000`

#### Option B: Apache Configuration
Create a virtual host:
```apache
<VirtualHost *:80>
    ServerName student-tracking.local
    DocumentRoot "C:/path/to/Student-Project-Tracking-System/public"
    
    <Directory "C:/path/to/Student-Project-Tracking-System/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Option C: Nginx Configuration
```nginx
server {
    listen 80;
    server_name student-tracking.local;
    root C:/path/to/Student-Project-Tracking-System/public;
    index index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Step 4: Initial Setup

1. **Access the Application**
   Navigate to your configured URL (e.g., `http://127.0.0.1:8000`)

2. **Create Admin Account**
   - Register as a new user
   - By default, the first user is automatically assigned admin privileges

3. **Add Users**
   - Log in as admin
   - Navigate to "User Management" to add students and teachers
   - Use "Promote Students" to convert students to teachers
   - Use "Teacher Assignment" to assign teachers to students

## 🔐 Authentication & Security

- **Role-Based Access Control**: Three distinct user roles (Admin, Teacher, Student)
- **Password Protection**: Secure password hashing using bcrypt
- **Session Management**: Secure session handling with CSRF protection
- **Input Validation**: Comprehensive validation for all user inputs

## 📊 Database Schema

The system uses the following main tables:

- **users**: User accounts with role-based permissions
- **projects**: Student project information and metadata
- **documents**: Project document uploads and file management
- **progress_reports**: Student progress tracking and reporting
- **comments**: Communication between students and teachers
- **sessions**: User session management

## 🎨 Customization

### Adding New Features
1. Create database migrations: `php artisan make:migration create_table_name_table`
2. Create models: `php artisan make:model ModelName`
3. Create controllers: `php artisan make:controller ControllerName`
4. Add routes in `routes/web.php`
5. Create views in `resources/views/`

### Styling Changes
- Main CSS: `resources/css/app.css`
- Main JavaScript: `resources/js/app.js`
- Bootstrap components: `resources/views/components/`

## 🚀 Deployment

### Production Environment
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Ensure proper file permissions

### Environment Variables for Production
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
LOG_CHANNEL=stack
SESSION_DRIVER=database
QUEUE_CONNECTION=sync
```

## 🐛 Troubleshooting

### Common Issues

**"Class '...' not found"**
```bash
composer dump-autoload
composer install
```

**"SQLSTATE[HY000] [1045] Access denied"**
- Check database credentials in `.env` file
- Ensure MySQL server is running
- Verify database exists and user has permissions

**"Target class [Controller] does not exist"**
- Clear Laravel cache: `php artisan cache:clear`
- Clear config cache: `php artisan config:clear`
- Clear route cache: `php artisan route:clear`

**"The stream or file could not be opened"**
- Ensure `storage/logs/` directory is writable
- Set proper permissions: `chmod -R 775 storage/`

### Getting Help

1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode temporarily in `.env`: `APP_DEBUG=true`
3. Run `php artisan list` to see available commands
4. Visit [Laravel Documentation](https://laravel.com/docs)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes
4. Commit your changes: `git commit -m 'Add feature'`
5. Push to the branch: `git push origin feature-name`
6. Submit a pull request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- Frontend powered by [Bootstrap 5](https://getbootstrap.com)
- Database management with [Eloquent ORM](https://laravel.com/docs/eloquent)
- Authentication using [Laravel Fortify](https://laravel.com/docs/fortify)

---

**For support or questions, please create an issue in the GitHub repository.**