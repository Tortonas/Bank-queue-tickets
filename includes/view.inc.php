<?php
	class ViewHandler 
	{
		function __construct()
		{

		}

		public function redirect_to_another_page($urlDestination, $delay)
		{
            echo '<meta http-equiv="refresh" content="'.$delay.'; url='.$urlDestination.'" />';
		}

		public function printMainMenuButton()
        {
            echo '<form action="/">
                    <button>Pagrindinis</button>
                </form>';
        }

        public function printClientLoginButton()
        {
            echo '<form action="client-login.php">
                        <button>Prisijungti kaip klientui</button>
                  </form>';
        }

        public function printSpecialistLoginButton()
        {
            echo '<form action="specialist-login.php">
                    <button>Prisijungti kaip specialistui</button>
                  </form>';
        }

        public function printLogOutButton()
        {
            echo '<form method="GET">
                                <button name="logout" value="logout">Atsijungti</button>
                              </form>';
        }

        public function printClientZoneButton()
        {
            echo '<form action="/main-client.php">
                                <button>Kliento zona</button>
                              </form>';
        }

        public function printSpecialistZoneButton()
        {
            echo '<form action="/main-specialist.php">
                                <button>Admin zona</button>
                              </form>';
        }

        public function printYouCannotAccess()
        {
            echo "Jūs negalite matyti šio puslapio!";
        }

        public function saluteMember()
        {
            echo "Sveiki prisijungę, ".$_SESSION['clientName'];
        }

        public function printFailedLogin()
        {
            echo "Prisijungimas nesėkmingas!";
        }

        public function printRandomError()
        {
            echo "<span style='color:red'>Nutiko klaida!</span>";
        }

        public function printSuccessfulRegister()
        {
            echo "Jūsų laikas sėkmingai užregistruotas!";
        }

        public function printWaitingPeopleList($peopleList)
        {
            if ($peopleList->num_rows > 0)
            {
                while($row = $peopleList->fetch_assoc())
                {
                    $lastName = $row['lastname'];
                    echo "<h3>".$row['id']." - ".$row['name']." ".$lastName[0].". (".$row['estimatedTime']."min)</h3>";
                }
            }
            else
            {
                echo "<h3>Laukiančių žmonių eilėje nėra!</h3>";
            }
        }

        public function informClientAboutHisQueueEnd()
        {
            echo "<h4 style='color:green'>Jūsų eilė atėjo! :)</h4>";
        }

        public function informAboutEstimatedLeftTime($time, $time2)
        {
            echo "<h4 style='color:#ff4643'>Likęs laikas: " .$time." minutės!</h4>";
            echo "<h4 style='color:#ff4643'>Likęs apytikslis pagal vidurki: " .$time2." minutės!</h4>";
        }

        public function informAboutEmptyQueue()
        {
            echo "<h4>Laukiančių žmonių eilėje kolkas nebėra :)</h4>";
        }

        public function printNextClientForm($name, $lastname, $visit_id, $estimatedTime)
        {
            echo "<form method='POST'>";
            echo "<h3>Sekantis klientas - <span style='color:#ff4251'>" .$name." ".$lastname."</span> su numeriu <span style='color:#ff4251'>".$visit_id
                ."</span> Skirtas laikas - <span style='color:#ff4251'>".$estimatedTime."</span> minutės.</h3>";
            echo "<button name='clientServicedStart' class='main-button'>Klientas pradėtas aptarnauti</button>";
            echo "<button name='clientServiced' class='main-button'>Klientas aptarnautas</button>";
            echo "</form>";
        }

        public function printYouCannotSkipClient()
        {
            echo "Kliento vizitas dar neprasidėjas, jo užbaigti negalima!";
        }

        public function printPreviousClientTime($time)
        {
            echo "Paskutinis vizitas truko - ".$time;
        }

        public function printTicketReceptionForm()
        {
            echo '<h1>Talonėlio išdavimo punktas</h1>
                    <form method="GET">
                        <span> Kiek laiko planuojate užtrukt? </span><input name="estimatedTime" type="text" placeholder="Laikas"></input><br>
                        <button name="registerReceipt" type="submit" class="main-button">Registruotis</button>
                    </form>';
        }

        public function printCheckStatusWithTicketForm()
        {
            echo "<h1>Pasitikrinkite apytiksli laukimo laiką</h1>";
            echo "<form method='GET'>";
            echo "Suveskite talonėlio NR <input name='ticketId' placeholder='Talonėlio numeris'><br>";
            echo "<button name='submitTicket' class='main-button'>Patikrinti</button>";
            echo "</form>";
        }

        public function printTicketIdNotFound()
        {
            echo "<span style='color:red'>Vizito numeris nerastas!</span>";
        }

        public function printNavigationBar()
        {
            $userHandler = new UserHandler();
            if($_SESSION['loginStatus'] == "0")
            {
                $this->printClientLoginButton();
                $this->printSpecialistLoginButton();
            }
            else
            {
                $this->printLogOutButton();
                if($_SESSION['loginStatus'] == "client")
                    $this->printClientZoneButton();
                else
                    $this->printSpecialistZoneButton();
                if(isset($_GET['logout']))
                {
                    $userHandler->logout();
                    $this->redirect_to_another_page("index.php", 0);
                }
            }
            $this->printMainMenuButton();
        }

        public function onlyClientCanSeeThis()
        {
            if($_SESSION['loginStatus'] != "client")
            {
                $this->printYouCannotAccess(); // TODO: This text is bugged at the top of navbar, fix using CSS.
                $this->redirect_to_another_page("index.php", 0);
                die();
            }
        }

        public function onlySpecialistCanSeeThis()
        {
            if($_SESSION['loginStatus'] != "specialist")
            {
                $this->printYouCannotAccess(); // TODO: This text is bugged at the top of navbar, fix using CSS.
                $this->redirect_to_another_page("index.php", 0);
                die();
            }
        }

        public function printFooterInformation()
        {
            echo '                <a href="https://github.com/Tortonas/Bank-queue-tickets" target="_blank"><img class="icon" src="./img/github.png" alt="github logo"></a>
                <h4>Project was done by Valentinas Kasteckis 2019</h4>';
        }

        public function printThatYouAlreadyHaveANumber($number)
        {
            echo "<span style='color:red'>Jūs jau esate užsiregistravę! Jūsų vizito numeris numeris - ".$number."</span>";
        }

        public function pleaseUseLimitedRanges($number)
        {
            echo "<span style='color:red'>Nutiko klaida, prašome pasirinkti minutes maksimaliai iki ".$number.".</span>";
        }

        public function printCancelVisitForm($ticketId)
        {
            echo "<form class='cancelVisitForm' method='POST'>
<h3>Jūs esate užsiregistravę, jūsų talonėlio numeris yra - <span style='color:red'>$ticketId</span></h3>
<button name='cancelVisit' class='main-button'>Atšaukti vizitą</button>
</form>";
        }

        public function visitCancelSuccessful()
        {
            echo "<span style='color:red'>Vizitas buvo sėkmingai atšauktas!</span>";
        }
	}

?>