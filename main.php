<html>
<head>
	<title>The BrassPackers, Fanfare Solidaire à Paris</title>
	
	<link rel="icon" type="image/png" href="ico3.png" />

    <link href="style.css" rel="stylesheet">	
	
	<link rel="stylesheet" href="redactor.css" />
	
	<script type="text/javascript" src="jquery-2.0.3.min.js"></script>

	<script type="text/javascript" src="redactor.min.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta description="Une fanfare de l'Ecole Centrale Paris qui mène un projet solidaire pour apporter un échange culturel à des enfants défavorisés dans des pays en voie de développement." />

    <meta name="google-translate-customization" content="1d1052af4e934706-52d4e5245f0442e7-gabbb8c25316d002f-11"></meta>

    <meta name="robots" content="<?php
        
        $pages = array("projet", "fanfare", "reseau", "partenaires", "soutien", "contact", "accueil");

        if (! in_array($_GET['page'], $pages) )
        {
            echo "noindex";
        }
    ?>"/>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-48430682-1', 'brasspackers.org');
        ga('send', 'pageview');
    </script>


	
	
</head>

<body class="clearfix">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "http://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div id="main" class="clearfix">
        <div id="fond-discret"></div>
        <?php
            if( $page == "bitegrossebite")
            {
                ?>
                <img src="<?php 
            
                    echo $path . $img ;
            
                    ?>" alt="" id="random" /><?php
            }
        ?>
        <div id="onglets" class="<?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>">

			<div id="page"><?php
					if( isset($_GET['page']))
					{
						echo $_GET['page'];
					}
					else echo 'accueil';
			?></div>

            <div id="session"><?php
					echo $_SESSION['autorisation'];
			?></div>

            <a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="fanfare" href="?page=fanfare">La Fanfare</a>
			<a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="projet" href="?page=projet">Le Projet</a>
			<a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="soutien" href="?page=soutien">Soutenez-nous</a>
			<a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="reseau" href="?page=reseau">Réseau FSF</a>
			<a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="partenaires" href="?page=partenaires">Partenaires</a>
			<a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="contact" href="?page=contact">Contact</a>
            <a class="onglet <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>" id ="actualites" href="?page=actualites">Actualités</a>
			<a href="?page=accueil" id="accueil" class="<?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>"></a>
		
			<div id='logos' class="clearfix <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>">
				<a href="mailto:brasspackers@gmail.com" target="new">
					<img src="graphismes/mail.png">
				</a>
				<a href="https://www.facebook.com/TheBrasspackers" target="new">
					<img src="graphismes/fb.png">
				</a>
                
			</div>
            <div id="google_translate_element"></div>
            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'fr',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                        multilanguagePage: true,
                        gaTrack: true,
                        gaId: 'UA-48430682-1'
                    },
                    'google_translate_element');
                }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		</div>
              <?php
        if( $page == "accueil")
        {
        ?>
        <div id="bas" class="clearfix">
            <div id="gauche" class="colonne">
                <div id="littleNigga" class="speech">
                    <p>Brasspackers est un projet de solidarité internationale mené par 11 jeunes musiciens, qui promeut l'éveil des enfants défavorisés par la musique et l'écoute. <a href="?page=projet">En savoir plus</a></p>
                </div>
                <div class="speech" id="bigNigga">
                    <p>Les Brasspackers c'est aussi une fanfare qui enflamme le public aussi bien dans la rue que sur scène. Habitués des prestations professionelles, elle est rompue à l'animation de mariages, festivals, événements sportifs... <a href="?page=fanfare">En savoir plus</a></p>
                </div>
            </div>
            <div id="droite" class="colonne">

                <?php
					$sql_articles = "SELECT article, id, page
										FROM articles
										WHERE articles.page = '$page'
										AND articles.date =
										(
											SELECT MAX(date)
											FROM articles a2
											WHERE a2.id = articles.id
											AND a2.page = articles.page
										)
                                        AND articles.etat = 'available'
										ORDER BY articles.id ASC
                                        LIMIT 1
									";

					$reponse = $bdd->query($sql_articles);
					while ($donnees = $reponse->fetch())
					{
						?>
							<div class='article_container'>
								<div class='article'>
									<?php echo $donnees['article'];  ?>
								</div>
								<button class='id' id='<?php echo $donnees['id'] ?>' onclick='postSave(this);'>Sauvegarder</button>
								<button class='id' id='<?php echo $donnees['id'] ?>' onclick='effacer(this);'>Supprimer cet article</button>
							</div>
						<?php
						
					}
                    ?>

            </div>
        </div>
        <?php   
        }
        if( $page !== "accueil")
        {

        ?>

		<section id="content" class="clearfix <?php if( $page == "accueil"){echo "accueil";}else{echo"autres";}?>">


			<div id="f_tete" class="fond"></div>
			<div id="f_corps" class="fond"></div>
			<div id='f_pied' class="fond"></div>



			<div id="content2">
                <?php
                    $tri = "";
                    if($page == "actualites")
                    {
                        $tri = "DESC";
                        ?><h1 style="text-align: center;">ACTUALITES</h1><?php
                    } else {
                        $tri = "ASC";
                    } 

					$sql_articles = "SELECT article, id, page
										FROM articles
										WHERE articles.page = '" . $page . "' AND articles.date =
										(
											SELECT MAX(date)
											FROM articles a2
											WHERE a2.id = articles.id
											AND a2.page = articles.page
										)
                                        AND articles.etat = 'available'
										ORDER BY articles.id " . $tri;
                    
					$reponse = $bdd->query($sql_articles);
					while ($donnees = $reponse->fetch())
					{
						?>
							<div class='article_container'>
								<div class='article'>
									<?php echo $donnees['article'];  ?>
								</div>
								<button class='id' id='<?php echo $donnees['id'] ?>' onclick='postSave(this);'>Sauvegarder</button>
								<button class='id' id='<?php echo $donnees['id'] ?>' onclick='effacer(this);'>Supprimer cet article</button>
							</div>
						<?php
						
					}
                    if($_GET['page']=="fanfare")
                    include('trombines.html');

                    if($_GET['page']=="menu")
                    include('menu.php');
				    
                   if( $_SESSION['autorisation'] == "oui")
                   {
                        echo "<button id='nouveau' onclick='nouveau();'>Ecrire un nouvel article</button>" ;
                   }
           
                ?>
				
			</div>
		</section>

        <?php
        }
        ?>

	</div>
    <div id="editer"></div>
    <img src="html5rocks.png" id="editer-ex"/>
    <?php
         if($_GET['page']=="avion" || $_SESSION["autorisation"] == "oui")

         echo '<div id="avion" >
        <img src="graphismes/avion/plane.png">
    </div>';
    ?>
    
    <div id="temoin"></div>

	<script src="scripts.js" type="text/javascript"></script>

    <!--?php
        if($_GET['page']=="avion" || $_SESSION["autorisation"] == "oui")
        echo '<script type="text/javascript" src="avion.js" ></script>';
        if($_GET['page']=="avion-ex" )
        echo '<script type="text/javascript" src="avion-ex.js" ></script>';
    ?-->



</body>


</html>
