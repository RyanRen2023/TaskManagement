
use task_management_db;
delete from Tasks;
delete from TaskLists;
delete from TaskStatuses;
delete from TaskCategories;
delete from Users;



-- Active: 1711483040803@@127.0.0.1@3306@task_management_db
-- create test data for Users 
INSERT INTO Users (userid,Username, Password, Email, CreatedDate, UpdatedDate) VALUES
(1,'user1', 'password1', 'user1@example.com', NOW(), NOW()),
(2,'user2', 'password2', 'user2@example.com', NOW(), NOW()),
(3,'user3', 'password3', 'user3@example.com', NOW(), NOW()),
(4,'user4', 'Password666@', 'user4@example.com', NOW(), NOW());
-- create test data for TaskLists
INSERT INTO TaskLists (listid,ListName, UserID, IsPersonalList, CreatedDate, UpdatedDate) VALUES
(1,'Personal List 1', 1, true, NOW(), NOW()),
(2,'Personal List 2', 1, true, NOW(), NOW()),
(3,'Shared List 1', 2, false, NOW(), NOW()),
(4,'Shared List 2', 3, false, NOW(), NOW());

-- create test data for TaskStatuses
INSERT INTO TaskStatuses (statusid,StatusName, CreatedDate, UpdatedDate) VALUES
(1,'To Do', NOW(), NOW()),
(2,'In Progress', NOW(), NOW()),
(3,'Completed', NOW(), NOW());

-- add a new status.
INSERT INTO TaskStatuses (statusid,StatusName, CreatedDate, UpdatedDate) VALUES
(4,'Deleted', NOW(), NOW());

-- create test data for TaskCategories
INSERT INTO TaskCategories (CategoryId,CategoryName, CreatedDate, UpdatedDate) VALUES
(1,'Category 1', NOW(), NOW()),
(2,'Category 2', NOW(), NOW()),
(3,'Category 3', NOW(), NOW());

-- create test data for Tasks
INSERT INTO Tasks (Title, Description, DueDate, Priority, StatusID, CategoryID, ListID, AssignedToUserID, CreatedByUserID, CreatedDate, UpdatedDate) VALUES
('Task 1', 'Description for task 1', '2024-04-01', 'Medium', 1, 1, 1, 2, 1, NOW(), NOW()),
('Task 2', 'Description for task 2', '2024-04-02', 'High', 2, 2, 2, NULL, 2, NOW(), NOW()),
('Task 3', 'Description for task 3', '2024-04-03', 'Low', 3, 3, 3, 3, 3, NOW(), NOW());




INSERT INTO Tasks (Title, Description, DueDate, Priority, StatusID, CategoryID, ListID, AssignedToUserID, CreatedByUserID, CreatedDate, UpdatedDate) VALUES
('Task 1', 'Description for task 1', '2024-04-01', 'Medium', 1, 1, 1, 2, 1, NOW(), NOW()),
('Task 2', 'Description for task 2', '2024-04-02', 'High', 2, 2, 2, NULL, 2, NOW(), NOW()),
('Task 3', 'Description for task 3', '2024-04-03', 'Low', 3, 3, 3, 3, 3, NOW(), NOW());

