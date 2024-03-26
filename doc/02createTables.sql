use task_management_db;

drop table if exists Tasks;
drop table if exists TaskCategories;
drop table if exists TaskStatuses;
drop table if exists TaskLists;
drop table if exists Users;
-- Create Users table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE,
    Password VARCHAR(255),
    Email VARCHAR(100) UNIQUE,
    CreatedDate DATETIME,
    UpdatedDate DATETIME
);


-- Create Task Lists table
CREATE TABLE TaskLists (
    ListID INT AUTO_INCREMENT PRIMARY KEY,
    ListName VARCHAR(50),
    UserID INT,
    IsPersonalList BOOLEAN,
    CreatedDate DATETIME,
    UpdatedDate DATETIME,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Create Task Statuses table
CREATE TABLE TaskStatuses (
    StatusID INT AUTO_INCREMENT PRIMARY KEY,
    StatusName VARCHAR(50),
    CreatedDate DATETIME,
    UpdatedDate DATETIME
);

-- Create Task Categories table
CREATE TABLE TaskCategories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50),
    CreatedDate DATETIME,
    UpdatedDate DATETIME
);

-- Create Tasks table
CREATE TABLE Tasks (
    TaskID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(100),
    Description TEXT,
    DueDate DATE,
    Priority ENUM('Low', 'Medium', 'High'),
    StatusID INT,
    CategoryID INT,
    ListID INT,
    AssignedToUserID INT,
    CreatedByUserID INT,
    CreatedDate DATETIME,
    UpdatedDate DATETIME,
    FOREIGN KEY (StatusID) REFERENCES TaskStatuses(StatusID),
    FOREIGN KEY (CategoryID) REFERENCES TaskCategories(CategoryID),
    FOREIGN KEY (ListID) REFERENCES TaskLists(ListID),
    FOREIGN KEY (AssignedToUserID) REFERENCES Users(UserID),
    FOREIGN KEY (CreatedByUserID) REFERENCES Users(UserID)
);



