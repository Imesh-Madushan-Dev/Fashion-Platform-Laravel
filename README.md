# DesignSphere - Digital Design Marketplace

<p align="center">
  <img src="public/images/logo.png" alt="DesignSphere Logo" width="200">
</p>

<p align="center">
  <strong>A Professional Digital Design Marketplace Platform</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/MySQL-8.0+-orange.svg" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## 📋 Table of Contents

-   [About DesignSphere](#about-designsphere)
-   [Features](#features)
-   [Technology Stack](#technology-stack)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Database Setup](#database-setup)
-   [Usage Guide](#usage-guide)
-   [API Documentation](#api-documentation)
-   [Testing](#testing)
-   [Contributing](#contributing)
-   [License](#license)
-   [Support](#support)

## 🎨 About DesignSphere

DesignSphere is a comprehensive digital design marketplace platform that connects talented designers with buyers looking for high-quality design services. Built with Laravel 10 and featuring a modern, responsive interface using TailwindCSS, the platform provides a seamless experience for both designers and buyers.

### Key Highlights

-   **Dual User System**: Separate authentication and dashboards for designers and buyers
-   **Professional Design Showcase**: Advanced portfolio management for designers
-   **Secure Payment Processing**: Integrated payment system with order tracking
-   **Responsive Design**: Mobile-first approach with modern UI/UX
-   **Real-time Order Management**: Complete order lifecycle management
-   **Advanced Search & Filtering**: Powerful marketplace browsing capabilities

## ✨ Features

### For Designers

-   🎨 **Portfolio Management**: Create and manage design portfolios
-   📊 **Dashboard Analytics**: Track orders, earnings, and performance
-   🛍️ **Order Management**: Handle incoming orders and client communications
-   💰 **Pricing Control**: Set custom pricing for different design categories
-   📱 **Responsive Design Tools**: Mobile-optimized design management interface

### For Buyers

-   🔍 **Advanced Search**: Find designs by category, price, and designer
-   🛒 **Order System**: Seamless ordering process with custom requirements
-   💳 **Secure Payments**: Safe and secure payment processing
-   📋 **Order Tracking**: Real-time order status updates
-   ⭐ **Designer Profiles**: View detailed designer information and portfolios

### Admin Features

-   📈 **Analytics Dashboard**: Comprehensive platform statistics
-   👥 **User Management**: Manage designers and buyers
-   🔧 **System Configuration**: Platform settings and configurations
-   📊 **Financial Reports**: Revenue and transaction reporting


## 🛠️ Technology Stack

### Backend

-   **Framework**: Laravel 10.x
-   **Language**: PHP 8.1+
-   **Database**: MySQL 8.0+ / PostgreSQL 13+
-   **Authentication**: Laravel Sanctum
-   **File Storage**: Local/S3 Compatible

### Frontend

-   **CSS Framework**: TailwindCSS 3.x
-   **JavaScript**: Vanilla JS with modern ES6+
-   **Build Tool**: Vite
-   **Icons**: Heroicons
-   **Responsive**: Mobile-first design

### Development Tools

-   **Package Manager**: Composer
-   **Testing**: PHPUnit
-   **Code Style**: PSR-12
-   **Version Control**: Git

## 🚀 Installation

### Prerequisites

Ensure you have the following installed:

-   PHP 8.1 or higher
-   Composer
-   Node.js 16+ and npm
-   MySQL 8.0+ or PostgreSQL 13+
-   Git

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/design-sphere.git
cd design-sphere
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

```bash
# Run database migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### Step 5: Build Assets

```bash
# Compile assets for development
npm run dev

# Or for production
npm run build
```

### Step 6: Start the Application

```bash
# Start the development server
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## ⚙️ Configuration

### Environment Variables

Configure the following in your `.env` file:

```env
# Application
APP_NAME="DesignSphere"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=designsphere
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls

# File Storage
FILESYSTEM_DISK=local
# For production, use S3:
# FILESYSTEM_DISK=s3
# AWS_ACCESS_KEY_ID=your-access-key
# AWS_SECRET_ACCESS_KEY=your-secret-key
# AWS_DEFAULT_REGION=us-east-1
# AWS_BUCKET=your-bucket-name
```

## 🗄️ Database Setup

### Migration Commands

```bash
# Run all migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:refresh

# Reset, re-run migrations, and seed
php artisan migrate:refresh --seed
```

### Database Structure

The application uses the following main tables:

-   `users` - Base user authentication
-   `designers` - Designer-specific information
-   `buyers` - Buyer-specific information
-   `designs` - Design portfolio items
-   `orders` - Order management
-   `payments` - Payment tracking

## 📖 Usage Guide

### Getting Started as a Designer

1. **Registration**: Visit `/designer/register` to create a designer account
2. **Profile Setup**: Complete your designer profile with portfolio information
3. **Upload Designs**: Add your designs to the marketplace
4. **Manage Orders**: Handle incoming orders from the dashboard
5. **Track Earnings**: Monitor your earnings and performance

### Getting Started as a Buyer

1. **Registration**: Visit `/buyer/register` to create a buyer account
2. **Browse Marketplace**: Explore available designs by category
3. **Place Orders**: Select designs and place custom orders
4. **Track Orders**: Monitor order progress from your dashboard
5. **Make Payments**: Complete secure payments for your orders

### Admin Panel Access

Access the admin panel at `/admin` with administrator credentials to:

-   Monitor platform statistics
-   Manage users and content
-   Configure system settings
-   Generate reports

## 🔌 API Documentation

### Authentication Endpoints

```http
POST /api/auth/login
POST /api/auth/register
POST /api/auth/logout
POST /api/auth/refresh
```

### Design Endpoints

```http
GET /api/designs - List all designs
GET /api/designs/{id} - Get specific design
POST /api/designs - Create new design (Designer only)
PUT /api/designs/{id} - Update design (Designer only)
DELETE /api/designs/{id} - Delete design (Designer only)
```

### Order Endpoints

```http
GET /api/orders - List user orders
POST /api/orders - Create new order
GET /api/orders/{id} - Get specific order
PUT /api/orders/{id} - Update order status
```

## 🧪 Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### Test Categories

-   **Unit Tests**: Test individual components and methods
-   **Feature Tests**: Test complete application workflows
-   **Browser Tests**: End-to-end testing with Laravel Dusk

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines

-   Follow PSR-12 coding standards
-   Write comprehensive tests for new features
-   Update documentation for any API changes
-   Use meaningful commit messages

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## 🆘 Support

### Documentation

-   [Installation Guide](docs/installation.md)
-   [API Reference](docs/api.md)
-   [Deployment Guide](docs/deployment.md)
-   [Troubleshooting](docs/troubleshooting.md)

### Getting Help

-   **Email**: support@designsphere.com
-   **Documentation**: [docs.designsphere.com](https://docs.designsphere.com)
-   **Issues**: [GitHub Issues](https://github.com/yourusername/design-sphere/issues)
-   **Discussions**: [GitHub Discussions](https://github.com/yourusername/design-sphere/discussions)

### Community

-   **Discord**: [Join our Discord](https://discord.gg/designsphere)
-   **Twitter**: [@DesignSphere](https://twitter.com/designsphere)
-   **LinkedIn**: [DesignSphere Company](https://linkedin.com/company/designsphere)

---

<p align="center">
  Made with ❤️ by the DesignSphere Team
</p>

<p align="center">
  <a href="#top">Back to Top</a>
</p>
