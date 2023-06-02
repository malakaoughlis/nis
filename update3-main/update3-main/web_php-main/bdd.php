<?php

	  
//db config
$servername="localhost";
$username="root";
$password="";
$dbname="h20_helper";

//connexion
$lien=mysqli_connect($servername,$username,$password,$dbname);

//verifier la connexion 
if(mysqli_connect_error())
{
  echo"La connexion a echoue ! <br>" ;
}


//form de la BDD
if(isset($_POST['bdd']))
{
  $sql="SELECT * FROM marque_eau";
  $result = $lien->query($sql);

    // Vérifier si des résultats ont été trouvés
    if ($result->num_rows > 0) {
      // Afficher les instances
      while ($row = $result->fetch_assoc()) {
          // Afficher les données de chaque instance
          echo "Nom : " . $row['Nom'] . "<br>";
          echo "Disponibilite des litres : " . $row['Disponibilite'] . "<br>";
          echo "Potassium : " . $row['Potassium'] . "<br>";
          echo "Calcium : " . $row['Calcium'] . "<br>";
          echo "Magnesium : " . $row['Magnesium'] . "<br>";
          echo "Sodium : " . $row['Sodium'] . "<br>";
          echo "Bicarbonate : " . $row['Bicarbonate'] . "<br>";
          echo "Sulfates : " . $row['Sulfates'] . "<br>";
          echo "Chlorure : " . $row['Chlorure'] . "<br>";
          echo "Nitrate : " . $row['Nitrate'] . "<br>";
          echo "Nitrite : " . $row['Nitrite'] . "<br>";
          echo "PH : " . $row['PH'] . "<br>";
          echo "<br>";
          echo "<br>";
      }
      echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  } else {
      echo "Aucun résultat trouvé.";
      echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }
  
}




//form de composants d'une marque
if(isset($_POST['reseignements']))
{
  $marqueau=$_POST['reseign'];
  $sql="SELECT * FROM marque_eau WHERE Nom='$marqueau'";
  $result = $lien->query($sql);

  // Vérifier si des résultats ont été trouvés
  if ($result->num_rows > 0) {
    // Afficher les instances
    while ($row = $result->fetch_assoc()) {
        // Afficher les données de chaque instance
        echo "Nom : " . $row['Nom'] . "<br>";
        echo "Potassium : " . $row['Potassium'] . "<br>";
        echo "Calcium : " . $row['Calcium'] . "<br>";
        echo "Magnesium : " . $row['Magnesium'] . "<br>";
        echo "Sodium : " . $row['Sodium'] . "<br>";
        echo "Bicarbonate : " . $row['Bicarbonate'] . "<br>";
        echo "Sulfates : " . $row['Sulfates'] . "<br>";
        echo "Chlorure : " . $row['Chlorure'] . "<br>";
        echo "Nitrate : " . $row['Nitrate'] . "<br>";
        echo "Nitrite : " . $row['Nitrite'] . "<br>";
        echo "PH : " . $row['PH'] . "<br>";
    }
     echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
} else {
    echo "Aucun résultat trouvé.";
    echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
}
}




//form pour l'equivalent d'une marque
if(isset($_POST['compare']))
{
  // Récupérer les données
  $marque = $_POST['equiva'];
  $composant = $_POST['choix'];
  $composantc = (string)$composant;

  // Vérifier si la marque d'eau existe dans la base de données
  $checkMarque = "SELECT * FROM marque_eau WHERE Nom = '$marque'";
  $checkMarqueResult = $lien->query($checkMarque);

  if ($checkMarqueResult->num_rows > 0) {
    // La marque d'eau existe dans la base de données, requête SQL pour trouver l'eau la plus proche
    $sql = "SELECT * FROM marque_eau WHERE Nom NOT LIKE '$marque' ORDER BY ABS(marque_eau.$composantc - $composant) ASC LIMIT 1";
    $result = $lien->query($sql);

    // Vérifier si un résultat a été trouvé
    if ($result->num_rows > 0) {
      // Afficher les détails de l'eau la plus proche
      while ($row = $result->fetch_assoc()) {
        echo "Nom de la marque d'eau minérale équivalente : " . $row['Nom'] . "<br>";
      }
    } 
    else {
      echo "Aucun résultat trouvé pour l'équivalent de cette marque d'eau.";
    }

    echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  } 
  else {
    echo "Désolé, cette marque n'existe pas dans notre base de données.";
    echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }
}



  //partie +
// Formulaire pour rechercher la valeur la plus élevée du composant
if (isset($_POST['recherche+'])) {
  $attribut = $_POST['choix+'];
  $inputString = (string)$attribut;

  // Exécuter la requête pour trouver la bouteille avec la valeur la plus élevée du composant sélectionné
  $sql = "SELECT Nom FROM marque_eau WHERE $attribut = (SELECT MAX($attribut) FROM marque_eau)";
  $resultat = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($resultat->num_rows > 0) {
      // Afficher le nom de la bouteille avec la valeur la plus élevée du composant
      while ($ligne = $resultat->fetch_assoc()) {
          echo "Nom de la bouteille contenant la valeur la plus élevée du composant sélectionné : " . $ligne['Nom'] . "<br>";
      }
  } else {
      echo "Aucun résultat trouvé.";
  }
}









  // Exécuter la requête pour trouver l'eau avec l'attribut choisi ayant la valeur la plus élevée
  //$sql = "SELECT * FROM marque_eau WHERE $attribut = '$attribut'" ;
  //ORDER BY  DESC LIMIT 1"
 /* $result = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($result->num_rows >0) {
      // Afficher les détails de l'eau ayant l'attribut choisi avec la valeur la plus élevée
      while ($row = $result->fetch_assoc()) {
          echo "Nom : " . $row['Nom'] . "<br>";
        
      }
    }
    echo " <br> <a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }*/







//partie -
// Formulaire pour rechercher la valeur la plus élevée du composant
if (isset($_POST['recherche-'])) {
  $attribut = $_POST['choix-'];
  $inputString = (string)$attribut;

  // Exécuter la requête pour trouver la bouteille avec la valeur la plus élevée du composant sélectionné
  $sql = "SELECT Nom FROM marque_eau WHERE $attribut = (SELECT MIN($attribut) FROM marque_eau)";
  $resultat = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($resultat->num_rows > 0) {
      // Afficher le nom de la bouteille avec la valeur la plus élevée du composant
      while ($ligne = $resultat->fetch_assoc()) {
          echo "Nom de la bouteille contenant la valeur la plus faible du composant sélectionné : " . $ligne['Nom'] . "<br>";
      }
  } else {
      echo "Aucun résultat trouvé.";
  }
}











  //partie -
/*if(isset($_POST['recherche-'])){
  $attribut = $_POST['choix-'];
  $inputString = (string) $attribut;

  // Exécuter la requête pour trouver l'eau avec l'attribut choisi ayant la valeur la plus élevée
  $sql = "SELECT * FROM EAU WHERE $inputString = '$attribut' ORDER BY valeur ASC DESC LIMIT 1";
  $result = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($result->num_rows ==1) {
      // Afficher les détails de l'eau ayant l'attribut choisi avec la valeur la plus élevée
      while ($row = $result->fetch_assoc()) {
          echo "Nom : " . $row['nom'] . "<br>";
        
      }
    }
    echo " <br> <a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }*/


  
// Fermer la connexion à la base de données
$lien->close();


?>