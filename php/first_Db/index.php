<?php  
    include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<?php

    $sql = "SELECT * FROM users;";
    $result =  mysqli_query($link, $sql);
    $result_Check = mysqli_num_rows($result);
    if ($result_Check >0) {
        while($row = mysqli_fetch_assoc($result)){
            echo $row['user_uid'];
        }
    }

?>

</body>
</html>