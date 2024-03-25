# TaskManagement

## Requirements Description for Task Management System:

### 1. Overview:
The Task Management System is an online platform for managing personal or team tasks. Users can create, view, edit, and delete tasks through the system, as well as sort, categorize, and mark tasks as complete.

### 2. Business Logic Description:

#### 2.1 User Management:
- Users can register and login to the system using unique usernames and passwords.
- Registered users can manage their tasks and task lists within the system.

##### User Login and Registration:

- Users can access the system by registering an account.
- Registration requires providing information such as username, password, and email.
- Registered users can log in using their username and password.

#### 2.2 Task Lists Management:
- Users can create personal task lists.
- Each task list can have multiple tasks associated with it.
- Users can categorize tasks within task lists based on priority, due date, or other criteria.

#### 2.3 Task Management:
- Users can create tasks with titles, descriptions, due dates, priorities, and assigned users.
- Tasks can be assigned to specific users or remain unassigned.
- Users can mark tasks as completed and delete tasks when they are no longer needed.
- Tasks can belong to one or more task lists.

##### 2.3.1 Task Query and Filtering:

- Users can query the task list based on due dates, priorities, and statuses.
- Users can filter the task list based on categories to display only tasks of specific categories.

##### 2.3.2 Task Query:

- Users can create different categories for tasks to organize and manage them better.
- Users can assign tasks to different categories and view tasks within each category in the list.

##### 2.3.3 Task Search:

- Users can search for tasks by keywords in titles or descriptions to quickly find specific tasks.

### 3. Technical Requirements:

#### 3.1 Frontend Technologies:

- Implement the user interface using HTML, CSS, and JavaScript to ensure it is aesthetically pleasing, user-friendly, and responsive.
- Implement client-side validation using JavaScript to provide clear error messages.

#### 3.2 Backend Technologies:

- Implement user authentication, task management, data storage, and retrieval using PHP or other server-side technologies.

#### 3.3 Database:

- Use MySQL as the database to store user information and task data, leveraging its flexible document model and powerful querying capabilities.

## Installation Instructions:

This application runs on the XAMPP environment. 

1. Firstly, create a database and configure database user and initialize database tables. You can run the `doc/dbinstall.sql` script for this purpose.

### Common Commands:

- For deployment on macOS: `cp ../TaskManagement /Applications/XAMPP/htdocs`

Feel free to adjust these instructions according to your specific environment and setup requirements.
