<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: blue;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    include("baglanti.php");
    if(isset($_POST["olustur"]))
    {
        $indis=0;
        $kodlar=array();
        $sql="SELECT kod FROM baglantilar";
        $sorgu=mysqli_query($bagno,$sql);
        while($kodlarvt=mysqli_fetch_array($sorgu))
        {
            $kodlar[$indis]=$kodlarvt[0];
        }


        $yenikod=null;

        do {
            $yenikod = rand(100000, 999999);
        } while (in_array($yenikod, $kodlar));

        $sql="INSERT INTO baglantilar VALUES(null,\"$yenikod\",\"$_POST[url]\")";
        $sorgu=mysqli_query($bagno,$sql);

    }
    if(isset($_POST["bul"]))
    {
        header("Location:tespit.php?kod=$_POST[kod]");
    }
    ?>
    <h1>Tek kullanımlık kod oluşturma</h1>

    <form method="post" action="">
        <label for="url">Yönlendirelecek sayfanın URL'si:</label><br>
        <input type="text" id="url" name="url" placeholder="URL" required><br>
        <input type="submit" name="olustur" value="Yeni URL Oluştur">
    </form>

    <h1>Konum tespitini listele ve kaydı silme</h1>

    <form method="post" action="">
        <label for="kod">Konum Tespitini Listele:</label><br>
        <input type="text" id="kod" name="kod" placeholder="Verilen Kodu Giriniz" required><br>
        <input type="submit" name="bul" value="Konum Tespitlerini Listele">
    </form>

    <?php
    if(isset($yenikod))
    {
    echo "<h2>Kodunuz: $yenikod <br> Bağlantınız:http://localhost/yertespiti/p.php?h=$yenikod</h2>";
    }
    ?>
</body>
</html>
