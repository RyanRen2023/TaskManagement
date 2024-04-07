/*
  File Name: script.js
  Created Date:Mar 21 2024
  Brief Description: this file is the JaveScript for assignment 2.
*/

/* To implement the registration and login forms as modal pop-ups that appear when buttons on the firstPage.html are clicked */
// Get the modal
var registrationModal = document.getElementById("registrationModal");
var loginModal = document.getElementById("loginModal");

// Get the button that opens the modal
var registrationBtn = document.querySelector(".register-btn");
var loginBtn = document.querySelector(".login-btn");

// Get the <span> element that closes the modal
var spans = document.querySelectorAll(".close");

// When the user clicks the button, open the modal 
if (registrationBtn) {
  registrationBtn.onclick = function () {
    registrationModal.style.display = "block";
  }
}
if (loginBtn) {
  loginBtn.onclick = function () {
    loginModal.style.display = "block";
  }
}


// When the user clicks on <span> (x), close the modal
spans.forEach(span => {
  span.onclick = function () {
    registrationModal.style.display = "none";
    loginModal.style.display = "none";
  }
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == registrationModal || event.target == loginModal) {
    registrationModal.style.display = "none";
    loginModal.style.display = "none";
  }
}

/* ---------------------------forms validation------------------------------- */

// This function is to validate the email
function validateEmail() {
  let email = document.getElementById("email");
  let emailValue = email.value;
  // valid email structure 
  let emailReg = /^\w+(\.\w+)*@[A-z0-9]+(\.[A-z]{2,5}){1,2}$/;
  if (emailValue === "" || !emailReg.test(emailValue)) {
    document.getElementById("emailError").textContent = "Email address should be non-empty with the format xyz@xyz.xyz";
    email.style.borderColor = "red";
    return false;
  } else {
    document.getElementById("emailError").textContent = "";
    email.style.borderColor = "";
    return true;
  }
}

// This function is to validate the login name
function validateLoginName() {
  let login = document.getElementById("login");
  let loginValue = login.value;
  if (loginValue.length === 0 || loginValue.length > 30) {
    document.getElementById("loginNameError").textContent = "User name should be non-empty and within 30 characters long.";
    login.style.borderColor = "red";
    return false;
  } else {
    document.getElementById("loginNameError").textContent = "";
    login.style.borderColor = "";
    return true;
  }
}

// This function is to validate the password
function validatePassword() {
  let pass = document.getElementById("pass");
  let passwordValue = pass.value;
  if (!/[A-Z]/.test(passwordValue) || !/[a-z]/.test(passwordValue) || passwordValue.length < 8) {
    document.getElementById("passwordError").textContent = "Password must be at least 8 characters long, including 1 upper case and 1 lower case letter.";
    pass.style.borderColor = "red";
    return false;
  } else {
    document.getElementById("passwordError").textContent = "";
    pass.style.borderColor = "";
    return true;
  }
}

// This function is to validate the confirm password
function validatePassword2() {
  let pass = document.getElementById("pass");
  let pass2 = document.getElementById("pass2");
  let passwordValue = pass.value;
  let password2Value = pass2.value;
  if (password2Value === "" || password2Value !== passwordValue) {
    document.getElementById("password2Error").textContent = "Passwords do not match.";
    pass2.style.borderColor = "red";
    return false;
  } else {
    document.getElementById("password2Error").textContent = "";
    pass2.style.borderColor = "";
    return true;
  }
}

// This function is to validate the terms and conditions
function validateTerms() {
  let terms = document.getElementById("terms").checked;
  if (!terms) {
    document.getElementById("termsError").textContent = "Please accept the terms and conditions.";
    return false;
  } else {
    document.getElementById("termsError").textContent = "";
    return true;
  }
}

// Main validation function called on form submission
function validate() {
  // Perform validation for each field
  const emailValid = validateEmail();
  const loginNameValid = validateLoginName();
  const passwordValid = validatePassword();
  const password2Valid = validatePassword2();
  const termsValid = validateTerms();

  // Only allow form submission if all validations passed
  return emailValid && loginNameValid && passwordValid && password2Valid && termsValid;
}


// check login form func

