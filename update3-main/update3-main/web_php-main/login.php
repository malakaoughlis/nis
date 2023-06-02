<?php
  
//db config
$servername="localhost";
$username="root";
$password="";
$dbname="h20_helper";
/*if (file_exists('conx.php')) 
{
	require 'conx.php';
}
else {
	echo "File not found";
	die();
}*/
  //connexion
 $lien=mysqli_connect($servername,$username,$password,$dbname);

  //verifier la connexion 
  if(!mysqli_connect_error())
  {
    echo"La connexion a echoue ! <br>" ;
  }

  setcookie('malak', $session_id, time() + 3600);


  //connexion a un compte existant

if (isset($_POST['check'])) //verifier que les checkbox sont bien check
 {  
  $choix = $_POST['check']; //user ou fournisseur ?

  //utilisateur
 if ($choix == 'utilisateur') {
	
	$email_u=$_POST['mail'];

	$password_u = $_POST['pass'];
	$sql = "SELECT * FROM utilisateur WHERE email_u = '$email_u'";
	$result = $lien->query($sql);

	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM utilisateur WHERE email_u='$email_u' AND mot_passe_u='$password_u'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) >0) {
			    // redirection  
				session_start(); 
				$sessionid = session_id();
            $_SESSION['malak'] = $sessionid;
				//$sessionid = $_SESSION['malak'];
			    header("Location: +compte.php?email_u=$email_u");
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			//mysqli_close($lien); //ferme le flux de connexion
	    }
	 else {
		// L'e-mail n'existe pas
		header('Location: user.html');
	     }
	
} //fournisseur
else if ($choix == 'fournisseur') {

	$email_f=$_POST['mail'];
	$password_f = $_POST['pass'];

	$sql = "SELECT * FROM fournisseur WHERE email_f = '$email_f'";
	$result = $lien->query($sql);
	
	$stmt = $lien->prepare($sql);



	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM fournisseur WHERE email_f='$email_f' AND mot_passe_f='$password_f'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) >0) {
			    // redirection  
				session_start(); 
				$sessionid = $_SESSION['malak'];
			    header("Location: fourn2.php?email_f=$email_f");
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			//mysqli_close($lien); //ferme le flux de connexion
	    }

		
	 else {
		// L'e-mail n'existe pas
		header('Location: fournisseur.html');
	     }
}

}
else{
	 header('Location: index.html');
}




//partie creation de compte

//user
if (isset($_POST['user'])) {
	// recuperer les donnees
	$nom_u=$_POST["nom_u"];
	$prenom_u=$_POST["prenom_u"];
	$mail_u=$_POST["email_u"];
	$mdp_u=$_POST["password_u"];
	$pwd_hash= password_hash($mdp,PASSWORD_DEFAULT);
	$dn_u=$_POST["date_naissance_u"];
	$poids_u=$_POST["poids_u"];
	$taille_u=$_POST["taille_u"];
	$imc_u=(($poids_u -20)*15+1500)/1000;
	

	// insert into BDD
	$sql = "INSERT INTO utilisateur (nom_u, prenom_u, email_u, mot_passe_u, poids_u, taille_u) VALUES ('$nom_u', '$prenom_u', '$mail_u', '$pwd_hash', '$poids_u', '$taille_u')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		session_start(); 
		$sessionid = $_SESSION['malak'];
		header("Location: +compte.php?email_u=$email_u");
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
		
	}
	mysqli_close($lien); //fermer le flux de connexion
}
else{
	//header('Location: user.html');
}

//fournisseur
if (isset($_POST['fournisseur'])) {
	// recuperer les donnees
	$nom_f=$_POST["nom_f"];
	$prenom_f=$_POST["prenom_f"];
	$email_f=$_POST["email_f"];
	$mdp_f=$_POST["password_f"];
	$pwd_hash2= password_hash($mdp_f,PASSWORD_DEFAULT);
	$dn_f=$_POST["date_naissance_f"];
	$wilaya_f=$_POST["wilaya_f"];
    
	// insert into BDD
	$sql = "INSERT INTO fournisseur (nom_f, prenom_f, email_f, mot_passe_f, wilaya_f) VALUES ('$nom_f', '$prenom_f', '$email_f', '$pwd_hash2', '$wilaya_f')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		session_start(); 
		$sessionid = $_SESSION['malak'];
		// Utilisez la fonction urlencode pour encoder correctement les valeurs des variables
$nom_f_enc = urlencode($nom_f);
$email_f_enc = urlencode($email_f);

// Redirection vers le deuxième fichier PHP en incluant les données encodées dans l'URL
header("Location: fourn2.php?nom_f=$nom_f_enc&email_f=$email_f_enc");
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
		
	}
	//mysqli_close($lien); //fermer le flux de connexion
}
else{
	//header('Location: fournisseur.html');
}





//logout
if (isset($_POST['logout_u'])) {
	session_destroy();
	header('Location: index.html');
	exit();

}

if (isset($_POST['logout_f'])) {
	session_destroy();
	header('Location: index.html');
	exit();
}


//bouton ajouter
if(isset($_POST['ajt_marques_f']))
{
 
  header('Location: ajteau.html');
  exit;
}


//ajouter une eau pour un fournisseur
if (isset($_POST['ajouteau'])) {
	
	session_start(); 
	$sessionid = $_SESSION['malak'];
	$session_id = $sessionid;
header('Location: fourn2.php?variable=' . $session_id);

$nom_e=$_POST['nom_e'];
$logo=$_POST['logo'];
$disponibilite=$_POST['litre'];
$potassium=$_POST['potassium'];
$calcium=$_POST['calcium'];
$magnesium=$_POST['magnesium'];
$sodium=$_POST['sodium'];
$bicarbonate=$_POST['bicarbonate'];
$sulfates=$_POST['sulfates'];
$chlorure=$_POST['chlorure'];
$nitrate=$_POST['nitrate'];
$nitrite=$_POST['nitrite'];
$ph=$_POST['ph'];
$ef=$_POST['m_f'];

$stmt = $lien->prepare("SELECT IDF FROM fournisseur WHERE email_f = ?");
$stmt->bind_param("s", $ef);
$stmt->execute();
$result = $stmt->get_result();
$idf = $result->fetch_assoc()['IDF'];


		// insert into BDD
		$sql = "INSERT INTO marque_eau (IDF,Nom,Logo,Disponibilite,Potassium,Calcium,Magnesium,Sodium,Bicarbonate,Sulfates,Chlorure,Nitrate,Nitrite,PH) VALUES ('$idf','$nom_e', '$logo', '$disponibilite', '$potassium', '$calcium', '$magnesium', '$sodium', '$bicarbonate', '$sulfates', '$chlorure', '$nitrate', '$nitrite', '$ph')";
		if (mysqli_query($lien, $sql)) {
			// redirection
			
			header("Location: fourn2.php?email_f=$ef");

			exit();}
		 else {
			echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
			header('Location: ajteau.html');
		}
}

mysqli_close($lien); //ferme le flux de connexion
?>
