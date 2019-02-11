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

    if($ad != "" && $soyad != "" && $cinsiyet != ""){
      $SQL = "SELECT * FROM isim_sozlugu
            WHERE  ad LIKE '%$ad%' AND soyad LIKE '%$soyad%' AND cinsiyet LIKE '%$cinsiyet%'
            ORDER BY ad";
    }
    elseif($ad != "" && $soyad != ""){
      $SQL = "SELECT * FROM isim_sozlugu
          WHERE ad LIKE '%$ad%' AND soyad LIKE '%$soyad%'
          ORDER BY ad";
    }
    elseif($ad != "" && $cinsiyet != ""){
      $SQL = "SELECT * FROM isim_sozlugu
              WHERE ad LIKE '%$ad%' AND cinsiyet LIKE '%$cinsiyet%'
              ORDER BY ad";
    }
    elseif($soyad != "" && $cinsiyet != ""){
      $SQL = "SELECT * FROM isim_sozlugu
              WHERE soyad LIKE '%$soyad%' AND cinsiyet LIKE '%$cinsiyet%'
              ORDER BY ad";
    }
    elseif($ad != ""){
      $SQL = "SELECT * FROM isim_sozlugu
              WHERE ad LIKE '%$ad%'
              ORDER BY ad";
    }
    elseif($soyad != ""){
      $SQL = "SELECT * FROM isim_sozlugu
              WHERE soyad LIKE '%$soyad%'
              ORDER BY ad";
    }
    elseif($cinsiyet != ""){
      $SQL = "SELECT * FROM isim_sozlugu
              WHERE cinsiyet LIKE '%$cinsiyet%'
              ORDER BY ad";
    }
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
