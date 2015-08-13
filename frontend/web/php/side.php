<?php
$idprov = "Kepulauan Riau";
$kota = 8;
$kec = 12;
$desa = 15;
$luas = 1000;
$geo = "sds";
$idkab = "Tanjungpinang";
$idkec ="Bukit Bestari";
$iddesa="Dompak";
$idint=0;
$imk = 0;
$idup1="display:none";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "podes_db";

$conn = mysql_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());

} 

mysql_select_db("podes_db");
/*$sql = "SELECT * FROM myguests";
$hasil = mysql_query($sql);

while($baris = mysql_fetch_row($hasil))
*/
function nbsp($x){
	for($i = 0; $i < $x; $i++) {echo "&nbsp;";}
	}



switch ($idprov) {
    case "Kepulauan Riau":
        $idup1="display:hide";
        break;
    case "Tanjungpinang":
        $idup2="display:hide";
        break;
    case "Dompak":
        $idup3="display:hide";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}

$klhsql = mysql_query("SELECT `R101`, `R101N`, `R102N`, `R103N`, `R104N`, `R404A`, `R501A1`, `R501A2`, `R501B`, `R503`, `R507A`
					FROM `kepri` WHERE `R104N`='KEMBOJA'")or die(mysql_error());
$klh = mysql_fetch_row ($klhsql); 

$pksql = mysql_query("SELECT `R101`, `R101N`, `R102N`, `R103N`, `R104N`,`R701A_K2`,`R701A_K3`,`R701B_K2`, `R701B_K3`, `R701C_K2`, `R701C_K3`, `R701D_K2`, `R701D_K3`, `R701E_K2`, `R701E_K3`, `R701F_K2`, `R701F_K3`, `R701G_K2`, `R701G_K3`, `R701H_K3`, `R701I_K3`,
					`R704A_K3`, `R704B_K3`, `R704C_K3`, `R704D_K3`, `R704E_K3`, `R704F_K3`, `R704G_K3`, `R704H_K3`, `R704I_K3`, `R704J_K3`, `R704K_K3`, `R704L_K3`,`R706A1`, `R706A2`, `R706B`, `R706C`, `R706D` 
					FROM `kepri` WHERE `R104N`='KEMBOJA'")or die(mysql_error());                
$pk = mysql_fetch_row($pksql);   

$esql = mysql_query("SELECT `R101`, `R101N`, `R102N`, `R103N`, `R104N`,`R1201A`, `R1201B`, `R1201C`, `R1201D`, `R1201E`, `R1201F`, `R1201G`, `R1201H`, `R1204A`, `R1204B`, `R1205`, `R1206`, `R1209`, `R1210`, `R1211`, `R1215A_K3`, `R1215B_K3`
		FROM `kepri` WHERE `R104N`='KEMBOJA'")or die(mysql_error());
$e = mysql_fetch_row ($esql);

$sbksql = mysql_query("SELECT `R101`, `R101N`, `R102N`, `R103N`, `R104N`,`R802`, `R803A`, `R803B`, `R803C`, `R803D`, `R803E`, `R803F`, `R803G`, `R803H`,
		`R1305`, `R1303B`, `R601A_K2`, `R601B_K2`, `R601C_K2`, `R601D_K2`, `R601E_K2`, `R601F_K2`, `R601G_K2`, `R601H_K2`, `R601I_K2`, `R601J_K2`
		FROM `kepri` WHERE `R104N`='KEMBOJA'")or die(mysql_error());
$sbk = mysql_fetch_row($sbksql);


	//for ($x = 0; $x < count($pk); $x++) {
    //echo $pk[$x];}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/3.3.5/dist/css/bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap/3.3.5/dist/js/bootstrap.min.js"></script>
<script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/highcharts-3d.js"></script>
<script src="highcharts/js/modules/exporting.js"></script>
<script src="highcharts/js/modules/data.js"></script>
<script> 
$(document).ready(function(){
    $("#upper").click(function(){
        $("#mid").animate({height:'toggle'});

    });
});
</script>

<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
		data: {
            csv: document.getElementById('csv').innerHTML
        },
      
            
        
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            
         
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
       
    });
});
</script>
	
<style>
#section {
	width:27%; 
	height: 100%; 
	border : 1px solid red; 
	float:left; 
	background-color:#C0C0BA;
	}

#upper {
	height :10%;
	background-color : aqua;
	
	}
h2 {margin-top: 0px;
	text-align : center;
	padding-top : 5px;
	}

.Tinfo {width:90%;
		margin-left:10px;
		margin-bottom:5px;
		}
		
#tdinfo {font-size:12px;
		padding-left:5px;
		padding-right:5px;
		}
#mid {
	height :25%;
	background-color:lightblue;
	}
	
#lower {
	height :500px;
	background-color:cream;
	}	
	
h3 {text-align:center;
	padding-bottom:5px;
	}
	
		
#tdtab	{padding-left:20px;
		 }
		 
#tdtabe	{padding-left:20px;
		padding-right:20px;
		}
</style>
</head>


	
<body> 

