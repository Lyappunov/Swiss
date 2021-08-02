@extends('layouts.load')
@section('content')

						<div class="content-area no-padding">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">

                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th>{{ __("Customer ID#") }}</th>
                                                <td>{{$data->id}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Customer Photo") }}</th>
                                                <td>
                                              <img src="{{ $data->photo ? asset('assets/images/customers/'.$data->photo):asset('assets/images/noimage.png')}}" alt="{{ __("No Image") }}">

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Customer Name") }}</th>
                                                <td>{{$data->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Customer Address") }}</th>
                                                <td>{{ $data->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Customer Email") }}</th>
                                                <td>{{$data->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Customer Phone") }}</th>
                                                <td>{{$data->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __("Joined") }}</th>
                                                <td>{{$data->created_at->diffForHumans()}}</td>
                                            </tr>
                                        </table>
                                    </div>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection