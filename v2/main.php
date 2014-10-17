<!DOCTYPE html>
<html>
<head>
  <title>The BrassPackers, Fanfare Solidaire</title>
  <link href="ico3.png" rel="icon" type="image/png">
  <link href="style.css" rel="stylesheet">
  <link href="redactor.css" rel="stylesheet">
  <script src="jquery-2.0.3.min.js" type="text/javascript"></script>
  <script src="jquery.cookie.js" type="text/javascript"></script>
  <script src="redactor.min.js" type="text/javascript"></script>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
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
  <div class="clearfix" id="main">
      <div id="onglets">
          <div id="onglets_in">
              <div id="onglets_middle">
                  <a class="onglet img" href="#fanfare" id="fanfare">La Fanfare</a>
                  <a class="onglet" href="#projet" id="projet">Le Projet</a>
                  <a class="onglet" href="#soutien" id="soutien">Soutenez Nous</a>
                  <a class="onglet" href="#reseau" id="reseau">Réseau FSF</a>
                  <a class="onglet" href="#partenaires" id="partenaires">Partenaires</a>
                  <a class="onglet" href="#contact" id="contact">Contact</a>
                  <a class="img" href="#accueil" id="accueil"></a>
              </div>
          </div>

          <div id='logos'>
              <a class="fsf img" href="http://fanfaresansfrontieres.org/" target="new"></a>
              <a class="soundcloud img" href="https://soundcloud.com/brasspackers" target="new"></a>
              <a class="fb img" href="https://www.facebook.com/TheBrasspackers" target="new"></a>
              <a class="gmail img" href="mailto:brasspackers@gmail.com" target="new"></a>
          </div>
      </div>

      <section class="clearfix" id="content">
          <div class="fond" id="f_tete"></div>

          <div class="fond" id="f_corps"></div>

          <div class="fond" id='f_pied'></div>

          <div id="content2"></div>
      </section>
  </div>

  <div id="editer"></div>
  <?php
      $pages = array("projet", "fanfare", "reseau", "partenaires", "soutien", "contact", "accueil","testV2");

      foreach ($pages as $page) {

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

              ";



        $reponse = $bdd->query($sql_articles);



        ?><script id="<?php echo $page; ?>_template" type="text/template"><?php



        while ($donnees = $reponse->fetch())

        {

          ?>

            <div class='article_container'>

              <div class='article' data-page="<?php echo $page ?>" id="<?php echo $donnees['id']; ?>" onclick='redact(this);'>

                <?php echo $donnees['article'];  ?>

              </div>

              <button class='control' onclick='postSave(this);'>Sauvegarder</button>

              <button class='control' onclick='effacer(this);'>Supprimer cet article</button>

            </div>
          <?php
        }
        ?></script><?php
      }

    ?>
  <!--<script src="js/backbone/backbone.js"></script>
  <script src="js/backbone/marionette.js"></script>-->
  <script src="js/script.js"></script>
  </body>
  </html>