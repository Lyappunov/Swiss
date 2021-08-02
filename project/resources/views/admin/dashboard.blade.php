@extends('layouts.admin')

@section('content')
<div class="content-area">
    @include('includes.form-success')

    
    @if(Session::has('cache'))

    <div class="alert alert-success validation">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <h3 class="text-center">{{ Session::get("cache") }}</h3>
    </div>


  @endif



    <div class="row row-cards-one">
 
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg4">
                <div class="left">
                    <h5 class="title">{{ __('Total Projects') }}</h5>
                    <span class="number">{{count($projects)}}</span>
                    <a href="{{route('project-index')}}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-brand-windows"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg5">
                <div class="left">
                    <h5 class="title">{{ __('Total Customers') }}</h5>
                    <span class="number">{{count($customers)}}</span>
                    <a href="{{route('admin-customer-list')}}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-users-alt-5"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row row-cards-one">
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box1">
                    <p style='font-size:25px; font-weight:bold'>{{ count($projects) }}</p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title">{{ __('All Projects') }}</h6>
                    <p class="text">{{ __('Total') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box2">
                    <p style='font-size:25px; font-weight:bold'>{{ count($working_projects)  }}</p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title">{{ __('Working Projects') }}</h6>
                    <p class="text">{{ __('Total') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box4">
                    <p style='font-size:25px; font-weight:bold'>{{ count($closed_projects) }}</p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title">{{ __('Closed Projects') }}</h6>
                    <p class="text">{{ __('Total') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box3">
                    <p style='font-size:25px; font-weight:bold'>{{ count($offer_projects) }}</p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title">{{ __('Offerphase Projects') }}</h6>
                    <p class="text">{{ __('Total') }}</p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')



<script type="text/javascript">
    $('#poproducts').dataTable( {
      "ordering": false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>


<script type="text/javascript">
    $('#pproducts').dataTable( {
      "ordering": false,
      'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>

@endsection