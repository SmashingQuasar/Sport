<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                  <a href="Index.php"><h3>Sport</h3></a>
            </div>
            <ul class="list-unstyled components">
                <p>Dashborad</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Adhérents</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="Index.php?action=listerAdherentsAJour">Adhérents à jour</a>
                        </li>
                        <li>
                            <a href="Index.php?action=listerAdherentsNonAJour">Adhérents non à jour</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Clubs</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="Index.php?action=listerClubAdherents">Voir les adhérents</a>
                        </li>
                    </ul>
                </li>
            </ul>

  
        </nav>

        <!-- Page Content  -->
        <div id="content">
           <?php

            if(!empty($etape))
            {
                switch($etape)
                {
                        case 1 :
                            include($repVues."/adherents/v_listerAdherents.php") ;
                            break;
                        
                        case 2:
                            include($repVues."/adherents/v_listerAdherentsNonAJour.php") ;  
                            break;
                        case 3:
                            include($repVues."/clubs/v_listerClubAdherents.php") ;  
                            break;
                        case 4:
                            include($repVues."/clubs/v_listerClubAdherents.php") ;  
                            break;

                }
            }
           ?>
        </div>
    </div>


</body>