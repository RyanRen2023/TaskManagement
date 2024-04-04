-- Active: 1711483040803@@127.0.0.1@3306@task_management_db
-- create test data for Users 
INSERT INTO Users (Username, Password, Email, CreatedDate, UpdatedDate) VALUES
('user1', 'password1', 'user1@example.com', NOW(), NOW()),
('user2', 'password2', 'user2@example.com', NOW(), NOW()),
('user3', 'password3', 'user3@example.com', NOW(), NOW());
('user4', 'Password666@', 'user4@example.com', NOW(), NOW());
-- create test data for TaskLists
INSERT INTO TaskLists (ListName, UserID, IsPersonalList, CreatedDate, UpdatedDate) VALUES
('Personal List 1', 1, true, NOW(), NOW()),
('Personal List 2', 1, true, NOW(), NOW()),
('Shared List 1', 2, false, NOW(), NOW()),
('Shared List 2', 3, false, NOW(), NOW());

-- create test data for TaskStatuses
INSERT INTO TaskStatuses (StatusName, CreatedDate, UpdatedDate) VALUES
('To Do', NOW(), NOW()),
('In Progress', NOW(), NOW()),
('Completed', NOW(), NOW());

-- create test data for TaskCategories
INSERT INTO TaskCategories (CategoryName, CreatedDate, UpdatedDate) VALUES
('Category 1', NOW(), NOW()),
('Category 2', NOW(), NOW()),
('Category 3', NOW(), NOW());

-- create test data for Tasks
INSERT INTO Tasks (Title, Description, DueDate, Priority, StatusID, CategoryID, ListID, AssignedToUserID, CreatedByUserID, CreatedDate, UpdatedDate) VALUES
('Task 1', 'Description for task 1', '2024-04-01', 'Medium', 1, 1, 1, 2, 1, NOW(), NOW()),
('Task 2', 'Description for task 2', '2024-04-02', 'High', 2, 2, 2, NULL, 2, NOW(), NOW()),
('Task 3', 'Description for task 3', '2024-04-03', 'Low', 3, 3, 3, 3, 3, NOW(), NOW());
