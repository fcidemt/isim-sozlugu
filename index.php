<?php
  include 'sozluk.html';
  $host     = "localhost";
  $user     = "root";
  $password = "root";
  $database = "sozluk";
  $cnnMySQL = mysqli_connect( $host, $user, $password, $database );
  if( mysqli_connect_error() ) die("Veritabanına bağlanılamadı.");
  $temp = mysqli_query($cnnMySQL, "set names 'utf8'");

  if(isset($_POST["ad"])){
    $ad = mysqli_real_escape_string($cnnMySQL, $_POST["ad"]);
    $soyad = mysqli_real_escape_string($cnnMySQL, $_POST["soyad"]);
    $cinsiyet = mysqli_real_escape_string($cnnMySQL, $_POST["cinsiyet"]);
    $arrWhere = array();
    $arrWhere[] = 1;
    if($ad       <> "") $arrWhere[] = " ad LIKE '%$ad%' ";
    if($soyad    <> "") $arrWhere[] = " soyad LIKE '%$soyad%' ";
    if($cinsiyet <> "") $arrWhere[] = " cinsiyet LIKE '%$cinsiyet%' ";
    $SuzmeKosulu = implode(" AND ", $arrWhere);
    $SQL = "SELECT * FROM isim_sozlugu WHERE $SuzmeKosulu";

    $rows = mysqli_query($cnnMySQL, $SQL);
    $RowCount = mysqli_num_rows($rows);
    if($RowCount == 0) {
      echo "<p>Kayıt bulunamadı.</p>";
    } else {
      echo "<p>$RowCount adet Kayıt bulundu.</p>";
      echo "<table border=1 align=center>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Ad</th>";
      echo "<th>Soyad</th>";
      echo "<th>Cinsiyet</th>";
      echo "</tr>";
      $c=0;
      while($row = mysqli_fetch_assoc($rows)) {
        extract($row);
        $c++;
        echo "<tr><td>$c</td><td>$ad</td><td>$soyad</td><td>$cinsiyet</td></tr><br>";
      }
      echo "</table>";
    }
  }

?>
