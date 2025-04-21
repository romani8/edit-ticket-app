INSERT INTO customers (name) VALUES
('PCL Construction'),
('EllisDon Calgary'),
('Ledcor Group'),
('Clark Builders'),
('Bird Construction');

INSERT INTO customer_jobs (customer_id, name) VALUES
(1, '#512 YYC Terminal Renovation'),
(1, '#513 City Maintenance Depot'),
(2, '#614 Downtown Office Tower'),
(2, '#615 Parking Structure Upgrade'),
(3, '#721 Multi-Family Skyview Ranch'),
(4, '#822 Logistics Centre Build'),
(5, '#931 Highway Maintenance Facility');

INSERT INTO job_locations (customer_job_id, name) VALUES
(1, 'Terminal B – Upper Level'),
(1, 'Arrivals Hall Staging'),
(2, '6th Ave & 1st Street SW'),
(2, 'Main Tower Sub-Basement'),
(3, 'Skyview Crescent NE'),
(3, 'East Wing Underground Garage'),
(4, 'Airport Trail NW'),
(5, 'NW Grading Zone'),
(6, 'Deerfoot Industrial Park'),
(7, 'Highway Entrance Sector');

INSERT INTO staff (name) VALUES
('John Doe'),
('Alice Smith'),
('Mohammed Khan'),
('Emily Zhang');

INSERT INTO staff_positions (
    staff_id, position_name,
    hourly_regular_rate, hourly_overtime_rate,
    fixed_regular_rate, fixed_overtime_rate
) VALUES
(1, 'Carpenter', 30.00, 45.00, 400.00, 600.00),
(1, 'Electrician', 32.00, 50.00, 420.00, 630.00),
(2, 'Electrician', 35.00, 52.50, 500.00, 725.00),
(2, 'Formwork Specialist', 28.00, 42.00, 350.00, 525.00),
(3, 'Concrete Finisher', 29.00, 43.50, 380.00, 570.00),
(4, 'Surveyor', 40.00, 60.00, 600.00, 900.00),
(4, 'Site Engineer', 45.00, 67.50, 750.00, 1125.00);

INSERT INTO trucks (name, hourly_rate, fixed_rate) VALUES
('100 - Ford F150', 50.00, 700.00),
('200 - CAT Loader', 80.00, 950.00),
('300 - Dump Truck', 75.00, 900.00),
('400 - Grader', 90.00, 1200.00),
('500 - Mini Excavator', 65.00, 800.00),
('600 - Flatbed Trailer', 55.00, 750.00);
