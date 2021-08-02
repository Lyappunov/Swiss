@extends('layouts.admin')

@section('content')
<body style="background-color: #00ff6c;">
  
</body>
  <div class="content-area" style="padding-right: 100px; padding-left: 100px;">
    <div class="mr-breadcrumb">
      <div class="row">
        <div class="col-lg-12" style="display:block">
            <h4 class="heading"> {{ __('Tire Detail View') }} 
              <a class="add-btn float-right" href="{{ route('admin-storage-index') }}" ><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
            </h4>
            <ul class="links">
                <li>
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                </li>
                <li>
                    <a href="{{ route('admin-storage-index') }}">{{ __('Storage(Tire) List') }} </a>
                </li>
                <li>
                    <a href="javascript:;">{{ __('Details View') }}</a>
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
            <form id="geniusform" action="{{route('admin-storage-pickup',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              @include('includes.admin.form-both')
              <input type='hidden' name='hotel_id' value='{{ $data->hotel_id }}'>
              <input type='hidden' id='storage_idx' value='{{ $data->storage_idx }}'>
              <input type='hidden' id='staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>
              <input type='hidden' id='detail_flg' value='detail'>
              <div style='text-float : center;'>
                <div class="action-list">
                  <?php 
                    $class='';
                    $status='';

                    $today = new DateTime(date("Y-m-d h:i:sa"));
                    $register_date = new DateTime($data->created_at);
                    $interval = $register_date->diff($today);
                    $diffInDays    = $interval->d; //21
                    $diffInMonths  = $interval->m; //4
                    $diffInYears   = $interval->y; //1
                    $pure_months = $diffInYears*12 + $diffInMonths;
                    $title ='';
                    if($pure_months >=9 && $pure_months < 12) $title = 'More than 9 months';
                    else if($pure_months >= 12) $title = 'More than 12 months';
                    if($data->is_picked_up==2){$class = 'drop-trash'; $status='Trashed';}
                    else {
                        if($data->is_booking == 1&&$data->is_picked_up == 0) {$class = 'drop-danger'; $status='Booked';}
                        if($data->is_booking == 1&&$data->is_picked_up == 1) {$class = 'drop-success'; $status='Picked Up';}
                        if($data->is_booking == 0&&$data->is_picked_up == 0) {$class = 'drop-warning'; $status='Stand By';}
                        if($data->is_booking == 0&&$data->is_picked_up == 3) {$class = 'drop-new'; $status='NEW';}
                    }
                  ?>
                  <a class="{{ $class }}">{{ __($status) }}</a>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Storage ID') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="storage_ID" required="" disabled value="{{ $data->storage_ID }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Register Date') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="created_at" disabled value="{{ $data->created_at }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Saving Months') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="created_at" disabled value="{{ $pure_months.' (Months)' }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Storage Location') }} </h4>
                      <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                  </div>
                </div>
                <?php
                  $disabled = 'disabled';
                  $col_lg = 'col-lg-7';
                  if($status == 'NEW') {$disabled = '';
                    $col_lg = 'col-lg-4';}
                ?>
                <div class="{{ $col_lg }}">
                  <input type="text" class="input-field" name="location" {{$disabled}} value="{{ $data->location }}">
                </div>
                @if($status == 'NEW')
                <div class="col-lg-3">
                  <a class="add-btn float-left" data-href="{{ route('admin-location-saving',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id]) }}" id='location_btn'> {{ __('SAVE') }}</a>
                </div>
                @endif
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Fulll Name of Customer') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="customer_name" placeholder="{{ __('Enter Name') }}" required="" disabled value="{{ $data_detail->customer_name }}">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Social ID') }} </h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="social_id" placeholder="{{ __('Enter Social ID') }}" disabled value="{{ $data_detail->social_id }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Home Address') }} </h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="home_address" placeholder="{{ __('Enter Home Address') }}" disabled value="{{ $data_detail->home_address }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Phone Number') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="phone" placeholder="{{ __('Enter Phone Number') }}" required='' disabled value="{{ $data_detail->phone }}">
                </div>
              </div>
              <div class="row">
                
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Email') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="email" placeholder="{{ __('Enter Email') }}" required='' disabled value="{{ $data_detail->email }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Car License Plate') }}</h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="car_license" placeholder="{{ __('Enter Car License Plate') }}" disabled value="{{ $data->car_license }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Car Make') }}</h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="car_make" placeholder="{{ __('Enter Car Make') }}" disabled value="{{ $data->car_make }}">
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Quantity of Tire') }} </h4>
                      <p class="sub-heading">{{ __('(In Number)') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="quantity" placeholder="{{ __('Enter Quantity of Tire') }}" required="" disabled value="{{ $data->quantity }}">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Tire Size') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="tire_size" placeholder="{{ __('Enter Tire Size') }}" disabled value="{{ $data->tire_size }}">
                </div>
              </div>
              <div class="row" id='rim_size'>
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Rim Size') }} </h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="rim_size" placeholder="{{ __('Enter Rim Size') }}" disabled value="{{ $data->rim_size }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Tire Brand') }} </h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="tire_brand" placeholder="{{ __('Enter Tire Brand') }}" disabled value="{{ $data->tire_brand }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Condition') }} </h4>
                      <p class="sub-heading">{{ __('In Any Language') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="condition" placeholder="{{ __('Enter the condition of your tires.') }}" disabled value="{{ $data->condition }}">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Tire photo') }} </h4>
                  </div>
                </div>
                <!-- <div class="col-lg-7">
                  <div class="img-upload">
                      <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/images/storage/'.$data->photos) }});">
                          
                          <a href="{{ asset('assets/images/storage/'.$data->photos) }}"><i class="fas fa-eye"></i> {{ __('VIEW PHOTO') }}</a>
                          <input type="file" name="photos" class="img-upload" id="image-upload">
                        </div>
                  </div>

                </div> -->
                <div class='col-lg-7'>
                    <div class="row">
                      <div class="col-lg-6 col-md-12">
                        <div class="xzoom-container">
                            <img class="xzoom5" id="xzoom-magnific" src="{{filter_var($data->photos, FILTER_VALIDATE_URL) ?$data->photos:asset('assets/images/storage/'.$data->photos)}}" xoriginal="{{filter_var($data->photos, FILTER_VALIDATE_URL) ?$data->photos:asset('assets/images/storage/'.$data->photos)}}" />
                            <div class="xzoom-thumbs">

                              <div class="all-slider">

                                  <a href="{{filter_var($data->photos, FILTER_VALIDATE_URL) ?$data->photos:asset('assets/images/storage/'.$data->photos)}}">
                                  <img class="xzoom-gallery5" width="80" src="{{filter_var($data->photos, FILTER_VALIDATE_URL) ?$data->photos:asset('assets/images/storage/'.$data->photos)}}" title="The description goes here">
                                  </a>
                              </div>

                            </div>
                        </div>
                      </div>
                      <div class='col-lg-6 col-md-12'></div>
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-lg-4">
                    <div class="left-area">
                        <h4 class="heading">{{ __('Summer / Winter') }} </h4>
                    </div>
                  </div>
                  <div class="col-lg-7">
                  <?php 
                    $is_summer_checked='';
                    if($data->weather==1)$is_summer_checked='checked'; 
                    $is_winter_checked='';
                    if($data->weather==0)$is_winter_checked='checked'; 
                  ?>
                  <input type='hidden' name='weather_mail' value='{{ $data->weather==1?"for summer":"for winter" }}'>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="summer" name="weather" class="custom-control-input" disabled value='1' {{ $is_summer_checked }}>
                        <label class="custom-control-label" for="summer">{{ __('Summer') }}</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="winter" name="weather" class="custom-control-input" disabled value='0' {{ $is_winter_checked }}>
                        <label class="custom-control-label" for="winter">{{ __('winter') }}</label>
                      </div>
                  </div>
              </div>
                <br>
              <div class="row">
                  <div class="col-lg-4">
                    <div class="left-area">
                        <h4 class="heading">{{ __('Is your Tire on Rim') }} </h4>
                    </div>
                  </div>
                  <div class="col-lg-7">
                  <?php 
                    $is_yes_checked='';
                    $display = '';
                    if($data->is_rim==1){$is_yes_checked='checked'; $display='show';} 
                    $is_no_checked='';
                    if($data->is_rim==0){$is_no_checked='checked';$display='none';} 
                  ?>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="rim_yes" name="is_rim" class="custom-control-input" disabled value='1' {{ $is_yes_checked }}>
                        <label class="custom-control-label" for="rim_yes">{{ __('Yes') }}</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="rim_no" name="is_rim" class="custom-control-input" disabled value='0' {{ $is_no_checked }}>
                        <label class="custom-control-label" for="rim_no">{{ __('No') }}</label>
                      </div>
                  </div>
              </div>
              <?php 
                $disabling ='';
                if(Auth::guard('admin')->user()->role_id != 0)$disabling='disabled';
              ?>
              <div class="row">
                <div class="col-lg-3">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Invoice Number') }} </h4>
                  </div>
                </div>
                <div class="col-lg-6">
                  <input type="text" class="input-field" name="invoice_number" placeholder="{{ __('Enter Invoice Number') }}" {{ $disabling }} value="{{ $data->invoice_number }}">
                </div>
                <div class="col-lg-3">
                @if(Auth::guard('admin')->user()->role_id == 0)
                  <a class="add-btn float-left" data-href="{{ route('admin-storage-saving',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id]) }}" id='saving_btn'> {{ __('SAVE') }}</a>
                @endif
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3">
                  <div class="left-area">
                      <h4 class="heading">{{ __('Paid') }} </h4>
                  </div>
                </div>
                <div class="col-lg-6">
                  <input type="text" class="input-field" name="paid" placeholder="{{ __('Enter the Amount that was Paid') }}" {{ $disabling }} value="{{ $data->paid }}">
                </div>
              </div>
              <br>
              
              <div class="row">
                <div class="col-lg-2">
                  <div class="left-area">
                  @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('mark_booking'))
                    @if($data->is_picked_up != 2)
                      @if($data->is_booking == 0 && $data->is_picked_up==3)
                          <button class="addProductSubmit-btn" data-href="{{route('admin-storage-booking',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='stand_btn'>{{ __('To Stand By') }}</button>
                      @elseif($data->is_booking==0 && $data->is_picked_up==0)
                        <button class="addProductSubmit-btn" data-href="{{route('admin-storage-backToNew',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='backnew_btn'>{{ __('BACK TO NEW') }}</button>
                      @endif
                    @endif
                  @endif
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="left-area">
                  @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('mark_booking'))
                    @if($data->is_picked_up != 2)
                      @if($data->is_booking == 0 && $data->is_picked_up==0)
                          <button class="addProductSubmit-btn" data-href="{{route('admin-storage-booking',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='booking_btn'>{{ __('BOOKING') }}</button>
                      @elseif($data->is_booking==1 && $data->is_picked_up==0)
                        <button class="addProductSubmit-btn" data-href="{{route('admin-storage-backstand',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='backstand_btn'>{{ __('BACK TO STAND BY') }}</button>
                      @endif
                    @endif
                  @endif
                  </div>
                </div>
                <div class="col-lg-2">
                @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('mark_picked_up'))
                  @if($data->is_picked_up != 2)
                    @if($data->is_booking == 1 && $data->is_picked_up == 0)
                        @if($pure_months >= 9)
                        <button data-toggle="modal" data-target="#message_modal" class="addProductSubmit-btn" type="submit">{{ __('PICKED UP!') }}</button>
                        @elseif($pure_months < 9)
                        <button class="addProductSubmit-btn" type="submit">{{ __('PICKED UP!') }}</button>
                        @endif
                    @elseif($data->is_booking == 1 && $data->is_picked_up == 1)
                        <button class="addProductSubmit-btn" data-href="{{route('admin-storage-backstand',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='backbook_btn'>{{ __('BACK TO BOOKED') }}</button>
                    @endif
                  @endif
                @endif
                </div>
                <div class="col-lg-2">
                @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('mark_trash'))
                  @if($data->is_picked_up != 2)
                      <button class="addProductSubmit-btn" data-href="{{route('admin-storage-trash',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='trash_btn'>{{ __('TRASH!') }}</button>
                  @elseif($data->is_picked_up == 2)
                      <button class="addProductSubmit-btn" data-href="{{route('admin-storage-backStandTrash',['id'=>$data->storage_idx, 'staff'=>Auth::guard('admin')->user()->id])}}" type="button" id='backStandTrash_btn'>{{ __('BACK TO NEW') }}</button>
                  @endif    
                @endif
                </div>
                <div class="col-lg-1">
                @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('print_sticker'))
                  @if($data->is_picked_up != 2)
                    <a class="add-btn float-right" href="{{ route('admin-storage-sticker', $data->storage_idx) }}" target="_blank"> {{ __('PRINT STICKER') }}</a>
                  @endif
                @endif
                </div>
                <div class="col-lg-1">
                @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('print_ticket'))
                  @if($data->is_picked_up != 2)
                    <a class="add-btn float-left" href="{{ route('admin-storage-ticket',$data->storage_idx) }}" target="_blank"> {{ __('PRINT TICKET') }}</a>
                  @endif
                @endif
                </div>
                <div class="col-lg-2">
                @if(Auth::guard('admin')->user()->role_id == 0 || Auth::guard('admin')->user()->sectionCheck('send_email'))
                  <a data-toggle="modal" data-target="#vendorform" class="mybtn1 ml-3 float-right" href="javascript:;"><i class="fas fa-envelope"></i> {{ __('SEND E-MAIL') }}</a>
                  @endif
                </div>
              </div>
              <div class='row' style="margin-bottom:30px;">
                <div class='col-lg-12'>
                  <div style="padding:15px; border-bottom: 1px solid grey;">
                    <h3>{{ __('Logs of This Tire') }}</h3>
                  </div>
                </div>
              </div>
              @foreach($data_logs as $log)
              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                      <h4 class="heading">{{ $log->created_at.' : ' }} </h4>
                  </div>
                </div>
                <?php
                  $contents_person = '';
                  if($log->staff_id != null) $contents_person = App\Models\Admin::where('id', $log->staff_id)->first()->name;
                ?>
                <div class="col-lg-7">
                  <input type="text" class="input-field" value="{{ $log->content.' by '.$contents_person }}" disabled>
                </div>
              </div>
              @endforeach
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
            {{-- 9 or 12 months modal --}}
            <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

              <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="submit-loader">
                      <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
                  </div>
                <div class="modal-header" style="display:block">
                  <h3 class="modal-title" style='color:red; font-weight:bold'>{{ $title }}</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>                                     
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-5">
                      <div class="left-area">
                          <h4 class="heading">{{ __('Register Date : ') }} </h4>
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <h4  style='font-weight:bold;'>{{ $data->created_at }}</h4>
                    </div>
                  </div>
                  @if($pure_months >= 9 && $pure_months < 12)
                    <p style='font-size:16px; font-weight:bold'>{{ __('This tire has been 9 months since you have registered.') }}</p>
                    <p style='font-size:16px; font-weight:bold'>{{ __('Exactly '.$pure_months.' months and '.$diffInDays.' days.') }}</p>
                    <p style='font-size:16px; font-weight:bold'>{{ __('You need to charge additional price') }}</p>
                  @elseif($pure_months >= 12)
                    <p style='font-size:16px; font-weight:bold'>{{ __('This tire has been 12 months since you have registered.') }}</p>
                    <p style='font-size:16px; font-weight:bold'>{{ __('Exactly '.$pure_months.' months and '.$diffInDays.' days.') }}</p>
                    <p style='font-size:16px; font-weight:bold'>{{ __('You need to charge additional price.') }}</p>
                  @endif
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
              </div>
              </div>
            </div>
            {{-- 9 or 12 months modal end-- }}
            {{-- MESSAGE MODAL --}}
