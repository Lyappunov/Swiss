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
 
</head>
<body style="background-color: white; padding-right: 100px; padding-left: 100px; padding-top:20px;">
<div style='width: 65%; margin: auto; margin-top:40px; background-color: white;padding: 20px; border-radius: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);'>
	<div style='width:100%; overflow:hidden; border-bottom:1px;'>
        <div style='width:30%; position:relative; float:center; text-align:center;'>
            <img src="https://hotel.nesdekk.is/assets/images/admins/hotel_logo.png" style='width:40%'>
        </div>
    </div>
    <div class="row">
    	<div class='col-lg-12' style="text-align: center; padding: 2%;">
    		<h3>{!! 'Hello, '.$cname.'!' !!}</h3>
    	</div>
        <div class='col-lg-12' style="text-align: left; padding: 2%;">
    		<p>{!! "Dekki?? ??itt hefur veri?? skr???? r??tt ?? verslun okkar." !!}</p>
    		<p>{!! "Vinsamlegast athuga??u hvort eftirfarandi atri??i eru r??tt." !!}</p>
    	</div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! 'N??meraplata: '.$number_plate !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! 'Storage ID: '.$storage_id !!} </h4>
        	</div>
        </div>
    </div>

    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! 'Dekkjast??r?? : '.$size !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! 'Dekkjategund : '.$brand !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! 'Fj??ldi dekkja : '.$qty !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
                
            	<h4 class="heading">{!! 'Sumar e??a Vetrardekk : '.$weather !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{!! '?? felgu? : '.$is_rim !!} </h4>
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
                
            	<h4 class="heading">{!! 'Skr???? : '.$reg_date !!} </h4>
        	</div>
        </div>
    </div>
    <div style="margin-top: 30px;">
    	<div class="row">
    		<div class="col-lg-12" style="padding-bottom: 10px;">
    			<h3>Skilm??lar dekkjah??tels.</h3>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-lg-12">
    			
    				<span>{!! $email_body !!}</span>
    			
    		</div>
    	</div>

    </div>

   
   <div style='margin-top:30px; overflow:hidden; width:100%'>
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

</body>
</html>
