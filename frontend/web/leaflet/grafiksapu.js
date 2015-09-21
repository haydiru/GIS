var daerah = new Array();
var agregat = new Array();
var tw;

function calldatavis(twil,nwil){
	tw=twil;

	$.ajax({
url: '?r=site/datavis&twil='+twil+'&nwil='+nwil,
		type : 'POST',
		dataType : 'json',
success: function(data)   
		{
			data.data.forEach(function(entry) {
		
	 	 daerah=[entry.ID_WIL, entry.R101, entry.R101N, entry.R102N, entry.R103N, entry.R104N, entry.R401, entry.R404A, entry.R501A1, entry.R501A2,
		 entry.R501B, entry.R503, entry.R507A, entry.R701A_K2, entry.R701A_K3, entry.R701B_K2, entry.R701B_K3, entry.R701C_K2, entry.R701C_K3, entry.R701D_K2, 
		 entry.R701D_K3, entry.R701E_K2, entry.R701E_K3, entry.R701F_K2, entry.R701F_K3, entry.R701G_K2, entry.R701G_K3, entry.R701H_K3, entry.R701I_K3, entry.R704A_K3, 
		 entry.R704B_K3, entry.R704C_K3, entry.R704D_K3, entry.R704E_K3, entry.R704F_K3, entry.R704G_K3, entry.R704H_K3, entry.R704I_K3, entry.R704J_K3, entry.R704K_K3,
		 entry.R704L_K3, entry.R706A1, entry.R706A2, entry.R706B, entry.R706C, entry.R706D, entry.R1201A, entry.R1201B, entry.R1201C, entry.R1201D,
		 entry.R1201E, entry.R1201F, entry.R1201G, entry.R1201H, entry.R1204A, entry.R1204B, entry.R1205, entry.R1206, entry.R1209, entry.R1210,
		 entry.R1211, entry.R1215A_K3, entry.R1215B_K3, entry.R802, entry.R803A, entry.R803B, entry.R803C, entry.R803D, entry.R803E, entry.R803F,
		 entry.R803G, entry.R803H, entry.R1305, entry.R1303B, entry.R601A_K2, entry.R601B_K2, entry.R601C_K2, entry.R601D_K2, entry.R601E_K2, entry.R601F_K2,
		 entry.R601G_K2, entry.R601H_K2, entry.R601I_K2, entry.R601J_K2];														

		 for(i=6; i<= 83; i++){daerah[i]=parseInt(daerah[i]);}
		
		 });	wilayah(twil);
		}
	});
}

function calldatasum(twil,nwil,namawil){
	
	$.ajax({
url: '?r=site/datasum&twil='+twil+'&nwil='+nwil+'&namawil='+namawil,
		type : 'POST',
		dataType : 'json',
success: function(data)   
		{ 
			data.data.forEach(function(entry) {
		
		agregat=[entry.jkota, entry.jkec, entry.jdesa];
		
		}); 
						
		}
	});
}

function spu(spu){
		switch (spu) {
		case 1 : return "Pertanian";break;
		case 2 : return "Pertambangan dan penggalian";break;
		case 3 : return "Industri pengolahan";break;
		case 4 : return "Perdagangan besar";break;
		case 5 : return "Angkutan, pergudangan, komunikasi";break;
		case 6 : return "Jasa";break;
		case 7 : return "Lainnya";break;
		default:  return "Kode tidak dikenali";}} 
		
function bbm(bbm){
		switch (bbm) {
		case 1: return "Gas kota";break;
		case 2: return "LPG";break;
		case 3: return "Minyak tanah";break;
		case 4: return "Kayu bakar";break;
		case 5: return "Lainnya";break;
		default: return "Kode tidak dikenali";}}

function sam(sam){
		switch (sam) {
		case 1: return "Air kemasan";break;
		case 2: return "PAM/PDAM";break;
		case 3: return "Ledeng";break;
		case 4: return "Sumur bor/pompa";break;
		case 5: return "Sumur";break;
		case 6: return "Mata air";break;
		case 7: return "Sungai /danau /kolam";break;
		case 8: return "Air Hujan";break;
		case 9: return "Lainnya";break;
		default: return "Kode tidak dikenali";}}	

function mad(mad){
		switch (mad) {
		case 1: return "Islam";break;
		case 2: return "Kristen";break;
		case 3: return "Katolik";break;
		case 4: return "Buddha";break;
		case 5: return "Hindu";break;
		case 6: return "Konghucu";break;
		case 7: return "Lainnya";break;
		default: return "Kode tidak dikenali";}}

