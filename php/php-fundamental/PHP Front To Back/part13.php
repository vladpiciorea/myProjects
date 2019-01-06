<?php
// Message Vars
$msg = '';
$msgClass = '';
// Check for submit
if(filter_has_var(INPUT_POST,'submit')){
    // GET form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    // Check reguired fields
    if(!empty($email) && !empty($name) && !empty($message)){
        // PASSED
        // check email
        if (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
            $msg = 'Please use a valid email';
            $msgClass = 'alert-danger'; 
        }else{
            // passed
            // Recipien Email
            $toEmail = 'support@form.com';
            // Subject
            $subject = 'Contact Reguest From'.$name;
            $body = '<h2> Contact Reguest</h2>
                     <h2>Name</h2><p>'.$name.'</p>
                     <h2>Email</h2><p>'.$email.'</p>
                     <h2>Message</h2><p>'.$message.'</p>';  
            // header
            $headers = "MINE-Version: 1.0"."\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8"."\r\n";

            // Aditionale headers
            $headers .= "From: ".$name. "<".$email.">"."\r\n";

            if(mail($toEmail, $subject, $body, $headers)){
                // Email Sent
                $msg = 'Your email has been sent';
                $msgClass = 'alert-success'; 
            }else{
                $msg = 'Your email was not sent';
                $msgClass = 'alert-danger'; 
            }
        
        }
    }else {
        // FAILER
        $msg = 'Please fill all filds';
        $msgClass = 'alert-danger';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
    <title>Contact us</title>
</head>
<body>
   <nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="contact_form.php" class="navbar-brand">My website</a>
        </div>
    </div>
   </nav>
<div class="container">
<?php if($msg != ''):?>
    <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?> </div>
<?php endif;?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" role="form">
    <legend>Form title</legend>

    <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" name = 'name' value = "<?php echo isset($_POST['name']) ?  $name : ''; ?>">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" class="form-control" name = 'email' value = "<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label for="">Message</label>
        <input type="text" class="form-control" name = 'message'value ="<?php echo isset($_POST['message']) ? $message : ''; ?>">
    </div>

    <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
</form>
</div>
</body>
</html>