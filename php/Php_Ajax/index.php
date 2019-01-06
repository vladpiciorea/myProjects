<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Serch User</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <script>

    function showSuggestion(str){
        console.log(str);
        if(str.length == 0){
            document.getElementById('output').innerHTML=''
        }else{
            // Ajax request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('output').innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "sugest.php?q="+str, true);
            xmlhttp.send();
        }
    }
    </script>
</head>
<body>
    <div class="container">
    <h1>Search Users</h1>
        <form action="">
        Search User: <input type="text" name="" clas="form-control" onkeyup ="showSuggestion(this.value)">
        </form>
        <p>Sugestions: <span id='output'style = "font-weight:bold"></span></p>
    </div>
</body>
</html>