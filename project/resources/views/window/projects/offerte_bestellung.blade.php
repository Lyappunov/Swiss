@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

@endsection
@section('content')
					<?php 
						$name_array = array('Toplam Ürün','SANDIK BEDELİ','İSTANBUL NAKLİYE','İSTANBUL NAKLİYE','VERZOLLUNG ','MWST','MONTAJ','Toplam PAKETLEME  Nakliye Ve Montaj','GENEL TOPLAM Tüm maliyet');
						$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L');
					?>
						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __('Offerte Bestellung') }} <a class="add-btn" href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
											<ul class="links">
												<li>
													<a href="javascript:;">{{ __('Dashboard') }} </a>
												</li>
                                                <li>
                                                    <a href="javascript:;">{{ __('Offerte Bestellung') }} </a>
                                                </li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">
												<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
													<form id="geniusform" action="{{route('project-create-new')}}" method="POST" enctype="multipart/form-data">
														{{csrf_field()}}

														@include('includes.admin.form-both')

														<div class="row">

															<div class="col-lg-6 col-12">
																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading">{{ __('Offerte Firma:') }}* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="{{ __('Enter Project Number') }}" name="project_number" required="" value="{{$new_index}}" readonly>
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading">{{ __('Adresse:') }}* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="{{ __('Enter Project Name') }}" name="name" required="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading">{{ __('Kontakt Person:') }}* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="{{ __('Enter Project Name') }}" name="name" required="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading">{{ __('Tel:') }}* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="{{ __('Enter your ref') }}" name="ref">
																	</div>
																</div>
																
																
															</div>

														</div>

														<div style="margin:30px 0px; text-align:center;">
															<img  src="{{asset('assets/images/window1.png')}}" alt="" style="width:70%;">
														</div>

														<div class="project_table" id="project_table_1">
															<div style="text-align:center;">
																<h3>Varient 1</h3>
															</div>
															<div id="table_1" class="table-editable" >
																
																<table class="table">
																	<tr>
																		<td colspan='10'>Project</td>
																	</tr>
																	<tr>
																		<td colspan='3'>Proje No:</td>
																		<td colspan='5'>Tras Kapama</td>
																		<td colspan='2'>TARİH:</td>
																	</tr>
																	<tr>
																		<th>Pos</th>
																		<th>System</th>
																		<th>EN A (mm)</th>
																		<th>BOY D (mm)</th>
																		<th>Arka Yüksek B (mm)</th>
																		<th>Ön Yüksek C (mm)</th>
																		<th>M2</th>
																		<th>AD.</th>
																		<th>AÇIKLAMA</th>
																		<th>Fiyati</th>
																		<th>
																			<span class="table-add" attr="1"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	@for($i=1;$i<=10;$i++)
																		<tr>
																			<td contenteditable="true">{{$i}}</td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td>
																				<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																			</td>
																		</tr>
																	@endfor
																	@for($j = 0; $j < sizeof($name_array); $j++)
																		<tr>
																			<td>{{$j+11}}</td>
																			<td>{{$name_array[$j]}}</td>
																			<td colspan='7'>&nbsp;</td>
																			<td>&nbsp;</td>
																		</tr>
																	@endfor
																	<tr>
																	</tr>
																</table>
															</div>
															<p id="export"></p>
														</div>

														<span id="table_add" class="btn btn-primary">
															Add <i class="icofont-plus-circle"></i>
														</span>

														<span id="table_delete" class="btn btn-danger">
															Delete <i class="icofont-ui-delete"></i>
														</span>

														<div style="margin:30px 0px; text-align:center;">
															<img  src="{{asset('assets/images/window2.png')}}" alt="" style="width:70%;">
														</div>

														<div class="order_table_1">
															<div style="text-align:center;">
																<h3 style="color:red">Ölcüler ve Bilgiler Egimli Cati</h3>
															</div>
															<div id="order_table_1" class="order-table-editable" >
																
																<table class="table">
																	<tr>
																		<th attr="number">Pos</th>
																		<th attr="tech">Teknik Aciklama</th>
																		<th attr="rear">Arka Ölcü (mm)</th>
																		<th attr="front">Ön Ölcü (mm)</th>
																		<th attr="notify">Not</th>
																		<th>
																			<span class="table-add-order" attr="1"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	@for($i=0; $i < sizeof($alphabet);$i++)
																		<tr>
																			<td contenteditable="true">{{$alphabet[$i]}}</td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td>
																				<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																			</td>
																		</tr>
																	@endfor
																	<tr class="hide_order">
																		<td contenteditable="true"></td>
																		<td contenteditable="true"></td>
																		<td contenteditable="true"></td>
																		<td contenteditable="true"></td>
																		<td contenteditable="true"></td>
																		<td>
																			<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																		</td>
																	</tr>
																</table>
															</div>
														</div>

														<div class="order_table_2">
															<div style="text-align:center;">
																<h3>Maas und Infos Flach Dach</h3>
															</div>
															<div id="order_table_2" class="order-table-editable" >
																<table class="table">
																	<tr>
																		<th attr="number">Pos</th>
																		<th attr="tech">Teknik Aciklama</th>
																		<th attr="rear">Arka Ölcü (mm)</th>
																		<th attr="front">Ön Ölcü (mm)</th>
																		<th attr="notify">Not</th>
																		<th>
																			<span class="table-add-order" attr="2"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	@for($i = 0; $i < sizeof($alphabet);$i++)
																		<tr>
																			<td contenteditable="true">{{$alphabet[$i]}}</td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td>
																				<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																			</td>
																		</tr>
																	@endfor
																</table>
															</div>
														</div>																

														<input type="hidden" name="status" value="1" />
														
														<input type="hidden" id="project_table_info" name="project_table_info" value="">
														<input type="hidden" id="project_order_table_info" name="project_order_table_info" value="">
														<input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">

														<div class="text-center">
															<span onClick="onSumbitClick()" class="btn btn-primary">{{ __('Create Project') }}</span>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

		<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
							</div>
							<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
						</div>
					</div>
					<div class="gallery-images">
						<div class="selected-image">
							<div class="row">
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>

