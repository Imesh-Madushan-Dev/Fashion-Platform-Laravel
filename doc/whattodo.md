# XAMPP/phpMyAdmin Setup Instructions for Fashion Platform

## Prerequisites
- XAMPP installed on your system
- Fashion Platform Laravel project files in place
- Basic understanding of phpMyAdmin

## Step-by-Step Database Setup

### 1. Start XAMPP Services
1. Open XAMPP Control Panel
2. Start **Apache** service
3. Start **MySQL** service
4. Verify both services show "Running" status

### 2. Access phpMyAdmin
1. Open your web browser
2. Navigate to: `http://localhost/phpmyadmin`
3. You should see the phpMyAdmin interface

### 3. Create Database
1. Click on **"New"** in the left sidebar
2. Enter database name: `fashion_platform`
3. Choose collation: `utf8mb4_unicode_ci` (recommended for Laravel)
4. Click **"Create"**

### 4. Import Database Schema
1. Select the `fashion_platform` database from the left sidebar
2. Click on **"SQL"** tab at the top
3. Copy the entire content from `doc/db.sql` file
4. Paste it into the SQL query box
5. Click **"Go"** to execute

**Alternative Method - Import SQL File:**
1. Click on **"Import"** tab
2. Click **"Choose File"** and select `doc/db.sql`
3. Leave other settings as default
4. Click **"Go"**

### 5. Verify Database Tables
After successful import, you should see these tables in the left sidebar:
- `buyers`
- `designers` 
- `designs`
- `orders`

Click on each table to verify the structure matches the requirements.

### 6. Configure Laravel Environment
1. Navigate to your Laravel project root directory
2. Copy `.env.example` to `.env` (if not already done)
3. Edit `.env` file with these database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fashion_platform
DB_USERNAME=root
DB_PASSWORD=
```

**Note:** Default XAMPP MySQL username is `root` with no password.

### 7. Run Laravel Setup Commands
Open command prompt/terminal in your Laravel project directory and run:

```bash
# Install dependencies
composer install

# Generate application key
php artisan key:generate

# Create storage link for file uploads
php artisan storage:link

# Run migrations (if using Laravel migrations instead of direct SQL)
php artisan migrate

# Optional: Seed database with sample data
php artisan db:seed
```

### 8. Create Required Directories
Ensure these directories exist for image uploads:
```
public/designs/
storage/app/public/designs/
```

Create them manually if they don't exist.

### 9. Test Database Connection
1. Start Laravel development server: `php artisan serve`
2. Open browser to: `http://localhost:8000`
3. Try accessing registration pages:
   - Designer: `http://localhost:8000/designer/register`
   - Buyer: `http://localhost:8000/buyer/register`

### 10. Troubleshooting Common Issues

#### Issue: "Database connection refused"
**Solution:**
- Verify MySQL service is running in XAMPP
- Check database credentials in `.env` file
- Ensure database name matches exactly

#### Issue: "Table doesn't exist"
**Solution:**
- Verify SQL import was successful
- Check if all tables are visible in phpMyAdmin
- Re-run the SQL import if necessary

#### Issue: "Permission denied" for file uploads
**Solution:**
- Ensure `public/designs/` directory exists
- Check folder permissions (read/write access)
- Run `php artisan storage:link`

#### Issue: "Class not found" errors
**Solution:**
- Run `composer install` to install dependencies
- Run `composer dump-autoload` to refresh autoloader
- Clear Laravel cache: `php artisan cache:clear`

## Sample Data for Testing

### Test Designer Account
You can manually insert a test designer:

```sql
INSERT INTO designers (name, email, password, created_at, updated_at) 
VALUES ('John Designer', 'designer@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());
```
**Password:** `password`

### Test Buyer Account
You can manually insert a test buyer:

```sql
INSERT INTO buyers (name, email, password, created_at, updated_at) 
VALUES ('Jane Buyer', 'buyer@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());
```
**Password:** `password`

## Database Management Tips

### Viewing Records
- Use phpMyAdmin's **"Browse"** tab to view table data
- Use **"Search"** tab to find specific records
- Use **"SQL"** tab for custom queries

### Backup Database
1. Select `fashion_platform` database
2. Click **"Export"** tab
3. Choose **"Quick"** export method
4. Select **"SQL"** format
5. Click **"Go"** to download backup

### Reset Database
To start fresh:
1. Drop all tables or delete database
2. Recreate `fashion_platform` database
3. Re-import `doc/db.sql`

## Security Notes for Production

  **Important:** These instructions are for development only!

For production deployment:
- Create a dedicated MySQL user (not root)
- Use strong passwords
- Enable SSL connections
- Configure proper firewall rules
- Regular database backups

## Next Steps After Setup

1. **Test Authentication:**
   - Register as Designer and Buyer
   - Test login functionality
   - Verify dashboard access

2. **Test Design Upload:**
   - Login as Designer
   - Upload a test design with image
   - Verify file storage in `/public/designs/`

3. **Test Marketplace:**
   - Login as Buyer
   - Browse designs in marketplace
   - Create test orders

4. **Test Payment Flow:**
   - Create an order as Buyer
   - Go through dummy payment process
   - Verify order status updates

## Support

If you encounter issues:
1. Check XAMPP error logs
2. Check Laravel logs in `storage/logs/`
3. Verify all services are running
4. Ensure file permissions are correct

---

**Your Fashion Platform database is now ready for development and testing!**