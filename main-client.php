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
    </head>
    <body>
        <nav>
            <div class="wrapper">
                <img class="main-icon" src="./img/bank.png" alt="github logo">
                <?php
                    $viewHandler = new ViewHandler();
                    $viewHandler->printNavigationBar();
                    $viewHandler->onlyClientCanSeeThis();
                ?>
            </div>
        </nav>
        <main>
            <div class="wrapper">
                <div class="client-main">
                    <?php
                        $dbModel = new DB_Model();
                        $viewHandler->printTicketReceptionForm();
                        if(isset($_GET['registerReceipt']))
                        {
                            $returnValueBool = $dbModel->checkIfICanRegisterForTicket($_GET['estimatedTime']);
                            if($returnValueBool)
                            {
                                $dbModel->registerTicket($_GET['estimatedTime']);
                                $viewHandler->printSuccessfulRegister();
                            }
                        }


                        $viewHandler->printCheckStatusWithTicketForm();
                        if(isset($_GET['submitTicket']))
                        {
                            $dbModel->checkEstimatedTimeById($_GET['ticketId']);
                        }

                        $returnValueBool = $dbModel->checkIfIveRegisteredForTicket();

                        if($returnValueBool != -1)
                        {
                            $viewHandler->printCancelVisitForm($returnValueBool);
                            if (isset($_POST['cancelVisit']))
                            {
                                //TODO: Padaryti cancel vizito requesta
                                echo "clicked cancel";
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