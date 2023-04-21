<html lang="en">
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

    <section class="registration-area">
        <main class="container"> 
            <div class="row d-flex justify-content-center h-100">
               <div class="col-12 col-md-8 col-lg-6 register-form-con">
                    <form action="../../controller/register.php" method="post" class="register-form">
                        <h2>Registrovat se</h3>
                        <hr>
                        <label for="username">Jméno</label>
                        <input type="text" name="username">
                        <label for="password">Helo</label>
                        <input type="password" name="password"> 
                        <label for="password-confirm">Potvrdit heslo</label>
                        <input type="password" name="password-confirm"> 
                        <hr>
                        <div class="form-footer">
                            <h4>Již máte účet?</h4>
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <a href="../login/index.php">Přihlásit se</a>
                                <input type="submit" value="Registrovat" class="submit-button"> 
                            </div>
                        </div>
                    </form> 
               </div> 
            </div> 
        </main>
    </section>
    



    </body>
</html>