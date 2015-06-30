//variabel untuk menampung peta
 var map;
 //variabel untuk menampung polygon provinsi

 var layerprovinsi;

 //array untuk menampung idprovinsi, nama provinsi, dan jumlah penduduk

 var idProvinsi=new Array();

 var namaProvinsi=new Array();

 var jp=new Array();
 
 var tahun=new Array();
 
 

 //style untuk polygon

 var styleProvinsi ={

   'color':'#00ff00',

   'opacity':0.1,

   'weight':4,

  }

 var styleSelected ={

   'color':'#0000ff',

   'opacity':0.1,

   'weight':4,

  }

 var styleHigh ={

   'color':'#ff0000',

   'opacity':0.1,

   'weight':4,

  }

 var styleMed ={

   'color':'#ffff00',

   'opacity':0.1,

   'weight':4,

  }

 var styleLow ={

   'color':'#00ff00',

   'opacity':0.1,

   'weight':4,

  }

 

  function initializez()

  {

   //panggil base map
   map = L.map('map').setView([-1.889306,114.697266], 5);

   L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {

       attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

   }).addTo(map);

   //panggil function callJumlahPenduduk

   callJumlahPenduduk();  


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

     layerprovinsi.on('click', function(e) {

      //layerprovinsi.setStyle(styleProvinsi);

         map.setView(e.latlng);       

         //e.layer.setStyle(styleSelected);     

        });       

    }

   });     


  }

  function onEachFeature(feature, layer)

  {

   //tampung kodeprovinsi tiap polygon

   var kodeprovinsi=layer.feature.properties.PROV_NO;

   var jumlah=0;

   //mengatur warna polygon berdasarkan jumlah penduduk nya

   for(var i=0;i<idProvinsi.length;i++)

   {

    if(kodeprovinsi==idProvinsi[i])

    {

     if(jp[i]<3000000)

     {

      layer.setStyle(styleLow);      

     }

     else if(jp[i]>=3000000&&jp[i]<6000000)

     {

      layer.setStyle(styleMed);

     }

     else if(jp[i]>=6000000)

     {

      layer.setStyle(styleHigh);

     }

     jumlah=jp[i];    

    }

   }

   //menambahkan info window ketika polygon di klik
   //informasi yang ditampilkan adalah nama provinsi dan jumlah penduduk
   layer.bindPopup("<b>"+layer.feature.properties.PROVINSI+"</b>"+jumlah+" Jiwa");
  }