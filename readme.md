# TaskDone Task Management System

A comprehensive student management system built with Laravel 12, designed to simplify administration for educational institutions.

## Features

- **User Management**: Role-based access for administrators, teachers, and students  
- **Student Profiles**: Complete student information with academic history  
- **Course Management**: Create, edit, and organize courses and classes  
- **Attendance Tracking**: Record and monitor student attendance  
- **Grade Management**: Input, calculate, and report student grades  
- **Timetable System**: Schedule classes and manage resources  
- **Communication Tools**: Messaging between students, teachers, and parents  
- **Report Generation**: Export academic reports and statistics  
- **Dashboard Analytics**: Visual insights into performance metrics  
- **Mobile Responsive**: Access from any device  

## Requirements

- PHP 8.2 or higher  
- Composer  
- MySQL 8.0 or higher  
- Node.js and NPM  

## Installation

### Clone the repository
```bash
git clone https://github.com/Sahariar/TaskDone.git
cd laravel-student-management
```

### Install dependencies
```bash
composer install
npm install
```

### Set up environment variables
```bash
cp .env.example .env
php artisan key:generate
```

### Configure your database in the `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_management
DB_USERNAME=root
DB_PASSWORD=
```

### Run migrations and seed the database
```bash
php artisan migrate --seed
```

### Compile assets
```bash
npm run dev
```

### Start the server
```bash
php artisan serve
```

## Usage

After installation, you can access the application at [http://localhost:8000](http://localhost:8000).

**Default login credentials:**
- **Admin**: `admin@example.com` / `password`
- **Teacher**: `teacher@example.com` / `password`
- **Student**: `student@example.com` / `password`

## Documentation

Detailed documentation is available in the `docs` directory.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Screenshots

(Add screenshots of your application here)

## Support

If you encounter any issues or have questions, please open an issue on GitHub or contact [support@yourdomain.com](mailto:support@yourdomain.com).

## Roadmap

- Mobile application integration  
- Payment gateway for fee collection  
- Advanced reporting features  
- Parent portal  

## Credits

Developed by [Sahariar Kabir]
