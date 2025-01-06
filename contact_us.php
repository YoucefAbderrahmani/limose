<?php

require 'connection.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Contact-us</title>
    <link rel="shortcut icon" href="assets\images\Limose-removebg-preview.png">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/plugins/slider/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- ################# Header Starts Here#######################--->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 left-item">
                        <ul>
                            <li><i class="fas fa-envelope-square"></i> Limoselaboratory@smartypes.com</li>
                            <li><i class="fas fa-phone-square"></i> +213 982308080</li>
                        </ul>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block right-item">
                        <ul>
                            <li><a><i class="fab fa-twitter"></i></a></li>
                            <li> <a><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12 nav-img">
                        <img src="assets\images\photo_2024-04-02_23-11-52.jpg" alt="">
                       <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                    </div>
                    <div id="menu" class="col-md-9 d-none d-md-block nav-item">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about_us.php">About Us</a></li>
                            <li><a href="cources.php">Cources</a></li>
                            <li><a href="event.php">Event</a></li>
                            <li><a href="team.php">teams</a></li>
                            <li><a href="contact_us.php">Contact Us</a></li>
                            <?php if(empty($_SESSION["id"])){?>
                                <div class="input-box">
                                <a href="login.php" ><input type="submit" class="input-submit"
                                        value="SIGN IN">&nbsp;</a>
                                &nbsp;<a href="singup.php" ><input type="submit" class="input-submit"
                                        value="SIGN UP"></a>
                            </div>

                            <?php }else{?>
                                <div class="input-box">
                                <a href="logout.php" ><input type="submit" class="input-submito"
                                        value="LOG OUT">&nbsp;</a>
                                &nbsp;<a href="updateinformation.php" ><input type="submit" class="input-submit"
                                        value="UPDATE"></a>
                            </div>
                            <?php } ?>
                            
                                
            
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </header>
    


    <!--  ************************* Page Title Starts Here ************************** -->
    <div class="page-nav no-margin row">
        <div class="container">
            <div class="row">
                <h2>About Limose Laboratory</h2>
                <ul>
                    <li> <a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><i class="fas fa-angle-double-right"></i> About Us</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ######## Page  Title End ####### -->    

     <div style="margin-top:0px;" class="row no-margin"> 
        
        
        <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2543.1346035312627!2d3.4704000770446526!3d36.752469703648586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e688d16851b83%3A0xd9b6c88acb9517ba!2sUniversit%C3%A9%20M&#39;hamed%20Bougara%20-%20Facult%C3%A9%20des%20sciences!5e0!3m2!1sfr!2sdz!4v1712195327824!5m2!1sfr!2sdz"  height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


      </div>

      <?php
// Inclure le fichier de connexion à la base de données
require 'connection.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises depuis le formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['ph'];
    $message = $_POST['msg'];

    // Préparer la requête SQL d'insertion
    $sql = "INSERT INTO contact (name, mail, ph, msg) VALUES (?, ?, ?, ?)";
    
    // Préparer la déclaration
    $stmt = mysqli_stmt_init($conn);
    
    // Vérifier si la déclaration est prête
    if(mysqli_stmt_prepare($stmt, $sql)) {
        // Lier les variables à la déclaration comme paramètres
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $message);
        
        // Exécuter la déclaration
        mysqli_stmt_execute($stmt);
        
        // Vérifier si l'insertion a réussi
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script type="text/javascript">';
            echo 'Swal.fire({
                title: "Good job!",
                text: "Votre Message a été Envoiée avec succès!",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "contact_us.php";
                }
            });';
            echo '</script>';
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement des informations.";
        }
    } else {
        echo "Erreur: Impossible de préparer la requête.";
    }
    
    // Fermer la déclaration
    mysqli_stmt_close($stmt);
}

// Fermer la connexion à la base de données (dans connection.php)
mysqli_close($conn);
?>


      <div class="row contact-rooo no-margin">
        <div class="container">
           <div class="row">
               
          
            <div style="padding:20px" class="col-sm-6">
            <h2 style="font-size:18px">Contact Form</h2>
            <form method="post">
                <div class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Enter Name :</label></div>
                    <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="name" class="form-control input-sm"  ></div>
                </div>
                <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Email Address :</label></div>
                    <div class="col-sm-8"><input type="text" name="email" placeholder="Enter Email Address" class="form-control input-sm"  ></div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Mobile Number:</label></div>
                    <div class="col-sm-8"><input type="text" name="ph" placeholder="Enter Mobile Number" class="form-control input-sm"  ></div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label>Enter  Message:</label></div>
                    <div class="col-sm-8">
                      <textarea rows="5" name="msg" placeholder="Enter Your Message" class="form-control input-sm"></textarea>
                    </div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label></label></div>
                    <div class="col-sm-8">
                     <button class="btn btn-success btn-sm">Send Message</button>
                    </div>
                </div>
            </form>
            </div>
             <div class="col-sm-6">
                    
                  <div style="margin:50px" class="serv"> 
                
               
             
                              
              
          <h2 style="margin-top:10px;">Address</h2>

          Université Houari Boumedien - Faculté informatique <br>
    Bab Ezzouar<br>
    Algeria<br>
    Phone:&nbsp;+213 982308080<br>
    Email:&nbsp;infolimose@entreprisw.com<br>
    Website:&nbsp;www.Limose-Laboratory.com<br>

 
       
            
                
                
              
           </div>    
                
             
         </div>

            </div>
        </div>
        
      </div>





    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 about">
                    <h2>About Us</h2>
                    <p>Limose Laboratory is a company which is helps persones and groupes to make a searches and participates in many events  </p>

                    <div class="foot-address">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="addet">
                            Boumerdes Street
                            55 Road - Boumerdes (35000)
                            ALGERIA
                        </div>
                    </div>
                    <div class="foot-address">
                        <div class="icon">
                            <i class="far fa-envelope-open"></i>
                        </div>
                        <div class="addet">
                            infolimose@entreprisw.com <br>
                            Limoselaboratory@smartypes.com
                        </div>
                    </div>
                    <div class="foot-address">
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="addet">
                            +213 982308080 <br>
                            +213 108946310
                        </div>
                    </div>
                </div>
                

                <div class="col-md-3 glink">
                    <ul>
                    <li><a href="index.php"><i class="fas fa-angle-double-right"></i>Home</a></li>
                    <li><a href="about_us.php"><i class="fas fa-angle-double-right"></i>About Us</a></li>
                    <li><a href="cources.php"><i class="fas fa-angle-double-right"></i>Cources</a></li>
                    <li><a href="event.php"><i class="fas fa-angle-double-right"></i>Event</a></li>
                    <li><a href="team.php"><i class="fas fa-angle-double-right"></i>Teams</a></li>
                    <li><a href="contact_us.php"><i class="fas fa-angle-double-right"></i>Contact Us</a></li>
                  </ul>
                </div>
                
            </div>
        </div>
    </footer>

    <div class="copy">
        <div class="container">
            <a href="https://www.limoselaboratory.com/">2024 &copy; All Rights Reserved by LIMOSE LABORATORY</a>

            <span>
                
                <a><i class="fab fa-twitter"></i></a>
                <a><i class="fab fa-facebook-f"></i></a>
            </span>
        </div>

    </div>

</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/slider/js/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>


</html>
