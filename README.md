# 🚀 Laravel Job Portal

A comprehensive job portal application built with Laravel 12 that connects job seekers with employers. This platform provides a complete ecosystem for job management, applications, and user profiles.

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 🌟 Features

### 👥 **Multi-Role System**
- **Job Seekers (Applicants)**: Browse jobs, apply, manage profile and resume
- **Companies**: Post jobs, manage applications, company profile

### 🔍 **Job Management**
- **Job Posting**: Companies can create detailed job listings
- **Job Categories**: Organized job categorization system
- **Job Search**: Advanced search and filtering capabilities
- **Application Tracking**: Complete application management system

### 📄 **Resume & Profile System**
- **Resume Upload**: PDF/DOC resume upload functionality
- **Profile Management**: Comprehensive user profiles
- **Skills & Experience**: Detailed professional information
- **Application History**: Track all job applications

### 🛡️ **Security & Authentication**
- Secure user authentication system
- Role-based access control
- Session management
- CSRF protection

## 🏗️ **System Architecture**

### **Database Schema**
- **Users**: Multi-role user management
- **Jobs**: Job listings with detailed information
- **Applications**: Job application tracking
- **Resumes**: Resume file management
- **Categories**: Job categorization
- **Roles**: User role management
- **Sessions**: Secure session handling

### **Key Models**
- `User` - User management with role-based features
- `Job` - Job posting and management
- `Application` - Job application system
- `Resume` - Resume file handling
- `Category` - Job categorization
- `Role` - User roles (Applicant, Company, Admin)

## 🚀 **Live Demo**

The application is deployed and accessible at:
**🌐 [https://job-portal-fp.host1.uno/](https://job-portal-fp.host1.uno/)**


## 📋 **Requirements**

### **System Requirements**
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Database**: MySQL 8.0+ or MariaDB 10.3+
- **Web Server**: Apache/Nginx
- **Node.js**: For asset compilation (optional)

### **Laravel Dependencies**
- Laravel Framework 12.x
- Laravel Tinker
- Faker PHP (for seeding)
- Pest PHP (for testing)

## 🛠️ **Installation Guide**

### **1. Prerequisites Setup**

#### **Install Composer**
1. Download Composer from [getcomposer.org](https://getcomposer.org/Composer-Setup.exe)
2. Run the installer
3. Follow installation steps:
   - **Installation Option** → Next
   - **Settings Check** → Browse to your PHP executable → Check "Add this PHP to your path" → Next
   - **Proxy Settings** → Next
   - **Ready to Install** → Install
   - **Information** → Next → Finish

#### **Verify Composer Installation**
```bash
composer --version
```

#### **Install Git (if not installed)**
1. Download Git from [git-scm.com](https://github.com/git-for-windows/git/releases/download/v2.50.0.windows.1/Git-2.50.0-64-bit.exe)
2. Install with default settings

### **2. Project Setup**

#### **Clone the Repository**
```bash
git clone https://github.com/irfanprayoga29/job-portal.git
cd job-portal
```

#### **Install Dependencies**
```bash
composer install
```

#### **Environment Configuration**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### **Configure Database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=your_password
```

### **3. Database Setup**

#### **Create Database**
```sql
CREATE DATABASE job_portal;
```

#### **Run Migrations**
```bash
php artisan migrate
```

#### **Seed Database (Optional)**
```bash
php artisan db:seed
```

### **4. Run the Application**

#### **Start Development Server**
```bash
php artisan serve
```

#### **Access the Application**
Open your browser and navigate to: `http://localhost:8000`

## 🔧 **Configuration**

### **Environment Variables**
Key environment variables in `.env`:

```env
APP_NAME="Job Portal"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### **File Storage**
Configure file storage for resume uploads:
```env
FILESYSTEM_DISK=local
```

## 🧪 **Testing**

### **Run Tests**
```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

### **Database Testing**
```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

## 🚀 **Deployment**

### **Production Deployment**
The application is configured for deployment on:
- **Railway** (Current deployment)
- **Heroku**
- **DigitalOcean**
- **AWS**
- **Traditional hosting**

### **Production Checklist**
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure production database
- [ ] Set up proper session driver
- [ ] Configure file storage
- [ ] Set up SSL certificate
- [ ] Configure caching
- [ ] Set up monitoring

### **Deployment Files**
- `Dockerfile` - Docker container configuration
- `nixpacks.toml` - Railway deployment configuration
- `entrypoint.sh` - Container startup script

## 🤝 **Contributing**

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 **API Documentation**

### **Key Endpoints**
- `GET /` - Homepage
- `GET /jobs` - Job listings
- `POST /jobs` - Create job (Company)
- `GET /jobs/{id}` - Job details
- `POST /applications` - Apply for job
- `GET /user/profile` - User profile
- `POST /user/profile` - Update profile

## 🐛 **Troubleshooting**

### **Common Issues**

#### **Composer Install Fails**
```bash
composer install --no-dev --optimize-autoloader
```

#### **Migration Errors**
```bash
php artisan migrate:refresh --seed
```

#### **Permission Issues**
```bash
chmod -R 755 storage bootstrap/cache
```

#### **Database Connection Failed**
1. Check database credentials in `.env`
2. Ensure database server is running
3. Verify database exists

## 📊 **Performance**

### **Optimization Features**
- Database query optimization
- Caching implementation
- Asset optimization
- Session management
- Queue processing

### **Monitoring**
- Application logging
- Error tracking
- Performance metrics
- Database monitoring

## 🔒 **Security**

### **Security Features**
- CSRF protection
- SQL injection prevention
- XSS protection
- Authentication system
- Role-based access control
- Secure file uploads

## 📞 **Support**

### **Getting Help**
- **Issues**: [GitHub Issues](https://github.com/irfanprayoga29/job-portal/issues)
- **Documentation**: This README and Laravel docs
- **Community**: Laravel community forums

### **Reporting Bugs**
Please include:
- Laravel version
- PHP version
- Error messages
- Steps to reproduce

## 📜 **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 **Acknowledgments**

- **Laravel Framework** - The amazing PHP framework
- **Railway** - Deployment platform
- **Community Contributors** - Thank you for your contributions!

---

**📅 Last Updated**: July 2025  
**🔧 Maintained by**: Development Team  
**🌟 Version**: 1.0.0
