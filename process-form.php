<?php
    // check input...
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // check is an ajax request or no
    function is_ajax_request() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';	
    }
    
    $form_error = []; // an array to hold errors
    // check if it's an ajax request
    if(is_ajax_request()){
   
        // name validation...
        if (empty(trim($_POST["name"]))) {
            $form_error['name']= "Required Field";
        }else {
            $name = test_input($_POST["name"]);
            if ( !preg_match("/^[a-zA-Z ]*$/",$name) ) {
                $form_error['name']= "Only letters and white space allowed"; 
            }
        }

        // email validation...
        if (empty(trim($_POST["email"]))) {
            $form_error['email']= "Required Field";
        }else {
            $email= test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $form_error['email']= "Invalid email format";
            }
        }

        // message validation...
        if (empty(trim($_POST["message"]))) {
            $form_error['message']= "Required Field";
        }else {
            $message = nl2br(test_input($_POST["message"]));
            if ( !preg_match("/^[-_a-zA-Z0-9. ]*$/",$message) ) {
                $form_error['message']= "Only letters, numbers and white space allowed";
            }
        }

        // if there is any invalid input return array contains errors
        if(!empty($form_error)){
            echo json_encode($form_error);
            exit;
        }
        // if there is no error send the email
        if(empty($form_error)){        

            $to = "exampleEmail@e.com";
            $subject = 'Test Email';
            $from = $email;

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html;' . "\r\n";
            $headers .= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            $message_content  = '<html><body>';
            $message_content .= '<div style="width:80%; margin:10px auto; text-align:left">';
            $message_content .= '<h3>Hello</h3>';
            $message_content .= '<h3>You have a new message</h3>';
            $message_content .= '<h3 style="color:#B06FA7">Name: </h3>' . $name;
            $message_content .= '<h3 style="color:#B06FA7">Email: </h3>' . $email;
            $message_content .= '<h3 style="color:#B06FA7">Message: </h3>' . $message;
            $message_content .= '</div>';
            $message_content .= '</body></html>';
            //Send the email!
            if(mail($to, $subject, $message_content, $headers)){
                // Success
                $success = "Your message has been sent, Thanks...";
                echo json_encode(array('success' => $success));
            }else {
                // Failure
                $error = "Error, Please try again later";
                echo json_encode(array('error' => $error));
            }
        } // if empty error condition...    
    }// if ajax request condition...
    else{
        exit;
    }
?>