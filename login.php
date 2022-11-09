<?php
	session_start();
	@$login=$_POST["login"];
	@$pass=$_POST["pass"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		include("connexion.php");
		$res=$pdo->prepare("select * from users where login=? and pass=? limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($login,md5($pass)));
		$tab=$res->fetchAll();
		if(count($tab)==0)
			$message="<li>Mauvais login ou mot de passe!</li>";
		else{
			$_SESSION["autoriser"]="oui";
			$_SESSION["nomlogin"]=strtoupper($tab[0]["nom"]." ".$tab[0]["login"]);
			header("location:session.php");
		}
	}
?>
<!DOCYTPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			a{
				text-decoration: none;
				color: black;
				margin-left: 12px;
			}
		</style>
	</head>
	<body onLoad="document.fo.login.focus()">
		<header>
			Authentification
			<a href="inscription.php">S'inscrire</a>
		</header>
		<form class="login" name="fo" method="post" action="">

		<div class="form-group">
                <label for="input1" class="col-sm-5 control-label">login</label>
                <div class="col-sm-10">
                    <input type="text" name="login" placeholder="Entrer votre login" class="form-control" id="input1" value="<?php echo $login?>">
                </div>
            </div><br>
			<div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Mots de passe</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" placeholder="Mots de passe" class="form-control" id="input1">


                </div><br>

			<input class="btn btn-success" type="submit" name="valider" value="Se connecter" />
		</form>

		<?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
		<?php } ?>
		
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</html>