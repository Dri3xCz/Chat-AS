<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - as</title>
</head>
<body>
    <form action="../../controller/login.php" method="post">
        <input type="text" name="username">
        <input type="password" name="password"> 
        <input type="submit" value="POST JUPÍ">
    </form> 

    <?php 
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        if($error == "invalid_credentials") {
            echo "Špatné zadané heslo nebo jméno";
        }
    ?>

</body>
</html>