@endsection

@section('scripts')

		<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
		<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script>
	function onSumbitClick()
	{
		get_varient_table_info();
		get_order_table_info();
		$("#geniusform").submit();
	}
</script>



<script type="text/javascript">

// Gallery Section Insert

  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $('#galval'+id).remove();
    $(this).parent().parent().remove();
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
     $('.selected-image .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });


  $("#uploadgallery").change(function(){
     var total_file=document.getElementById("uploadgallery").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+i+'">'+
                                            '</span>'+
                                            '<a href="'+URL.createObjectURL(event.target.files[i])+'" target="_blank">'+
                                            '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  '</div> '
                                      );
      $('#geniusform').append('<input type="hidden" name="galval[]" id="galval'+i+'" class="removegal" value="'+i+'">')
     }

  });

// Gallery Section Insert Ends

</script>

<script type="text/javascript">
	$('.cropme').simpleCropper();
	$('#crop-image').on('click',function(){
		$('.cropme').click();
	});
</script>

<script>
	// var $TABLE = $('#table');
	var $BTN = $('#export-btn');
	// var $EXPORT = $('#export');

	

	$("#geniusform").on("click", ".table-remove", function(){
		$(this).parents('tr').detach();
	});

	$("#geniusform").on("click", "span.table-add", function(){
		var id = $(this).attr('attr');
		var $TABLE = $('#table_'+id);
		var tr_count = $('#table_' + id + ' tr').length;
		
		if( id > 1 )
			$('tr.hide td:first-child').html(tr_count);
		else
			$('tr.hide td:first-child').html(tr_count - 1);

		var $clone = $('tr.hide').clone(true).removeClass('hide table-line');
		$TABLE.find('table').append($clone);
	});

	$("#geniusform").on("click", "span.table-add-order", function(){
		var id = $(this).attr('attr');
		var $TABLE = $('#order_table_'+id);
		var tr_count = $('#order_table_' + id + ' tr').length;
		
		if( id > 1 )
			$('tr.hide_order td:first-child').html(tr_count);
		else
			$('tr.hide_order td:first-child').html(tr_count - 1);

		var $clone = $('tr.hide_order').clone(true).removeClass('hide_order table-line');
		$TABLE.find('table').append($clone);
	});


	// $('.table-up').click(function () {
	// 	var $row = $(this).parents('tr');
	// 	if ($row.index() === 1) 
	// 		return; // Don't go above the header
	// 	$row.prev().before($row.get(0));
	// });

	// $('.table-down').click(function () {
	// 	var $row = $(this).parents('tr');
	// 	$row.next().after($row.get(0));
	// });

	// A few jQuery helpers for exporting only
	jQuery.fn.pop = [].pop;
	jQuery.fn.shift = [].shift;

	function get_varient_table_info() {

		var all_varient = {};
		$('.table-editable').each(function(i, obj) {
			var $TABLE = $(this);
			var $rows = $TABLE.find('tr:not(:hidden)');
			var headers = [];
			var data = [];
			
			// Get the headers (add special header logic here)
			$($rows.shift()).find('th:not(:empty)').each(function () {
				headers.push($(this).text().toLowerCase());
			});
			headers.pop();
			
			$rows.each(function () {
				var $td = $(this).find('td');
				var h = {};
				headers.forEach(function (header, i) {
					h[header] = $td.eq(i).text();   
				});
				data.push(h);
			});
			all_varient[i] = data;
		});
		
		$("#project_table_info").val(JSON.stringify(all_varient));
	};

	function get_order_table_info() {

		var all_orders = {};
		$('.order-table-editable').each(function(i, obj) {
			var $TABLE = $(this);
			var $rows = $TABLE.find('tr:not(:hidden)');
			var headers = [];
			var data = [];
			
			// Get the headers (add special header logic here)
			$($rows.shift()).find('th:not(:empty)').each(function () {
				headers.push($(this).attr('attr'));
			});
			headers.pop();
			
			$rows.each(function () {
				var $td = $(this).find('td');
				var h = {};
				headers.forEach(function (header, i) {
					h[header] = $td.eq(i).text();   
				});
				data.push(h);
			});
			all_orders[i] = data;
		});

		$("#project_order_table_info").val(JSON.stringify(all_orders));
	};

	$("#table_delete").click(function () {
		var current_id = $('.project_table').length;
		if(current_id == 1)
		{
			alert("You need to input at least table.");
			return;
		}
		$('#project_table_' + current_id).remove();
	});
	$("#table_add").click(function () {

		var current_id = $('.project_table').length + 1;
		
		var element = '<div class="project_table" id="project_table_' + current_id + '">' + 
						'<div style="text-align:center;">' +
							'<h3>Varient ' + current_id + '</h3>' +
						'</div>' +
						'<div id="table_' + current_id + '" class="table-editable" >' + 
							'<table class="table">' +
								'<tr>' +
									'<th>Pos</th>' +
									'<th>System</th>' +
									'<th>Breite A(mm)</th>' +
									'<th>Tiefe D(mm)</th>' +
									'<th>Hinten Höhe B(mm)</th>' +
									'<th>Vorne Höhe C(mm)</th>' +
									'<th>M2</th>' +
									'<th>Menge</th>' +
									'<th>Produkt Bezeichnung</th>' +
									'<th>Notizen</th>' +
									'<th>' +
										'<span class="table-add" attr="' + current_id + '"><i class="icofont-plus-square"></i></span>' +
									'</th>' +
								'</tr>';
		for(var i=1;i<=10;i++)
		{
			var row = '<tr>' +
				'<td contenteditable="true">' + i + '</td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td contenteditable="true"></td>' +
				'<td>' +
					'<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>' +
				'</td>' + 
			'</tr>';
			element += row;
		}
		element += '</table></div></div>';
		$('div.project_table:last').after(element);
	});
</script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
