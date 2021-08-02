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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,700,300italic,400italic,500italic">
  <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 
  <style type="text/css">
        
        @media print {
            @page { size: A4;  margin: 0mm; }
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
	<div style='width:100%; overflow:hidden; border-bottom:1px;padding-top:40px;'>
        <div style='width:50%; position:relative; float:left;'>
        	<h1 style='position:absolute; font-color: blue;'>Dekkjahótel</h1>
        </div>
        <div style='width:30%; position:relative; float:right; text-align:right;'>
            <img src="{{ asset('assets/images/admins/hotel_logo.png') }}" style='width:50%'>
        </div>
    </div>
    <div class="row">
    	<div class='col-lg-12' style="text-align: right; padding: 2%;">
    		<h3>{{__('Storage ID').':'}} {{ $data->storage_ID }}</h3>
    	</div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Full Name').' : '.$data_detail->customer_name }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Heimilisfang : '.$data_detail->home_address }} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Sími : '.$data_detail->phone }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Netfang : '.$data_detail->email }} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Bílnúmer : '.$data->car_license }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Bíltegund : '.$data->car_make }} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Fjöldi dekkja  : '.$data->quantity }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Dekkjastærð : '.$data->tire_size }} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Dekkjategund : '.$data->tire_brand }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
                <?php 
                    $weather='';
                    $data_detail->weather==1?$weather='Summer':$weather='winter';
                ?>
            	<h4 class="heading">{{ 'Sumar eða Vetrardekk : '.__($weather) }} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-5">
        	<div class="left-area">
                <?php 
                    $rim='';
                    $data_detail->is_rim==1?$rim='Yes':$rim='No';
                ?>
            	<h4 class="heading">{{ 'Á felgu? : '.__($rim) }} </h4>
        	</div>
        </div>
    
    	<div class="col-lg-5">
        	<div class="left-area">
            	<h4 class="heading">{{ 'Skráð : '.$data->created_at }} </h4>
        	</div>
        </div>
    </div>
    <div style="margin-top: 30px;">
    	<div class="row">
    		<div class="col-lg-12" style="padding-bottom: 10px;">
    			<h3>Skilmálar dekkjahótels.</h3>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-lg-12">
    			
    				<span>
                    Dekkin fast aðeins afhent til þess aðila sem bókar þau í geymslu og er með geymslu númerið. Gildistími
geymslu er að hámarki 5 mánuði, ef lengja þarf þann tíma þarf að greiða auka gjald. ATH. Dekk sem eru ekki
sótt innan 18 mánaða teljast eign Nesdekkja og verður heimilt að selja þau fyrir áföllnum kostnaði eða farga
þeim.
Vinsamlegast bókið með dags fyrirvara til að setja hjólbarða undir aftur.

    				</span>
    			
    		</div>
    	</div>

    </div>

   <div class="row" style="width:100%; margin-top: 110px; overflow:hidden;">
        <div style="margin-right: 20px; width:42%; position:relative; float:left">
           <div style="border-bottom: 1px solid black;"></div>
           <p>Mótekið fyrir hönd Nesdekk ehf.</p>
        </div>
        <div style="margin-left: 20px; width:42%; position:relative; float:right">
           <div style="border-bottom: 1px solid black;"></div>
           <p style='text-align:right'>{{ __('Undirskrift '.$data_detail->customer_name) }}</p>
        </div>
   </div> 
   <div style='margin-top:30px; overflow:hidden; width:100%'>
        <div style='width:30%; position:relative; float:left'>
            <img src="{{ asset('assets/images/admins/hotel_logo.png') }}" style='width:50%'>
        </div>
        <div style='width:70%; position:relative; float:left'>
            <span>
                Nesdekk ehf | Kt. 420295-2079 | Vsk.nr: 49771 | 551-4200 | nesdekk@nesdekk.is
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