function tkt(tkt){
		switch (tkt) {
		case 0: return "Jarang terjadi kejahatan"; break;
		case 1: return "Pencurian";break;
		case 2: return "Pencurian dengan kekerasan";break;
		case 3: return "Penipuan/penggelapan";break;
		case 4: return "Penganiayaan";break;
		case 5: return "Pembakaran";break;
		case 6: return "Perkosaan/kejahatan terhadap kesusilaan";break;
		case 7: return "Penyalahgunaan/peredaran narkoba";break;
		case 8: return "Perjudian";break;
		case 9: return "Pembunuhan";break;
		case 10: return "Perdagangan orang(trafficking)";break;
		default:  return "Kode tidak dikenali";}}		
		
function bat(bat){var x,y=0; var z="";
		for(x = 74; x < 84; x++) {
		if (bat[x] == 1) {
		switch (x) {
			case 74 : z = "Tanah Longsor";break;
			case 75 : z = "Banjir";break;
			case 75 : z = "Banjir bandang";break;
			case 77 : z = "Gempa bumi";break;
			case 78 : z = "Tsunami";break;
			case 79 : z = "Gelombang pasang laut";break;
			case 80 : z = "Angin puyuh/puting beliung/topan";break;
			case 81 : z = "Gunung meletus";break;
			case 82 : z = "Kebakaran hutan";break;
			case 83 : z = "Kekeringan lahan";break;
			default : z = "Kode tidak dikenali";}
			x=x+1; 
			for(x; x<84; x++){
				if (bat[x] == 1){
				switch (x) {
					case 75: z = z + ", Banjir";break;
					case 76: z = z + ", Banjir bandang";break;
					case 77: z = z + ", Gempa bumi";break;
					case 78: z = z + ", Tsunami";break;
					case 79: z = z + ", Gelombang pasang laut";break;
					case 80: z = z + ", Angin puyuh/puting beliung/topan";break;
					case 81: z = z + ", Gunung meletus";break;
					case 82: z = z + ", Kebakaran hutan";break;
					case 83: z = z + ", Kekeringan lahan";break;
					default :  z = z + ", Kode tidak dikenali";}}}
			return "<p style='color:red'>"+z+"</p>";}
			else y++;}
			if (y == 10) {return "Tidak terjadi bencana alam 3 tahun terakhir";}
				
		}

function wilayah(kode){
	switch(kode)	{case "0" : {$('#upper').html(''); $('#vis').html(''); $('#lower').html(''); $('#slider').html('');}
						break;
					 case "1" : {$('#upper').html('<h2>'+daerah[2]+'</h2><table class="Tinfo" align="center"><tr><td id="tdinfo">Jumlah Kota / Kabupaten : '+agregat[0]+'</td><tr><td id="tdinfo">Jumlah Kecamatan : '+agregat[1]+'</span></td><tr><td id="tdinfo">Jumlah Desa / Kelurahan :	'+agregat[2]+'</td></tr></table>'); klh();}
						break;
					 case "2" : {$('#upper').html('<h2>'+daerah[3]+'</h2><table class="Tinfo" align="center"><tr><td id="tdinfo">Provinsi : '+daerah[2]+'</td><tr><td id="tdinfo">Jumlah Kecamatan : '+agregat[1]+'</span></td><tr><td id="tdinfo">Jumlah Desa / Kelurahan :	'+agregat[2]+'</td></tr></table>'); klh();}
						break;
					 case "3" : {$('#upper').html('<h2>'+daerah[4]+'</h2><table class="Tinfo" align="center"><tr><td id="tdinfo">Provinsi : '+daerah[2]+'</td><tr><td id="tdinfo">Kota/Kabupaten : '+daerah[3]+'</span></td><tr><td id="tdinfo">Jumlah Desa / Kelurahan :	'+agregat[2]+'</td></tr></table>'); klh();}
						break;
					 case "4" : {$('#upper').html('<h2>'+daerah[5]+'</h2><table class="Tinfo" align="center"><tr><td id="tdinfo">Provinsi : '+daerah[2]+'</td><tr><td id="tdinfo">Kota/Kabupaten : '+daerah[3]+'</span></td><tr><td id="tdinfo">Kecamatan :	'+daerah[4]+'</td></tr></table>'); klh();}
						break;
					}}

function subgraf(kode){
	switch(kode)	{case "1" : return 'Provinsi '+daerah[2];
						break;
					 case "2" : return daerah[3];
						break;
					 case "3" : return 'Kecamatan '+daerah[4];
						break;
					 case "4" : return daerah[4]; 
						break;
					}}				
					
