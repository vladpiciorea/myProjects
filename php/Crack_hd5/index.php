<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>MD5 cracker</h1>
<p>
<pre>
<?php
 if ( ! isset($_GET['md5']) ) { 
    echo("<br>Original Text: Not found ");
  } else if ( strlen($_GET['md5']) < 1 ) {
    echo("<br> Original Text:Not found");
  }else {
    $starttime = microtime(true);
    for($i=0;$i<=9999;$i++){
    $check = hash('md5', $i);
    $ckeck_00 = '0'.$i;
    $ckeck_00 = '00'.$i;
    $ckeck_00 = '000'.$i;
    if ($i <= 15 ){
        echo $check." ".$i.'<br>';
    } 
    if(hash('md5', $ckeck_00) == $_GET['md5']){
        echo "<br> PIN = 0".$i;
        break;
    }else if(hash('md5', $ckeck_00) == $_GET['md5']){
        echo "<br> PIN = 00".$i;
        break;
    }else if(hash('md5', $ckeck_00) == $_GET['md5']){
        echo "<br> PIN = 00".$i;
        break;
    }else if ($check == $_GET['md5']){
        echo "<br> PIN = ".$i;
        break;
    }
    if ( $i == 9999){
            echo "PIN: Not found";
        }
    
    }
    $endtime = microtime(true);
    $timediff = $endtime - $starttime;
    echo "<br> Time Elapsed: $timediff ";   
   
}
?>
</pre>
</p>
    <form action="index.php" method="get">
        <input type="text" name="md5" size="40">
        <button type="submit">CRACK MD5</button>  
    </form>
</body>
</html>
