<?php 
	class user_info
	{
		public $pseudo;
		public $nom;
		public $prenom;
		public $mail;
		public $date_creation;
		public $last_connexion;
		public $ip_connexion;
		public $user_level;
		public $user_avatar;
		public $id_account;
		
		
		public function select_user($login)
		{	
			$selectuser = mysql_query("SELECT `pseudo`,`nom`, `prenom`, `mail`, `date_creation`, `last_connexion`, `ip_connexion`, `user_level`, `user_avatar`, `id_account` FROM `account` WHERE pseudo ='".$_SESSION['login']."' ");		
			while ($req=mysql_fetch_array($selectuser))
			{
				$this->pseudo=$req[0];
				$this->nom=$req[1];
				$this->prenom=$req[2];
				$this->mail=$req[3];
				$this->date_creation=$req[4];
				$this->last_connexion=$req[5];
				$this->ip_creation=$req[6];
				$this->user_level=$req[7];
				$this->user_avatar=$req[8];
				$this->id_account=$req[9];
			}
		}
	}
?>