//variabel untuk menampung peta
var serie;
var map;
//variabel untuk menampung polygon provinsi
var dataTabel = new Array();
var layerprovinsi=0;
var peta;

//array untuk menampung idprovinsi, nama provinsi, dan jumlah penduduk
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
var legend = L.control({position: 'bottomleft'});
	
legend.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info legend'),labels = [];
	
	// create a div with a class "info"
    this.update();
    return this._div;
};
legend.update = function () {

    // loop through our density intervals and generate a label with a colored square for each interval
	this._div.innerHTML='<h4>Legenda</h4>';
    for (var i = 0; i < grades.length; i++) {
        this._div.innerHTML +='<i style="background:' + getColor(i) + '"></i> ' + grades[i] + '<br>';
    }
};

var vVal;


// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>'+$('#variabel-nama option:selected').text()+'</h4>' +  (props ?
        '<b>' + props.PROVINSI + '</b><br />' + dataTabel[vVal][props.PROV_NO+"00000000"]
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

info.addTo(map);
	legend.addTo(map);
}

//highlight ketika mouse diarahkan 
function highlightFeature(e)
{
	var layer=e.target;
	layer.setStyle({
		'dashArray':'3',
		'color': '#ffffff',
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
}

function callProvMap()
{

	//ajax untuk memanggil polygon provinsi dari geoserver
var aWil = $('#wilayah-nama').val();
	$.ajax({

url: '?r=geoserver-url/load-peta&idWil='+aWil,

		type : 'POST',

		dataType : 'json',

success: function(data)   

		{   
			map.removeLayer(layerprovinsi);
			//tampilkan polygon provinsi, setiap polygon mempunyai fitur yang ada pada function onEachFeature
			layerprovinsi=L.geoJson(data,{style:styleProvinsi}).addTo(map);
			map.fitBounds(layerprovinsi.getBounds());
			//kasih warna
		setVariableTahun(tahun[0]);
		}

	});     


}

function setVariableTahun(valTahun) {
	vVal=valTahun;
			var jp=new Array();
			var i=0;
			idProvinsi.forEach(function(untukSeries) {
			jp[i]=dataTabel[valTahun][untukSeries];
			i++;
			});
	
serie = new geostats(jp);
$('#rata-rata').html('<b>'+serie.mean().toFixed(2)+'</b>');
$('#nilai-min').html('<b>'+serie.min()+'</b>');
$('#nilai-max').html('<b>'+serie.max()+'</b>');
$('#varian').html('<b>'+serie.variance().toFixed(2)+'</b>');
$('#s-d').html('<b>'+serie.stddev().toFixed(2)+'</b>');
$('#kov').html('<b>'+serie.cov().toFixed(2)+'</b>');
serie.getClassJenks(4);	
grades = serie.ranges;
layerprovinsi.eachLayer(function(layer) {
var kodeprovinsi=layer.feature.properties.PROV_NO+'00000000';
	layer.setStyle(style(dataTabel[vVal][kodeprovinsi]));

layer.on({
mouseover: highlightFeature,
mouseout: resetHighlight,  
dblclick : zoomToFeature       
	});
	//	layer.bindPopup("<b>"+layer.feature.properties.PROVINSI+"</b> "+jp[layer.feature.properties.PROV_NO+vVal]+" Jiwa");
    });

	legend.update();
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

function getColor(d) {
	var warna=['#FFEDA0','#FED976','#FEB24C','#FD8D3C','#FC4E2A','#E31A1C','#BD0026'];
return warna[d];
}