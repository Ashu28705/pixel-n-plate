# Pixel n Plate

Pixel n Plate is a full-stack web project for a modern cafe + gaming zone + event venue.
The platform includes a premium responsive frontend and PHP/MySQL backend forms for event bookings, feedback, and contact submissions.

## Highlights

- Premium, modern UI across all pages
- Responsive layout for mobile, tablet, and desktop
- Dark/light theme toggle
- Animated hero, counters, filters, and countdowns
- Menu search and category filtering
- Multi-step event booking form
- Feedback form with rating and reaction input
- Contact form with backend storage

## Tech Stack

- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP
- Database: MySQL
- Local environment: XAMPP (Apache + MySQL)

## Pages

- `index.html` - Homepage
- `menu.html` - Food menu with filters/search
- `games.html` - Gaming showcase
- `events.html` - Event cards with countdowns
- `book-event.html` - Booking form (posts to PHP)
- `contact.html` - Contact form (posts to PHP)
- `feedback.html` - Feedback form (posts to PHP)

## Backend Endpoints

- `book_event.php` - Stores event bookings in `bookings`
- `contact_submit.php` - Stores contact requests in `contacts`
- `feedback.php` - Stores feedback in `feedback`
- `db_connect.php` - MySQL connection config

## Database Setup

1. Start Apache and MySQL from XAMPP.
2. Open phpMyAdmin.
3. Import `setup.sql`.
4. Confirm database `pixelnplate_db` and tables:
   - `bookings`
   - `feedback`
   - `contacts`

## Local Run

1. Place this project folder inside XAMPP `htdocs`.
2. Start Apache and MySQL.
3. Open in browser:
   - `http://localhost/pixel-n-plate/index.html`
4. Test forms:
   - Booking from `book-event.html`
   - Contact from `contact.html`
   - Feedback from `feedback.html`

## Project Structure

```text
pixel-n-plate/
|- index.html
|- menu.html
|- games.html
|- events.html
|- book-event.html
|- contact.html
|- feedback.html
|- style.css
|- main.js
|- book_event.php
|- contact_submit.php
|- feedback.php
|- db_connect.php
|- setup.sql
|- logo.png
`- README.md
```

## Notes

- Keep files saved in UTF-8 to avoid broken characters in UI text.
- If database credentials differ in your machine, update `db_connect.php`.

