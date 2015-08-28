var layerPopup; //popup
var map; //variabel untuk menampung peta
var kodewilayah;
var serie;
var indexTahun=0;
var jlhKelas = 4;
var metode = ['natural breaks','equal intervals','standard deviation','arithmetic progression','geometric progression','quantiles'];
var noMetode = 0;
//warna
var noWarna = 0;
var warnaa = new Array();
var warnab = new Array();
var kelasWarna = new Array();
kelasWarna[9]=[8,7,6,5,4,3,2,1,0];
kelasWarna[8]=[8,7,6,5,4,3,2,1];
kelasWarna[7]=[7,6,5,4,3,2,1];
kelasWarna[6]=[7,6,5,4,3,1];
kelasWarna[5]=[7,6,4,3,1];
kelasWarna[4]=[7,6,4,2];
kelasWarna[3]=[7,4,2];

warnaa[0]=['#67000D','#A50F15','#CB181D','#EF3B2C','#FB6A4A','#FC9272','#FCBBA1','#FEE0D2','#FFF5F0'];//merah
warnaa[1]=['#3F007D','#54278F','#6A51A3','#807DBA','#9E9AC8','#BCBDDC','#DADAEB','#EFEDF5','#FCFBFD'];//ungu
warnaa[2]=['#08306B','#08519C','#2171B5','#4292C6','#6BAED6','#9ECAE1','#C6DBEF','#DEEBF7','#F7FBFF'];//biru
warnaa[3]=['#00441B','#006D2C','#238B45','#41AB5D','#74C476','#A1D99B','#C7E9C0','#E5F5E0','#F7FCF5'];//hijau
warnaa[4]=['#662506','#993404','#CC4C02','#EC7014','#FE9929','#FEC44F','#FEE391','#FFF7BC','#FFFFE5'];//orange
warnaa[5]=['#7F0000','#B30000','#D7301F','#EF6548','#FC8D59','#FDBB84','#FDD49E','#FEE8C8','#FFF7EC'];//merah tua
warnaa[6]=['#49006A','#7A0177','#AE017E','#DD3497','#F768A1','#FA9FB5','#FCC5C0','#FDE0DD','#FFF7F3'];//merah ungu
warnaa[7]=['#081D58','#253494','#225EA8','#1D91C0','#41B6C4','#7FCDBB','#C7E9B4','#EDF8B1','#FFFFD9'];//hijau biru
warnaa[8]=['#004529','#006837','#238443','#41AB5D','#78C679','#ADDD8E','#D9F0A3','#F7FCB9','#FFFFE5'];//hijau kuning


warnab[0]=['#01665E','#35978F','#80CDC1','#C7EAE5','#F5F5F5','#F6E8C3','#DFC27D','#BF812D','#8C510A'];//biru coklat
warnab[1]=['#4D9221','#7FBC41','#B8E186','#E6F5D0','#F7F7F7','#FDE0EF','#F1B6DA','#DE77AE','#C51B7D'];//hijau ungu
warnab[2]=['#1B7837','#5AAE61','#A6DBA0','#D9F0D3','#F7F7F7','#E7D4E8','#C2A5CF','#9970AB','#762A83'];//hijau ungu tua
warnab[3]=['#542788','#8073AC','#B2ABD2','#D8DAEB','#F7F7F7','#FEE0B6','#FDB863','#E08214','#B35806'];//ungu oranye 
warnab[4]=['#2166AC','#4393C3','#92C5DE','#D1E5F0','#F7F7F7','#FDDBC7','#F4A582','#D6604D','#B2182B'];//biru merah 
warnab[5]=['#4D4D4D','#999999','#E0E0E0','#FFFFFF','#FFFFFF','#FDDBC7','#F4A582','#EF8A62','#B2182B'];//hitam merah 
warnab[6]=['#1A9850','#66BD63','#A6D96A','#D9EF8B','#FFFFBF','#FEE08B','#FDAE61','#F46D43','#D73027'];//hijau merah 
warnab[7]=['#3288BD','#66C2A5','#ABDDA4','#E6F598','#FFFFBF','#FEE08B','#FDAE61','#F46D43','#D53E4F'];//hijau biru merah 



var layerprovinsi=0;
var peta;

//array untuk menampung idprovinsi, tahun, bulan, satuan nama provinsi, dan nilai
var dataTabel = new Array();
var jumlah=new Array();
var tahun=new Array();
var idProvinsi=new Array();
var namaProvinsi=new Array();
var tahun=new Array();
var bulan=new Array();
var satuan=new Array();

var info = L.control();
info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');// create a div with a class "info"
    this.update();
    return this._div;
};
var grades=new Array();
function legenda(){
	$('#legend').html('');
	$('#legend').append('<div class="row"><div class="col-md-6"><h4>Legenda</h4></div><div class="col-md-6"><a class="pull-right" style="cursor: pointer" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-menu-hamburger" data-toggle="tooltip" data-placement="top" title="Ubah Legenda"></span></a></div></div>');
	    for (var i = 0; i < grades.length; i++) {
        $('#legend').append('<i style="background:' + getColor(i) + '"></i><span> ' + grades[i] + '</span><br>');
    }
}

var vVal;


// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>'+$('#variabel-nama option:selected').text()+'</h4>' +  (props ?
        '<b>' + namaProvinsi[props.ID] + '</b><br />' + dataTabel[vVal][props.ID]
        : 'Hover over a state');
};


//style untuk polygon

var styleProvinsi ={
	'fillColor':'#ff0000',
	'fillOpacity':0.6,
	'color':'#ffffff',
	'opacity':1,
	'weight':2,
	'dashArray':3,
}
var styleSelected ={
	'weight': 5,
	'color': '#666',
	'dashArray': '',
	'fillOpacity': 0.7
}


function initializez()
{	
	//panggil base map
	map = L.map('map').setView([-1.889306,114.697266], 4);
	//overlay layer, bisa menampilkan data curah hujan, dll   
	var overlayLayers = {   
		//bisa ditambahkan sendiri overlay layernya, lihat dokumentasi plugin untuk layer yang tersedia
	};
	
	var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
	var osmAttrib='Map data © OpenStreetMap contributors';
	var osm2 = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 13, attribution: osmAttrib }).addTo(map);
	//tampilkan control pemilihan layer pada peta   
	//L.control.layers(overlayLayers,{collapsed: true}).addTo(map);

	//panggil function callJumlahPenduduk
warnalegenda();
info.addTo(map);
}

//highlight ketika mouse diarahkan 
function highlightFeature(e)
{
	var layer=e.target;
	layer.setStyle({
		'dashArray':'3',
		'color': '#000000',
	});

	if (!L.Browser.ie && !L.Browser.opera) {
		layer.bringToFront();
	}
	info.update(layer.feature.properties);
}

//kembalikan style ketika tidak ditunjuk oleh mouse
function resetHighlight(e) {
	var layer=e.target;
	layer.setStyle({
		'dashArray':'0',
		'color': 'white',
	});      
	info.update();
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
	calldata(e.target.feature.properties.ID);
}

function callProvMap(aWil)
{

	//ajax untuk memanggil polygon provinsi dari geoserver
//loadingt(20);
	$.ajax({
url: '?r=geoserver-url/load-peta&idWil='+aWil,
		type : 'POST',
		dataType : 'json',
success: function(data)
		{   kodewilayah=aWil;
			map.removeLayer(layerprovinsi); //hapus layer sebelumnya
			//kasih layer geoJson
			layerprovinsi=L.geoJson(data,{style:styleProvinsi}).addTo(map);
			map.fitBounds(layerprovinsi.getBounds());
			//kasih warna
		setVariableTahun(tahun[indexTahun]);
		loadingt(100);	
		}
	});     
}

function setVariableTahun(valTahun) {
	vVal=valTahun;
			var jp=new Array();
			var npr=new Array();
			var i=0;
//tampung data yang akan diwarnai
			idProvinsi.forEach(function(untukSeries) {
			npr[i]=namaProvinsi[untukSeries];
			jp[i]=dataTabel[valTahun][untukSeries];
			i++;
			});
			
//menutup popup
	if (layerPopup && map) {
        map.closePopup(layerPopup);
        layerPopup = null;
    }
	
serie = new geostats(jp);
$('#rata-rata').html('<b>'+serie.mean().toFixed(2)+'</b>');
$('#nilai-min').html('<b>'+serie.min()+'</b>');
$('#nilai-max').html('<b>'+serie.max()+'</b>');
$('#varian').html('<b>'+serie.variance().toFixed(2)+'</b>');
$('#s-d').html('<b>'+serie.stddev().toFixed(2)+'</b>');
$('#kov').html('<b>'+serie.cov().toFixed(2)+'</b>');
//metode
if(noMetode==0) serie.getClassJenks(jlhKelas);
else if(noMetode==1) serie.getClassEqInterval(jlhKelas);
else if(noMetode==2) serie.getClassStdDeviation(jlhKelas);
else if(noMetode==3) serie.getClassArithmeticProgression(jlhKelas);
else if(noMetode==4) serie.getClassGeometricProgression(jlhKelas);
else serie.getClassQuantile(jlhKelas);

grades = serie.ranges;
layerprovinsi.eachLayer(function(layer) {
var kodeprovinsi=layer.feature.properties.ID;
	layer.setStyle(style(dataTabel[vVal][kodeprovinsi]));

layer.on({
mouseover: highlightFeature,
mouseout: resetHighlight,  
dblclick : zoomToFeature,
click :  grafikPetaline,     
	});
//	layer.bindPopup('<div id="lineChart" style="width:300px; height:300px"></div>');
    });
	
	legenda(); //tampilkan lagenda
grafikPeta(npr,jp);//tampilkan grafik dibawah peta
}

function style(nilaiData) {
    return {
        fillColor: getColor(serie.getRangeNum(nilaiData)),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}
function calldatabaru(){
	var aWil = $('#wilayah-nama').val();
calldata(aWil);	
}
function getColor(indexWarna) {
	if(noWarna<9) return warnaa[noWarna][kelasWarna[jlhKelas][indexWarna]];
	else return warnab[noWarna-9][kelasWarna[jlhKelas][indexWarna]];
}

function loadingt(t){
	if(t==0){
$('#loadingmap').html('<img src="logo/ajax-loader.gif" style="margin-Left:46%">');
	}
	else {
		$('#loadingmap').html('');
	}
	}