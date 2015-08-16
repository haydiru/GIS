//variabel untuk menampung peta
var map;
//variabel untuk menampung polygon provinsi

var layerprovinsi=0;
var peta;

//array untuk menampung idprovinsi, nama provinsi, dan jumlah penduduk
	var jumlah=new Array();
	var tahun=new Array();
var idProvinsi=new Array();

var namaProvinsi=new Array();

var jp=new Array();

var tahun=new Array();

var satuan=new Array();

			var $select = $('<select></select>')
    .appendTo($('#variables'))
    .on('change', function() {
        setVariable($(this).val());
    });

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
        this._div.innerHTML +='<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }
};

var vVal;


// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>'+$('#topik-nama option:selected').text()+'</h4>' +  (props ?
        '<b>' + props.PROVINSI + '</b><br />' + jp[props.PROV_NO+vVal] + ' '+satuan[0]
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
	map = L.map('map').setView([-1.889306,114.697266], 5);
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
function getColor(d) {
if(d>=grades[4]) {return '#800026';}
else if(d>=grades[3]) {return '#BD0026';}
else if(d>=grades[2]) {return '#E31A1C';}
else if(d>=grades[1]) {return '#FC4E2A';}
//else if(d>=grades[3]) {return '#FD8D3C'}
//else if(d>=grades[2]) {return '#FEB24C';}
//else if(d>=grades[1]) {return '#FED976';}
else {return '#FFEDA0';}
}
function getGrade(data) {
	var ranges={ min: Infinity, max: -Infinity };
	
for (i = 0; i < data.length; i++) {
	 ranges.min = Math.min(data[i], ranges.min);
            ranges.max = Math.max(data[i], ranges.max);
}
var jangkauan = Math.floor((ranges.max-ranges.min)/5);
for (i = 0; i < 5; i++){
	if(i==0){
		grades[i]=0;
	}
	else{grades[i]=grades[i-1]+jangkauan;}
}
}
function style(feature) {
    return {
        fillColor: getColor(feature),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}

//highlight ketika mouse diarahkan 
function highlightFeature(e)
{
	var layer=e.target;
	layer.setStyle({
		'dashArray':'3',
		'color': '#0000ff',
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

function callJumlahPenduduk()

{


	var aVarn = $('#variabel-nama').val();
	var aVar = aVarn.substring(10);
	var aWil = $('#wilayah-nama').val();
	var aKat = $('#kategori-nama').val();
	//ajax untuk mendapatkan data jumlah penduduk
	//	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	$.ajax({

url: '?r=site/data&wil='+aWil+'&var='+aVar+'&kat='+aKat,

		type : 'POST',

		dataType : 'json',
		
		//	 data: {data:'data', _csrf : csrfToken},
		
success: function(data)   

		{     

			//simpan data jumlah penduduk ke dalam array

			for(var i=0;i<data.data.length;i++)

			{
					idProvinsi[i]=data.data[i].id.substring(0, 2);
				tahun[i]=data.data[i].tahun+' '+data.data[i].nama;
					jp[idProvinsi[i]+tahun[i]]=data.data[i].nilai;
					satuan[i]=data.data[i].satuan;
					//console.log('data tahun : '+tahun[i]+ ' kota : '+namaProvinsi[i]+' jumlah = '+jp[idProvinsi[i]+tahun[i]]);
					// tahun[i]=data.data[i].tahun;
			}
			

for (var i = 0; i < tahun.length; i++) {
   // ranges[tahun[i]] = { min: Infinity, max: -Infinity };
    // Simultaneously, build the UI for selecting different
    // ranges
	if (i==0){
    $('<option></option>')
        .text(tahun[i])
        .attr('value', tahun[i])
	.appendTo($select);
	}
	else if (tahun[i]!=tahun[i-1]){    
	$('<option></option>')
        .text(tahun[i])
        .attr('value', tahun[i])
	.appendTo($select);
	}
	else {}
}

			//panggil function callProvMap()

			callProvMap();   

		}

	});

}

function callProvMap()
{

	//ajax untuk memanggil polygon provinsi dari geoserver

	$.ajax({

url: 'http://localhost:81/skripsigis/proxy.php?id=1',

		type : 'POST',

		dataType : 'json',

success: function(data)   

		{     peta=data;

			//tampilkan polygon provinsi, setiap polygon mempunyai fitur yang ada pada function onEachFeature
			layerprovinsi=L.geoJson(data,{style:styleProvinsi}).addTo(map);

			//event ketika polygon di klik

      setVariable(tahun[0]);

		}

	});     


}

function onEachFeature(feature, layer)

{
	//tampung kodeprovinsi tiap polygon

	var kodeprovinsi=layer.feature.properties.PROV_NO;



	//mengatur warna polygon berdasarkan jumlah penduduk nya


		
		
			layer.setStyle(style(jp[kodeprovinsi+tahun[0]]));
			


		




	//menambahkan info window ketika polygon di klik
	//informasi yang ditampilkan adalah nama provinsi dan jumlah penduduk

}

function setVariable(val) {
	vVal=val;
var i=0;
var dataSe=new Array();
layerprovinsi.eachLayer(function(layer) {		
dataSe[i]=jp[layer.feature.properties.PROV_NO+vVal];
i+=1;
});	
getGrade(dataSe);
layerprovinsi.eachLayer(function(layer) {
var kodeprovinsi=layer.feature.properties.PROV_NO;
        layer.setStyle(style(jp[layer.feature.properties.PROV_NO+vVal]));
//		console.log(jp[layer.feature.properties.PROV_NO+vVal]);

			layer.on({
mouseover: highlightFeature,
mouseout: resetHighlight,  
click : zoomToFeature        
	});
		layer.bindPopup("<b>"+layer.feature.properties.PROVINSI+"</b> "+jp[layer.feature.properties.PROV_NO+vVal]+" Jiwa");
    });

	legend.update();
}