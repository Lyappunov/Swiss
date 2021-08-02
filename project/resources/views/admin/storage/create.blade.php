@extends('layouts.admin')

@section('content')

<body style="background-color: #00ff6c;">
  
</body>
<div class="content-area" style="padding-right: 100px; padding-left: 100px;">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12" style="display:block">
          <h4 class="heading"> {{ __('Tire Detail View') }} 
            <a class="add-btn float-right" href="{{ url()->previous() }}" ><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
          </h4>
          <ul class="links">
              <li>
                  <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
              </li>
              <li>
                  <a href="{{ route('admin-storage-index') }}">{{ __('Storage(Tire) List') }} </a>
              </li>
              <li>
                  <a href="javascript:;">{{__('Details View')}}</a>
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
         
            @include('includes.admin.form-error') 
          <form id="geniusform" action="{{route('admin-storage-store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('includes.admin.form-both')
            <input type='hidden' name='hotel_id' value='{{ $hotel_id }}'>
            <input type='hidden' id='staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>
            <input type='hidden' id='customer_name' value='{{ $customer_name }}'>

            <div class="row">
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Date and Time') }} *</h4>
                </div>
              </div>
              <div class="col-lg-7">
                <div id="datetimepicker" class="input-append date">
                  <input type="text" value='{{ date("Y-m-d h:i:sa") }}' class="input-field" name='created_at'></input>
                  <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Storage Location') }} </h4>
                    <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                </div>
              </div>
              <div class="col-lg-7">
                <input type="text" class="input-field" name="location" placeholder="{{ __('Enter Storage') }}" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Storage ID') }} *</h4>
                </div>
              </div>
              <div class="col-lg-7">
                <input type="text" class="input-field" name="storage_ID" placeholder="{{ __('Enter Storage_ID') }}" required="" value="{{ $recomend_ID }}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Car License Plate') }} *</h4>
                    <p class="sub-heading">{{ __('In Any Language') }}</p>
                </div>
              </div>
              <div class="col-lg-7">
                <input type="text" class="input-field" name="car_license" placeholder="{{ __('Enter Car License Plate') }}" required value="">
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
                <input type="text" class="input-field" name="car_make" placeholder="{{ __('Enter Car Make') }}" required value="">
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
                <input type="text" class="input-field" name="quantity" placeholder="{{ __('Enter Quantity of Tire') }}" required="" value="">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Tire Size') }} </h4>
                </div>
              </div>
              <div class="col-lg-7">
                <input type="text" class="input-field" name="tire_size" placeholder="{{ __('Enter Tire Size') }}" value="">
              </div>
            </div>
            <div class="row" id='rim_size'>
              <div class="col-lg-4">
                <div class="left-area">
                    <h4 class="heading">{{ __('Rim Size') }} </h4>
                </div>
              </div>
              <div class="col-lg-7">
                <input type="text" class="input-field" name="rim_size" placeholder="{{ __('Enter Rim Size') }}" value="">
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
                <input type="text" class="input-field" name="tire_brand" placeholder="{{ __('Enter Tire Brand') }}" value="">
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
                <input type="text" class="input-field" name="condition" placeholder="{{ __('Enter the conditions of your tire.') }}" value="">
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
                    <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                        <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Tire Photo') }}</label>
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
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="summer" name="weather" class="custom-control-input" value='1'>
                      <label class="custom-control-label" for="summer">{{ __('Summer') }}</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="winter" name="weather" class="custom-control-input" value='0'>
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
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="rim_yes" name="is_rim" class="custom-control-input" value='1'>
                      <label class="custom-control-label" for="rim_yes">{{ __('Yes') }}</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="rim_no" name="is_rim" class="custom-control-input" value='0'>
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
              <div class="col-lg-4">
                <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
              </div>
              <div class="col-lg-4">
                <a data-toggle="modal" data-target="#vendorform" class="mybtn1 ml-3 float-right" href="javascript:;"><i class="fas fa-envelope"></i> {{ __('SEND E-MAIL') }}</a>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
                  <form id="emailreply" >
                    {{csrf_field()}}
                    
                    <input type='hidden' id='mail_storage_idx' name='mail_storage_idx' value=''>
                    <input type='hidden' id='customer_name' value='{{ $customer_name }}'>
                    <input type='hidden' id='mail_staff_id' name='staff_id' value='{{ Auth::guard("admin")->user()->id }}'>
                    <ul>

                      <li>
                        <input type="email" class="input-field" id="eml" name="email" placeholder="{{ $langg->lang363 }} *" required="" value="{{ $custom_email }}">
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
                            <span style='font-weight:bold;'>{{ __('Storage ID') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="storage_id" name="storage_id" placeholder="{{ __('Storage ID') }} " value="">
                          </div>
                        </div>
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Tire Size') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="size" name="size" placeholder="{{ __('Tire Size') }}" value="">
                          </div>
                        </div> 
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Tire Brand') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="brand" name="brand" placeholder="{{ __('Tire Brand') }}" value="">
                          </div>
                        </div>  
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Fjöldi dekkja') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="qty" name="qty" placeholder="{{ __('Fjöldi dekkja') }}" value="">
                          </div>
                        </div>
                        
                        
                      </li>

                      <li>
                      <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('Is Rim') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="is_rim" name="is_rim" placeholder="{{ __('Is Rim') }}" value="">
                          </div>
                        </div>  
                      </li>

                      <li>
                        <div class='row'>
                          <div class='col-lg-3'>
                            <span style='font-weight:bold;'>{{ __('S/W') }}</span>
                          </div>
                          <div class='col-lg-9'>
                            <input type="text" class="input-field" id="weather" name="weather" placeholder="{{ __('S/W') }}" value="">
                          </div>
                        </div>  
                      </li>

                      <li>
                       
                        <textarea class="input-field textarea" id="msg" name="message" placeholder="{{ $langg->lang365 }}" >Skilmálar dekkjahótels.
Dekkin fast aðeins afhent til þess aðila sem bókar þau í geymslu og er með geymslu númerið.
Gildistími geymslu er að hámarki 9 mánuði, ef lengja þarf þann tíma þarf að greiða auka gjald.
ATH. Dekk sem eru ekki sótt innan 18 mánaða teljast eign Nesdekkja og verður heimilt að selja þau fyrir áföllnum kostnaði eða farga þeim.<br />
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
@section('scripts')
<script type="text/javascript">
		$('#datetimepicker').datetimepicker({
			format: 'yyyy-mm-dd hh:mm:ss',
			language: 'pt-BR'
		});
</script>
@endsection