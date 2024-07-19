<!DOCTYPE html>
<html>
<head>
    <title>Enlem ve Boylam ile Konum Gösterme</title>
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>
    <?php
    include("baglanti.php");
if(isset($_POST["ok"]))
{
    $sql="DELETE FROM baglantilar WHERE kod=$_POST[kod]";
    $sorgu=mysqli_query($bagno,$sql);

    $sql="DELETE FROM tespitler WHERE kod=$_POST[kod]";
    $sorgu=mysqli_query($bagno,$sql);
    header("Location: index.php");
}

    $enlem = 41.0266; // Varsayılan enlem değeri
    $boylam = 41.0266; // Varsayılan boylam değeri

    $sql = "SELECT enlem, boylam FROM tespitler WHERE kod = '{$_GET['kod']}' AND id = (SELECT MAX(id) FROM tespitler where kod='{$_GET['kod']}')";
    $sorgu = mysqli_query($bagno, $sql);
    if ($sorgu) {
        if (mysqli_num_rows($sorgu) > 0) {
            $koordinatlar = mysqli_fetch_array($sorgu);
            $enlem = $koordinatlar[0];
            $boylam = $koordinatlar[1];
        }
    }
    ?>
    <h1>Konum Gösterme</h1>
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        function initMap() {
            var latitude = <?php echo $enlem; ?>; // Konumun enlemi
            var longitude = <?php echo $boylam; ?>; // Konumun boylamı

            var map = L.map('map').setView([latitude, longitude], 25);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Konum')
                .openPopup();
        }
        initMap();
    </script>
   <h1> Daha detaylı bilgi için Google Maps Üzerinden <br><br>
        <font color="red"><?php echo $enlem."<br><br>".
        $boylam;?></font> <br><br>
        koordinat bilgilerini aratınız lütfen</h1>
        </body>
        <form method="post" action="">
            <input type="hidden" value="<?php echo $_GET["kod"]; ?>" name="kod">
            <input type="submit" value="Kodu ve Kayıtları Sil" name="ok">
        </form>
</html>
