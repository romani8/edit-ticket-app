# Edit Ticket App

A single-page ticketing application built with PHP 5.6, MySQL, and jQuery.  
The application allows users to create tickets with project details, labour entries, trucks, and miscellaneous items.

## Requirements

- PHP 5.6
- MySQL 8.x
- Apache (recommended via WAMP/XAMPP)
- A modern browser that supports jQuery and basic HTML5 inputs

## Setup Instructions

1. **Place the project into your server directory**  
   Example (WAMP): `C:/wamp64/www/edit-ticket-app`

2. **Create the database and import schema:**
    Run the SQL files in order:

    - `database/00_initial.sql` – create the database and the user
    - `database/01_schema.sql` – creates all necessary tables
    - `database/02_insert_data.sql` – inserts sample customers, jobs, staff, trucks, locations

3. **Update database credentials in:**

    config/config.php

4. **Open the app in your browser:**

    http://localhost/edit-ticket-app/public

## Features

- Dropdowns: Customer / Job / Location with 2-way filtering
- Add/remove dynamic rows: Labour, Trucks, Misc
- Auto-calculate subtotals and total
- Rich text input using TinyMCE
- AJAX-based form submit
- Final alert confirmation: “Ticket created.”

## File Structure

- `public/` – Frontend and main entry point
- `config/` – Database connection config
- `src/Controller/Api/` – Backend API endpoints
- `src/Infrastructure/` – DB connection logic
- `src/View/Partials/` – Page sections (HTML + PHP)
- `database/` – SQL schema and seed data

## Notes

- The layout is not optimized for smaller screen sizes. There are no responsive layout requirements in the task, so formatting is only visually correct on larger/fullscreen widths.
- It's not possible to exactly match the design of the TinyMCE editor shown in the mockup, as some toolbar options and themes are only available with a paid TinyMCE subscription.
- The calculation formula for Miscellaneous total is not specified in the task. It's unclear whether to use `cost × quantity`, `price × quantity`, or something else, so assumptions were made for implementation.
- Tested with WAMP 3.3.7 (PHP 5.6.40, MySQL 8.0.40)

