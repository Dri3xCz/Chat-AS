<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - as</title>
    <!-- BOOTSTRAP 4.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <section class="login-area">
        <main class="container"> 
            <div class="row d-flex justify-content-center h-100">
               <div class="col-12 col-md-8 col-lg-6 login-form-con">
                    <form action="../../controller/login.php" method="post" class="login-form">
                        <h2>Příhlásit se</h3>
                        <hr>
                        <label for="username">Jméno</label>
                        <input type="text" name="username" autocomplete="off">
                        <label for="password">Heslo</label>
                        <input type="password" name="password"> 
                        <hr>
                        <div>
                            <h4>Nemáte účet?</h4>
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <a href="../register/">Registrovat se</a>
                                <?php
                                    $error = isset($_GET["error"]) ? $_GET["error"] : "";
                                    if($error == "invalid_credentials")
                                        echo '<h5 style="color: red">Špatné přihlašovací údaje</h5>';
                                ?>
                                <input type="submit" value="Přihlásit se" class="submit-button"> 
                            </div>
                        </div>
                    </form> 
               </div> 
            </div> 
        </main>
    </section> 
</body>
</html>