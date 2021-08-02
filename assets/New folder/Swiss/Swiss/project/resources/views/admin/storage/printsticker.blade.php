<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{$seo->meta_keys}}">
        <meta name="author" content="GeniusOcean">

        <title>{{$gs->title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/print/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/print/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/print/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/print/css/style.css')}}">
  <link href="{{asset('assets/print/css/print.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 
  <style type="text/css">

        @media print {
            @page { size: 17in 11in;
                    size: landscape;
                    margin: 10mm; }

        html {

        }
        ::-webkit-scrollbar {
            width: 0px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */
        }
        }
  </style>
</head>
<body onload="window.print();">
<div style='width: 80%; margin: auto;'>
	<div style='width:100%; overflow:hidden; border-bottom:1px; padding-top:40px;'>
        <div style='width:50%; position:relative; float:left;'>
        	<h1 style='position:absolute; font-color: blue;'>Dekkjahótel</h1>
        </div>
        <div style='width:30%; position:relative; float:right; text-align:right;'>
            <img src="{{ asset('assets/images/admins/hotel_logo.png') }}" style='width:70%'>
        </div>
    </div>
    <div class="row">
    	<div class='col-lg-12' style="text-align: right; padding: 2%;">
    		<h2>{{__('Storage ID')}}: {{ $data->storage_ID }}</h2>
    	</div>
    </div>
    <div class="row" style='margin-top:100px;'>
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h3 class="heading">{{ __('Full Name').' : '.$data_detail->customer_name }} </h3>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h3 class="heading">{{ 'Heimilisfang : '.$data_detail->home_address }} </h3>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h3 class="heading">{{ 'Sími : '.$data_detail->phone }} </h3>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h3 class="heading">{{ 'Netfang : '.$data_detail->email }} </h3>
        	</div>
        </div>
    </div>
   <div style='margin-top:100px; overflow:hidden; width:100%'>
        <div style='width:30%; position:relative; float:left'>
            <img src="{{ asset('assets/images/admins/hotel_logo.png') }}" style='width:70%'>
        </div>
        <div style='width:70%; position:relative; float:left'>
            <span>
                Nesdekk ehf | Kt. 420296-2079 | Vsk.nr: 49771 | 561-4200 | nesdekk@nesdekk.is
            </span>
        </div>
   </div>
</div>
<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 2000);
</script>

</body>
</html>
