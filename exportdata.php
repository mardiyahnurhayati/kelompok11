<?php
  $host   = "localhost"; // nama server
  $userdb = "root"; // user database
  $passdb = ""; //password database
  $namadb = "dbsekolah"; // nama database

  // koneksi ke MySQL
  $konek = mysql_connect($host, $userdb, $passdb);
  if(!$konek) die("Gagal dalam Koneksi ke MySQL");
  else {
    // memilih database
    mysql_select_db($namadb, $konek)
    
    //jika database tidak ditemukan
    or die("Database tidak ditemukan");
  }
    $query = "SELECT * FROM datasekolah";
    $sql = mysql_query($query, $konek);
    $jumlah_baris = mysql_num_rows($sql);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="dist/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">

</script>
<script src="dist/semantic.min.js"></script>
  <!-- Standard Meta -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<!-- Site Properties -->
<title>Tabel</title>

<link rel="stylesheet" type="text/css" href="dist/components/reset.css">
<link rel="stylesheet" type="text/css" href="dist/components/site.css">

<link rel="stylesheet" type="text/css" href="dist/components/container.css">
<link rel="stylesheet" type="text/css" href="dist/components/grid.css">
<link rel="stylesheet" type="text/css" href="dist/components/header.css">
<link rel="stylesheet" type="text/css" href="dist/components/image.css">
<link rel="stylesheet" type="text/css" href="dist/components/menu.css">

<link rel="stylesheet" type="text/css" href="dist/components/divider.css">
<link rel="stylesheet" type="text/css" href="dist/components/list.css">
<link rel="stylesheet" type="text/css" href="dist/components/segment.css">
<link rel="stylesheet" type="text/css" href="dist/components/dropdown.css">
<link rel="stylesheet" type="text/css" href="dist/components/icon.css">

<script type="dist/semantic.min.js">$('.autumn.leaf').transition('fade');
</script>
</head>
<body style="background-color: #78536A;font-family: 'Roboto'">
<div class="ui container" style="margin-top: 15px">
  <div class="ui stackable menu" style="background-color: #E8A0CF">
    <a class="item" style="font-size: 18px;color: white">Home</a>
  </div>

<table class="ui selectable celled table">
  <thead>
      <tr class='center aligned'>
        <th>Nama</th>
        <th>Nps</th>
        <th>Bp</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($data = mysql_fetch_array ($sql)){
      $id = $data['id'];
       echo "    
              <tr>
      	        <td>".$data['nama']."</td>
      	        <td>".$data['nps']."</td>
      	        <td>".$data['bp']."</td>
      	        <td>".$data['status']."</td>        
              </tr> 
              ";              
      }?>
</tbody>
</table>
</div>
</body>
</html>