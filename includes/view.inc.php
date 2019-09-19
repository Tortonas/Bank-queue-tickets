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
	}

?>