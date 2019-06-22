// Define variables
var button = document.querySelector("#send-button");// get submit button
var buttonValue = button.value; // get submit button value
var formMessage = document.querySelector('#form-message'); 
var inputs = document.querySelectorAll(".contact-input");// select all input fields 

// Function to prevent user from submitting the form again while it's in process... 
function disableSubmitButton() {
    button.disabled = true;
    button.value = 'Sending....'; // indicator that the data is sending to the server...
}

// function to return the button value after processing the form
function enableSubmitButton() {
    button.disabled = false;
    button.value = buttonValue;
}

// if any input is empty or has any invalid value display the error 
function displayErrors(errors){
    // loop through input fields 
    for(i = 0; i< inputs.length; i++){
        /* we validate input value in the php script and return the errors in an array...
           if any input has error message*/
        if(errors.hasOwnProperty(inputs[i].name)){
            inputs[i].classList.add('error'); // add red border to the input
            inputs[i].placeholder = errors[inputs[i].name];// write the error message into the placeholder attribute
            inputs[i].value = ""; // empty the value attribute
        }
    }
}

// loop through input fields and remove the red border
function clearErrors(){
    for(i = 0; i< inputs.length; i++){  
        inputs[i].classList.remove('error'); // remove red border from the input
    }
}
// submit contact form
function sendMessage() {

    disableSubmitButton();
    clearErrors();
    var form = document.querySelector("#contact-form");
    var action = form.getAttribute("action");
    var formData = new FormData(form);// gather form data
    var xhr = new XMLHttpRequest();// create XMLHttpRequest

    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText; // return the result from the php process script
            enableSubmitButton();
            var json = JSON.parse(result); // Converts JavaScript Object Notation (JSON) string into an object
            /* if the returned array contains key name or phone or email or message 
                display the value*/
            if( json.hasOwnProperty('name')  || 
                json.hasOwnProperty('email') ||
                json.hasOwnProperty('message')){
                    displayErrors(json);
            }else if(json.hasOwnProperty('success')){
                formMessage.innerHTML = json.success;
                formMessage.classList.add('success-message');
            }else{
                formMessage.innerHTML = json.error;
                formMessage.classList.add('error-message');
            }      
        }
    };
    xhr.send(formData);
}

// when clicking the send button call sendMessage function
button.addEventListener("click", function (e) {
    e.preventDefault(); //prevent send the HTML form we need only to execute sendMessage function
    sendMessage();
});
