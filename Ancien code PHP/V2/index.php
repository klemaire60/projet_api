<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
		<link href='font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="assets/js/jquery-1.3.2.min.js" ></script>
		<script src="assets/js/jquery-1.9.1.min.js" ></script>
		<script src="owl.carousel.js"></script>
	</head>
	<?php
		include('assets/biblio/function.php');
		connexion ();
		echo"
			<header>
				<div class='navbar'>
					<img src='assets/img/gears.png' class='logo'>
					<div class='page'>		
						<a href='index.php'><div";
							if(!isset($_GET['p']))
							{
								echo" class='active' style='background-color:#db6692'";
							}
							else
							{
								echo" class='link' style='background-color:#db6692'";
							}
							echo"><i class='fa fa-home' aria-hidden='true'></i> Accueil
							</div></a>";
					
						navbar();

						echo"
						<a href='index.php?p=logiciels'><div";
						if(isset($_GET['p'])&& $_GET['p']=='logiciels')
						{
							echo" class='active' style='background-color:#48d0b0'";
						}
						else
						{
							echo" class='link' style='background-color:#48d0b0'";
						}
						echo"><i class='fa fa-cogs' aria-hidden='true'></i> Logiciels
						</div>
						</a>
						<a href='http://www.la-providence.net/'><img src='assets/img/logo_providence.jpg' target='_blank' class='lapro'></A>
					</div>
				</div>
			</header>";
			if(isset($_GET['p'])&&$_GET['p']=='actu')
			{
				printnews();
			}
			if(!isset($_GET['p']))
			{
			echo"
			<body>
				<div id='home'>		
					<div class='cloud'></div>
					<div class='cloud2'></div>
					<img src='assets/img/robot.png' class='robots'>
					<img src='assets/img/logo_techno.png' class='l_techno'>
					<div class='appartement'>
						<img src='assets/img/immeuble.png'>
					</div>
					<div class='presentation'>
						<div class='menu'>
							<span>
								<b> Actualités </b>
								<img src='assets/img/news.png'>
							</span>
						</div>
						<div class='panel'>
							<h3>Informations</h3>
							<div class='news'>
								<h4>Pourquoi la technologie au collège ? </h4>
								« Comprendre les objets techniques » de la vie courante c’est comprendre le monde dans lequel nous vivons. La technologie fait donc partie intégrante de l’enseignement général dispensé au collège.
							</div>							
							<div class='news'>
								<h4>Intérêt du site :</h4>
								Ce site a pour but de montrer l'intérêt des cours de technologie au collège mais aussi de proposer un accès aux élèves leur permettant d'accéder aux fichiers numériques pour travailler en classe mais aussi à la maison.
							</div>							
							<h3><i class='fa fa-bar-chart' aria-hidden='true'></i>Actualités</h3>
							<div class='EnglobageCss'>
								<div class='stat'>";
									read_news();
									echo"
								</div>
								<div id='CssLienAcutalite'><a href='".$address."/index.php?p=actu'>Toutes les actualités</a>
								</div>
							</div>	
							<div class='clear'></div>
						</div> 
						<div class='clear'></div>
					</div>
					
					<div class='select'>
						<div class='ecoledirect'>
							<span>
							<a target='_blank' href='https://www.ecoledirecte.com/login'><img class='ecoledirectimg' src='assets/img/ecoledirect.png' alt='Lien ecole directe' /></a></span> 
						</div>
						<div class='menu'>
							<span>
								<b> Nos cours </b>
								<img src='assets/img/livre.png'>
							</span>
						</div>
						<div class='panel'>
							<h3>Les différents niveaux : </h3>"; 
							select_menu();
							echo"
									<a href='index.php?p=3 ème'>
										<div class='block_one' style='background-color:#5dc6b8'>
											<div class='classe'>3 ème</div>
												<center><img src='assets/img_categorie/logo_projet.png' alt='logo'><p></center>
												<div class='button'>
												<i class='fa fa-book' aria-hidden='true'></i> Cours
												<div class='clear'></div>
											</div>
										</div>
									</a>
								<a href='index.php?p=logiciels'>
									<div class='block_two' style='background-color:#d8d827'>
										<center><img src='assets/img/logo_logiciel.png' alt='logiciel'><p></center>
										<div class='button'>
											<span> <i class='fa fa-question-circle-o' aria-hidden='true'></i> Logiciels </span>
										</div>
									</div>	
								</a>
								<div class='clear'></div>
							</div> 
							<div class='clear'></div>
						</div>";
						echo"<div id='footer'>
								<div class='link'>
									<img src='assets/img/logo_providence.jpg'>
									Accueil - Logiciels - Contact
									<br>
									&copy; tout droit reservé
									<br>
									<a href='index.php?p=mention' class='hover'>Mentions Légales</a>
								</div>
								<div class='dev'>
									<i class='fa fa-cogs  fa-2x' aria-hidden='true'></i> Développé par Jérémy Bourdon - Aurélien Boucher - François Duprez - Pierre-Baptiste Warnier
								</div>
								<div class='clear'></div>
							</div>
					</div>
				</body>";
			}	
			if(isset($_GET['p'])&&$_GET['p']=='mention')
			{
				echo"<div id='page'>
						<div class='mention'>
							<h3> Mentions Légales</h3>
								Merci de lire avec attentions les différentes modalités d’utilisation du présent site avant d’y parcourir ses pages. En vous connectant sur ce site, vous acceptez sans réserves les présentes modalités. Aussi, conformément de l’Article n°6 de la Loi n°2004-575 du 21 Juin 2004 pour la confiance dans l’économie numérique, les responsables du présent site internet <URL DU SITE ICI> sont :
								
								<h4>Editeur du Site :</h4>
								Nom : BOURDON, BOUCHER, WARNIER, DUPREZ<br>
								Prénom : Jérémy, Aurélien, Pierre-Baptiste, François<br>
								146 boulevard St Quentin – 80090 Amiens<br>
								Email : ftrepagne@la-providence.net<br>
								Site Web : <URL DU SITE ICI><br>
								
								<h4>Hébergement : </h4>
								Hébergeur : OVH<br>
								2 rue Kellermann – 59100 Roubaix – France<br>
								Site Web : https://www.ovh.com/fr/<br>
								
								<h4>Développement :</h4>
								BOURDON, BOUCHER, WARNIER, DUPREZ<br>
								Adresse : 146 boulevard St Quentin – 80090 Amiens
								Site Web : La Providence Section STS
						</div>
					</div>
					<div id='footer' style='position:absolute'>
								<div class='link'>
									<img src='assets/img/logo_providence.jpg'>
									Accueil - Logiciels - 
									<br>
									Latechnoalapro &copy; tout droit reservé
									<br>
									<a href='index.php?p=mention'>Mentions Légales</a>
								</div>
								<div class='dev'>
									<i class='fa fa-cogs  fa-2x' aria-hidden='true'></i> Développé par Jérémy Bourdon - Aurélien Boucher - François Duprez - Pierre-Baptiste Warnier
								</div>
								<div class='clear'></div>
							</div>	";
			}
			if(isset($_GET['p'])&& $_GET['p']=='cours')
			{
			page_class();
			if(isset($_GET['chap']))
			{
				$chapitre=$_GET['chap'];
			}
			echo"
			<body>
				<div id='page'>
					<center>
						<div class='slide'>
							<h3>$title</h3>
							<p class='sub'>Sélectionnez un chapitre pour voir le cours:</p>
							<div id='owl-demo' class='owl-carousel'>"; 
								select_chapitre();
						echo"</div>
						</div>
					</Center>
					<div class='intro'>
						<img src='assets/img/logo_help.png'>
						<div class='text'>$description</div>
					</div>
					<div class='download'>
							<h3><i class='fa fa-download' aria-hidden='true'></i> Fichiers Ressources :</h3>
							<hr color=#BA0D2A>";
							select_ressource();
						echo"</div>";
					if(isset($_GET['chap']))
					{
					echo"
						<div class='p_cours'style='margin-bottom:8%'>";
							select_l($chapitre);
							if(isset($_GET['id']))
							{
								$cours=$_GET['id'];
								select_cours($cours);
								echo"<center><iframe src='$pdf' width='90%' height='800VW'></iframe></center>";
							}
							else
							{
								echo"
						<center><iframe src='assets/ressource/pdf_cours/accueil.pdf' width='90%' height='800VW'></iframe></center>		
						";
							}
							echo"
							<div class='clear'></div>
						</div>	
						";
					}
					else
					{
						echo"
						<div class='p_cours' style='margin-bottom:8%'><center><iframe src='assets/ressource/pdf_cours/accueil.pdf' width='90%' height='800VW'></iframe></center>
			
							<div class='clear'></div>
						</div>	
						";
					}
					echo"<div id='footer' style='position:absolute'>
								<div class='link'>
									<img src='assets/img/logo_providence.jpg'>
									Accueil - Logiciels - Contact
									<br>
									&copy; tout droit reservé
									<br>
									<a href='index.php?p=mention'>Mentions Légales</a>
								</div>
								<div class='dev'>
									<i class='fa fa-cogs  fa-2x' aria-hidden='true'></i> Développé par Jérémy Bourdon - Aurélien Boucher - François Duprez - Pierre-Baptiste Warnier
								</div>
								<div class='clear'></div>
							</div>	";
				echo"</div>
			</body>
			";	
			}
			if(isset($_GET['p'])&& $_GET['p']=='contact')
			{
				
			
			}
			if(isset($_GET['p'])&& $_GET['p']=='logiciels')
			{
				echo"
			<body>
				<div id='page'>
					<div class='p_logiciel' style='margin-bottom:8%;'>
						<h3>Logiciels utlisés en cours : </h3>
						<div class='logiciel'>
							<h3><i class='fa fa-pencil aria-hidden='true'></i> Google Sketchup</h3>
							<img src='assets/img/sketchup.png'>
							Google SketchUp est un puissant logiciel de traitement d'images 3D. Plus précisément, le programme permet de concevoir, de visualiser, et bien entendu de modifier des images 3D. Il a été conçu pour être bien précis dans ses oeuvres, de l'esquisse au crayon à la vitesse et la flexibilité de l'application. De plus, il est doté d'une interface permettant l'exploration originale des images 3D.
							<div class='clear'></div>
							<center><a href='assets/ressource/logiciel/SketchUpMake-fr.exe' class='button-dl'>Téléchargement</a></center>	
							<br>		
						</div>
						<div class='logiciel'>
							<h3><i class='fa fa-pencil aria-hidden='true'></i> eDrawings</h3>
							<img src='assets/img/eDrawings.png'>
							Utilisez eDrawings ™ et Collaborez plus efficacement avec les différents intervenants du développement des produits grâce au logiciel Solidworks, premier outil de communication par courrier électronique qui facilite grandement le partage des données de conception de produit.<br>				
							<div class='clear'></div>		
							<center><a href='assets/ressource/logiciel/eDrawings.exe' class='button-dl'>Téléchargement</a></center>
							<br>
						</div>
						<div class='logiciel'>
							<h3><i class='fa fa-pencil aria-hidden='true'></i> Sweet Home 3D</h3>
							<img src='assets/img/sweethome.png'>
							Sweet Home 3D est un logiciel libre d'aménagement d'intérieue qui vous aide à dessiner le plan de votre maison, y placer vos meubles et visiter le résultat en 3D.</br>	
							<div class='clear'></div>		
							<center><a href='assets/ressource/logiciel/SweetHome3D.exe' class='button-dl'>Téléchargement</a></center>
							<br>
						</div>
						<div class='logiciel'>
							<h3><i class='fa fa-pencil aria-hidden='true'></i> Inkscape</h3>
							<img src='assets/img/logo_ink.png'>
						Inkscape est un logiciel de dessin vectoriel, c'est-à-dire un programme spécialement conçu pour l'édition ou la création de graphisme vectoriel. Il s'agit d'un logiciel libre, donc chaque utilisateur a la possibilité d'apporter des modifications s'il a la compétence pour cela. Il propose toute une panoplie d'outils. <br>
							<div class='clear'></div>		
							<center><a href='assets/ressource/logiciel/Inkscape.exe' class='button-dl'>Téléchargement</a></center>
							<br>
						</div>
					</div>
					<div id='footer' style='position:absolute;'>
								<div class='link'>
									<img src='assets/img/logo_providence.jpg'>
									Accueil - Logiciels - Contact
									<br>
									&copy; tout droit reservé
									<br>
									<a href='index.php?p=mention'>Mentions Légales</a>
								</div>
								<div class='dev'>
									<i class='fa fa-cogs  fa-2x' aria-hidden='true'></i> Développé par Jérémy Bourdon - Aurélien Boucher - François Duprez - Pierre-Baptiste Warnier
								</div>
								<div class='clear'></div>
							</div>	
				</div>

			</body>
			";	
			}
			if(isset($_GET['p'])&& $_GET['p']=='3 ème')
			{
				echo"
			<body>
				<div id='page'>
					<center>
						<div class='slide'>
							<h3>Le Projet Solaire</h3>
							<p class='sub'>Sélectionez un chapitre pour voir le cours:</p>
							<div id='owl-demo' class='owl-carousel'> 
							<a href='index.php?p=3 ème&cat=approb'><div class='item'><h1>Chapitre 1</h1></div></a>
							<a href='index.php?p=3 ème&cat=recherche'><div class='item'><h1>Chapitre 2</h1></div></a>
							<a href='index.php?p=3 ème&cat=modelisation'><div class='item'><h1>Chapitre 3</h1></div></a>
							<a href='index.php?p=3 ème&cat=conception'><div class='item'><h1>Chapitre 4</h1></div></a>
					</div>
						</div>
					</Center>
					<div class='intro'>
						<img src='assets/img/logo_help.png'>
						<div class='text'>L’enseignement en classe de troisième est articulé autour la mise en  œuvre d’un ou plusieurs projets collectifs qui doivent permettre à  chaque élève :<br>
						<br>- de mobiliser, à l’occasion de la gestion de ce(s) projet(s)  collectif(s), les connaissances et les capacités acquises dans les années précédentes ;
						<br>-d’acquérir de nouvelles connaissances et un plus grand degré d’autonomie ;
						<br>-d’élargir et de diversifier ses capacités en matière d’usage raisonné et autonome  des techniques de l’information et de la communication à l’occasion notamment de la production d’un média numérique associé au projet.</div>
					</div>";
					if(isset($_GET['cat']))
					{
						if(isset($_GET['cat'])&&$_GET['cat']=='approb')
						{
							echo"<div id='projet'>
									<h3>La voiture électrique </h3>
									<center><iframe src='assets/ressource/pdf_cours/frise_chrono.pdf' width='80%' height='600VW'></iframe></center>
									<h3>Tutoriel InKscape </h3>
									Dans un premier temps vous pouvez télecharger le logiciel google sketchup en cliquant <u><a href='assets/ressource/logiciel/Inkscape.exe'>ici</a></u>.<br>
									Voici ensuite deux vidéos tutoriels pour apprendre à utiliser se logiciel : <p>
									<center><iframe width='560' height='315' src='https://www.youtube.com/embed/Rz20DIvg3Yg' frameborder='0' allowfullscreen></iframe></center>
								</div>";
						}
						if(isset($_GET['cat'])&&$_GET['cat']=='modelisation')
						{
							echo"<div id='projet'
									<h3>Tutoriel Sketchup </h3>
									Dans un premier temps vous pouvez télecharger le logiciel google sketchup en cliquant <u><a href='assets/ressource/logiciel/SketchUpMake-fr.exe'>ici</a></u>.<br>
									Voici ensuite deux vidéos tutoriels pour apprendre à utiliser se logiciel : <p>
									<center>
										<iframe width='560' height='315' src='https://www.youtube.com/embed/JI37HK7Ol8A' frameborder='0' allowfullscreen></iframe>
										<iframe width='560' height='315' src='https://www.youtube.com/embed/vDjddjlcvsM' frameborder='0' allowfullscreen></iframe>
									</center>
									<h3> Fiche de montage Moto Réducteur </h3>
									<center><iframe src='assets/ressource/pdf_cours/MOTO-B.pdf' width='60%' height='800VW'></iframe></center>
								</div>";
						}
						if(isset($_GET['cat'])&&$_GET['cat']=='conception')
						{
							echo"<div id='projet'>
									<h3>Conception et Fabrication </h3>
									<center><iframe src='assets/ressource/pdf_cours/croquisT.pdf' width='60%' height='800VW'></iframe></center>
								</div>";
						}
						if(isset($_GET['cat'])&&$_GET['cat']=='recherche')
						{
							echo"<div id='projet'>
									<h3> Structuration Matériaux : </h3>
									<center><iframe src='assets/ressource/pdf_cours/structuration_matériaux_01.pdf' width='60%' height='800VW'></iframe></center>
									<h3> Panneaux Solaires : </h3>
									<center><iframe src='assets/ressource/pdf_cours/Ressource_panneau_soalaires_02.pdf' width='60%' height='800VW'></iframe></center>
									<center><iframe src='assets/ressource/pdf_cours/structuration_panneaux_solaires_03.pdf' width='60%' height='800VW'></iframe></center>
									<h3> Structuration Moteur </h3>
									<center><iframe src='assets/ressource/pdf_cours/Structuration_moteur_04.pdf' width='60%' height='800VW'></iframe></center>
								</div>";
						}
					}
					else
					{
						echo"<div id='projet'>
								<center><iframe src='assets/ressource/pdf_cours/error.pdf' width='60%' height='800VW'></iframe></center>
							</div>";
						
					}
			}
		close_bdd();	
	?>
<script>
   $(document).ready(function() {
 
  var owl = $("#owl-demo");
 
  owl.owlCarousel({
      items : 7, 
      itemsDesktop : [1000,5],
      itemsDesktopSmall : [700,3], 
      itemsTablet: [600,2], 
      itemsMobile : false
  });
});
    </script>
	<script type="text/javascript">
		$('.button1').click(function(){
			$('.show_present').slideToggle();
			$('.button1').toggleClass('rotate');	
			$('.more').toggleClass('visible');			
		});
		
		$('.button2').click(function(){
			$('.block_one').slideToggle();
			$('.block_two').slideToggle();
			$('.help').slideToggle();
			$('.button2').toggleClass('rotate');
			$('.more2').toggleClass('visible');				
		});
	</Script>


</html>
