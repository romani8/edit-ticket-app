USE edit_ticket_db;

DROP TABLE IF EXISTS ticket_misc;
DROP TABLE IF EXISTS ticket_truck;
DROP TABLE IF EXISTS ticket_labour;
DROP TABLE IF EXISTS tickets;

DROP TABLE IF EXISTS trucks;

DROP TABLE IF EXISTS staff_positions;
DROP TABLE IF EXISTS staff;

DROP TABLE IF EXISTS job_locations;
DROP TABLE IF EXISTS customer_jobs;
DROP TABLE IF EXISTS customers;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE customer_jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

CREATE TABLE job_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_job_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (customer_job_id) REFERENCES customer_jobs(id) ON DELETE CASCADE
);

CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE staff_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    position_name VARCHAR(255) NOT NULL,
    hourly_regular_rate DECIMAL(10,2),
    hourly_overtime_rate DECIMAL(10,2),
    fixed_regular_rate DECIMAL(10,2),
    fixed_overtime_rate DECIMAL(10,2),
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE CASCADE
);

CREATE TABLE trucks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    hourly_rate DECIMAL(10,2),
    fixed_rate DECIMAL(10,2)
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    job_id INT NOT NULL,
    location_id INT NOT NULL,
    status ENUM('Active', 'Pending', 'Closed') NOT NULL DEFAULT 'Active',
    ordered_by VARCHAR(255),
    date DATE NOT NULL,
    area VARCHAR(255),
    description TEXT,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (job_id) REFERENCES customer_jobs(id),
    FOREIGN KEY (location_id) REFERENCES job_locations(id)
);

CREATE TABLE ticket_labour (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    staff_position_id INT NOT NULL,
    uom ENUM('Hourly', 'Fixed') NOT NULL DEFAULT 'Hourly',
    regular_hours DECIMAL(6,2),
    overtime_hours DECIMAL(6,2),
    fixed_total DECIMAL(6,2),
    total DECIMAL(10,2),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (staff_position_id) REFERENCES staff_positions(id)
);

CREATE TABLE ticket_truck (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    truck_id INT NOT NULL,
    uom ENUM('Hourly', 'Fixed') NOT NULL,
    quantity DECIMAL(6,2),
    fixed_total DECIMAL(6,2),
    total DECIMAL(10,2),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (truck_id) REFERENCES trucks(id)
);

CREATE TABLE ticket_misc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    cost DECIMAL(10,2),
    price DECIMAL(10,2),
    quantity DECIMAL(6,2),
    total DECIMAL(10,2),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
);