function validateEmail2() {
  let email = document.getElementById("email-login");
  let emailValue = document.getElementById("email-login").value;
  // valid email structure 
  let emailReg = /^\w+(\.\w+)*@[A-z0-9]+(\.[A-z]{2,5}){1,2}$/;
  let emailTest = emailReg.test(emailValue);
  if (emailValue === "" || emailTest === false) {
    document.getElementById("emailError2").innerHTML = "x Email address should be non-empty with the format xyz@xyz.xyz";
    email.style.borderColor = "red"; // set the border color to red
  } else {
    document.getElementById("emailError2").innerHTML = "";
    email.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the email in real time
  document.getElementById("email-login").addEventListener("input", validateEmail2);
}

function validatePassword2() {
  let pass = document.getElementById("pass-login");
  let password = document.getElementById("pass-login").value;
  // Password textbox value is at least 8 characters long. 1 upper case, 1 lower case.
  if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || password.length < 8) {
    document.getElementById("passwordError2").innerHTML = "x Password textbox value is at least 8 characters long. 1 upper case, 1 lower case.";
    pass.style.borderColor = "red"; // set the border color to red
  } else {
    document.getElementById("passwordError2").innerHTML = "";
    pass.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the password in real time
  document.getElementById("pass-login").addEventListener("input", validatePassword2);
}
// check login form
function validate2() {
  validateEmail2();
  validatePassword2();

  // Check for error messages
  let errorMessages = document.getElementsByClassName("error-message");
  for (let i = 0; i < errorMessages.length; i++) {
      if (errorMessages[i].innerHTML !== '') {
          return false;
      }
  }
  return true; // If no errors, allow form submission
}


/* ---------------------------form validation ends------------------------------ */


// Task Query and Filtering:

function taskQuery() { };

function taskFiltering() { };

/* ---------------------------Task edit------------------------------ */

// get 'task-li' elements
const taskItems = document.querySelectorAll('.task-li');
const buttonContainer = document.getElementById('buttonContainer');
// if (buttonContainer) {
//   buttonContainer.classList.remove('show');
// }
// Iterate over all 'task-li' elements and add event listeners to each one
taskItems.forEach(function (item) {
  item.addEventListener('mouseover', function (event) {
    if (buttonContainer) {

      const editButton = buttonContainer.querySelector('.edit-button');
      const deleteButton = buttonContainer.querySelector('.delete-button');
      editButton.addEventListener('click', editTask);
      deleteButton.addEventListener('click', deleteTask);
      item.appendChild(buttonContainer);

      buttonContainer.classList.add('show');
      console.log("nouse enter");
    }


  });

  item.addEventListener('mouseleave', function () {
    if (buttonContainer) {
      const editButton = buttonContainer.querySelector('.edit-button');
      const deleteButton = buttonContainer.querySelector('.delete-button');
      editButton.removeEventListener('click', editTask);
      deleteButton.removeEventListener('click', deleteTask);
      // Hide the button container
      buttonContainer.classList.remove('show');
      item.removeChild(buttonContainer);
    }


  });
});



// Function to edit a task
function editTask(event) {
  // Edit task logic
  // Get the parent element of the clicked button
  const parentTask = buttonContainer.parentElement;
  // Check if the parent element exists
  if (parentTask) {
    // Get the ID of the parent element
    const taskId = parentTask.id;
    showTaskStatusModal(taskId);
    // Now you have the ID of the parent element, you can use it as needed
    console.log('Edit task with ID:', taskId);
  }
  console.log('Edit task');
}

// Function to delete a task
function deleteTask(event) {
  // Delete task logic
  const parentTask = buttonContainer.parentElement;
  // Check if the parent element exists
  if (parentTask) {
    // Get the ID of the parent element
    const taskId = parentTask.id;
    showTaskDeleteModal(taskId);
    // Now you have the ID of the parent element, you can use it as needed
    console.log('delete task with ID:', taskId);
  }
  console.log('Edit task');
  console.log('Delete task');

}
// params should be string like  k1=v1&k2=v2
function sendDataToServer(url, method, callback, params) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = callback;
  // post requirest
  xmlhttp.open(method, url, true);
  // set header
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xmlhttp.send("q=" + "str");
  xmlhttp.send(params);
}


