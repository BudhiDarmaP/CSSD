var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {
        myIndex = 1
    }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 4000);
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("rpl-show") == -1) {
        x.className += " rpl-show";
    } else {
        x.className = x.className.replace(" rpl-show", "");
    }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {
        myIndex = 1
    }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 4000);
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("rpl-show") == -1) {
        x.className += " rpl-show";
    } else {
        x.className = x.className.replace(" rpl-show", "");
    }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function removeElement(accessKey) {
    if (accessKey == '2') {
        document.getElementById("riwayat2").style.display = "none";
    } else {
        document.getElementById("riwayat").style.display = "none";
    }
}

function resetElement(accessKey) {
    if (accessKey == '2') {
        document.getElementById("riwayat2").style.display = "block";
    } else {
        document.getElementById("riwayat").style.display = "block";
    }
}

function validasi_input(form) {
    var maxcar = 4;
    if (form.username.value.length > maxcar) {
        alert("Panjang Username Maximal 4 Karater!");
        form.username.focus();
        return (false);
    }
    return (true);
}

