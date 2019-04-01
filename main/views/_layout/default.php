<?php require '../main/views/_partial/general/header.php';?>

<!----- Elie Bismuth !-->

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                  <a href="/"><h1>Accueil</h1></a>
            </div>
            <div class="sidebar-header">
                  <a href="/meteo"><h2>Météo</h2></a>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Adhérents</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="/adherents/lister-adherents-a-jour">Adhérents à jour</a>
                        </li>
                        <li>
                            <a href="/adherents/lister-adherents-non-a-jour">Adhérents non à jour</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Clubs</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="/clubs/lister-club-adherents">Voir les adhérents</a>
                        </li>
                        <li>
                            <a href="/clubs/ajouter-adherent">Ajouter un adhérent</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#statSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Statistiques</a>
                    <ul class="collapse list-unstyled" id="statSubmenu">
                        <li>
                            <a href="/statistiques/stat-global">Statistiques globales</a>
                        </li>
                        <li>
                            <a href="/statistiques/stat-clubs">Statistique par clubs</a>
                        </li>
                        <li>
                            <a href="/statistiques/stat-ages">Statistique par ages</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <?php $this->content();?>

             <div class="container mt-5">
                <div class="copyright text-center">
                    <span>Copyright © Elie Bismuth</span>
                <div class="addthis_inline_share_toolbox"></div>
             </div>
         </div>
    </div>
   
    <?php require '../main/views/_partial/general/footer.php';?>
