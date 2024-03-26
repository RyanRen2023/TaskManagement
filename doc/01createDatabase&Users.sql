-- Create a new database
CREATE DATABASE task_management_db;

-- Create a new user
CREATE USER 'task_user'@'localhost' IDENTIFIED BY 'task_password';

-- Grant privileges to the user for the newly created database
GRANT ALL PRIVILEGES ON task_management_db.* TO 'task_user'@'localhost';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;