function showTaskStatusModal(taskId) {
  const url = "../php/taskAction.php";
  const method = "POST";
  const params = "taskId=" + taskId + "&func=getTaskById";
  const callback = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("task: " + this.responseText);
      const responseData = JSON.parse(this.responseText);
      console.log(responseData.TaskID);

      setTaskFormData(responseData);
      const task_modal = document.getElementById("edit-task-status");
      task_modal.classList.remove("show");
      // before show need to add data 
      task_modal.classList.add("show");
    } else {
      console.log("server error!");
    }
  }
  sendDataToServer(url, method, callback, params)


}
// set modal data for update 
function setTaskFormData(task) {
  const taskForm = document.forms["editTaskForm"];
  taskForm.elements["taskId"].value = task.TaskID;
  taskForm.elements["title"].value = task.Title;
  taskForm.elements["description"].value = task.Description;
  taskForm.elements["dueDate"].value = task.DueDate;
  taskForm.elements["priority"].value = task.Priority;
  taskForm.elements["status"].value = task.StatusID;

}





// after click Comfirm
function updateStatusEvent() {
  var taskId = document.getElementById("taskId").value;
  var radios = document.getElementsByName('status');
  let defaultstatus = document.getElementById("default-status").value;
  var selectedStatus;
  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
      selectedStatus = radios[i].value;
      break;
    }
  }
  if (defaultstatus !== selectedStatus) {
    updateTaskStatus(taskId, selectedStatus);
  } else {
    console.log("here to send task new data to php for update" + taskId + " = " + selectedStatus);
    closeEditModal();
    // refresh the parent page.
    // window.location.reload();
  }

}

function updateTaskFormSubmit() {
  const taskForm = document.forms["editTaskForm"];
  let input = document.createElement("input");
  input.type = "hidden"; 
  input.name = "func";
  input.value = "updateTaskById";
  taskForm.appendChild(input);
  const formData = new FormData(taskForm);

  fetch('../php/taskAction.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(data => {
      console.log("update task == > "+data);
      closeEditModal();
      taskForm.removeChild(input);
      // refresh the parent page.
      window.location.reload();
    })
    .catch(error => {
      console.error('Error:', error);
    });

}


function updateTaskStatus(taskId, selectedStatus) {

  let callback = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("task update: " + this.responseText);
      closeEditModal();
      // refresh the parent page.

      window.location.reload();

    }
  };
  let params = "taskId=" + taskId + "&StatusID=" + selectedStatus + "&func=updateTaskById";
  sendDataToServer("../php/taskAction.php", "POST", callback, params);
}


function closeEditModal() {
  const task_modal = document.getElementById("edit-task-status");
  task_modal.classList.remove("show");

}


// after choose delete ,there are two options, one is delete ,another is cannel
function showTaskDeleteModal(taskId) {

  document.getElementById("deleteTaskId").value = taskId;
  document.getElementById("delete-confirm-message").innerText = "Are you sure to delete Task: Task " + taskId + "?";
  const task_modal = document.getElementById("delete-task");
  task_modal.classList.remove("show");
  // before show need to add data 
  task_modal.classList.add("show");
}

function confirmDelete() {
  let taskId = document.getElementById("deleteTaskId").value;
  let callback = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("task delete: " + this.responseText);
      closeDeleteModal();

      window.location.reload();

    }
  };
  let params = "taskId=" + taskId + "&func=deleteTaskById";
  sendDataToServer("../php/taskAction.php", "POST", callback, params);
}

function closeDeleteModal() {
  const task_modal = document.getElementById("delete-task");
  task_modal.classList.remove("show");
}

document.addEventListener("DOMContentLoaded", function () {
  // Execute your initialization function here
  initialize();
});

function initialize() {
  // Your initialization code here
  console.log("Page initialized");
  // You can put any code here that you want to run after the page is refreshed
  // refresh the parent page.
  // const buttonContainer = document.getElementById('buttonContainer');
  // if (buttonContainer) {
  //   buttonContainer.classList.remove('show');
  // }

}

var addformbtn = document.getElementById("addTaskButton");
if (addformbtn) {
  addformbtn.addEventListener('click', function () {
    let addModel = document.getElementById("add-task");
    addModel.classList.remove("show");
    addModel.classList.add("show");
  })
}

function goToSearch() {
  console.log("enter go to search!");
  location.href = "../html/search.php";
}


// cancel add form
document.getElementById('cancelButton').addEventListener('click', function () {
  document.getElementById('add-task').style.display = 'none';
});

// re-click add task from
document.getElementById('addTaskButton').addEventListener('click', function () {
  document.getElementById('add-task').style.display = 'block';
});




