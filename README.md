# ES2IM Site Skeleton

This repository provides a minimal scaffold for rebuilding the ES2IM school website. It includes a PHP API for contact leads and a basic front page with a contact form.

## Installation

1. Copy configuration file:
   ```bash
   cp src/config/env.example.php src/config/env.php
   ```
   Adjust database credentials as needed.
2. Import the database schema:
   ```bash
   mysql -u root -p < database.sql
   ```
3. Start a development server:
   ```bash
   php -S localhost:8000 -t public
   ```

## API Example

Create a lead:
```bash
curl -X POST http://localhost:8000/api/leads \
  -H "X-CSRF-Token: <token from cookie>" \
  -d "name=John Doe&email=john@example.com&message=Hello"
```

## Create Admin User

After importing the database, create an admin:
```sql
INSERT INTO users(email,password_hash,name)
VALUES ('admin@es2im.ma', PASSWORD('ChangeMe!'), 'Admin');
```
If the `PASSWORD()` function is unavailable, generate a hash using PHP:
```php
<?php echo password_hash('ChangeMe!', PASSWORD_DEFAULT); ?>
```

## Notes

This is a starting point; additional pages, models, controllers, and SEO enhancements still need to be implemented.
