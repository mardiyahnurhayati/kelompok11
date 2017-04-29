<?php 
	require "excel_reader.php";
	require "koneksi.php";
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
<title>Export Excell</title>

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

<center><form method="post" enctype="multipart/form-data">
    
    <div class="ui inverted pink button">
    <input style="color: white" type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory=""><br><br>
	    <center><div class="ui checkbox">
		    <input type="checkbox" name="drop" value="1" >
		      <label style="color: white">
		        Kosongkan tabel terlebih dahulu
		      </label>
	    </div></center>
    </div><br><br>
    <input class="ui inverted pink button" type="submit" name="submit" style="color: white">
    
</form></center>
	<div style="color: white">		
  		<?php
  		if ($_SERVER['REQUEST_METHOD'] == 'POST')
  		{
	  		echo "<a href='exportdata.php?files=".serialize($_FILES['files']['name'])."' class='ui pink submit button'>Export Data</a>";
	  		?><br><br><?php
		    foreach ($_FILES['files']['name'] as $j => $name) 
		    {
		        if (strlen($_FILES['files']['name'][$j]) > 1) 
		        {
		            if (move_uploaded_file($_FILES['files']['tmp_name'][$j],$name)) 
		            {

		                chmod($_FILES['files']['name'][$j],0777);
				    
				    	$data = new Spreadsheet_Excel_Reader($_FILES['files']['name'][$j],$name,false);
				    	echo $name;
				    
						//menghitung jumlah baris file xls
				    	$baris = $data->rowcount($sheet_index=0);
				    	$drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
						   if($drop == 1)
						   {
							//kosongkan tabel sekolah
		 					$truncate ="TRUNCATE TABLE datasekolah";
							 mysql_query($truncate);
						   };
				    	?>

						<table class="ui selectable celled table">
						<thead>
					  		<tr class='center aligned'>
						  		<th>Nama</th>
						  		<th>Nps</th>
						  		<th>Bp</th>
						  		<th>Status</th>
					  		</tr>
					  	</thead>
					  	<tbody>";
						
						<?php    
						//import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
					    $baris = $data->rowcount($sheet_index=0);
					    for ($i=2; $i<=$baris; $i++)
					    {
							//membaca data (kolom ke-1 sd terakhir)
				      
					      $nama 		= $data->val($i, 1,0);
					      $nps 			= $data->val($i, 2,0);
					      $bp 			= $data->val($i, 3,0);
					      $status 		= $data->val($i, 4,0);
					      echo "<tr>
							<td>".$nama."</td>
		  					<td>".$nps."</td>
		  					<td>".$bp."</td>
		  					<td>".$status."</td>
							</tr>";
					     $query = "INSERT into datasekolah (
										nama,
										nps,
										bp,
										status)values('$nama','$nps','$bp','$status')";
							$hasil = mysql_query($query);
							//setelah data dibaca, masukkan ke tabel sekolah sql
				    	}

			  	echo "</tbody>
					</table>";
				    }
				}
			}								    
		}?>
	</div>
</div>
</body>
</html>