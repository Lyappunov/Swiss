@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area" id="modalEdit">
                        @include('includes.admin.form-error') 
                      <form id="geniusformdata" action="{{route('admin-storage-update',$data->storage_idx)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <?php
                          $disabled = '';
                          if(Auth::guard('admin')->user()->sectionCheck('change_storage_location') && !Auth::guard('admin')->user()->sectionCheck('change_tire_info'))
                          $disabled = 'disabled';
                        ?>
                        <input type='hidden' name='hotel_id' value='{{ $data->hotel_id }}'>
                        <input type='hidden' id='changed_location' name='is_changed' value=''>
                        <input type='hidden' id='staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Date and Time') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="input-append date">
                              <input type="text" value='{{ $data->created_at }}' class="input-field" name='created_at'></input>
                              <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                              </span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Storage Location') }}</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" id='storage_location' name="location" placeholder="{{ __('Enter Storage') }}" value="{{ $data->location }}">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Storage ID') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="storage_ID" placeholder="{{ __('Enter Storage_ID') }}" required="" value="{{ $data->storage_ID }}">
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
                            <input type="text" class="input-field" name="car_license" placeholder="{{ __('Enter Car License Plate') }}" value="{{ $data->car_license }}">
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
                            <input type="text" class="input-field" name="car_make" placeholder="{{ __('Enter Car Make') }}" value="{{ $data->car_make }}">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Quantity of Tire') }} *</h4>
                                <p class="sub-heading">{{ __('(In Number)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="quantity" placeholder="{{ __('Enter Quantity of Tire') }}" required="" value="{{ $data->quantity }}" {{ $disabled }}>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Tire Size') }} </h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="tire_size" placeholder="{{ __('Enter Tire Size') }}" value="{{ $data->tire_size }}" {{ $disabled }}>
                          </div>
                        </div>

                        <div class="row" id='rim_size'>
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Rim Size') }} </h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="rim_size" placeholder="{{ __('Enter Rim Size') }}" value="{{ $data->rim_size }}" {{ $disabled }}>
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
                            <input type="text" class="input-field" name="tire_brand" placeholder="{{ __('Enter Tire Brand') }}" value="{{ $data->tire_brand }}" {{ $disabled }}>
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
                            <input type="text" class="input-field" name="condition" placeholder="{{ __('Enter the conditions of your tires.') }}" value="{{ $data->condition }}">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Tire photo') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/images/storage/'.$data->photos) }});">
                                  @if(Auth::guard('admin')->user()->role_id ==0 || Auth::guard('admin')->user()->sectionCheck('change_tire_info'))
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Tire Photo') }}</label>
                                  @endif
                                    <input type="file" name="photos" class="img-upload" id="image-upload">
                                  </div>
                            </div>

                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('Summer / Winter') }} *</h4>
                              </div>
                            </div>
                            <div class="col-lg-7">
                            <?php 
                              $is_summer_checked='';
                              if($data->weather==1)$is_summer_checked='checked'; 
                              $is_winter_checked='';
                              if($data->weather==0)$is_winter_checked='checked'; 
                            ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="summer" name="weather" class="custom-control-input" value='1' {{ $is_summer_checked }} {{ $disabled }}>
                                  <label class="custom-control-label" for="summer">{{ __('Summer') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="winter" name="weather" class="custom-control-input" value='0' {{ $is_winter_checked }} {{ $disabled }}>
                                  <label class="custom-control-label" for="winter">{{ __('winter') }}</label>
                                </div>
                            </div>
                        </div>
                          <br>
                        <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('Is your Tire on Rim') }} *</h4>
                              </div>
                            </div>
                            <div class="col-lg-7">
                            <?php 
                              $is_yes_checked='';
                              $display = '';
                              if($data->is_rim==1){$is_yes_checked='checked';} 
                              $is_no_checked='';
                              if($data->is_rim==0){$is_no_checked='checked';} 
                            ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="rim_yes" name="is_rim" class="custom-control-input" value='1' {{ $is_yes_checked }}>
                                  <label class="custom-control-label" for="rim_yes">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="rim_no" name="is_rim" class="custom-control-input" value='0' {{ $is_no_checked }}>
                                  <label class="custom-control-label" for="rim_no">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection
@section('scripts')
<script type="text/javascript">
		$('#datetimepicker').datetimepicker({
			format: 'yyyy-mm-dd hh:mm:ss'
		});
</script>
@endsection