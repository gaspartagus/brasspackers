<?php
    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=brasspackers', 'gaspardbenoit', 'pI314159');

?>

<?php
    // define the path and name of cached file
    $cachefile = 'index.html';

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