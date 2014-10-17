<?php 
	if( isset($_POST['article']))
	{
        $bdd = new PDO('mysql:host=localhost;dbname=brasspackers', 'gaspardbenoit', 'pI314159');

		$sql = $bdd->prepare("INSERT INTO articles (article, page, id, etat)	VALUES(:article, :page, :id, :etat)");
		$sql->execute(array
			(
				"article" => stripslashes($_POST["article"]),
				"page" => $_POST["page"],
				"id" => $_POST["id"],
                "etat" => "available"
			)
		);

		echo $_POST["article"];
		//echo $_POST["page"];

	}
?>