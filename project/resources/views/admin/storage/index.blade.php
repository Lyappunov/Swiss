@extends('layouts.admin')

@section('content')
					<input type="hidden" id="headerdata" value="{{ __('STORAGE') }}">
					<input type="hidden" id="attribute_data" value="{{ __('ADD NEW ATTRIBUTE') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Storage (Tires)') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-storage-index') }}">{{ __('Storage(Tires) List') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')

										<div class="table-responsiv">
												<table id="storagetable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th style='width:7%;'>{{ __('Customer Name') }}</th>
															<th style='width:7%;'>{{ __('Storage Location') }}</th>
															<th style='width:7%;'>{{ __('Storage ID') }}</th>
															<th style='width:7%;'>{{ __('Car License') }}</th>
															<th style='width:7%;'>{{ __('Car Make') }}</th>
															<th style='width:5%;'>{{ __('Quantity') }}</th>
															<th style='width:5%;'>{{ __('Tire Size') }}</th>
															<th style='width:9%;'>{{ __('Tire Brand') }}</th>
															<th style='width:9%;'>{{ __('Saving Months') }}</th>
															<th>{{ __('Status') }}</th>
															<th>{{ __('Actions') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

{{-- ADD / EDIT MODAL --}}

		<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="submit-loader">
							<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
					</div>
					<div class="modal-header" style="display:block">
						<h5 class="modal-title"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>										
					</div>
					<div class="modal-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
					</div>
				</div>
			</div>
		</div>

{{-- ADD / EDIT MODAL ENDS --}}



{{-- ATTRIBUTE MODAL --}}

										<div class="modal fade" id="attribute" tabindex="-1" role="dialog" aria-labelledby="attribute" aria-hidden="true">

										<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
											</div>
										</div>
										</div>
</div>

{{-- ATTRIBUTE MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Storage(Tire).') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection


@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#storagetable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
			   filtering:true,
               ajax: '{{ route('admin-storage-datatables') }}',
               columns: [
               			{ data: 'customer_name', name: 'customer_name'},
               			{ data: 'location', name: 'location'},
               			{ data: 'storage_id', name: 'storage_id'},
               			{ data: 'car_license', name: 'car_license'},
               			{ data: 'car_make', name: 'car_make'},
						{ data: 'quantity', name: 'quantity' },
						{ data: 'tire_size', name: 'tire_size' },
						{ data: 'tire_brand', name: 'tire_brand' },
						{ data: 'saving_months', name: 'saving_moths' },
						{ data: 'status', name: 'status' },
						{ data: 'action', searchable: false, orderable: false }
								],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();
				}
            });
			$(function() {
				$(".btn-area").append('<div class="col-sm-4 table-contents">'+
					'<select class="form-control" id="filtering_data">'+
						'<option value="">{{__("-- Select Status --")}}</option>'+
						'<option value="new">{{__("New")}}</option>'+
						'<option value="picked up">{{__("Picked Up")}}</option>'+
						'<option value="booked">{{__("Booked")}}</option>'+
						'<option value="stand by">{{__("Stand By")}}</option>'+
						'<option value="trashed">{{__("Trashed")}}</option>'+
					'</select>'+
				'</div>');
			});
$(document).on('change','#filtering_data',function(e){
	var value = $(this).val().toLowerCase();
    $("#storagetable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

{{-- DATA TABLE ENDS--}}

</script>

@endsection
