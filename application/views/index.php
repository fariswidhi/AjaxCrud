<!DOCTYPE html>
<html>
<script type="text/javascript">
		 
			function addCommas(nStr) {
				nStr += '';
				var comma = /,/g;
				nStr = nStr.replace(comma,'');
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}

</script>	
<head>
	<title>Index</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<div class="container" style="margin-top: 50px;">
<button class="btn btn-primary btn-act" data-name='add'  href="<?php echo base_url('Barang/add') ?>"> Tambah</button>
<br>
<br>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<h1></h1>
				<table class="table table-hover">
					<thead>
						<th>Barang</th><th>Harga</th><th>Opsi</th>
					</thead>
					<tbody id="wrap">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>


<style type="text/css">
	body{
		background: #eee;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		list();

	$(document).on('click',".update",function(){
		$.ajax({
			url: "<?php echo base_url('Barang/update/'); ?>"+$(this).data('id'),
			method: "POST",
			data: {
				barang: $(".name").val(),
				harga: $(".price").val()
			},
			dataType: 'json',
			success:function(r){

				if (r.result ==200) {
					$("#myModal").modal('hide');
					list();
				}
			}
		});
	});

	$(document).on('click',".insert",function(){
		$.ajax({
			url: "<?php echo base_url('Barang/insert'); ?>",
			method: "POST",
			data: {
				barang: $(".name").val(),
				harga: $(".price").val()
			},
			dataType: 'json',
			success:function(r){

				if (r.result ==200) {
					$("#myModal").modal('hide');
					list();
				}
			}
		});
	});
	$(document).on('click','.btn-delete',function(){
	$.ajax({
		url: $(this).attr("href"),
		dataType : 'json',
		success: function(r){
			if (r.result == 200) {
					$("#myModal").modal('hide');
					list();
			}
		}
	});
});


		function list(){
			$.ajax({
				url: "<?php echo base_url('Barang/get'); ?>",
				dataType:"json",
				success: function(r){
					var html ='';
					var i;

					for (i = 0;i < r.length; i++) {
						html += "<tr>";

						html += "<td>"+r[i].barang+"</td>";
						html += "<td>"+addCommas(r[i].harga)+"</td>";
						html += "<td><button data-name='edit' class='btn btn-act btn-update btn-success' href='<?php echo base_url('Barang/edit/'); ?>"+r[i].id_barang+"'>Edit</button> <button  class='btn-act btn btn-danger' data-name='delete' href='<?php echo base_url('Barang/delete/'); ?>"+r[i].id_barang+"'>Hapus</button></td>";
						html += "</tr>";
					}
					$("#wrap").html(html);

				}
			});
		setTimeout(list, 5000);	
		}
	});

	// aksi btn-act 
	$(document).on("click", ".btn-act",function(){
		var name = $(this).data('name');
		// jika data-name sama dengan edit;
		if (name=='edit') {
					$("#myModal .modal-title").html("Edit Data");
		
		$("#myModal .modal-body").load($(this).attr('href'));
		$("#myModal").modal('show');
		
		$("#myModal .modal-footer").html('<button type="button" class="btn btn-danger btn-close" data-dismiss="modal">Tutup</button>')
		}
		if (name=='add') {
		$("#myModal .modal-title").html("Tambah Data");
		
		$("#myModal .modal-body").load($(this).attr('href'));
		$("#myModal").modal('show');
		var href = $(this).attr("href");
		$("#myModal .modal-footer").html('<button type="button" class="btn btn-danger btn-close" data-dismiss="modal">Tutup</button>')
		}
		if(name=='delete'){
		$("#myModal .modal-title").html("Konfirmasi");		
		$("#myModal .modal-body").html("Apakah Anda Akan Menghapusnya?");
		$("#myModal").modal('show');
		var href = $(this).attr("href");
		$("#myModal .modal-footer").html('<button href="'+href+'" type="button" class="btn btn-danger btn-delete" data-dismiss="modal">Hapus</button>')
		}
	});


</script>
</body>
</html>
