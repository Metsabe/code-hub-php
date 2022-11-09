<?php
	try{
		$pdo=new PDO("mysql:host=localhost;dbname=code-hub","root","");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>