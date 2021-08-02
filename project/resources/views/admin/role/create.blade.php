@extends('layouts.admin')

@section('content')

            <div class="content-area">
                <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Add Role') }} <a class="add-btn float-right" href="{{route('admin-role-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-index') }}">{{ __('Manage Roles') }}</a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-create') }}">{{ __('Add Role') }}</a>
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
                      <form id="geniusform" action="{{route('admin-role-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('includes.admin.form-both') 

                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">{{ __("Name") }} *</h4>
                                <p class="sub-heading">{{ __("(In Any Language)") }}</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Name') }}" required="" value="">
                          </div>
                        </div>

                        <hr>
                        <h5 class="text-center">{{ __('Permissions') }}</h5>
                        <hr>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Create Hotel Storage') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="create_hotel_storage" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Input Customer Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="input_customer_info">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Decide Storage Location') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="decide_storage_location" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Input Tire Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="input_tire_info">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Print Ticket') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="print_ticket" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Print Sticker') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="print_sticker">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Picked up') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_picked_up" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Booking') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_booking">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Customer Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_customer_info" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Storage Location') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_storage_location">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Send Email') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="send_email">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Import And Export Data') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="import_and_export_data">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Hotel Storage') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="hotel_storage">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Change Tire Info') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="change_tire_info">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Delete Customer') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="delete_customer">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Delete Tire') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="delete_tire">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Booking List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="booking_list">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Old Storage List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="old_storage_list">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Stand by List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="stand_by_list">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Picked Up List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="picked_up_list">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Trashed List View') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="trashed_list">
                                <span class="slider round"></span>
                              </label> 
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Mark Trash') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="mark_trash" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('New List') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="new_list">
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
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Role') }}</button>
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