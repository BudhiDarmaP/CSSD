<footer class="w3-padding-16 w3-green w3-center w3-margin-top w3-margin-bottom">
    <a href="https://www.usd.ac.id/" target="_blank" class="w3-opacity-min w3-hover-opacity-off"><img src="<?php echo base_url('images/USD.png') ?>"></a>
    <br><b class="w3-text-black">Universitas Sanata Dharma, DI Yogyakarta</b>
    <br>Powered by : <a title="" target="_blank" class="w3-hover-text-black">Imam Dwicahya & I Putu Budi Dharma P.</a>
    <br class="w3-large"><b>© 2017</b>
</footer>
<script>
    function myFunction() {
        var navbar = document.getElementById("myNavbar");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            navbar.className = "w3-bar" + " w3-card-2" + " w3-animate-top" + " w3-white";
        } else {
            navbar.className = navbar.className.replace(" w3-card-2 w3-animate-top w3-white", "");
        }
    }
    function toggleFunction() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it

    modal2.style.display = "block";
    window.onclick = function (event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
</script>
</body>
</html>