function podes(){	
			$('#lower').html('<div class="container" style="margin-left:-10px">'+
				'<ul class="nav nav-tabs nav-justified" style="margin-left:-2px; width:35%">'+
				'<li class="active" onclick="klh()"><a data-toggle="tab" href="#klh">KLH<br><br></a></li>'+
				'<li onclick="pk()"><a data-toggle="tab" href="#pk">Pendidikan & Kesehatan</a></li>'+
				'<li onclick="e()"><a data-toggle="tab" href="#e">Ekonomi <br><br></a></li>'+
				'<li onclick="sbk()"><a data-toggle="tab" href="#sbk">Sosbud & Keamanan</a></li></ul>'+
		
		
			'<div class="tab-content" style="width:33%; margin-left:5px; font-size:13px">'+
				'<div id="klh" class="tab-pane fade in active">'+
				'<h3>Kependudukan & Lingkungan Hidup</h3>'+
				'<table align="center">'+
					'<tr><td>Jumlah Penduduk</td><td>:       '+ daerah[6] +' </td></tr>'+
					'<tr><td>Jumlah Keluarga Pengguna Listrik</td><td>: '+ (parseInt(daerah[8])+parseInt(daerah[9])) +' </td></tr>'+
					'<tr><td>Jumlah Keluarga Pengguna non Listrik &nbsp; </td><td> : '+ daerah[10] +' </td></tr>'+
					'<tr><td>Bahan Bakar Memasak</td><td>: '+ bbm(daerah[11]) +' </td></tr>'+
					'<tr><td>Sumber Air Minum</td><td>: '+ sam(daerah[12]) +' </td></tr>'+
					'<tr><td>Sumber Penghasilan Utama</td><td>: '+ spu(daerah[7]) +' </td></tr>'+
				'</table></div>'+
	

				'<div id="pk" class="tab-pane fade">'+
				'<h3>Sarana Pendidikan</h3>'+
				'<table id="pkpendidikan" align="center">'+
					'<tr><td>TK/RA/BA&nbsp;&nbsp;</td><td>: '+ (parseInt(daerah[13])+parseInt(daerah[14])) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Akademi/Perguruan Tinggi&nbsp;&nbsp;</td><td>: '+ (parseInt(daerah[23])+parseInt(daerah[24])) +' </td></tr> '+
					'<tr><td>SD/MI</td><td>: '+ (parseInt(daerah[15])+parseInt(daerah[16])) +' </td><td>Sekolah Luar Biasa</td><td>: '+ (parseInt(daerah[25])+parseInt(daerah[26])) +' </td></tr> '+
					'<tr><td>SMP/MTs</td><td>: '+ (parseInt(daerah[17])+parseInt(daerah[18])) +' </td><td>Pondok Pesantren</td><td>: '+ daerah[27] +' </td></tr> '+
					'<tr><td>SMU/MA</td><td>: '+ (parseInt(daerah[19])+parseInt(daerah[20])) +' </td><td>Madrasah Diniyah</td><td>: '+ daerah[28] +' </td></tr> '+
					'<tr><td>SMK</td><td>: '+ (parseInt(daerah[21])+parseInt(daerah[22])) +' </td></tr>'+ 
				'</table>'+
				
				'<h3>Sarana Kesehatan</h3>'+
				'<table align="center">'+
					'<tr><td>Rumah Sakit</td><td>: '+ daerah[29] +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td>Praktek Bidan&nbsp;&nbsp;</td><td>: '+ daerah[36] +' </td></tr> '+
					'<tr><td>RS Bersalin</td><td>: '+ daerah[30] +' </td><td>Poskesdes</td><td>: '+ daerah[37] +' </td></tr> '+
					'<tr><td>Puskesmas</td><td>: '+ (parseInt(daerah[31])+parseInt(daerah[32])+parseInt(daerah[33])) +' </td><td>Polindes</td><td>: '+ daerah[38] +' </td></tr> '+
					'<tr><td>Poliklinik</td><td>: '+ daerah[34] +' </td><td>Posyandu</td><td>: '+ daerah[39] +' </td></tr> '+
					'<tr><td>Praktek Dokter&nbsp;&nbsp;</td><td>: '+ daerah[35] +' </td><td>Apotek</td><td>: '+ daerah[40] +' </td></tr> '+
				'</table>'+
				
				'<h3>Tenaga Kesehatan</h3>'+
				'<table align="center">'+
					'<tr><td>Dokter&nbsp;&nbsp;</td><td>: '+ (parseInt(daerah[41])+parseInt(daerah[42])) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td><td>Dokter Gigi</td><td>: '+ daerah[43] +' </td></tr> '+
					'<tr><td>Bidan</td><td>: '+ daerah[44] +' </td><td>Tenaga Kesehatan Lainnya&nbsp;&nbsp;</td><td>: '+ daerah[45] +' </td></tr> '+
				'</table></div>'+
   


				'<div id="e" class="tab-pane fade">'+
				'<h3>Ekonomi</h3>'+
				'<table align = "center">'+
					'<tr><td id="tdtabe">Industri Menengah Kecil </td><td>: &nbsp;'+ (parseInt(daerah[46])+parseInt(daerah[47])+parseInt(daerah[48])+parseInt(daerah[49])+parseInt(daerah[50])+parseInt(daerah[51])+parseInt(daerah[52])+parseInt(daerah[53])) +' </td></tr>'+
					'<tr><td id="tdtabe">Pasar</td><td>: &nbsp;'+ (parseInt(daerah[54])+parseInt(daerah[55])+parseInt(daerah[56])) +' </td></tr>'+
					'<tr><td id="tdtabe">Minimarket</td><td>: &nbsp;'+ daerah[57] +' </td></tr>'+
					'<tr><td id="tdtabe">Restoran</td><td>: &nbsp;'+ daerah[58] +' </td></tr>'+
					'<tr><td id="tdtabe">Hotel</td><td>: &nbsp;'+ daerah[59] +' </td></tr>'+
					'<tr><td id="tdtabe">Penginapan</td><td>: &nbsp;'+ daerah[60] +' </td></tr>'+
					'<tr><td id="tdtabe">Bank Umum Pemerintah</td><td>: &nbsp;'+ daerah[61] +' </td></tr>'+
					'<tr><td id="tdtabe">Bank Umum Swasta</td><td>: &nbsp;'+ daerah[62] +' </td></tr>'+
				'</table></div>'+
      
   
			'<div id="sbk" class="tab-pane fade" align="center">'+
				'<h3>Sosial Budaya & Keamanan</h3>'+
				'<p>Mayoritas agama yang dianut : &nbsp;&nbsp; '+ mad(daerah[63]) +'</p>'+
				'<table>'+
					'<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Jumlah Tempat Ibadah</b></tr>'+
					'<tr><td>Masjid</td><td>: &nbsp;'+ daerah[64] +' </td></tr>'+
					'<tr><td>Surau</td><td>: &nbsp;'+ daerah[65] +' </td></tr>'+
					'<tr><td>Gereja Kristen</td><td>: &nbsp;'+ daerah[66] +' </td></tr>'+
					'<tr><td>Gereja Katolik</td><td>: &nbsp;'+ daerah[67] +' </td></tr>'+
					'<tr><td>Kapel</td><td>: &nbsp;'+ daerah[68] +' </td></tr>'+
					'<tr><td>Pura</td><td>: &nbsp;'+ daerah[69] +' </td></tr>'+
					'<tr><td>Vihara</td><td>: &nbsp;'+ daerah[70] +' </td></tr>'+
					'<tr><td>Klenteng</td><td>: &nbsp;'+ daerah[71] +' </td></tr>'+
					'</table><br>'+
				'<p>Jumlah Anggota linmas/Hansip : '+ daerah[72] +'</p>'+
				'<p>Tindak Kejahatan yang Paling Sering Terjadi : </p><p style="color:red"> '+ tkt(daerah[73]) + '</p>' +
				'<p>Bencana Alam yang terjadi 3 Tahun Terakhir : </p>'+ bat(daerah) +
				'</div></div></div>');
				 
}

