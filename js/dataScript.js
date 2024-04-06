class Ajax {
    // Constructor
    constructor(url, method) {
        // Initialize URL and method
        this.url = url;
        this.method = method;
    }

    // Method to send AJAX request
    sendRequest(data, successCallback, errorCallback) {
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Set the request type, URL, and async flag
        xhr.open(this.method, this.url, true);

        // Set the callback function to execute when the request is complete
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // If the request is successful
                successCallback(xhr.responseText);
            } else {
                // If the request fails
                errorCallback(xhr.statusText);
            }
        };

        // Set the callback function to execute when there is an error
        xhr.onerror = function () {
            errorCallback('Request failed');
        };

        // Send the request
        if (this.method === 'POST') {
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        } else {
            xhr.send();
        }
    }
}




class Task {
    constructor(title, description, dueDate, priority, statusId, categoryId, listId, assignedToUserId, createdByUserId, createdDate, updatedDate) {
        this.title = title;
        this.description = description;
        this.dueDate = dueDate;
        this.priority = priority;
        this.statusId = statusId;
        this.categoryId = categoryId;
        this.listId = listId;
        this.assignedToUserId = assignedToUserId;
        this.createdByUserId = createdByUserId;
        this.createdDate = createdDate;
        this.updatedDate = updatedDate;
    }

    // Method to set the status ID
    setStatusId(statusId) {
        this.statusId = statusId;
    }

    // Method to get the task details
    getDetails() {
        return {
            title: this.title,
            description: this.description,
            dueDate: this.dueDate,
            priority: this.priority,
            statusId: this.statusId,
            categoryId: this.categoryId,
            listId: this.listId,
            assignedToUserId: this.assignedToUserId,
            createdByUserId: this.createdByUserId,
            createdDate: this.createdDate,
            updatedDate: this.updatedDate
        };
    }
}

// Example usage:
// const task = new Task('Complete project', 'Finish the coding task', '2024-04-10', 'High', null, null, null, null, null, new Date(), null);
// console.log(task.getDetails());


// // Create an instance of the AJAX class this.is an example
// const ajax = new Ajax('https://localhost/taskmanagement/php/getTaskbyId.php?taskid=$taskId', 'GET');

// // Send an AJAX request and specify success and error callback functions
// ajax.sendRequest(null, function (response) {
//     const responseData = JSON.parse(response);

//     // Extract task details from the response data
//     const { title, description, dueDate, priority, statusId, categoryId, listId, assignedToUserId, createdByUserId, createdDate, updatedDate } = responseData;

//     // Create a new Task instance with the fetched task details
//     const task = new Task(title, description, dueDate, priority, statusId, categoryId, listId, assignedToUserId, createdByUserId, createdDate, updatedDate);
//     console.log('Request succeeded:', response);
// }, function (error) {
//     console.error('Request failed:', error);
// });

