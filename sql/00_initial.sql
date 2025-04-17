CREATE USER 'ticket_user'@'localhost'
IDENTIFIED WITH mysql_native_password BY 'P@ssword1#';

GRANT ALL PRIVILEGES ON edit_ticket_db.* TO 'ticket_user'@'localhost';

FLUSH PRIVILEGES;
