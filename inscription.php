<?php
	@$nom=$_POST["nom"];
	@$langage=$_POST["langage"];
	@$login=$_POST["login"];
	@$pass=$_POST["pass"];
	@$repass=$_POST["repass"];
	@$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		if(empty($nom)) $message="<li>Non invalide!</li>";
		if(empty($langage)) $message.="<li>langage invalide!</li>";
		if(empty($login)) $message.="<li>Login invalide!</li>";
		if(empty($pass)) $message.="<li>Mot de passe invalide!</li>";
		if($pass!=$repass) $message.="<li>Mots de passe non identiques!</li>";	
		if(empty($message)){
			include("connexion.php");
			$req=$pdo->prepare("select id from users where login=? limit 1");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($login));
			$tab=$req->fetchAll();
			if(count($tab)>0) {
                $message="<li>Ce Login existe déjà!</li>";

            }
            
			else{
				$ins=$pdo->prepare("insert into users(date,nom,langage,login,pass) values(now(),?,?,?,?)");
				$ins->execute(array($nom,$langage,$login,md5($pass)));
				header("location:login.php");
			}
		}
	}
?>
<!DOCYTPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            header{
             font-size: larger;
             background:linear-gradient(45deg,#23b7ca,#60ddb8,#0c2e33,#3cd87d);

            }
           a{
				text-decoration: none;
				color: black;
				margin-left: 12px
			}
            a:hover{
                color:burlywood;
                background-color: #fff;
                border-radius:20px;
            }

        </style>
	</head>
	<body style="background-color: grey;">
		<header>
		   Inscription
            <a href="login.php">Déja inscrit</a> 
        </header>
        <!--champs de saisi formulaire-->
		<form name="fo" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" name="nom" placeholder="Nom complet" class="form-control">
                </div>

            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Langages de Programmation</label>
                <div class="col-sm-10">
                    <select name="langage" class="form-control">
                        <option>selectionner un langage de programmation</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP">PHP</option>
                        <option value="Java">JAVA</option>
                        <option value="C/C++">C/C++</option>
                        <option value="Python">PYTHON</option>
                        <option value="R">R</option>
                        <option value="Ruby">RUBY</option>
                        <option value="SQL">SQL</option>
                        <option value="XML">XML</option>
                    </select>
                </div>
            </div><br>

            </div>
            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">login</label>
                <div class="col-sm-10">
                    <input type="text" name="login" placeholder="Entrer votre login" class="form-control">
                </div>
            </div><br>



            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Mots de passe</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" placeholder="Mots de passe" class="form-control">


                </div><br>
            </div>
            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Confirmer Mots de passe</label>
                <div class="col-sm-10">
                    <input type="password" name="repass" placeholder="Confirmer Mots de passe" class="form-control">


                </div>
            </div> <br>

			<input class="btn btn-primary" type="submit" name="valider" value="S'inscrire"  />
		</form>
		<?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
		<?php } ?>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
	
   //  Securisation de l'application
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
</html>
