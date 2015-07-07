//variabel untuk menampung peta
var map;
//variabel untuk menampung polygon provinsi

var layerprovinsi;


//array untuk menampung idprovinsi, nama provinsi, dan jumlah penduduk
	var jumlah=new Array();
var idProvinsi=new Array();

var namaProvinsi=new Array();

var jp=new Array();

var tahun=new Array();

var satuan=new Array();


var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
};

var legend = L.control({position: 'bottomleft'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = [0, 10, 20, 50, 100, 200, 500, 1000],
        labels = [];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }

    return div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h4>'+$('#topik-nama option:selected').text()+'</h4>' +  (props ?
        '<b>' + props.PROVINSI + '</b><br />' + jumlah[props.PROV_NO] + ' '+satuan[props.PROV_NO]
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
legend.addTo(map);
info.addTo(map);
}
function getColor(d) {
    return d > 1000 ? '#800026' :
           d > 500  ? '#BD0026' :
           d > 200  ? '#E31A1C' :
           d > 100  ? '#FC4E2A' :
           d > 50   ? '#FD8D3C' :
           d > 20   ? '#FEB24C' :
           d > 10   ? '#FED976' :
                      '#FFEDA0';
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

	var arVal = $('#topik-nama').val();
	var arValWil = $('#tipewilayah-nama').val();

	//ajax untuk mendapatkan data jumlah penduduk
	//	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	$.ajax({

url: '?r=site/data&wil='+arValWil+'&var='+arVal,

		type : 'POST',

		dataType : 'json',
		
		//	 data: {data:'data', _csrf : csrfToken},
		
success: function(data)   

		{     

			//simpan data jumlah penduduk ke dalam array

			for(var i=0;i<data.data.length;i++)

			{
				if(data.data[i].tahun==1961){
					idProvinsi[i]=data.data[i].id.substring(0, 2);

					namaProvinsi[i]=data.data[i].nama;

					jp[i]=data.data[i].nilai;
					
					satuan[i]=data.data[i].satuan;
					
					// tahun[i]=data.data[i].tahun;
				}
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

		{     

			//tampilkan polygon provinsi, setiap polygon mempunyai fitur yang ada pada function onEachFeature

			layerprovinsi=L.geoJson(data,{style:styleProvinsi,onEachFeature:onEachFeature}).addTo(map);

			//event ketika polygon di klik

      

		}

	});     


}

function onEachFeature(feature, layer)

{

	//tampung kodeprovinsi tiap polygon

	var kodeprovinsi=layer.feature.properties.PROV_NO;



	//mengatur warna polygon berdasarkan jumlah penduduk nya

	for(var i=0;i<idProvinsi.length;i++)

	{

		if(kodeprovinsi==idProvinsi[i])

		{
			layer.setStyle(style(jp[i]));
			
			jumlah[kodeprovinsi]=jp[i]; 
			satuan[kodeprovinsi]=satuan[i];

		}

	}
	layer.on({
mouseover: highlightFeature,
mouseout: resetHighlight,  
click : zoomToFeature        
	});

	//menambahkan info window ketika polygon di klik
	//informasi yang ditampilkan adalah nama provinsi dan jumlah penduduk
	layer.bindPopup("<b>"+layer.feature.properties.PROVINSI+"</b> "+jumlah[kodeprovinsi]+" Jiwa");
}