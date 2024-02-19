<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
		<link href='../font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		<link href='css/owl.carousel.css' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="../assets/js/owl.carousel.js"></script>
		<script src="../assets/js/jquery-1.3.2.min.js" type="text/javascript"></script>
		<script src="../assets/js/jquery.backgroundPosition.js" type="text/javascript"></script>	
		<script src="../assets/js/demo.js" type="text/javascript"></script>	
		<script type='text/javascript' src='../assets/js/jquery.particleground.min.js'></script>
	</head>
	<body>
	<?php
	include('../assets/biblio/function.php');
	connexion ();
	session_start();
	if(isset($_GET['p']))
		{
			if($_SESSION['user_level']=='administrateur' || $_SESSION['user_level']=='professeur' || $_SESSION['user_level']=='developpeur')
			{
				include('../assets/biblio/user.php');
				$login=$_SESSION['login'];
				$user= new user_info;
				$user->select_user($login);
				echo"
					<div class='navbar_admin'>
							<h4>Interface de Gestion</h4>
							<div class='panel'>
								<center>
									<img src='".$user->user_avatar."'><p>
									Bienvenue $user->pseudo<p>
									Grade : ";
									if($user->user_level=='administrateur')
									{
										echo "<i class='fa fa-user-secret' aria-hidden='true'></i> Administrateur";
									}
									elseif ($user->user_level=='developpeur')
									{
										echo "<i class='fa fa-cogs' aria-hidden='true'></i><u> Developpeur</u>";
									}
									else
									{
										echo"<i class='fa fa-user' aria-hidden='true'></i> Professeur";
									}
								echo"<a href='index.php?p=account'>
										<div class='my_account'>
											<i class='fa fa-user' aria-hidden='true'></i> Mon compte
										</div>
									</a>";
					echo"</div>
						</center>";
						if($_SESSION['user_level']=='administrateur' || $_SESSION['user_level']=='developpeur')
						{
						echo"<h3><i class='fa fa-bars' aria-hidden='true'></i> Gestion du Site <div class='button'><i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i></div></h3> 
							<div class='show_1'>
							<a href='index.php?p=g_onglet'><span";
							
							if($_GET['p']=='g_onglet')
							{
								echo" class=active";
							}
							echo">Onglet</span></a>
							
							<a href='index.php?p=actualite'><span";
							if($_GET['p']=='actualite')
							{
								echo" class=active";
							}
							echo">Actualité</span>

							</div>
							<div class='more'>...</div>";
						
						echo"<h3><i class='fa fa-user' aria-hidden='true'></i> Gestion des Comptes <div class='button2'><i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i></div></h3> 
							<div class='show_2'>
								<a href='index.php?p=addaccount'><span";
								if($_GET['p']=='addaccount')
								{
									echo" class=active";
								}
							echo"> Ajouter un utilisateur</span></a>		
								<a href='index.php?p=listaccount'><span";
								if($_GET['p']=='listaccount')
								{
									echo" class=active";
								}
							echo"> Liste des utilisateurs</span></a>
							</div>
							<div class='more1'>...</div>";
						}
						echo"
						<h3><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Gestion des Cours<div class='button3'><i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i></div></h3> 
							<div class='show_3'>
								<a href='index.php?p=a_cours'><span";
								if($_GET['p']=='a_cours')
								{
									echo" class=active";
								}
							echo"> Ajouter un cours</span>
							<a href='index.php?p=a_ressource'><span";
								if($_GET['p']=='a_ressource')
								{
									echo" class=active";
								}
							echo"> Ajouter ressource</span></a>
								
							
							</div>
							<div class='more2'>...</div>
							<h3><i class='fa fa-bars' aria-hidden='true'></i> Listing <div class='button'><i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i></div></h3> 
							<a href='index.php?p=liste_cours'><span";
								if($_GET['p']=='liste_cours')
								{
									echo" class=active";
								}
							echo"> Liste des cours</span></a>
							<a href='index.php?p=liste_ressources'><span";
								if($_GET['p']=='liste_ressources')
								{
									echo" class=active";
								}
							echo"> Liste des ressources</span></a>
							<a href='index.php?p=liste_onglets'><span";
								if($_GET['p']=='liste_onglets')
								{
									echo" class=active";
								}
							echo"> Liste des onglets</span></a>
							<a href='index.php?p=liste_actualite'><span";
								if($_GET['p']=='liste_actualite')
								{
									echo" class=active";
								}
							echo"> Liste des actualités</span></a>
							<div class='sign'>
								by &copy;jbourdon
							</div>
					</div>";
				if($_GET['p']=='deconnexion')
				{
				echo"<div id='home'>
						<div class='title'>
							<div class='button_deco'>
								<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
							</div>
							<h3>Information Système</h3>
						</div>";
						extract($_POST);
						if(isset($valider))
						{
						echo"
						<div class='message'>
							<h3>Déconnexion</h3>
							<div class='info'>
								Merci de votre visite ".$_SESSION['login'].".<p>
								<img src='../assets/img/loading_deco.gif' width='5%'>
							</div>
						</div>
						<META http-equiv='refresh' content='1; URL=index.php'>";
						session_destroy();
						
						}
						else
						{
						echo"
						<div class='message'>
							<h3>Déconnexion</h3>
							<div class='info'>
								<form method='post' action='index.php?p=deconnexion'>
									Vous êtes sur le point de vous déconnectez de l'application de gestion, êtes vous sur de vouloir vous déconnectez maintenant ?<br>
									<center><hr width='50%'></center>
									Une fois la déconnexion effectué vous allez être automatiquement redirigé vers la page d'identification.
									<input type='submit' class='deco' name='valider' value='Déconnexion'> <input type='button' class='return' value='Annuler' onClick='history.back()'>
								</form>
							</div>
						</div>";
						}
					echo" </div>";
				}
				if($_GET['p']=='home')
				{
					$max=select_max();
					$max_ressource=select_max_ressource();
					echo "
						<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Accueil</h3>
							</div>
							<div class='stat'>
								<div class='box'>
									<img src='../assets/img/livre.png' width=70%;><br>
									<span class='line'></span> 
									<h2> Nombre de cours : $max</h2>
								</div>
								<div class='box'>
									<img src='../assets/img/file.png' width=30%;><br>
									<span class='line'></span> 
									<h2> Nombre de ressource :$max_ressource </h2>
								</div>								
							</div>
							<div class='home_news'>
								<h3>Information</h3>
								<p> Bienvenue sur l'interface de gestion, ici vous allez pouvoir administrer votre site facilement et rapidement a l'aide de formulaire simple et fonctionnel. Vous pouvez également gêrer vos différents cours en ajoutant de nouveau 
								ou en supprimant.</p>
								<center><img src='../assets/img/capture_site.png' class='site'></Center>
							</div>
						</div>
						";
				}
				if($_GET['p']==='g_onglet')
				{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
									
								</div>
								<h3>Gestion des Onglets</h3>
							</div>";
					extract($_POST);
					extract($_FILES);
					if(isset($valider))
					{
						$check=add_categories($name,$color,$img_block,$title,$presentation);
						if($check=='true')
						{
							echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										Création  de la page terminer<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
						else
						{
							echo"
								<div class='message'>
									<h3>Echec</h3>
									<div class='info'>
										Création de la page impossible, veuillez vérifier vos informations.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
					}
					else
					{
					echo "
							<div id='p_gestion'>
								<h3>Ajouter une catégorie</h3>
								<div class='panel'>
									<div class='block'>
									<div class='tips'>
										<img src='../assets/img/help_icone.png'>
										<div class='info'>
											Sur cette page vous allez pouvoir crée et personnaliser les pages pour vos différentes classes. Arrière plan, déscription, apparence dans la barre de navigation principale
											et bien d'autre son modifiafle grâce à cette interface vous offrant ainsi une gestion de l'aspect visuel et du contenue entièrement entre vos mains.
										</div>
									</div><br>
										<form method='POST' action='index.php?p=g_onglet' enctype='multipart/form-data'>
											<div class='form'>
											<h4><i class='fa fa-paint-brush' aria-hidden='true'></i> Création de l'onglet : </h4>
												<div class='visuel'>
													Visuel : 
													<hr color=#000>
													<div class='link'>
														<div id='name'><i class='fa fa-book' aria-hidden='true'></i></div>
													</div>
												</div>
												<span> Nom de la catégorie : </span><p>
												<input type='text' name='name' onkeyup='showHint(this.value)'  maxlength='10' required placeholder='ex : 6 ème'><p>
												<span> Couleur de l'Onglet : </span><p>
												<input type='text' name='color' id='couleur' required><p>
												<span> Image : </span><p>
												<input type='file' name='img_block' required class='upload'>
											</div>
											<div class='form'>
												<h4><i class='fa fa-pencil' aria-hidden='true'></i> Entête de la page : </h4>
												<span> Titre : </span><p>
												<input type='text' name='title' maxlength='50' required placeholder='ex : Les moyens de Transport'><p>
												<span> Description : </span><br>
												<textarea name='presentation' required></textarea>
											</div>									
										</div>
										<center><input type='submit' name='valider' class='submit'></center>
										</form>
										<div class='clear'></div>
									</div>
							</div>
						</div>
						";
					}
				}
				if($_GET['p']=='addaccount')
				{
				extract($_FILES);
				extract($_POST);
				if(isset($valider))
				{
					$check=user_add ($pseudo,$password,$verif_password,$mail,$level,$nom,$prenom,$avatar);
						echo"<div id='home'>
								<div class='title'>
									<div class='button_deco'>
										<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
									</div>
									<h3>Ajouter un utilisateur $check</h3>
								</div>";
					if($check=='error_account')
					{
						echo"
								<div class='message'>
									<h3>Erreur</h3>
									<div class='info'>
										L'identifiant que vous souhaitez crée existe déjà, veuillez en saisir un autre.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
					}
					if($check=='error_mail"')
					{
						echo"
								<div class='message'>
									<h3>Erreur</h3>
									<div class='info'>
										L'adresse mail utilisait est invalide, veuillez en saisir une autre.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
					}
					if($check=='error_MDP')
					{
						echo"
								<div class='message'>
									<h3>Erreur</h3>
									<div class='info'>
										Les deux mots-de-passe saisient sont différent, veuillez vérifier vos informations<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
					}
					if($check=='3')
					{
						echo"
								<div class='message'>
									<h3>Erreur</h3>
									<div class='info'>
										Problème lors de l'enregistrement, veuillez réessayer dans un instant.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
					}
					if($check=='4')
					{
						echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										La création de l'utilisateur est terminée, n'oubliez pas de fournir l'identifiant et le mot-de-passe à la personne concerné pour qu'elle puisse se connecter.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
					}
					
				}
				else
				{
				echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Ajouter un utilisateur</h3>
							</div>
							<div id='p_account'>
								<h3><i class='fa fa-user-plus' aria-hidden='true'></i> Nouvelle Utilisateur </h3>
								<div class='panel'>
								<div class='tips'>
									<img src='../assets/img/help_icone.png'>
									<div class='info'>
									En tant qu'administrateur vous avez la possibilité de crée des comptes pour les différentes personnes amenées à acceder à la partie Administration du site. Il y a deux niveaux de securité pour la création d'un compte :
									</div>
								</div>
									<form method='POST' action='index.php?p=addaccount' enctype='multipart/form-data'>
										<div class='block'>
											<center><img id='link'></center>
											<h4><i class='fa fa-arrow-right' aria-hidden='true'></i> Informations principales</h4>
											<div class='input'>
												<span><i class='fa fa-user' aria-hidden='true'></i></span>
												<input type='text' name='pseudo' placeholder=' Identifiant' required>
											</div>
											<div class='input'>
												<span><i class='fa fa-lock' aria-hidden='true'></i></span>
												<input type='password' name='password' placeholder=' Mot de passe' required>
											</div>
											<div class='input'>
												<span><i class='fa fa-lock' aria-hidden='true'></i></span>
												<input type='password' name='verif_password' placeholder=' Verification mot de passe' required>
											</div>
											<div class='input'>
												<span><i class='fa fa-envelope' aria-hidden='true'></i></span>
												<input type='text' name='mail' placeholder=' Adresse E-mail' required>
											</div>
											<div class='input'>
											Sélection du grade du compte : 
											<select name='level'>
												<option value='administrateur'> Administrateur </option>
												<option value='professeur'> Professeur </option>
											</select>
											</div>
										</div>
										<div class='block'>
											<h4><i class='fa fa-arrow-right' aria-hidden='true'></i> Informations Secondaires</h4>
											<div class='input'>
												<span><i class='fa fa-user' aria-hidden='true'></i></span>
												<input type='text' name='nom' placeholder=' Nom'>
											</div>
											<div class='input'>
												<span><i class='fa fa-lock' aria-hidden='true'></i></span>
												<input type='text' name='prenom' placeholder=' Prénom'>
											</div>
											<div class='input'>
												<span><i class='fa fa-picture-o' aria-hidden='true'></i></span><input type='file' name='avatar' onchange='load_image(event)' REQUIRED>
											</div>
											<center><input type='submit' class='submit' name='valider'></center>
										</div>
									</div>
									</form>
							</div>
						</div>";
				}
				}
				if($_GET['p']=='account')
				{
				echo"
					<div id='home'>
						<div class='title'>
							<div class='button_deco'>
								<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
							</div>
							<h3>Mon compte</h3>
						</div>
						<div id='account'>
							<h3>Gestion du compte ".$_SESSION['login']."</h3>
							<div class='navbar'>
								<h4><i class='fa fa-bars' aria-hidden='true'></i> Menu</h4>
							<a href='index.php?p=account'>
								<span";
									if($_GET['p']=='account' && !isset($_GET['cat']))
									{
										echo" class='active'";
									}
									echo"><i class='fa fa-tasks' aria-hidden='true'></i> Informations</span></a>
								<a href='index.php?p=account&cat=edit'>
								<span";
									if($_GET['p']=='account' && isset($_GET['cat']) && $_GET['cat']=='edit')
									{
										echo" class='active'";
									}
									echo"><i class='fa fa-pencil' aria-hidden='true'></i> Modification</span>
								</a>
								<a href='index.php?p=account&cat=update_mdp'>
								<span";
									if($_GET['p']=='account'&& isset($_GET['cat']) && $_GET['cat']=='update_mdp')
									{
										echo" class='active'";
									}
									echo"><i class='fa fa-unlock-alt' aria-hidden='true'></i> Mot de Passe</span>
								</a>
							</div>";
							if(!isset($_GET['cat']))
							{
							echo"
							<div class='panel'>
								<center><img src='".$user->user_avatar."'><p></center><p>
								<div class='form'>
									<img src='../assets/img/icon-account.png'>
									<h4>Informations Principales : </h4>
									<span><i class='fa fa-user' aria-hidden='true'></i> Nom : </span>
									<div class='result'>".$user->nom."</div>
									<span><i class='fa fa-user' aria-hidden='true'></i> Prénom : </span>
									<div class='result'>".$user->prenom."</div>
									<span><i class='fa fa-envelope' aria-hidden='true'></i> Mail : </span>
									<div class='result'>".$user->mail."</div>
								</div>
								
								<div class='form'>
									<img src='../assets/img/icon-account.png'>
									<h4>Informations Secondaires : </h4>
									<span><i class='fa fa-user' aria-hidden='true'></i> Date de création : </span>
									<div class='result'>".$user->date_creation."</div>
									<span><i class='fa fa-user' aria-hidden='true'></i> Permission : </span>
									<div class='result'>".$user->user_level."</div>
									<span><i class='fa fa-envelope' aria-hidden='true'></i> IP de connexion : </span>
									<div class='result'>".$user->ip_creation."</div>
									</div>
								</div>
							</div>";
						echo"</div>";
							}
							if(isset($_GET['cat'])&& $_GET['cat']=='edit')
							{
								extract($_POST);
								if(isset($valider))
								{
									$user=$user->pseudo;
									updade_info($nom, $prenom, $mail,$user);
									echo"
										<div class='panel'>
											<div class='form'>
												<center>Modification des informations pour l'utilisateur $user terminer.</center><p>
												<center><a href='index.php?p=account'><input type='button' class='return' value='Retour' ></a></center>
											</div>
											</form>
										</div>";
									echo"</div>";	
								}
								else
								{
									echo"
									<div class='panel'>
										<center><img src='".$user->user_avatar."'><p></center><p>
										<div class='form'>
											<form method='POST' action='index.php?p=account&cat=edit'>
												<img src='../assets/img/icon-account.png'>
												<h4>Informations Principales : </h4>

												<span><i class='fa fa-user' aria-hidden='true'></i> Nom : </span>
												<input type='text' name='nom' value='".$user->nom."'>
												<span><i class='fa fa-user' aria-hidden='true'></i> Prénom : </span>
												<input type='text' name='prenom'value='".$user->prenom."'>
												<span><i class='fa fa-envelope' aria-hidden='true'></i> Mail : </span>
												<input type='text' name='mail'value='".$user->mail."'>
												<center><input type='submit' class='submit' name='valider'></center>
											</form>
										</div>
									</div>";
								echo"</div>";
								}	
							}

							if(isset($_GET['cat'])&& $_GET['cat']=='update_mdp')
							{
								extract($_POST);
								if(isset($valider))
								{
									$user=$user->pseudo;
									updade_password($password,$password_verif,$user);
									if ($check='true')
									{	
									echo"
										<div class='panel'>
											<div class='form'>
												<center>Modification du mot de passe pour l'utilisateur $user terminer.</center><p>
												<center><a href='index.php?p=account'><input type='button' class='return' value='Retour' ></a></center>
											</div>
											</form>
										</div>";
									echo"</div>";	
									}
									else
									{
									echo"
										<div class='panel'>
											<div class='form'>
												<center>Les mots-de-passe saisient sont différent, veuillez verifier vos informations.</center><p>
												<center><a href='index.php?p=account'><input type='button' class='return' value='Retour' onClick='history.back()'></a></center>
											</div>
											</form>
										</div>";
									echo"</div>";	
									}
								}
								else
								{
									echo"
									<div class='panel'>
										<center><img src='".$user->user_avatar."'><p></center><p>
										<div class='form'>
											<form method='POST' action='index.php?p=account&cat=update_mdp'>
												<h4>Modification du Mot de Passe : </h4>
												<span><i class='fa fa-unlock-alt' aria-hidden='true'></i> Nouveau : </span>
												<input type='password' name='password'>
												<span><i class='fa fa-unlock-alt' aria-hidden='true'></i> Identifiant : </span>
												<input type='password' name='password_verif'>
										</div>
										<center><input type='submit' class='submit' name='valider'></center>
										</form>
									</div>";
								echo"</div>";	
								}
							}
							
							
				}
				if($_GET['p']=='listaccount')
				{
					echo"
					<div id='home'>
						<div class='title'>
							<div class='button_deco'>
								<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
							</div>
							<h3>Liste des Utilisateurs</h3>
						</div>
						<div id='listing'>";
						listing_user();
		
						echo"</div>";
				}
				if($_GET['p']=='a_logiciel')
				{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des logiciels</h3>
							</div>";
					extract($_POST);
					extract($_FILES);
					if(isset($valider))
					{
						$check=create_cours($title,$class,$file,$chapitre);
						if($check=='true')
						{
							echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										Ajouter du logiciel terminer, vous pouvez retourner à l'accueil ou bien crée un nouveau cour.<p>
										<input type='button' class='return' value='Annuler' onClick='history.back()'>
									</div>
								</div>";
						}
						else
						{
							echo"
								<div class='message'>
									<h3>Echec</h3>
									<div class='info'>
										Ajout du logiciel impossible, veuillez vérifier vos informations.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
					}
					else
					{
					echo "
							<div id='p_gestion'>
								<h3>Ajouter des Logiciels</h3>
								<div class='panel'>
									<div class='block'>
									<div class='tips'>
										<img src='../assets/img/help_icone.png'>
										<div class='info'>
											Cette page vous permet d'ajouter des logiciels pour que vos élèves puissent les téléchargers directement sur le site sans devoir passer par un lien externe.
										</div>
									</div><br>
										<form method='POST' action='index.php?p=a_cours' enctype='multipart/form-data'>
											<div class='form'>
											<h4><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Nouveau cours : </h4>
												<span> Nom du logiciel : </span><p>
												<input type='text' name='title' required><p>
												<span> Description : </span><p>
												<input type='number' name='description' required><p>
									
												<span> Logiciel : </span><p>
												<input type='file' name='logiciel' required class='upload'><p>
												<span> Logo : </span><p>
												<input type='file' name='logo' required class='upload'>
											</div>
										</div>
										<center><input type='submit' name='valider' class='submit'></center>
										</form>
										<div class='clear'></div>
									</div>
							</div>
						</div>";
					}
				}
				if($_GET['p']=='a_cours')
				{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des cours</h3>
							</div>";
					extract($_POST);
					extract($_FILES);
					if(isset($valider))
					{
						$check=create_cours($title,$class,$file,$chapitre);
						if($check=='true')
						{
							echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										Ajouter du cours terminer, vous pouvez retourner à l'accueil ou bien crée un nouveau cour.<p>
										<input type='button' class='return' value='Annuler' onClick='history.back()'>
									</div>
								</div>";
						}
						else
						{
							echo"
								<div class='message'>
									<h3>Echec</h3>
									<div class='info'>
										Création du cours impossible, veuillez vérifier vos informations ou si vous avez bien importé un fichier PDF.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
					}
					else
					{
					echo "
							<div id='p_gestion'>
								<h3>Ajouter un cours</h3>
								<div class='panel'>
									<div class='block'>
									<div class='tips'>
										<img src='../assets/img/help_icone.png'>
										<div class='info'>
											Grâce à cette page vous allez pouvoir ajouter un cours pour une classe bien précise, vous avez juste à choisir le fichier contenant votre cours et sélectionez la classe pour qu'il soit visible aux élèves.
										</div>
									</div><br>
										<form method='POST' action='index.php?p=a_cours' enctype='multipart/form-data'>
											<div class='form'>
											<h4><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Nouveau cours : </h4>
												<span> Titre : </span><p>
												<input type='text' name='title' required><p>
												<span> Numéro du chapitre : </span><p>
												<input type='number' name='chapitre' required><p>
												<span> Classe : </span><p>
												<select name='class'>";
													select_classe();
												echo"</select><p>
												<span> Cours : </span><p>
												<input type='file' name='file' required class='upload'>
											</div>
										</div>
										<center><input type='submit' name='valider' class='submit'></center>
										</form>
										<div class='clear'></div>
									</div>
							</div>
						</div>";
					}
				}
				if($_GET['p']=='a_ressource')
				{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des ressources</h3>
							</div>";
					extract($_POST);
					extract($_FILES);
					if(isset($valider))
					{
						$check=create_ressource($title,$class,$file,$type);
						if($check=='true')
						{
							echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										Ajouter du fichier ressource terminer, vous pouvez retourner à l'accueil ou bien ajouter un nouveau fichier.<p>
										<input type='button' class='return' value='Annuler' onClick='history.back()'>
									</div>
								</div>";
						}
						else
						{
							echo"
								<div class='message'>
									<h3>Echec</h3>
									<div class='info'>
										Ajout du fichier impossible, veuillez vérifier vos informations.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
					}
					else
					{
					echo "
							<div id='p_gestion'>
								<h3>Ajouter un fichier</h3>
								<div class='panel'>
									<div class='block'>
									<div class='tips'>
										<img src='../assets/img/help_icone.png'>
										<div class='info'>
											Ici, vous allez pouvoir ajouter des fichiers ressources (fichier Edrawings, sketchup ou bien d'autre) pour chaque classe.
										</div>
									</div><br>
										<form method='POST' action='index.php?p=a_ressource' enctype='multipart/form-data'>
											<div class='form'>
											<h4><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Nouveau fichier ressource : </h4>
												<span> Titre : </span><p>
												<input type='text' name='title' required><p>
												<span> Classe : </span><p>
												<select name='class'>";
													select_classe();
												echo"</select><p>
												<span> Type : </span><p>
												<select name='type'>
													<option value='edrawings'>Edrawings</option>;
													<option value='sketchup'>Sketchup</option>;
													<option value='autre'>Autre</option>;
												</select><p>
												<span> Fichier : </span><p>
												<input type='file' name='file' required class='upload'>
											</div>
										</div>
										<center><input type='submit' name='valider' class='submit'></center>
										</form>
										<div class='clear'></div>
									</div>
							</div>
						</div>";
					}
				}
				if($_GET['p']=='liste_cours')
				{
					extract($_POST);
					if(isset($valider))
					{
						foreach($a as $id)
						{	
							$check=delet_cours($id);
						}	
						echo"
						<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des Liste des cours</h3>
							</div>
							<div class='message'>
								<h3>Réussie</h3>
								<div class='info'>
									Suppression terminer avec succès.<p>
									<input type='button' class='return' value='Retour' onClick='history.back()'>
								</div>
							</div>
						</div>";
					}
					else
					{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Liste des cours </h3>
							</div>
							<div id='listing'>
									<div class='panel'>
										<h3><i class='fa fa-list' aria-hidden='true'></i> Tous les cours </h3>
										<form method='POST' action='index.php?p=liste_cours'>";									
											liste_cours();
									echo"	<center><input type='submit' value='Supprimer sélection' name='valider' class='submit'></center>
										</form>
									</div>
									
								</div>
						</div>";
					}
				}
				if($_GET['p']=='liste_ressources')
				{
					extract($_POST);
					if(isset($valider))
					{
						foreach($a as $id)
						{	
							$check=delet_ressources($id);
						}	
						echo"
						<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des Liste des ressources</h3>
							</div>
							<div class='message'>
								<h3>Réussie</h3>
								<div class='info'>
									Suppression terminer avec succès.<p>
									<input type='button' class='return' value='Retour' onClick='history.back()'>
								</div>
							</div>
						</div>";
					}
					else
					{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Liste des ressources </h3>
							</div>
							<div id='listing'>
									<div class='panel'>
										<h3><i class='fa fa-list' aria-hidden='true'></i> Tous les cours </h3>
										<form method='POST' action='index.php?p=liste_ressources'>";									
											liste_ressources();
									echo"	<center><input type='submit' value='Supprimer sélection' name='valider' class='submit'></center>
										</form>
									</div>
									
								</div>
						</div>";
					}
				}
				if($_GET['p']=='liste_actualite')
				{
					extract($_POST);
					if(isset($valider))
					{
						foreach($a as $id)
						{	
							$check=delet_actu($id);
						}	
						echo"
						<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des actualités</h3>
							</div>
							<div class='message'>
								<h3>Réussie</h3>
								<div class='info'>
									Suppression terminer avec succès.<p>
									<input type='button' class='return' value='Retour' onClick='history.back()'>
								</div>
							</div>
						</div>";
					}
					else
					{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des actualités </h3>
							</div>
							<div id='listing'>
									<div class='panel'>
										<h3><i class='fa fa-list' aria-hidden='true'></i> Toutes les actualités </h3>
										<form method='POST' action='index.php?p=liste_actualite'>";									
											liste_actualite();
									echo"	<center><input type='submit' value='Supprimer sélection' name='valider' class='submit'></center>
										</form>
									</div>
									
								</div>
						</div>";
					}
				}
				if($_GET['p']=='liste_onglets')
				{
					extract($_POST);
					if(isset($valider))
					{
						foreach($a as $id)
						{	
							$check=delet_onglets($id);
							delet_allcours($id);
						}	
						echo"
						<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Gestion des Liste des onglets</h3>
							</div>
							<div class='message'>
								<h3>Réussie</h3>
								<div class='info'>
									Suppression terminer avec succès.<p>
									<input type='button' class='return' value='Retour' onClick='history.back()'>
								</div>
							</div>
						</div>";
					}
					else
					{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Liste des onglets </h3>
							</div>
							<div id='listing'>
									<div class='panel'>
										<h3><i class='fa fa-list' aria-hidden='true'></i> Tous les cours </h3>
										<h3>Supprimer un onglet entrainera la suppression de tout les cours appartenant à la catégorie.</h3>
										<form method='POST' action='index.php?p=liste_onglets'>";									
											liste_onglets();
									echo"	<center><input type='submit' value='Supprimer sélection' name='valider' class='submit'></center>
										</form>
									</div>
									
								</div>
						</div>";
					}
				}
				if($_GET['p']=='del'&& isset($_GET['id']))
				{
					select_user();
					extract($_POST);
					if(isset($valider))
					{
					delet_user();
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?kp=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Suppression de l'utilisateur</h3>
							</div>
							<div class='message'>
								<h3>Validation</h3>
								<form method='POST'>
									<div class='info'>
										Suppresion du compte <font color='#6a54b0'>$pseudo</font> terminer.<p>
										<a href='index.php?p=listaccount'> <input type='button' class='return' value='Retour'> </a>
									</div>
								</form>
							</div>";		
					}
					else
					{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?kp=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Suppresion de l'utilisateur</h3>
							</div>
							<div class='message'>
								<h3>Validation</h3>
								<form method='POST'>
									<div class='info'>
										Êtes-vous sur de vouloir supprimer le compte <font color='#6a54b0'>$pseudo</font><p>
										<input type='submit' class='return' value='valider' name='valider'><input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</form>
							</div>";
					}
				}
				if($_GET['p']=='actualite')
				{
					echo"<div id='home'>
							<div class='title'>
								<div class='button_deco'>
									<a href='index.php?p=deconnexion'>Déconnexion <i class='fa fa-power-off' aria-hidden='true'></i></a>
								</div>
								<h3>Actualité</h3>
							</div>";
					extract($_POST);

					if(isset($valider))
					{
						$check=add_news($title,$information);
						if($check=='true')
						{
							echo"
								<div class='message'>
									<h3>Réussie</h3>
									<div class='info'>
										Ajout de l'actualité terminer.<p>
										<input type='button' class='return' value='Retour' onClick='history.back()'>
									</div>
								</div>";
						}
						else
						{
							echo"
								<div class='message'>
									<h3>Echec</h3>
									<div class='info'>
										Erreur lors de la création de l'acualité, verifier vos informations ou attendez.<p>
										Evitez de mettre des apostrophes ou caractères spéciaux. 
										<input type='button' class='return' value='Retour' onClick='history.back()'>
			
									</div>
								</div>";
						}
					}
					else
					{
					echo "
							<div id='p_gestion'>
								<h3>Ajouter une actualité</h3>
								<div class='panel'>
									<div class='block'>
									<div class='tips'>
										<img src='../assets/img/help_icone.png'>
										<div class='info'>
											Cette page vous permet d'ajouter une information à faire parvenir à vos élèves grâce aux sites. L'information sera ajouté sous forme d'actualité sur la première page.
										</div>
									</div><br>
										<form method='POST' action='index.php?p=actualite' enctype='multipart/form-data'>
											<div class='form'>
											<h4><i class='fa fa-file-pdf-o' aria-hidden='true'></i> Nouvelle acualité : </h4>
												<span> Nom actualité : </span><p>
												<input type='text' name='title' required><p>
												<span> Information : </span><p>
												<textarea name='information' required></textarea>

											</div>
										</div>
										<center><input type='submit' name='valider' class='submit'></center>
										</form>
										<div class='clear'></div>
									</div>
							</div>
						</div>";
					}
				}
			}
			else
			{
				ECHO"pas d'autorisation";
			}
		}
		else
		{
			extract($_POST);
			if(isset($valider))
			{
				$check=identification ($login,$password);
				if($check==0)
				{
					echo"<div class='login'>
							<h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
							<div class='panel'>
								<center>
									<img src='../assets/img/login.png'>
									Erreur : Compte innexistant <br>
								</center>
								<div class='form'>
									Il semblerait que votre identifiant soit incorrecte. Vérifiez que vous avez correctement saisi ou si le problème persiste assurez vous d'être bien autorisé à accèder à ce site.
								</div>
								<center><input type='button' class='submit' value='Retour' onClick='history.back()'></center>
							</div>
						 </div>";
				}
				if($check==1)
				{
					echo"<div class='login'>
							<h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
							<div class='panel'>
								<center>
									<img src='../assets/img/login.png'>
									Bienvenue ". $_SESSION['login']."<br>
								</center>
								<div class='form'>
									Vous êtes désormais connecté à l'espace administration, vous allez être redirigez vers votre page dans quelques secondes. 
									<center><img src='../assets/img/loading.gif' style='width:12%'></center>
									<meta http-equiv='refresh' content='1; URL=index.php?p=home'>
								</div>
							</div>
						 </div>";
				}
				if($check==2)
				{
					echo"<div class='login'>
							<h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
							<div class='panel'>
								<center>
									<img src='../assets/img/login.png'>
									Erreur : Identifiant Invalide <br>
								</center>
								<div class='form'>
									Votre Mot de Passe semble invalide, verifiez vos informations personnels ou si le problème persiste contacté un Administrateur.
								</div>
								<center><input type='button' class='submit' value='Retour' onClick='history.back()'></center>
							</div>
						 </div>";
				}
			}
			else
			{
			echo"
				<form method='POST' action='index.php'>
					<div class='login'>
						<h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
						<div class='panel'>
							<center>
								<img src='../assets/img/login.png'>
								Connectez-vous à votre espace personnel.<br>
							</center>
							<div class='form'>
								<span>Votre identifiant</span>
								<input type='text' name='login' required>		
								<span>Votre Mot-de-Passe </span>
								<input type='password' name='password' required>
							</div>
							<center><input type='submit' name='valider' value='Connexion' class='submit'></center>
						</div>			
					</div>
				</form>";
			}
		}		
	?>
</body>
</html>
<script type="text/javascript">
	$('.button').click(function(){
			$('.show_1').slideToggle();
			$('.more').toggleClass('visible');				
		});
	$('.button2').click(function(){
			$('.show_2').slideToggle();
			$('.more1').toggleClass('visible');		
		});
	$('.button3').click(function(){
			$('.show_3').slideToggle();
			$('.more2').toggleClass('visible');		
		
		});
		
	function showHint(name) 
	{
		var xhttp;
		if (name.length == 0)//Chaine = 0 on affiche rien
		{
			document.getElementById("name").innerHTML = "<i class='fa fa-book' aria-hidden='true'></i> Home";
			return;
		}
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("name").innerHTML ="<i class='fa fa-book' aria-hidden='true'></i> "+ name;
			}
		};
		xhttp.open("GET", "gethint.php?q="+name, true);
		xhttp.send();
	}	
</script>
<script>
  var load_image = function(event) {
    var link = document.getElementById('link');
    link.src = URL.createObjectURL(event.target.files[0]);
  };
  var load_background = function(event) {
    var img_back = document.getElementById('img_back');
    img_back.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
