<div style='width: 90%; margin: auto;'>
	<div clas='row'>
        <div class='col-lg-9'>
        	<h1>Dekkjahótel</h1>
        </div>
        <div class='col-lg-3'>
            <img src="">
        </div>
    </div>
    <div class="row">
    	<div class='col-lg-12' style="text-align: right; padding: 2%;">
    		<h3>Storage ID:</h3>
    	</div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Full Name : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->customer_name }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Heimilisfang : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->home_address }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Sími : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->phone }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Netfang : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->email }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Bílnúmer : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->car_license }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Bíltegund : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->car_make }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Fjöldi dekkja  : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->quantity }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Dekkjastærð : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->tire_size }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Dekkjategund : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->tire_make }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Sumar eða Vetrardekk : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->weather==1?'Summer':'Winter' }}</span>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-3">
        	<div class="left-area">
            	<h4 class="heading">{{ __('Á felgu? : ') }} </h4>
        	</div>
        </div>
        <div class="col-lg-6">
        	<span>{{ $data_detail->is_rim==1?'Yes':'No' }}</span>
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
    			<textarea rows="6" cols="120" readonly="">
    				<span>
    					Terms of service. Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah blah Blah blah
    				</span>
    			</textarea>
    		</div>
    	</div>

    </div>

   <div class="row" style="margin-top: 70px;">
   		<div class="col-lg-6" style="margin-right: 20px; border-bottom: 1px solid black;">
   			
   		</div>
   		<div class="col-lg-6" style="margin-left: 20px; border-bottom: 1px solid black;">
   			
   		</div>
   </div> 
</div>
