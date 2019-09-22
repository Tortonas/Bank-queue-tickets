<?php
    session_start();
    foreach (glob("includes/*.php") as $filename)
    {
        include $filename;
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bank queue tickets</title>
        <meta name="description" content="Banking queue tickets allows you to track the time until your queue is over.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="shortcut icon" type="image/png" href="./img/bank.png"/>
    </head>
    <body>
        <nav>
            <div class="wrapper">
                <img class="main-icon" src="./img/bank.png" alt="github logo">
                <?php
                    $viewHandler = new ViewHandler();
                    $viewHandler->printNavigationBar();
                ?>
            </div>
        </nav>
        <main>
            <div class="wrapper">
                <div class="login-screen">
                    <?php
                        $viewHandler->printRegisterForm();
                        if(isset($_POST['loginButton']))
                        {
                            $userHandler = new UserHandler(); 
                            $loginReturnValue = $userHandler->register($_POST['username'], $_POST['name'], $_POST['lastName'], $_POST['password'], $_POST['password-repeat']);
                            if($loginReturnValue)
                            {
                                $viewHandler = new ViewHandler();
                                $viewHandler->printSuccessfulRegister();
                                $viewHandler->redirect_to_another_page("client-login.php", 2);
                            }
                            else
                            {
                                $viewHandler->printErrorWhileRegistering();
                            }
                        }
                    ?>
                </div>
            </div>
        </main>
        <footer>
            <div class="wrapper">
                <?php
                $viewHandler->printFooterInformation();
                ?>
            </div>
        </footer>
    </body>
</html>