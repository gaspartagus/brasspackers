<?php
    
    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=brasspackers', 'gaspardbenoit', 'pI314159');

    if( isset($_GET['page']) )
    {
        $page = $_GET['page'];
    }
    else $page = "accueil";

    include('random.php');

    if( ! isset($_SESSION['autorisation']) )
    {
        $_SESSION['autorisation'] = "non";
    }
?>

<?php
    // define the path and name of cached file
    $cachefile = 'cached-files/' . $_GET['page'] . '.html';
    // Check if the cached file is still fresh. If it is, serve it up and exit.
    $refresh = $_GET['query'] == 'refresh' || $_SESSION['autorisation'] == "oui";

   // if (file_exists($cachefile) && ! $refresh )
   // {
    //    include($cachefile);
    //    exit;
   // }
    // if there is either no file OR the file to too old, render the page and capture the HTML.
    ob_start();
?>

<?php
    include('main.php');
?>

<?php
    // We're done! Save the cached content to a file
    $fp = fopen($cachefile, 'w');
    fwrite($fp, ob_get_contents());
    fclose($fp);
    // finally send browser output
    ob_end_flush();
?>