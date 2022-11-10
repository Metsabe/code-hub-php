<?php
	session_start();
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
?>
<!DOCYTPE html>
<html> 
	<head>
		<link rel="stylesheet" href="style.css">
		<style>
			header{
				margin:0;
				padding:0;
				background:linear-gradient(45deg,#11245f,#40cfc8,#052c31,#030b22);
				padding:2rem;
				font-size:20px;
				color:cyan ;
				}
				body{
					background-color: grey;
					color: blanchedalmond;
				}
				a {
    				text-decoration:none;
    				font-size:20px;
    				color: black;
					margin-left: 12px;
        		}
				a{
   					 color:cyan;
				}

				a:hover {
   					 color:cyan;
						}
		</style>
	</head>
	<body>
		<main></main>
		<header>
			Membres Code-HUB
			<a style="float:right;" href="deconnexion.php">Se deconnecter</a>
		</header>
		<h1>
		<?php 
			echo (date("H")<18)?("Bonjour"):("Bonsoir");
		?>

		<div class="listes">
			<p>listes</p>
			
			<?php 
			 $username = "root"; 
			 $database = "code-hub";
			 $password = ""; //s'il y a un mot de passe faut le mettre

			 $mysqli = new mysqli("localhost", $username, $password, $database); 
				$query = "SELECT * FROM users";

			

			if ($result = $mysqli->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$nom = $row["nom"];
					$langage = $row["langage"];
					$login = $row["login"];

				
				}
				$result->free();
			} 
			?>
		</div>

		<span>
		<?php
		$_SESSION["nomlogin"]
		?>
		</span>
		</h1>
		
		// Securisation des formulaires
		<?php
                     $Nom=$LangagesdeProgrammation=$login= $Motsdepass=$ConfirmerMotsdepass= "";

                     function securisation($donnees){
                        $donnees = trim($donnees);
                        $donnees = stripslashes($donnees);
                        $donnees = strip_tags($donnees);
                        return $donnees;
                     }
           
                     $Nom = securisation($_POST['Nom']);
                     $LangagesdeProgrammation = securisation($_POST['LangagesdeProgrammation']); 
                     $login = securisation($_POST['login']);
                     $Motsdepass = securisation($_POST['Motsdepass']);
                     $ConfirmerMotsdepass = securisation($_POST['ConfirmerMotsdepass'])
                ?>
	</body>
</html>
