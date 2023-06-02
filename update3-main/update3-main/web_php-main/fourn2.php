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

session_start(); 
//$sessionid = $_SESSION['session_id'];


?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>H20-helper</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- css du template -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- partie css -->
  <link href="assets/css/style.css" rel="stylesheet">
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link rel="stylesheet" href="assets/css/carte3.css" />

</head>

<body>

  
  <!--menu-->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/photo/3A7202EC-2136-45C5-BAA8-D0EA51EF4BB2.PNG" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">H20-helper</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="https://twitter.com/?lang=fr" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="https://fr-fr.facebook.com/" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="https://www.instagram.com/" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="https://www.skype.com/fr/" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="https://fr.linkedin.com/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Login</span></a></li>
        </ul>
        
      </nav>
    </div>
  </header>

  <!-- home -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>H20-helper</h1>
      <p><strong>QUE CHOISIR?</strong><br><br> <br>  <span class="typed" data-typed-items=", Ifri?, Guedilla?, Saida?, Lalla Khedija? "></span></p>
    </div>
  </section>
  

  <main id="main">

    

    <!-- login  -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
        
    
<?php

$email_f=$_GET['email_f'];
          

 $sql2= "SELECT nom_f,prenom_f FROM fournisseur WHERE email_f='$email_f'";
 $result2 = $lien->query($sql2);
 
 if ($result2->num_rows > 0) {
  if ($row = $result2->fetch_assoc()) {
      $nom_f = $row['nom_f'];
      $prenom_f = $row['prenom_f'];
      
      echo "<h2>Bonjour " . $nom_f . " " . $prenom_f . "</h2>";
  }
} else {
  echo "Aucun résultat trouvé.";}

?>
          <style>
            input[type="submite"] {
              background-color: #2196f3;
              color: white;
              margin-left: 350px;
              padding: 10px;
              border: none;
              border-radius: 10px;
              
            }
          </style>
            
        <h5><b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          La liste des marques que vous fournissez :</b></h5>

        </html>
       
        
            <?php
           
           $email_f=$_GET['email_f'];
           
   
           
            $sql="SELECT * FROM marque_eau WHERE IDF IN (SELECT IDF FROM fournisseur WHERE email_f = '$email_f')";
            $result = $lien->query($sql);

      // Vérifier si des résultats ont été trouvés
      if ($result->num_rows > 0) {
      // Parcourir chaque résultat et afficher le nom
      while ($row = $result->fetch_assoc()) {
        $nom = $row['Nom'];
        $litre = $row['Disponibilite'];
        echo " *Nom : " . $nom . "<br><br>";
        echo " *Disponibilite des litres : " . $litre . "<br><br><br><br>";
       }
      } else {
    echo "Aucun résultat trouvé.";
     } 
            ?>
             </html>

<br><br><br><br>
            <form action="login.php" method="POST">
              <h5> <b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                Voulez-vous ajouter une marque d'eau minerale que vous fournissez ? </b></h5>
                <br>
              <button type="submite" value="       Ajouter une marque" name="ajt_marques_f" > AJOUTER UNE MARQUE
              </button>
              <input type="hidden" name="m_f" value="<?php echo $email_f; ?>">
             



            </form>
              <br><br><br>
              <form action="login.php" method="POST">
              <h5> <b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                Deconnexion </b></h5>
              <button type="submite" value="              LOGOUT" name="logout_f" > LOGOUT
              </button>
               
            </form>
        
        </div>

    </section>

  </main>

  <!-- partie du bas dans le menu -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        ESST &nbsp;&nbsp;&nbsp;<strong><span>D.WEB</span></strong>
      </div>
      <div class="credits">
          <a href="https://malakchahinez.com/">H20-helper</a>
      </div>
    </div>
  </footer>

 
  <!-- animations javascript en + -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src=".assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/typed.js/typed.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- animation javascript -->
  <script src="../assets/javascript/main.js"></script>

</body>

</html>