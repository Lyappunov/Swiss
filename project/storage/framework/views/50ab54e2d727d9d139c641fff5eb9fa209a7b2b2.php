<?php $__env->startSection('styles'); ?>

<link href="<?php echo e(asset('assets/admin/css/product.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('assets/admin/css/jquery.Jcrop.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('assets/admin/css/Jcrop-style.css')); ?>" rel="stylesheet"/>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading"><?php echo e(__('New Project')); ?> <a class="add-btn" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?></a></h4>
											<ul class="links">
												<li>
													<a href="javascript:;"><?php echo e(__('Projects')); ?> </a>
												</li>
                                                <li>
                                                    <a href="javascript:;"><?php echo e(__('New Project')); ?> </a>
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
												<div class="gocover" style="background: url(<?php echo e(asset('assets/images/'.$gs->admin_loader)); ?>) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
													<form id="geniusform" action="<?php echo e(route('project-create-new')); ?>" method="POST" enctype="multipart/form-data">
														<?php echo e(csrf_field()); ?>


														<?php echo $__env->make('includes.admin.form-both', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

														<div class="row">

															<div class="col-lg-6 col-12">
																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project Number')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project Number')); ?>" name="project_number" required="" value="<?php echo e($new_index); ?>" readonly>
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project Name')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project Name')); ?>" name="name" required="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Contact Date')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="date" class="input-field" placeholder="<?php echo e(__('Enter Date')); ?>" name="contact_date" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Your Ref')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter your ref')); ?>" name="ref">
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Offer Date ')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="date" class="input-field" placeholder="<?php echo e(__('Enter offer date')); ?>" name="offer_date">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Appointment Place')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter appointment place')); ?>" name="appointment_place">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project Object')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project object')); ?>" name="project_object" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project administration')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project administration')); ?>" name="project_administration" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project road')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project road')); ?>" name="project_road" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Project place')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project place')); ?>" name="project_place" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Customer')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<select name="customer_id" class="input-field" required="">
																			<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																				<option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
																			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																		</select>	
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Contact')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter Project contact')); ?>" name="contact" required="" value="">
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading"><?php echo e(__('Phone number')); ?>* </h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<input type="text" class="input-field" placeholder="<?php echo e(__('Enter phone number')); ?>" name="phone" required="" value="">
																	</div>
																</div>
															</div>

															<div class="col-lg-6 col-12">
																<div class="row">
																	<div class="col-lg-4">
																	<div class="left-area">
																		<h4 class="heading"><?php echo e(__('Project Image')); ?> *</h4>
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
																				<i class="icofont-upload-alt"></i> <?php echo e(__('Upload Image Here')); ?>

																			</a>
																	</div>
																</div>

																<input type="hidden" id="feature_photo" name="photo" value="">

																<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
																
																<div class="row">
																	<div class="col-lg-4">
																		<div class="left-area">
																			<h4 class="heading">
																				<?php echo e(__('Project Gallery Images')); ?>

																			</h4>
																		</div>
																	</div>
																	<div class="col-lg-7">
																		<a href="#" class="set-gallery"  data-toggle="modal" data-target="#setgallery">
																			<i class="icofont-plus"></i> <?php echo e(__('Set Gallery')); ?>

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
																							<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="<?php echo e(__('Enter Quantity')); ?>" min="0">
																							</div>

																							<div class="col-lg-6">
																							<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="<?php echo e(__('Enter Discount Percentage')); ?>" min="0" />
																							</div>
																						</div>
																					</div>
																				</div>

																				<a href="javascript:;" id="whole-btn" class="add-fild-btn"><i class="icofont-plus"></i> <?php echo e(__('Add More Field')); ?></a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

														</div>

														<div style="margin:30px 0px; text-align:center;">
															<img  src="<?php echo e(asset('assets/images/window1.png')); ?>" alt="" style="width:70%;">
														</div>

														<div class="project_table" id="project_table_1">
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
																		<th>Hinten H??he B(mm)</th>
																		<th>Vorne H??he C(mm)</th>
																		<th>M2</th>
																		<th>Menge</th>
																		<th>Produkt Bezeichnung</th>
																		<th>Notizen</th>
																		<th>
																			<span class="table-add" attr="1"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	<?php for($i=1;$i<=10;$i++): ?>
																		<tr>
																			<td contenteditable="true"><?php echo e($i); ?></td>
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
																	<?php endfor; ?>
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

														<span id="table_delete" class="btn btn-danger">
															Delete <i class="icofont-ui-delete"></i>
														</span>

														<div style="margin:30px 0px; text-align:center;">
															<img  src="<?php echo e(asset('assets/images/window2.png')); ?>" alt="" style="width:70%;">
														</div>

														<div class="order_table_1">
															<div style="text-align:center;">
																<h3>Maas und Infos Gef??ll Dach</h3>
															</div>
															<div id="order_table_1" class="order-table-editable" >
																<table class="table">
																	<tr>
																		<th attr="number">Pos</th>
																		<th attr="tech">Technische Info</th>
																		<th attr="rear">Hinten Maas (mm)</th>
																		<th attr="front">Vorne Maas (mm)</th>
																		<th attr="notify">Notize</th>
																		<th>
																			<span class="table-add-order" attr="1"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	<?php for($i=1;$i<=12;$i++): ?>
																		<tr>
																			<td contenteditable="true"><?php echo e($i); ?></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td>
																				<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																			</td>
																		</tr>
																	<?php endfor; ?>
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
																		<th attr="tech">Technische Info</th>
																		<th attr="rear">Hinten Maas (mm)</th>
																		<th attr="front">Vorne Maas (mm)</th>
																		<th attr="notify">Notize</th>
																		<th>
																			<span class="table-add-order" attr="2"><i class="icofont-plus-square"></i></span>
																		</th>
																	</tr>
																	<?php for($i=1;$i<=12;$i++): ?>
																		<tr>
																			<td contenteditable="true"><?php echo e($i); ?></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td contenteditable="true"></td>
																			<td>
																				<span class="table-remove glyphicon glyphicon-remove"><i class="icofont-ui-delete"></i></span>
																			</td>
																		</tr>
																	<?php endfor; ?>
																</table>
															</div>
														</div>																

														<input type="hidden" name="status" value="1" />
														
														<input type="hidden" id="project_table_info" name="project_table_info" value="">
														<input type="hidden" id="project_order_table_info" name="project_order_table_info" value="">
														<input type="hidden" name="admin_id" value="<?php echo e(Auth::guard('admin')->user()->id); ?>">

														<div class="text-center">
															<span onClick="onSumbitClick()" class="btn btn-primary"><?php echo e(__('Create Project')); ?></span>
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
					<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo e(__('Image Gallery')); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i><?php echo e(__('Upload File')); ?></label>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> <?php echo e(__('Done')); ?></a>
							</div>
							<div class="col-sm-12 text-center">( <small><?php echo e(__('You can upload multiple Images.')); ?></small> )</div>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

		<script src="<?php echo e(asset('assets/admin/js/jquery.Jcrop.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/admin/js/jquery.SimpleCropper.js')); ?>"></script>

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
									'<th>Hinten H??he B(mm)</th>' +
									'<th>Vorne H??he C(mm)</th>' +
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

<script src="<?php echo e(asset('assets/admin/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>