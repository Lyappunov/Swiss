@extends('layouts.admin')

@section('content')
            <div class="content-area">
                <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Edit Role') }} <a class="add-btn float-right" href="{{route('admin-role-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-index') }}">{{ __('Manage Roles') }}</a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-edit',$data->id) }}">{{ __('Edit Role') }}</a>
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
                      <form id="geniusform" action="{{route('admin-role-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          @include('includes.admin.form-both') 

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __("Name") }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Name') }}" value="{{$data->name}}" required="">
                          </div>
                        </div>


                        <hr>
                        <h5 class="text-center">{{ __('Permissions') }}</h5>
                        <hr>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Create Hotel Storage') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="create_hotel_storage" {{ $data->sectionCheck('create_hotel_storage') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Input Customer Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="input_customer_info" {{ $data->sectionCheck('input_customer_info') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Decide Storage Location') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="decide_storage_location" {{ $data->sectionCheck('decide_storage_location') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Input Tire Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="input_tire_info" {{ $data->sectionCheck('input_tire_info') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Print Ticket') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="print_ticket" {{ $data->sectionCheck('print_ticket') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Print Sticker') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="print_sticker" {{ $data->sectionCheck('print_sticker') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Picked up') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_picked_up" {{ $data->sectionCheck('mark_picked_up') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Booking') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_booking" {{ $data->sectionCheck('mark_booking') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Customer Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_customer_info" {{ $data->sectionCheck('change_customer_info') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Storage Location') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_storage_location" {{ $data->sectionCheck('change_storage_location') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Send Email') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="send_email" {{ $data->sectionCheck('send_email') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Import And Export Data') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="import_and_export_data" {{ $data->sectionCheck('import_and_export_data') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Hotel Storage') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="hotel_storage" {{ $data->sectionCheck('hotel_storage') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Tire Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_tire_info" {{ $data->sectionCheck('change_tire_info') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Delete Customer') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="delete_customer" {{ $data->sectionCheck('delete_customer') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Delete Tire') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="delete_tire" {{ $data->sectionCheck('delete_tire') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Booking List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="booking_list" {{ $data->sectionCheck('booking_list') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Old Storage List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="old_storage_list" {{ $data->sectionCheck('old_storage_list') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Stand by List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="stand_by_list" {{ $data->sectionCheck('stand_by_list') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Picked Up List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="picked_up_list" {{ $data->sectionCheck('picked_up_list') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Trashed List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="trashed_list" {{ $data->sectionCheck('mark_trash') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label> 
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Trash') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_trash" {{ $data->sectionCheck('mark_trash') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('New List') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="new_list" {{ $data->sectionCheck('new_list') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label> 
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-5">
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