<div class="message-modal">
  <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang362 }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form id="emailreply">
                    {{csrf_field()}}
                    <input type='hidden' id='mail_storage_idx' value='{{ $data->storage_idx }}'>
                    <input type='hidden' id='mail_staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>
                    <input type='hidden' id='mail_customer_name' name='mail_customer_name' value='{{ $data_detail->customer_name }}'>
                    <ul>

                      <li>
                        <input type="email" class="input-field" id="eml" name="email" placeholder="{{ $langg->lang363 }} *" required="" value="{{ $data_detail->email }}">
                      </li>


                      <li>
                        <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ $langg->lang364 }} *" required="" value="{{ __('Vinsamlegast athugaðu hvort eftirfarandi atriði eru rétt.') }}">
                      </li>

                      <li>
                        <p style='font-size:18x; font-weight:bold;'>{{ __('Dekkið þitt hefur verið skráð rétt í verslun okkar.') }}</p>
                        <p style='font-size:18x; font-weight:bold;'>{{ __('Vinsamlegast athugaðu hvort eftirfarandi atriði eru rétt.') }}</p>
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Number Plate') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="car_license" name="mail_number_plate" placeholder="{{ __('Number Plate') }} " value="{{ $data->car_license }}">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Storage ID') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="storage_id" name="storage_id" placeholder="{{ __('Storage ID') }} " value="{{ $data->storage_ID }}">
                          </div>
                        </div>
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Tire Size') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="size" name="size" placeholder="{{ __('Tire Size') }}" value="{{ $data->tire_size }}">
                          </div>
                        </div> 
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Tire Brand') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="brand" name="brand" placeholder="{{ __('Tire Brand') }}" value="{{ $data->tire_brand }}">
                          </div>
                        </div>  
                      </li>
                      
                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Fjöldi dekkja') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="qty" name="qty" placeholder="{{ __('Fjöldi dekkja') }}" value="{{ $data->quantity }}">
                          </div>
                        </div>
                        
                        
                      </li>

                      <li>
                      <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Is Rim') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="is_rim" name="is_rim" placeholder="{{ __('Is Rim') }}" value="{{ $data->is_rim==1?'Yes':'No' }}">
                          </div>
                        </div>  
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('S/W') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="weather" name="weather" placeholder="{{ __('S/W') }}" value="{{ $data->weather==1?'for Summer':'for Winter'}}">
                          </div>
                        </div>  
                      </li>
                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ 'Skráð' }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="reg_date" name="reg_date" placeholder="{{ __('Skráð') }}" value="{{ $data->created_at }}">
                          </div>
                        </div>  
                      </li>

                      <li>
                       
                        <textarea class="input-field textarea" id="msg" name="message" placeholder="{{ $langg->lang365 }}" >Skilmálar dekkjahótels.
                        Dekkin fast aðeins afhent til þess aðila sem bókar þau í geymslu og er með geymslu númerið. Gildistími
geymslu er að hámarki 6 mánuði, ef lengja þarf þann tíma þarf að greiða auka gjald. ATH. Dekk sem eru ekki
sótt innan 18 mánaða teljast eign Nesdekkja og verður heimilt að selja þau fyrir áföllnum kostnaði eða farga
þeim.
Vinsamlegast bókið með dags fyrirvara til að setja hjólbarða undir aftur.<br />
                        </textarea>
                      </li>

                    </ul>
                    <button class="submit-btn" id="emlsub" type="submit">{{ $langg->lang366 }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

@endsection
