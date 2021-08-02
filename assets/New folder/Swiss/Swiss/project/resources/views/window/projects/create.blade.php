@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

@endsection
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __('New Project') }} <a class="add-btn" href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
											<ul class="links">
												<li>
													<a href="javascript:;">{{ __('Projects') }} </a>
												</li>
                                                <li>
                                                    <a href="javascript:;">{{ __('New Project') }} </a>
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
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project Name') }}* </h4>
																	<p class="sub-heading">{{ __('(In Any Language)') }}</p>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project Name') }}" name="name" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Contact Date') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="date" class="input-field" placeholder="{{ __('Enter Date') }}" name="contact_date" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Your Ref') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter your ref') }}" name="ref">
															</div>
														</div>
														
														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Offer Date ') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="date" class="input-field" placeholder="{{ __('Enter offer date') }}" name="offer_date">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Appointment Place') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter appointment place') }}" name="appointment_place">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																		<h4 class="heading">{{ __('Project Number') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project Number') }}" name="project_number" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project Object') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project object') }}" name="project_object" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project administration') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project administration') }}" name="project_administration" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project road') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project road') }}" name="project_road" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project place') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project place') }}" name="project_place" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Contact') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project contact') }}" name="contact" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Phone number') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter phone number') }}" name="phone" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
															<div class="left-area">
																<h4 class="heading">{{ __('Project Image') }} *</h4>
															</div>
															</div>
															<div class="col-lg-7">
																<div class="row">
																	<div class="panel panel-body">
																		<div class="span4 cropme text-center" id="landscape" style="width: 400px; height: 400px; border: 1px dashed black;">
																		</div>
																	</div>
																</div>

																	<a href="javascript:;" id="crop-image" class="d-inline-block mybtn1">
																		<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
																	</a>
															</div>
														</div>

														<input type="hidden" id="feature_photo" name="photo" value="">

														<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">
																		{{ __('Project Gallery Images') }} *
																	</h4>
																</div>
															</div>
															<div class="col-lg-7">
																<a href="#" class="set-gallery"  data-toggle="modal" data-target="#setgallery">
																	<i class="icofont-plus"></i> {{ __('Set Gallery') }}
																</a>
															</div>
														</div>

														<div class="showbox">
															<div class="row">
																<div class="col-lg-4">
																	<div class="left-area">

																	</div>
																</div>
																<div class="col-lg-7">
																	<div class="featured-keyword-area">
																		<div class="feature-tag-top-filds" id="whole-section">
																			<div class="feature-area">
																				<span class="remove whole-remove"><i class="fas fa-times"></i></span>
																				<div class="row">
																					<div class="col-lg-6">
																					<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __('Enter Quantity') }}" min="0">
																					</div>

																					<div class="col-lg-6">
																					<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __('Enter Discount Percentage') }}" min="0" />
																					</div>
																				</div>
																			</div>
																		</div>

																		<a href="javascript:;" id="whole-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
																	</div>
																</div>
															</div>
														</div>											
														
														<div class="project_table">
															<div style="text-align:center;">
																<h3>Varient 1</h3>
															</div>
															<div id="table_1" class="table-editable" >
																<table class="table">
																	<tr>
																		<th>Pos</th>
																		<th>System</th>
																		<th>Breite A(mm)</th>
																		<th>Tiefe D(mm)</th>
																		<th>Hinten Höhe B(mm)</th>
																		<th>Vorne Höhe C(mm)</th>
																		<th>M2</th>
																		<th>Menge</th>
																		<th>Produkt Bezeichnung</th>
																		<th>Notizen</th>
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
																	<tr class="hide">
																		<td contenteditable="true"></td>
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
																</table>
															</div>
															<p id="export"></p>
														</div>

														<span id="table_add" class="btn btn-primary">
															Add <i class="icofont-plus-circle"></i>
														</span>

														<input type="hidden" name="status" value="1" />
														
														<input type="hidden" id="project_table_info" name="project_table_info" value="">
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

	$("#table_add").click(function () {
		var current_id = $('.project_table').length + 1;
		
		var element = '<div class="project_table">' + 
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
