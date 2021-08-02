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
										<h4 class="heading"> {{ __('Edit Project') }}<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
										<ul class="links">
											<li>
												<a href="javascript:;">{{ __('Projects') }}</a>
											</li>
											<li>
												<a href="javascript:;">{{ __('Edit') }}</a>
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
					                      <form id="geniusform" action="{{route('project-update',$data->id)}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}


                        						@include('includes.admin.form-both')

												<div class="row">

													<div class="col-lg-6 col-12">
														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																		<h4 class="heading">{{ __('Project Number') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project Number') }}" value="{{$data->project_number}}"  name="project_number" required="" readonly>
															</div>
														</div>
														
														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project Name') }}* </h4>
																	<p class="sub-heading">{{ __('(In Any Language)') }}</p>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project Name') }}" value="{{$data->name}}" name="name" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Contact Date') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="date" class="input-field" placeholder="{{ __('Enter Date') }}" value="{{$data->contact_date}}" name="contact_date" required="" value="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Your Ref') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter your ref') }}" value="{{$data->ref}}"  name="ref">
															</div>
														</div>
														
														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Offer Date ') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="date" class="input-field" placeholder="{{ __('Enter offer date') }}" value="{{$data->offer_date}}"  name="offer_date">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Appointment Place') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter appointment place') }}" value="{{$data->appointment_place}}"  name="appointment_place">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project Object') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project object') }}" value="{{$data->project_object}}"  name="project_object" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project administration') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project administration') }}" value="{{$data->project_administration}}"  name="project_administration" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project road') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project road') }}" value="{{$data->project_road}}" name="project_road" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Project place') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project place') }}" value="{{$data->project_place}}" name="project_place" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Customer') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<select name="customer_id" class="input-field" required="">
																	@foreach($customers as $customer)
																		@if($customer->id == $data->customer_id)
																			<option value="{{$customer->id}}" selected>{{$customer->name}}</option>
																		@else
																			<option value="{{$customer->id}}">{{$customer->name}}</option>
																		@endif
																	@endforeach
																</select>	
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Contact') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter Project contact') }}" value="{{$data->contact}}" name="contact" required="">
															</div>
														</div>

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																	<h4 class="heading">{{ __('Phone number') }}* </h4>
																</div>
															</div>
															<div class="col-lg-7">
																<input type="text" class="input-field" placeholder="{{ __('Enter phone number') }}" value="{{$data->phone}}" name="phone" required="">
															</div>
														</div>
													</div>

													<div class="col-lg-6 col-12">
														<div class="row">
															<div class="col-lg-4">
															<div class="left-area">
																<h4 class="heading">{{ __('Feature Image') }} *</h4>
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

														<input type="hidden" id="feature_photo" name="photo1" value="{{ $data->photo }}" accept="image/*">
														

														<div class="row">
															<div class="col-lg-4">
																<div class="left-area">
																		<h4 class="heading">
																			{{ __('Product Gallery Images') }} *
																		</h4>
																</div>
															</div>
															<div class="col-lg-7">
																<a href="javascript" class="set-gallery"  data-toggle="modal" data-target="#setgallery">
																	<input type="hidden" value="{{$data->id}}">
																		<i class="icofont-plus"></i> {{ __('Set Gallery') }}
																</a>
															</div>
														</div>
													</div>

												</div>

												<div style="margin:30px 0px; text-align:center;">
													<img  src="{{asset('assets/images/window1.png')}}" alt="" style="width:70%;">
												</div>

												@foreach ($table as $key => $value) 
													<div class="project_table" id="project_table_{{$key+1}}">
														<div style="text-align:center;">
															<h3>Varient {{ $key+1 }}</h3>
														</div>
														<div id="table_{{ $key+1 }}" class="table-editable" >
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
																		<span class="table-add" attr="{{ $key+1 }}"><i class="icofont-plus-square"></i></span>
																	</th>
																</tr>
																@foreach ($value as $key1 => $value1) 
																	<tr>
																		<td contenteditable="true">{{ $value1->{'pos'} }}</td>
																		<td contenteditable="true">{{ $value1->{'system'} }}</td>
																		<td contenteditable="true">{{ $value1->{'breite a(mm)'} }}</td>
																		<td contenteditable="true">{{ $value1->{'tiefe d(mm)'} }}</td>
																		<td contenteditable="true">{{ $value1->{'hinten höhe b(mm)'} }}</td>
																		<td contenteditable="true">{{ $value1->{'vorne höhe c(mm)'} }}</td>
																		<td contenteditable="true">{{ $value1->{'m2'} }}</td>
																		<td contenteditable="true">{{ $value1->{'menge'} }}</td>
																		<td contenteditable="true">{{ $value1->{'produkt bezeichnung'} }}</td>
																		<td contenteditable="true">{{ $value1->{'notizen'} }}</td>
																		<td>
																			<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																		</td>
																	</tr>
																@endforeach
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
													</div>
												
												@endforeach

												<span id="table_add" class="btn btn-primary">
													Add <i class="icofont-plus-circle"></i>
												</span>

												<span id="table_delete" class="btn btn-danger">
													Delete <i class="icofont-ui-delete"></i>
												</span>

												<div style="margin:30px 0px; text-align:center;">
													<img  src="{{asset('assets/images/window2.png')}}" alt="" style="width:70%;">
												</div>

												@foreach ($order_table as $key => $value) 
													<div class="order_table_{{$key+1}}">
														<div style="text-align:center;">
															@if($key == 0)
																<h3>Maas und Infos Gefäll Dach</h3>
															@else
																<h3>Maas und Infos Flach Dach</h3>
															@endif
														</div>
														<div id="order_table_{{ $key+1 }}" class="order-table-editable" >
															<table class="table">
																<tr>
																	<th attr="number">Pos</th>
																	<th attr="tech">Technische Info</th>
																	<th attr="rear">Hinten Maas (mm)</th>
																	<th attr="front">Vorne Maas (mm)</th>
																	<th attr="notify">Notize</th>
																	<th>
																		<span class="table-add-order" attr="{{ $key+1 }}"><i class="icofont-plus-square"></i></span>
																	</th>
																</tr>
																@foreach ($value as $key1 => $value1) 
																	<tr>
																		<td contenteditable="true">{{ $value1->{'number'} }}</td>
																		<td contenteditable="true">{{ $value1->{'tech'} }}</td>
																		<td contenteditable="true">{{ $value1->{'rear'} }}</td>
																		<td contenteditable="true">{{ $value1->{'front'} }}</td>
																		<td contenteditable="true">{{ $value1->{'notify'} }}</td>
																		<td>
																			<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																		</td>
																	</tr>
																@endforeach
																@if($key == 0)
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
																@endif
															</table>
														</div>
													</div>
												
												@endforeach

												<input type="hidden" id="project_table_info" name="project_table_info" value="">
												<input type="hidden" id="project_order_table_info" name="project_order_table_info" value="">

												<div class="text-center">
													<span onClick="onSumbitClick()" class="btn btn-primary">{{ __('Save') }}</span>
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
									<form  method="POST" enctype="multipart/form-data" id="form-gallery">
										{{ csrf_field() }}
									<input type="hidden" id="pid" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
											<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
									</form>
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
<script>
	function onSumbitClick()
	{
		get_varient_table_info();
		get_order_table_info();
		$("#geniusform").submit();

		var img = $('#feature_photo').val();

      $.ajax({
        url: "{{route('admin-prod-upload-update',$data->id)}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
          if (data.status) {
            $('#feature_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });

    

	}


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


<script type="text/javascript">

// Gallery Section Update

    $(document).on("click", ".set-gallery" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-show') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __('No Images Found.') }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }
                       }

                    }
                  });
      });


  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
	        type: "GET",
	        url:"{{ route('admin-gallery-delete') }}",
	        data:{id:id}
	    });
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
  });


  $("#uploadgallery").change(function(){
    $("#form-gallery").submit();
  });

  $(document).on('submit', '#form-gallery' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }
		    }

		                       }

		  });
		  return false;
 });


// Gallery Section Update Ends

</script>

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">

$('.cropme').simpleCropper();
$('#crop-image').on('click',function(){
$('.cropme').click();
});
</script>


  <script type="text/javascript">
  $(document).ready(function() {

    let html = `<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : asset('assets/images/projects/'.$data->photo) }}" alt="">`;
    $(".span4.cropme").html(html);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });


  $('.ok').on('click', function () {

 setTimeout(
    function() {


  	var img = $('#feature_photo').val();

      $.ajax({
        url: "{{route('admin-prod-upload-update',$data->id)}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
          if (data.status) {
            $('#feature_photo').val(data.file_name);
          }
          if ((data.errors)) {
            for(var error in data.errors)
            {
              $.notify(data.errors[error], "danger");
            }
          }
        }
      });

    }, 1000);



    });

  </script>

  <script type="text/javascript">

  $('#imageSource').on('change', function () {
    var file = this.value;
      if (file == "file"){
          $('#f-file').show();
          $('#f-link').hide();
      }
      if (file == "link"){
          $('#f-file').hide();
          $('#f-link').show();
      }
  });

  </script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
