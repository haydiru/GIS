<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mengatur Ulang Lagenda</h4>
      </div>
      <div class="modal-body">
        <p><b>Warna</b></p>
		<div class="row">
		
		<div class="col-md-6" style="padding-right:5px;"> 
		<p>Squential</p>
		<div id="warnaa" class="row">
		</div>
		</div>
	
		<div class="col-md-6" style="padding-right:5px;"> 
		<p>Diverging</p>
		<div  id="warnab" class="row">
		</div>
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script>
function warnalegenda(){
	$('#warnaa').html('');
	    for (var i = 0; i < warnaa.length; i++) {
			if(i==0) { $('#warnaa').append('<div id="warna'+i+'" class="col-md-1"><input type="radio" name="warnaa" value="'+i+'" checked>');
			}
			else {$('#warnaa').append('<div id="warna'+i+'" class="col-md-1"><input type="radio" name="warnaa" value="'+i+'">');}
			for (var j = 0; j < warnaa[i].length; j++) {
        $('#warna'+i).append('<div style="background:' + warnaa[i][j] + '; height:13px;width:13px"></div>');
    }
}
	    for (var i = 0; i < warnab.length; i++) {
			$('#warnab').append('<div id="warnab'+i+'" class="col-md-1"><input type="radio" name="warnaa" value="'+i+'">');
			for (var j = 0; j < warnab[i].length; j++) {
        $('#warnab'+i).append('<div style="background:' + warnab[i][j] + '; height:13px;width:13px"></div>');
    }
}

}
</script>