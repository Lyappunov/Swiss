@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area" id="modalEdit">
                        @include('includes.admin.form-error') 
                      <form id="geniusformdata" action="{{route('admin-hotel-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type='hidden' id='staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Date and Time') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div id="datetimepicker" class="input-append date">
                              <input type="text" value='{{ date("Y-m-d h:i:sa") }}' class="input-field"></input>
                              <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Fulll Name') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="customer_name" placeholder="{{ __('Enter Name') }}" required="" value="">
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
                            <input type="text" class="input-field" name="social_id" placeholder="{{ __('Enter Social ID') }}" value="">
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
                            <input type="text" class="input-field" name="home_address" placeholder="{{ __('Enter Home Address') }}" value="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Phone Number') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="phone" placeholder="{{ __('Enter Phone Number') }}" required='' value="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="email" placeholder="{{ __('Enter Email') }}" required='' value="">
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
			format: 'yyyy-mm-dd hh:mm:ss',
			language: 'pt-BR'
		});
</script>
@endsection