<?php 
	session_start();
	include('../V2/assets/biblio/function.php');
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../V2/css/style_admin.css">
	<title>Mot de passe oublié</title>
</head>
<body>
	<form method='post' action='forget.php'> 
		<div class='login'>
			<h3><i class='fa fa-user' aria-hidden='true'></i> Mot de passe oublié </h3>
				<div class='panel'>
					<center>
						<img src='../V2/assets/img/login.png'>
					</center>
					<div class='form'>
						<?php
							if(isset($_GET['mdp']))
							{ 
						?>
								<span>Mot de passe</span>
								<input type="password" name="mdpp" required>
								<span>Reconfirmer</span>
								<input type="password" name="mdpconfirm" required>
						<?php	
							}
							else
							{
						?>	
								<span>Identifant</span>
								<input type="text" name="pseudo" required>
								<span>Email</span>
								<input type="email" name="email" required>
						<?php
							} 
							
						?>
					</div>
					<center><input type='submit' name='valider' value='Connexion' class='submit'></center>
				</div>
			</div>
		</div>
	</form>
	
</body>
</html>

<?php	
	
	if(isset($_POST['pseudo'],$_POST['email'])) //partie création du token et envoie du mail
	{	
		connexion();
		$token=Genere_Password(10);
		$token=sha1($token);
		$reponse=mysql_query("SELECT * FROM account");
		//on parcoure la reponse sql
		while ($donnees = mysql_fetch_array($reponse))
		{
			//on test si le pseudo et l'email existe et coresponde dans la bdd
			if($donnees[0]==$_POST['pseudo']&&$donnees[4]==$_POST['email'])
			{
				$to      = $donnees[4];
				$subject = "Changement de mot de passe";
				$message = "Voici le lien permettant de changer votre mot de passe : "."".$address."/forget.php?mdp=".$token."";
				$headers = 'From: nepasrepondre@gmail.com' . "\r\n" .
				'Reply-To: nepasrepondre@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				
				$id_user=$donnees[10];
				$requete = mysql_query("INSERT INTO tokens(id_token,id_account,date_expi)VALUES('".$token."',".$id_user.",(NOW()+INTERVAL 10 MINUTE))");
				//on teste si la requete est bien passé
				if(!$requete)
				{
					echo "erreur";
				}
				else
				{
					echo "réussie";
				}	//plus tard
			}
		}
		close_bdd();
	}
	if (isset($_GET['mdp'])) //partie mot de passe 
	{
		$_SESSION['mdpget']=$_GET['mdp'];
	}
	
	if(isset($_POST['mdpp'],$_POST['mdpconfirm']))
	{
		if(isset($_SESSION['mdpget']))
		{
			connexion();			
			$token=$_SESSION['mdpget'];
			$reponse=mysql_query("SELECT * FROM tokens WHERE id_token='".$token."'AND date_expi>=NOW()");// 
			//on parcoure la reponse sql
			while ($donnees = mysql_fetch_array($reponse))
			{
				$id_account=$donnees[1];
				$tokenBDD=$donnees[0];
				$datebdd=$donnees[2];
			}
			$date = date('Y-m-d H:i:s', time());
			//on teste si le mot de passe et le même dans mdp et mdpconfirm
			if ($_POST['mdpp'] == $_POST['mdpconfirm'] ) 
			{
				if($date<$datebdd)
				{
					$new_mdp=sha1($_POST['mdpp']);
					$update=mysql_query("UPDATE account SET password='".$new_mdp."' WHERE id_account=".$id_account."");
					$suprr=mysql_query("DELETE FROM tokens WHERE id_token='".$token."'");
					$suprr1=mysql_query("DELETE FROM tokens WHERE id_token='".$token."'");
					header("Location:".$address."/admin");
				}
				else
				{
					header("Location:".$address."/forget.php?erreur=exp");

				}	
			}
			else
			{
				echo"les mdp sont pas pareil";
				header("Location: ".$address."/forget.php?mdp=".$token."");
			}
			close_bdd();
		}	
	}
	if (isset($_GET['erreur']))
	{
		if($_GET['erreur']== 'exp')
		{
			echo "Le temps pour changer votre mot de passe a expiré";
		}
	}
	
	function Genere_Password($size)
	{
	    // Initialisation des caractères utilisables
	    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
	    $password="";

	    for($i=0;$i<$size;$i++)
	    {
	        $password.= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
	    }
		
    	return $password;
	}
	
?>

		