function klh(){$('#vis').html('<div class="item active" id="gklhlistrik"></div><div class="item" id="dklhlistrik"></div>');grafik(); podes();}

function pk(){$('#vis').html('<div class="item active" id="gpkpendidikan"></div><div class="item" id="dpkpendidikan"></div><div class="item" id="gpkkesehatan"></div><div class="item" id="dpkkesehatan"></div><div class="item" id="gpktenaga"></div><div class="item" id="dpktenaga"></div>');grafik(); podes();}

function e(){$('#vis').html('<div class="item active" id="gekonomi"></div><div class="item" id="dekonomi"></div><div class="item" id="ebank"></div>');grafik(); podes();}

function sbk(){$('#vis').html('<div class="item active" id="gsbk"></div><div class="item" id="dsbk"></div>');grafik(); podes();}
 
function grafik() {
	$('#slider').html('<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="false"></span><span class="sr-only">Next</span></a>');
	
    $('#gklhpenduduk').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Jumlah Penduduk'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { categories: ['Laki-laki', 'Perempuan']},
		series: [{
				name: 'Penduduk',
				data:	[{	name:'Laki-laki',
							color: '#C5F6FF',
							y: 3},
						{	name :'Perempuan',
							color: '#FCB6FF',
							y: 5 }]
				}],
        yAxis: { min: 0, title: {text: 'Jumlah (orang)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f} orang</b></td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         });
				 	
	$('#gklhlistrik').highcharts({
        chart: {type: 'column', height:220},
	//			events: {drilldown: function(e) {chart.setTitle({ text: drilldownTitle + e.point.name });},
    //             drillup: function(e) {chart.setTitle({ text: 'Jumlah Keluarga menurut<br> penggunaan listrik' });}},
		credits: {enabled: false},
        title: {text: 'Jumlah Keluarga menurut<br> penggunaan listrik'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{
				name: 'Pengguna listrik',
				data:	[{	name:'Pengguna listrik',
							color: '#F2F681',
							y: daerah[8]+daerah[9] ,
							drilldown: "Pengguna listrik"},
						{	name :'Pengguna non listrik',
							color: '#736B62',
							y: daerah[10]}]
				}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Pengguna listrik",
							   id : "Pengguna listrik",
							   data : [["PLN",daerah[8] ],["non-PLN",daerah[9] ]]}]},
        yAxis: { min: 0, title: {text: 'Jumlah (keluarga)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f} keluarga</b></td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}}
         });
		 	 
	$('#gpkpendidikan').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Lembaga Pendidikan'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{	
				name: 'Pendidikan',
				data:	[{	name:'TK/RA/BA',
							color: '#FCB2DC',
							y: daerah[13]+daerah[14] ,
							drilldown: "TK/RA/BA"},
						{	name:'SD/MI',
							color: '#FC786F',
							y: daerah[15]+daerah[16] ,
							drilldown: "SD/MI"},
						{	name:'SMP/MTs',
							color: '#6A69CF',
							y: daerah[17]+daerah[18] ,
							drilldown: "SMP/MTs"},
						{	name:'SMU/MA',
							color: '#BCAACF',
							y: daerah[19]+daerah[20] ,
							drilldown: "SMU/MA"},
						{	name:'SMK',
							color: '#CC66C6',
							y: daerah[21]+daerah[22] ,
							drilldown: "BF6AE5"},
						{	name:'Akademi/PT',
							color: '#7CC7FC',
							y: daerah[23]+daerah[24] ,
							drilldown: "Akademi/PT"},
						{	name:'SLB',
							color: '#AEFC99',
							y: daerah[25]+daerah[26] ,
							drilldown: "SLB"},
						{	name :'PP',
							color: '#FCD8FC',
							y: daerah[27]  },
						{	name :'MD',
							color: '#CF9154',
							y: daerah[28]  }]
				}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"TK/RA/BA",
							   id : "TK/RA/BA",
							   data : [["Negeri",daerah[13] ],["Swasta",daerah[14] ]]},
							   {name:"SD/MI",
							   id : "SD/MI",
							   data : [["Negeri",daerah[15] ],["Swasta",daerah[16] ]]},
							   {name:"SMP/MTs",
							   id : "SMP/MTs",
							   data : [["Negeri",daerah[17] ],["Swasta",daerah[18] ]]},
							   {name:"SMU/MA",
							   id : "SMU/MA",
							   data : [["Negeri",daerah[19] ],["Swasta",daerah[20] ]]},
							   {name:"SMK",
							   id : "SMK",
							   data : [["Negeri",daerah[21] ],["Swasta",daerah[22] ]]},
							   {name:"Akademi/PT",
							   id : "Akademi/PT",
							   data : [["Negeri",daerah[23] ],["Swasta",daerah[23] ]]},
							   {name:"SLB",
							   id : "SLB",
							   data : [["Negeri",daerah[24] ],["Swasta",daerah[26] ]]}
							   ]},
        yAxis: { min: 0, title: {text: 'Jumlah (unit)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f}</b> unit</td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         });	 
	 
	$('#gpkkesehatan').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Sarana kesehatan'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{	
				data:	[{	name:'RS',
							color: '#BCAACF',
							y: daerah[29] },
						{	name:'RS Bersalin',
							color: '#FCB2DC',
							y: daerah[30] },
						{	name:'Puskesmas',
							color: '#FCD8FC',
							y: daerah[31]+daerah[32]+daerah[33] ,
							drilldown:'Puskesmas'},
						{	name:'Poliklinik',
							color: '#7CC7FC',
							y: daerah[34] },
						{	name:'Praktek dokter',
							color: '#AEFC99',
							y: daerah[35] },
						{	name:'Praktek bidan',
							color: '#CC66C6',
							y: daerah[36] },
						{	name:'Poskesdes',
							color: '#CF9154',
							y: daerah[37] },
						{	name :'polindes',
							color: '#6A69CF',
							y: daerah[38]  },
						{	name :'Posyandu',
							color: '#CCA4A1',
							y: daerah[39]  },
						{	name :'Apotek',
							color: '#B9CBCC',
							y: daerah[40]  }]
				}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Puskesmas",
							   id : "Puskesmas",
							   data : [["Rawat inap",daerah[31] ],["Tanpa rawat inap",daerah[32] ],["Pembantu",daerah[33] ]]}
							 ]},
        yAxis: { min: 0, title: {text: 'Jumlah (unit)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f}</b> unit</td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         });

	$('#gpktenaga').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Tenaga Kesehatan'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{
				name: 'Kesehatan',
				data:	[{	name:'Dokter',
							color: '#AEFC99',
							y: daerah[41]+daerah[42] ,
							drilldown: 'Dokter'},
						{	name:'Dokter gigi',
							color: '#FCB2DC',
							y: daerah[43] },
						{	name:'Bidan',
							color: '#CC66C6',
							y: daerah[44] },
						{	name:'Tenaga lainnya',
							color: '#CF9154',
							y: daerah[45] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Dokter",
							   id : "Dokter",
							   data : [["Pria",daerah[41] ],["Wanita",daerah[42] ]]}
							 ]},
        yAxis: { min: 0, title: {text: 'Jumlah (orang)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         });
		 
	$('#gekonomi').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Sektor Ekonomi'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{
				name: 'Ekonomi',  
				data:	[{	name:'IMK',
							color: '#7C8FFF',
							y: daerah[46]+daerah[47]+daerah[48]+daerah[49]+daerah[50]+daerah[51]+daerah[52]+daerah[53] ,
							drilldown: 'IMK'},
						{	name:'Pasar',
							color: '#FF767F',
							y: daerah[54]+daerah[55]+daerah[56] ,
							drilldown: 'Pasar'},
						{	name:'Minimarket',
							color: '#FFF95C',
							y: daerah[57] },
						{	name:'Restoran',
							color: '#68FF77',
							y: daerah[58] },
						{	name:'Hotel',
							color: '#7CC4FF',
							y: daerah[59] },
						{	name:'Bank',
							color: '#FFC09C',
							y: daerah[61]+daerah[62] ,
							drilldown: 'Bank'},
						{	name:'Penginapan',
							color: '#9184A7',
							y: daerah[59] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Industri menengah kecil",
							   id : "IMK",
							   data : [["Kulit",daerah[46] ],["Kayu",daerah[47] ],["Logam",daerah[48] ],["Anyaman",daerah[49] ],["Gerabah",daerah[50] ],["Kain/tenun",daerah[51] ],["Makanan",daerah[52] ],["lainnya",daerah[53] ]]},
							  {name:"Pasar",
							   id : "Pasar",
							   data : [["Permanen",daerah[54] ],["Semi permanen",daerah[55] ],["Tanpa bangunan",daerah[56] ]]},
							  {name:"Bank",
							   id : "Bank",
							   data : [["Pemerintah",daerah[61] ],["Swasta",daerah[62] ]]}
							 ]},
        yAxis: { min: 0, title: {text: 'Jumlah (unit)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f}</b> unit</td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         }); 
		 
	$('#gsbk').highcharts({
        chart: {type: 'column', height:220},
		credits: {enabled: false},
        title: {text: 'Tempat Ibadah'},
        subtitle: {text: subgraf(tw)+' 2014'},
		legend : {enabled :false},
		xAxis: { type: 'category'},
		series: [{ 
				name: 'Tempat ibadah',
				data:	[{	name:'Masjid',
							color: '#79FF4A',
							y: daerah[64] },
						{	name:'Surau',
							color: '#79FF9B',
							y: daerah[65] },
						{	name:'Gereja',
							color: '#E8DD45',
							y: daerah[66]+daerah[67] ,
							drilldown: 'Gereja'},
						{	name:'Kapel',
							color: '#D1AAC1',
							y: daerah[68] },
						{	name:'Pura',
							color: '#8870E8',
							y: daerah[69] },
						{	name:'Vihara',
							color: '#FF3F50',
							y: daerah[70] },
						{	name:'Klenteng',
							color: '#FF8441',
							y: daerah[71] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Gereja",
							   id : "Gereja",
							   data : [["Kristen",daerah[66] ],["Katolik",daerah[67] ]]}
							 ]},
        yAxis: { min: 0, title: {text: 'Jumlah (unit)'}},
        tooltip: {pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f}</b> unit</td></tr>',        
				useHTML: true},
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
         });  

	$(document).ready(function () {

        $('#dklhpenduduk').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'},
			credits: {enabled: false},
            title: {text: 'Proporsi Penduduk'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.percentage:.1f} %'},
								showInLegend: true}},
			series: [{
				name: 'Penduduk',
				colorByPoint: true,
				data:	[	{name:'Laki-laki',
							color: '#C5F6FF',
							y: daerah[7] ,
							sliced: false, selected: true},
							{name :'Perempuan',
							color: '#FCB6FF',
							y: 3000 }]}]
		});

		$('#dklhlistrik').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Keluarga menurut Penggunaan Listrik'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.percentage:.1f} %'},
								showInLegend: true}},
			series: [{
				name: 'Listrik',
				colorByPoint: true,
				data:	[	{name:'listrik',
							color: '#F2F681',
							y: daerah[8]+daerah[9] ,
							drilldown: "Listrik",
							sliced: false, selected: true},
							{name :'Non listrik',
							color: '#736B62',
							y: daerah[10]  }]}],
				drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Pengguna listrik",
							   id : "Listrik",
							   colors : ['#E3EF95','#40A727'],
							   data : [["PLN",daerah[8] ],["non-PLN",daerah[9] ]]}]}
		});
		 
		$('#dpkpendidikan').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Lembaga Pendidikan'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.name}: {point.percentage:.1f} %'},
								showInLegend: false}},
			series: [{
				name: 'Pendidikan',
				colorByPoint: true,
				data:	[{	name:'TK',
							color: '#FCB2DC',
							y: daerah[13]+daerah[14] ,
							sliced: false, selected: true,
							drilldown: "TK/RA/BA"},
						{	name:'SD',
							color: '#FC786F',
							y: daerah[15]+daerah[16] ,
							drilldown: "SD/MI"},
						{	name:'SMP',
							color: '#6A69CF',
							y: daerah[17]+daerah[18] ,
							drilldown: "SMP/MTs"},
						{	name:'SMU',
							color: '#BCAACF',
							y: daerah[19]+daerah[20] ,
							drilldown: "SMU/MA"},
						{	name:'SMK',
							color: '#CC66C6',
							y: daerah[21]+daerah[22] ,
							drilldown: "SMK"},
						{	name:'PT',
							color: '#7CC7FC',
							y: daerah[23]+daerah[23] ,
							drilldown: "Akademi/PT"},
						{	name:'SLB',
							color: '#AEFC99',
							y: daerah[24]+daerah[26] ,
							drilldown: "SLB"},
						{	name :'PP',
							color: '#FCD8FC',
							y: daerah[26]  },
						{	name :'MD',
							color: '#CF9154',
							y: daerah[27]  }]
				}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"TK/RA/BA",
							   id : "TK/RA/BA",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[13] ],["Swasta",daerah[14] ]]},
							   {name:"SD/MI",
							   id : "SD/MI",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[15] ],["Swasta",daerah[16] ]]},
							   {name:"SMP/MTs",
							   id : "SMP/MTs",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[17] ],["Swasta",daerah[18] ]]},
							   {name:"SMU/MA",
							   id : "SMU/MA",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[19] ],["Swasta",daerah[20] ]]},
							   {name:"SMK",
							   id : "SMK",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[21] ],["Swasta",daerah[22] ]]},
							   {name:"Akademi/PT",
							   id : "Akademi/PT",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[23] ],["Swasta",daerah[23] ]]},
							   {name:"SLB",
							   id : "SLB",
							   colors : ['#78FE68','#85BAE5'],
							   data : [["Negeri",daerah[24] ],["Swasta",daerah[26] ]]}
							   ]},	
		}); 

		$('#dpkkesehatan').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Sarana Kesehatan'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.name}:  {point.percentage:.1f} %'},
								showInLegend: false}},
			series: [{
				name: 'Kesehatan',
				colorByPoint: true,
				data:	[{	name:'RS',
							color: '#BCAACF',
							y: daerah[29] ,
							sliced: false, selected: true},
						{	name:'RS Bersalin',
							color: '#FCB2DC',
							y: daerah[30] },
						{	name:'Puskesmas',
							color: '#FCD8FC',
							y: daerah[31]+daerah[32]+daerah[33] ,
							drilldown:'Puskesmas'},
						{	name:'Poliklinik',
							color: '#7CC7FC',
							y: daerah[34] },
						{	name:'Praktek',
							color: '#AEFC99',
							y: daerah[35] },
						{	name:'Praktek bidan',
							color: '#CC66C6',
							y: daerah[36] },
						{	name:'Unit desa',
							color: '#CF9154',
							y: daerah[37]+daerah[38]+daerah[39] ,
							drilldown:'Unit desa'},
						{	name :'Apotek',
							color: '#B9CBCC',
							y: daerah[40]  }]
				}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Puskesmas",
							   id : "Puskesmas",
							   colors : ['#AB9C9E','#C29856','#A3FF91'],
							   data : [["Rawat inap",daerah[31] ],["Tanpa rawat inap",daerah[32] ],["Pembantu",daerah[33] ]]},
							   {name:"Unit desa",
							   id : "Unit desa",
							   colors : ['#AB9C9E','#C29856','#A3FF91'],
							   data : [["Poskesdes",daerah[37] ],["Polindes",daerah[38] ],["Posyandu",daerah[39] ]]}
							 ]},
		}); 
		
		$('#dpktenaga').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Tenaga Kesehatan'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.name}: {point.percentage:.1f} %'},
								showInLegend: false}},
			series: [{
				name: 'Tenaga',
				colorByPoint: true,
				data:	[{	name:'Dokter',
							color: '#AEFC99',
							y: daerah[41]+daerah[42] ,
							drilldown: 'Dokter'},
						{	name:'Dokter gigi',
							color: '#FCB2DC',
							y: daerah[43] },
						{	name:'Bidan',
							color: '#CC66C6',
							y: daerah[44] },
						{	name:'Lainnya',
							color: '#CF9154',
							y: daerah[45] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Dokter",
							   id : "Dokter",
							   colors : ['#C5F6FF','#FCB6FF'],
							   data : [["Pria",daerah[41] ],["Wanita",daerah[42] ]]}
							 ]},
		});
		
		$('#dekonomi').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Sektor ekonomi'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.name}: {point.percentage:.1f} %'},
								showInLegend: false}},		
			series: [{
				name: 'Ekonomi',
				colorByPoint: true,
				data:	[{	name:'IMK',
							color: '#7C8FFF',
							y: daerah[46]+daerah[47]+daerah[48]+daerah[49]+daerah[50]+daerah[51]+daerah[52]+daerah[53] ,
							drilldown: 'IMK',
							sliced: false, selected: true},
						{	name:'Pasar',
							color: '#FF767F',
							y: daerah[54]+daerah[55]+daerah[56] ,
							drilldown: 'Pasar'},
						{	name:'Minimarket',
							color: '#FFF95C',
							y: daerah[57] },
						{	name:'Restoran',
							color: '#68FF77',
							y: daerah[58] },
						{	name:'Hotel',
							color: '#7CC4FF',
							y: daerah[59] },
						{	name:'Penginapan',
							color: '#9184A7',
							y: daerah[59] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},					 
					 series: [{name:"Industri menengah kecil",
							   id : "IMK",
							   colors : ['#FFD4AA','#A36356','#FFDA6D','#ADF6A1','#F29EF6','#A68EF6','#AFFFF4','#A1A3A3'],
							   data : [["Kulit",daerah[46] ],["Kayu",daerah[47] ],["Logam",daerah[48] ],["Anyaman",daerah[49] ],["Gerabah",daerah[50] ],["Kain/tenun",daerah[51] ],["Makanan",daerah[52] ],["lainnya",daerah[53] ]]},
							  {name:"Pasar",
							   id : "Pasar",
							   colors : ['#AB9C9E','#C29856','#A3FF91'],
							   data : [["Permanen",daerah[54] ],["Semi permanen",daerah[55] ],["Tanpa bangunan",daerah[56] ]]},
							  ]} 
		});
	
		$('#ebank').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Bank Umum'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.percentage:.1f} %'},
								showInLegend: true}},
			series: [{
				name: 'Bank Umum',
				colorByPoint: true,
				data:	[{	name:'Pemerintah',
							color: '#FFC09C',
							y: daerah[61] ,
							sliced: false, selected: true
							},
						 {	name:'Swasta',
							color: '#7E74FF',
							y: daerah[62] 
							}]
					}]
		});
	
		$('#dsbk').highcharts({
            chart: {plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie', height:220},
            credits: {enabled: false},
			title: {text: 'Proporsi Tempat Ibadah'},
			subtitle: {text: subgraf(tw)+' 2014'},
            tooltip: {pointFormat: 'Jumlah: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {pie:{	allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {enabled: true,
								format: '{point.name}: {point.percentage:.1f} %'},
								showInLegend: false}},		
			series: [{
				name: 'Tempat ibadah',
				colorByPoint: true, 
				data:	[{	name:'Masjid',
							color: '#79FF4A',
							sliced: false, selected: true,
							y: daerah[64] },
						{	name:'Surau',
							color: '#79FF9B',
							y: daerah[65] },
						{	name:'Gereja',
							color: '#E8DD45',
							y: daerah[66]+daerah[67] ,
							drilldown: 'Gereja'},
						{	name:'Kapel',
							color: '#D1AAC1',
							y: daerah[68] },
						{	name:'Pura',
							color: '#8870E8',
							y: daerah[69] },
						{	name:'Vihara',
							color: '#FF3F50',
							y: daerah[70] },
						{	name:'Klenteng',
							color: '#FF8441',
							y: daerah[71] }]
						}],
		drilldown:	{drillUpButton: {relativeTo: 'spacingBox',
					 position: {y: 30, x: -30}},
					 series: [{name:"Gereja",
							   id : "Gereja",
							   colors: ['#E8DA91','#B19FE8'],
							   data : [["Kristen",daerah[66] ],["Katolik",daerah[67] ]]}
							 ]}
		});
		
		
	
	
	});	
	
	}

