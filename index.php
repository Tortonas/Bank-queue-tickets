<?php
    session_start();
    foreach (glob("includes/*.php") as $filename)
    {
        include $filename;
    }
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bank queue tickets</title>
        <meta name="description" content="Banking queue tickets allows you to track the time until your queue is over.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style/style.css">
    </head>
    <body>
    <?php
        //Auto refresh 5sec cd
        $viewHandler = new ViewHandler();
        $viewHandler->redirect_to_another_page("/", 5);
    ?>
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
                <div class="waiting-box">
                    <h1>Pirmiausių 10 klientų eilė</h1>
                    <?php
                        $dbModel = new DB_Model();
                        $dbModel->readAndPrintVisits();
                        if($_SESSION['loginStatus'] == "client")
                        {
                            $dbModel->calculateLeftTime();
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