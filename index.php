<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Contact Form with PHP, Ajax developed by Manar_Elnekiti">
    <title>Contact Form with PHP, Ajax</title>
    <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <script src="js/send-form.js" defer></script>
</head>
<body>
    <!-- Header-->
    <header class="clear">
        <div class="wrapper">
            <h2>PHP, Ajax Contact Form </h2>
        </div>
    </header>
    <main>
        <section id="contact">
            <div class="wrapper clear">
                <h2>Contact</h2>
                <div class="clear"></div>
                <div id="contact-form-container">
                    <form id="contact-form" action="process-form.php" method="POST">
                        <label for="name">Name<span class="red">*</span></label>
                        <input type="text"   name="name"  class="contact-input"  placeholder="Your Name..." value=""  maxlength="64">
                        <label for="email">Email<span class="red">*</span></label>
                        <input type="email"  name="email" class="contact-input"  placeholder="Your Email..." value="" maxlength="254">
                        <label for="message">Message<span class="red">*</span></label>
                        <textarea name="message" class="contact-input" cols="30" rows="5" placeholder="Your Message..." maxlength='350'></textarea>
                        <div id="form-message-container">
                            <p id="form-message"></p>
                        </div> 
                        <input type="submit" name="submit" class="action-button" id="send-button" value="send">  
                    </form>
                </div>   
            </div>     
        </section><!-- End of contact section -->
    </main>
    <!-- Footer -->
    <footer>
        <div class="wrapper clear">
            <p>By: <span class= "name">Manar Elnekiti</a></p>
        </div>
    </footer>
</body>
</html>