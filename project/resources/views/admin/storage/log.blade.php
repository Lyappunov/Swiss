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
                        <input type='hidden' name='hotel_id' value='{{ $data->hotel_id }}'>
                        <input type='hidden' id='changed_location' name='is_changed' value=''>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Storage ID') }}</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" value="{{ $data_hotel->storage_ID }}" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Storage Location') }} </h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" value="{{ $data->location }}" disabled>
                          </div>
                        </div>
                        @foreach($data_logs as $log)
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ $log->created_at.' : ' }} </h4>
                            </div>
                          </div>
                          
                          <div class="col-lg-7">
                            <input type="text" class="input-field" value="{{ $log->content.' by '.App\Models\Admin::where('id', $log->staff_id)->first()->name }}" disabled>
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

@endsection
@section('scripts')
<script type="text/javascript">
		$('#datetimepicker').datetimepicker({
			format: 'yyyy-mm-dd hh:mm:ss',
			language: 'pt-BR'
		});
</script>
@endsection