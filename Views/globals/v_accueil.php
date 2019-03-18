<!----- Elie Bismuth !-->

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                  <a href="Index.php"><h1>Accueil</h1></a>
            </div>
            <div class="sidebar-header">
                  <a href="Index.php?action=meteo"><h2>Météo</h2></a>
            </div>
            <ul class="list-unstyled components">
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
                        <li>
                            <a href="Index.php?action=ajouterAdherent">Ajouter un adhérent</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#statSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Statistiques</a>
                    <ul class="collapse list-unstyled" id="statSubmenu">
                        <li>
                            <a href="Index.php?action=statGlobal">Statistiques globales</a>
                        </li>
                        <li>
                            <a href="Index.php?action=statClubs">Statistique par clubs</a>
                        </li>
                        <li>
                            <a href="Index.php?action=statAges">Statistique par ages</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <?php if($etape === 0) : ?>
                <div class= "text-center">
                    <h2> Le Ski , votre sport d'hiver favori </h2>
                    <img src="assets/image/ski.jpg" class="img-fluid mt-5" alt="Responsive image">
                </div>
            <?php endif; ?>
           
           <?php
            if(!empty($etape))
            {
                switch($etape)
                {
                        //Le contenu de $etape est défini dans le fichier Index.php
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
                            include($repVues."/clubs/v_ajouterAdherent.php") ;  
                            break;
                        case 5 : 
                            include($repVues."/statistiques/v_allStatistique.php") ;  
                            break;
                        case 6 : 
                            include($repVues."/statistiques/v_statClubs.php") ;  
                            break;
                        case 7 : 
                            include($repVues."/statistiques/v_statsAges.php") ;  
                            break;
                        case 8: 
                            include($repVues."/meteo/v_meteo.php") ;  
                            break;

                }
            }
           ?>
             <div class="container mt-5">
                <div class="copyright text-center">
                    <span>Copyright © Elie Bismuth</span>
                <div class="addthis_inline_share_toolbox"></div>
             </div>
         </div>
    </div>
   
