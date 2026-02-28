# Simple Vanilla PHP CRUD

This project demonstrates a basic Create/Read/Update/Delete application using plain PHP and PDO.

## Setup

1. Make sure you have a MySQL database named `crud` (you can change the name in `config/db.php`).
2. Update credentials in `config/db.php` (`user`, `pass`, etc.).
3. When you load any page the code will automatically create a `contacts` table if it doesn't exist.

## Files

- `index.php` - list all contacts
- `create.php` - add a new contact
- `edit.php` - modify an existing contact
- `delete.php` - remove a contact
- `config/db.php` - database connection using PDO, table creation logic

### UI

Pages now use [Tailwind CSS](https://tailwindcss.com) via CDN and are wrapped in a centered container (`max-w-screen-lg mx-auto` ≈1200px) for spacing. Delete operations trigger a modal dialog instead of a native alert.

## Usage

Open `http://localhost/crud-public/index.php` in your browser and start managing contacts.

