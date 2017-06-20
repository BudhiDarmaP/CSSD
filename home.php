<%@page import="Model.CatatanBus"%>
<%@page import="Model.Pegawai"%>
<!DOCTYPE html>
<html>
    <title>Halaman Utama</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="Css/Login.css" rel="stylesheet" type="text/css" />
    <link href="./Gambar/logoBUS.png" rel="icon" type="image/png"/>
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
        body, html {
            height: 0%;
            color: #777;
            line-height: 1.8;
        }

        /* Create a Parallax Effect */
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* First image (Logo. Full height) */
        .bgimg-1 {
            background-image: url('Gambar/Rute TransJogja.png');
            min-height: 100%;
        }

        /* Second image (Portfolio) */
        .bgimg-2 {
            background-image: url("Gambar/RSUD.jpg");
            min-height: 400px;
        }

        /* Third image (Contact) */
        .bgimg-3 {
            background-image: url("");
            min-height: 400px;
        }

        .w3-wide {letter-spacing: 10px;}
        .w3-hover-opacity {cursor: pointer;}

        /* Turn off parallax scrolling for tablets and phones */
        @media only screen and (max-device-width: 1024px) {
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: scroll;
            }
        }
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div class="w3-bar w3-card w3-white" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="home.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i>HOME</a>
                <a href="InformasiBus.jsp" class="w3-bar-item w3-button w3-hide-small">INSTRUMEN</a>
                <a href="RuteBus.jsp" class="w3-bar-item w3-button w3-hide-small">PEMINJAMAN</a>
                <a href="RuteBus.jsp" class="w3-bar-item w3-button w3-hide-small">LAPORAN</a>
                <a href="./LogoutControl" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-green"><i class="fa fa-sign-out"></i> KELUAR</a>
            </div>
            <div id="id01" class="modal w3-responsive">

                <form class="modal-content animate" action="./LoginControl">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                        <img src="Gambar/LOGOrsud.png" alt="Avatar" class="avatar">
                    </div>

                    <div class="container">
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>

                        <button type="submit" name="login" value="Login">Login</button>
                        <input type="hidden" name="statusLogin" value="login">
                        <!--<input type="checkbox" checked="checked"> Remember me-->
                    </div>
                </form>
            </div>

            <div id="navDemo" class="w3-bar-block w3-white w3-card w3-hide w3-hide-large w3-hide-medium">
                <a href="InformasiBus.jsp" class="w3-bar-item w3-button" onclick="toggleFunction()">INSTRUMEN</a>
                <a href="RuteBus.jsp" class="w3-bar-item w3-button" onclick="toggleFunction()">RUTE BUS</a>
                <a href="./LogoutControl" class="w3-bar-item w3-button">KELUAR</a>
            </div>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <!-- Container (About Section) -->
        <div class="w3-content w3-container w3-center" id="about">
            
                <img src="Gambar/LOGOrsud.png" class="w3-center w3-margin-bottom">
                
        </div>



        <!-- Second Parallax Image with Portfolio Text -->
        <div class="bgimg-2 w3-display-container w3-opacity-min">
            
            <div class="w3-display-middle w3-center w3-black w3-opacity">
                
                <span class="w3-xxxlarge w3-text-white w3-wide">CSSD</span><br>
                <span class="w3-xxlarge w3-text-white w3-wide">Central Sterile Supply Department</span>
            </div>
        </div>

        <footer class="w3-center w3-green w3-margin-bottom">
            <div class="w3-section w3-padding-small"></div>
            <div class="w3-xlarge w3-section">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-snapchat w3-hover-opacity"></i>
                <i class="fa fa-pinterest-p w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i>
            </div>
            <p>Powered by <a title="" target="_blank" class="w3-hover-text-black">CSSD RSUD Karangasem</a></p>
            <div class="w3-section w3-padding-small"></div>
        </footer>


        <!-- Add Google Maps -->
        <script>
            
            function myMap()
            {
                myCenter = new google.maps.LatLng(41.878114, -87.629798);
                var mapOptions = {
                    center: myCenter,
                    zoom: 12, scrollwheel: false, draggable: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

                var marker = new google.maps.Marker({
                    position: myCenter
                });
                marker.setMap(map);
            }

            // Modal Image Gallery
            function onClick(element) {
                document.getElementById("img01").src = element.src;
                document.getElementById("modal01").style.display = "block";
                var captionText = document.getElementById("caption");
                captionText.innerHTML = element.alt;
            }

            // Change style of navbar on scroll
            //            window.onscroll = function() {
            //                myFunction()
            //            };
            function myFunction() {
                var navbar = document.getElementById("myNavbar");
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    navbar.className = "w3-bar" + " w3-card-2" + " w3-animate-top" + " w3-white";
                } else {
                    navbar.className = navbar.className.replace(" w3-card-2 w3-animate-top w3-white", "");
                }
            }

            // Used to toggle the menu on small screens when clicking on the menu button
            function toggleFunction() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
        <!--
        To use this code on your website, get a free API key from Google.
        Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
        -->
        <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
            var modal2 = document.getElementById('id02');

            // When the user clicks anywhere outside of the modal, close it
            
            modal2.style.display = "none";
                
            
        </script>
    </body>
</html>
