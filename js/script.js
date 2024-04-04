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
registrationBtn.onclick = function() {
  registrationModal.style.display = "block";
}
loginBtn.onclick = function() {
  loginModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spans.forEach(span => {
  span.onclick = function() {
    registrationModal.style.display = "none";
    loginModal.style.display = "none";
  }
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == registrationModal || event.target == loginModal) {
    registrationModal.style.display = "none";
    loginModal.style.display = "none";
  }
}

/* ---------------------------forms validation------------------------------- */ 

// validate the email
function validateEmail(){
  let email = document.getElementById("email");
  let emailValue = document.getElementById("email").value;  
  // valid email structure 
  let emailReg = /^\w+(\.\w+)*@[A-z0-9]+(\.[A-z]{2,5}){1,2}$/;
  let emailTest = emailReg.test(emailValue);
  if(emailValue === "" || emailTest === false){
    document.getElementById("emailError").innerHTML = "x Email address should be non-empty with the format xyz@xyz.xyz";
    email.style.borderColor = "red"; // set the border color to red
  }else{
    document.getElementById("emailError").innerHTML = "";
    email.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the email in real time
  document.getElementById("email").addEventListener("input", validateEmail);
}

// validate the login name
function validateLoginName(){
  let login = document.getElementById("login");
  let loginName = document.getElementById("login").value;
  // Login name should be non-empty and less than 30 characters long.
  if(loginName.length === 0 || loginName.length > 30){
    document.getElementById("loginNameError").innerHTML = "x User name should be non-empty, and within 30 characters long.";
    login.style.borderColor = "red"; // set the border color to red
  }else{
    document.getElementById("loginNameError").innerHTML = "";
    login.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the login name in real time
  document.getElementById("login").addEventListener("input", validateLoginName);
}

// validate the password
function validatePassword(){
  let pass = document.getElementById("pass");
  let password = document.getElementById("pass").value;
  // Password textbox value is at least 8 characters long. 1 upper case, 1 lower case.
  if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || password.length < 8) {
    document.getElementById("passwordError").innerHTML = "x Password textbox value is at least 8 characters long. 1 upper case, 1 lower case.";
    pass.style.borderColor = "red"; // set the border color to red
  }else{
    document.getElementById("passwordError").innerHTML = "";
    pass.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the password in real time
  document.getElementById("pass").addEventListener("input", validatePassword);
}

// validate the confirm password
function validatePassword2(){



  let pass2 = document.getElementById("pass2");
  let password = document.getElementById("pass").value;
  let password2 = document.getElementById("pass2").value;
  // Ensure that both the password fields have the same value and are not blank.
  if(password2 === "" || password2 === null){
    document.getElementById("password2Error").innerHTML = "x Please retype password.";
    pass2.style.borderColor = "red"; // set the border color to red
  }else if(password !== password2){
    document.getElementById("password2Error").innerHTML = "x Password and confirm password should be the same.";
    pass2.style.borderColor = "red"; // set the border color to red
  }else{
    document.getElementById("password2Error").innerHTML = "";
    pass2.style.borderColor = ""; // reset the border color
  }
  // use event listener to validate the confirm password in real time
  document.getElementById("pass2").addEventListener("input", validatePassword2);
}

// validate the terms and conditions
function validateTerms(){
  let terms = document.getElementById("terms").checked;
  // Ensure that the terms and conditions are accepted
  if(terms == false){
    document.getElementById("termsError").innerHTML = "x Please accept the terms and conditions.";
  }else{
    document.getElementById("termsError").innerHTML = "";
  }
  // use event listener to validate the terms and conditions in real time
  document.getElementById("terms").addEventListener("input", validateTerms);
}

// This function is to validate the form
function validate(){
  // Call individual validation functions for each field
  validateEmail();
  validateLoginName();
  validatePassword();
  validatePassword2();
  validateTerms();

  // Check if there are any error messages
  {
    let errorMessages = document.getElementsByClassName("error-message");
    for (let i = 0; i < errorMessages.length; i++) {
      if (errorMessages[i].innerHTML !== '') {
      return false; // As soon as an error is found, return false
      }
    }
    return true; // If no errors are found, return true
  }

}


/* ---------------------------form validation ends------------------------------ */ 


// Task Query and Filtering:

function taskQuery() {};

function taskFiltering() {};