<div id="section">

	<div id="upper" style=<?php echo $idup1 ?>>
		<h2> <?php echo $idprov ?> </h2>
		<table class="Tinfo">
			<tr><td id="tdinfo">Jumlah Kota / Kabupaten : <span> <?php echo $kota ?></span></td>
				<td id="tdinfo">Luas Wilayah : <span><?php echo $luas ?> </span> km<sup>2</sup> </td>
			</tr>
			<tr><td id="tdinfo">Jumlah Kecamatan : <span><?php echo $kec ?></span></td>
				<td id="tdinfo">Georeferens : <span><?php echo $geo ?> </span></td>
			</tr>
			<tr><td id="tdinfo">Jumlah Desa / Kelurahan : <span><?php echo $desa ?></span></td>
			</tr>
		</table>
	</div>

	<div id="mid">
		<div id="container" style="height:250px"></div>
		<pre id="csv" style="display:none">
DAERAH, TK, SD, SMP 
KEPRI, 8, 10, 11


</pre>
	</div>

	<div id="lower"> 
		<div class="container" style="margin-left:-12px;">
			<ul class="nav nav-tabs nav-justified" style="width:31%; font-size:12px">
				<li class="active"><a data-toggle="tab" href="#klh">KLH<br><br>
					<!-- <br><span style="font-size: 7px">(Kependudukan & Lingkungan Hidup)</span>--></a></li>
				<li><a data-toggle="tab" href="#pk">Pendidikan & Kesehatan</a></li>
				<li><a data-toggle="tab" href="#e">Ekonomi <br><br></a></li>
				<li><a data-toggle="tab" href="#sbk">Sosbud & Keamanan</a></li>
			</ul>
		
		
			<div class="tab-content" style="width:29%; margin-left:10px">
				<div id="klh" class="tab-pane fade in active">
				<h3><u>Kependudukan & Lingkungan Hidup</u></h3>
				<table align="center">
					<tr><td>Jumlah Penduduk '(lk)'</td><td>:</td></tr>
					<tr><td>Jumlah Penduduk '(pr)'</td><td>:</td></tr>
					<tr><td>Jumlah Keluarga</td><td>:</td></tr>
					<tr><td>Jumlah Keluarga Pertanian</td><td>:</td></tr>
					<tr><td>Jumlah Kelahiran</td><td>:</td></tr>
					<tr><td>Sumber Penghasilan Utama</td><td>:<span><?php nbsp(2); echo $klh[5]; ?></span></td></tr>
					<tr><td>Jumlah Keluarga Pengguna Listrik</td><td>:<span><?php nbsp(2); echo $klh[6]+$klh[7]; ?></span></td></tr>
					<tr><td>Jumlah Keluarga Pengguna non Listrik <?php nbsp(2); ?></td><td>:<span><?php nbsp(2); echo $klh[8]; ?></span></td></tr>
					<tr><td>Bahan Bakar Memasak</td><td>:<span><?php nbsp(2); echo $klh[9]; ?></span></td></tr>
					<tr><td>Sumber Air Minum</td><td>:<span><?php nbsp(2); echo $klh[10]; ?></span></td></tr>
				</table>
				</div>
	

				<div id="pk" class="tab-pane fade">
				<h3><u>Sarana Pendidikan</u></h3>
				<table id="pkpendidikan" align="center">
					<tr><td>TK/RA/BA<?php nbsp(2); ?></td><td>:<span><?php nbsp(2); echo $pk[5]+$pk[6]; nbsp(6);?></span></td><td>Akademi/Perguruan Tinggi<?php nbsp(2); ?></td><td>:<span><?php nbsp(2); echo $pk[15]+$pk[16]; ?></span></td></tr> 
					<tr><td>SD/MI</td><td>:<span><?php nbsp(2); echo $pk[7]+$pk[8]; ?></span></td><td>Sekolah Luar Biasa</td><td>:<span><?php nbsp(2); echo $pk[17]; ?></span></td></tr> 
					<tr><td>SMP/MTs</td><td>:<span><?php nbsp(2); echo $pk[9]+$pk[10]; ?></span></td><td>Pondok Pesantren</td><td>:<span><?php nbsp(2); echo $pk[18]; ?></span></td></tr> 
					<tr><td>SMU/MA</td><td>:<span><?php nbsp(2); echo $pk[11]+$pk[12]; ?></span></td><td>Madrasah Diniyah</td><td>:<span><?php nbsp(2); echo $pk[20]; ?></span></td></tr> 
					<tr><td>SMK</td><td>:<span><?php nbsp(2); echo $pk[13]+$pk[14]; ?></span></td></tr> 
				</table>
				
				<h3><u>Sarana Kesehatan</u></h3>
				<table align="center">
					<tr><td>Rumah Sakit</td><td>:<span><?php nbsp(2); echo $pk[21]; nbsp(10) ?></span></td><td>Praktek Bidan</td><td>:<span><?php nbsp(2); echo $pk[28]; ?></span></td></tr> 
					<tr><td>RS Bersalin</td><td>:<span><?php nbsp(2); echo $pk[22]; ?></span></td><td>Poskesdes</td><td>:<span><?php nbsp(2); echo $pk[29]; ?></span></td></tr> 
					<tr><td>Puskesmas</td><td>:<span><?php nbsp(2); echo $pk[23]+$pk[24]+$pk[25]; ?></span></td><td>Polindes</td><td>:<span><?php nbsp(2); echo $pk[30]; ?></span></td></tr> 
					<tr><td>Poliklinik</td><td>:<span><?php nbsp(2); echo $pk[26]; ?></span></td><td>Posyandu</td><td>:<span><?php nbsp(2); echo $pk[31]; ?></span></td></tr> 
					<tr><td>Praktek Dokter</td><td>:<span><?php nbsp(2); echo $pk[27]; ?></span></td><td>Apotek</td><td>:<span><?php nbsp(2); echo $pk[32]; ?></span></td></tr> 
				</table>
				
				<h3><u>Tenaga Kesehatan</u></h3>
				<table align="center">
					<tr><td>Dokter&nbsp;&nbsp;</td><td>:<span><?php nbsp(2); echo $pk[33]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td>Dokter Gigi</td><td>:<span><?php nbsp(2); echo $pk[35]; ?></span></td></tr> 
					<tr><td>Bidan</td><td>:<span><?php nbsp(2); echo $pk[36]; ?></span></td><td>Tenaga Kesehatan Lainnya&nbsp;&nbsp;</td><td>:<span><?php nbsp(2); echo $pk[37]; ?></span></td></tr> 
				</table>
				</div>
   


				<div id="e" class="tab-pane fade">
				<h3><u>Ekonomi</u></h3>
				<table align = "center">
					<tr><td id="tdtabe">Industri Menengah Kecil <?php nbsp(2);?></td><td>:<span><?php nbsp(2); for ($x = 5; $x <= 12; $x++) {$imk += $e[$x];} echo $imk; $imk=0;  ?></span></td></tr>
					<tr><td id="tdtabe">Pasar</td><td>:<span><?php nbsp(2); echo $e[13]+$e[14]+$e[15]; ?></span></td></tr>
					<tr><td id="tdtabe">Minimarket</td><td>:<span><?php nbsp(2); echo $e[16]; ?></span></td></tr>
					<tr><td id="tdtabe">Restoran</td><td>:<span><?php nbsp(2); echo $e[17]; ?></span></td></tr>
					<tr><td id="tdtabe">Hotel</td><td>:<span><?php nbsp(2); echo $e[18]; ?></span></td></tr>
					<tr><td id="tdtabe">Penginapan</td><td>:<span><?php nbsp(2); echo $e[19]; ?></span></td></tr>
					<tr><td id="tdtabe">Bank Umum Pemerintah</td><td>:<span><?php nbsp(2); echo $e[20]; ?></span></td></tr>
					<tr><td id="tdtabe">Bank Umum Swasta</td><td>:<span><?php nbsp(2); echo $e[21]; ?></span></td></tr>
				</table>
				</div>
      
   
				<div id="sbk" class="tab-pane fade">
				<h3><u>Sosial Budaya & Keamanan</u></h3>
				<p>Mayoritas agama yang dianut : &nbsp;&nbsp; <?php echo $sbk[5]; ?> </p>
				<table>	
					<tr><td><u>Jumlah Tempat Ibadah</u></tr>
					<tr><td id="tdtab">Masjid</td><td>:<span><?php nbsp(4); echo $sbk[6]; ?></span></td></tr>
					<tr><td id="tdtab">Surau</td><td>:<span><?php nbsp(4); echo $sbk[7]; ?></span></td></tr>
					<tr><td id="tdtab">Gereja Kristen</td><td>:<span><?php nbsp(4); echo $sbk[8]; ?></span></td></tr>
					<tr><td id="tdtab">Gereja Katolik</td><td>:<span><?php nbsp(4); echo $sbk[9]; ?></span></td></tr>
					<tr><td id="tdtab">Kapel</td><td>:<span><?php nbsp(4); echo $sbk[10]; ?></span></td></tr>
					<tr><td id="tdtab">Pura</td><td>:<span><?php nbsp(4); echo $sbk[11]; ?></span></td></tr>
					<tr><td id="tdtab">Vihara</td><td>:<span><?php nbsp(4); echo $sbk[12]; ?></span></td></tr>
					<tr><td id="tdtab">Klenteng</td><td>:<span><?php nbsp(4); echo $sbk[13]; ?></span></td></tr>
					</table><br>
				<p>Jumlah Anggota linmmas/Hansip : <?php nbsp(2); echo $sbk[14]; ?></p>
				<p>Tindak Kejahatan yang Paling Sering Terjadi : </p>
				<?php echo $sbk[15]; ?></p>
				<p>Bencana Alam yang terjadi 3 Tahun Terakhir : </p>
				<?php echo $sbk[16],$sbk[25]; ?></p>
				</div>
			</div>
  
  
		</div>


	</div>








</div>

<select name="cars">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat" selected>Fiat</option>
<option value="audi">Audi</option>
</select>

<pre id="csvx">
<?php echo $sbk[4];
	echo $sbk[5];
	echo $sbk[6];
	?>
	</pre>

</body>
</html>












