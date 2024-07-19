<?php
include("baglanti.php");
$kod=$_GET["kod"];
$sql="SELECT COUNT(id) FROM baglantilar WHERE kod=$kod";
$sorgu= mysqli_query($bagno,$sql);
$kontrol=mysqli_fetch_array($sorgu);
if($kontrol[0]==0)
{
    header("Location=www.google.com");
}
else
{
    $sql="SELECT url FROM baglantilar WHERE kod=$kod";
    $sorgu=mysqli_query($bagno,$sql);
    $url=mysqli_fetch_array($sorgu);

    $sql="INSERT INTO tespitler VALUES(null,\"$_GET[enlem]\",\"$_GET[boylam]\",\"$_GET[kod]\")";
    $sorgu=mysqli_query($bagno,$sql);

    header("Location:".$url[0]);

}
?>