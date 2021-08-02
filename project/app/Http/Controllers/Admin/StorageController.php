<?php

namespace App\Http\Controllers\Admin;
use App\Classes\GeniusMailer;
use Datatables;
use App\Models\HotelStorage;
use App\Models\Storage;
use App\Models\Log;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use DateTime;

class StorageController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Storage::orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
                            })
                            ->addColumn('storage_id', function(Storage $data) {
                                return $data->storage_ID;
                            })
                            ->addColumn('saving_months', function(Storage $data) {
                                $class='';
                                $status='';
                                $today = new DateTime(date("Y-m-d h:i:sa"));
                                $register_date = new DateTime($data->created_at);
                                $interval = $register_date->diff($today);
                                $diffInDays    = $interval->d; //21
                                $diffInMonths  = $interval->m; //4
                                $diffInYears   = $interval->y; //1
                                $pure_months = $diffInYears*12 + $diffInMonths;
                                // $pure_months = 88;
                                if($pure_months<9)$class = 'drop-success';
                                else if($pure_months>=9 && $pure_months<18)$class = 'drop-warning';
                                else if($pure_months>=18)$class = 'drop-danger';
                                return '<div class="action-list"><a class="'.$class.'">'.$pure_months.' '.__('(Months)').'</a></div>';
                            })
                            ->addColumn('status', function(Storage $data) {
                                $class='';
                                $status='';
                                if($data->is_picked_up == 2){$class = 'drop-trash'; $status='Trashed';}
                                else {
                                    if($data->is_booking == 1&&$data->is_picked_up == 0) {$class = 'drop-danger'; $status='Booked';}
                                    if($data->is_booking == 1&&$data->is_picked_up == 1) {$class = 'drop-success'; $status='Picked Up';}
                                    if($data->is_booking == 0&&$data->is_picked_up == 0) {$class = 'drop-warning'; $status='Stand By';}
                                    if($data->is_booking == 0&&$data->is_picked_up == 3) {$class = 'drop-new'; $status='New';}
                                }
                                return '<div class="action-list"><a class="'.$class.'">'.__($status).'</a></div>';
                            })
                            ->addColumn('action', function(Storage $data) {
                                $is_super = (Auth::guard('admin')->user()->role_id == 0)?1:0;
                                $is_edit_tire = Auth::guard('admin')->user()->sectionCheck('change_tire_info')?1:0;
                                $is_change_location = Auth::guard('admin')->user()->sectionCheck('change_storage_location')?1:0;
                                $is_delete_tire = Auth::guard('admin')->user()->sectionCheck('delete_tire')?1:0;
                                $action_edit = '';
                                $action_delete = '';
                                if($is_super==1 || $is_edit_tire==1 || $is_change_location==1){
                                    $action_edit = '<a data-href="' . route('admin-storage-edit',$data->storage_idx) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a>';
                                }
                                if($is_super==1 || $is_delete_tire==1){
                                    $action_delete = '<a href="javascript:;" data-href="' . route('admin-storage-delete',$data->storage_idx) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                }
                                return '<div class="action-list"><a href="' . route('admin-storage-details',$data->storage_idx) . '"> <i class="fas fa-eye"></i>'.__('Details').'</a>'.$action_edit.$action_delete.'</div>';
                            })
                            ->rawColumns(['saving_months','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function condatatables($id)
    {
         $datas = Storage::where('hotel_id','=',$id)
                        ->where('is_picked_up','=',0)               
                        ->orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
                            })
                            ->addColumn('storage_id', function(Storage $data) {
                                return $data->storage_ID;
                            })
                            ->addColumn('saving_months', function(Storage $data) {
                                $class='';
                                $status='';
                                $today = new DateTime(date("Y-m-d h:i:sa"));
                                $register_date = new DateTime($data->created_at);
                                $interval = $register_date->diff($today);
                                $diffInDays    = $interval->d; //21
                                $diffInMonths  = $interval->m; //4
                                $diffInYears   = $interval->y; //1
                                $pure_months = $diffInYears*12 + $diffInMonths;
                                if($pure_months<9)$class = 'drop-success';
                                else if($pure_months>=9 && $pure_months<12)$class = 'drop-warning';
                                else if($pure_months>=12)$class = 'drop-danger';
                                return '<div class="action-list"><a class="'.$class.'">'.$pure_months.' '.__('(Months)').'</a></div>';
                            })
                            ->addColumn('status', function(Storage $data) {
                                $class='';
                                $status='';
                                if($data->is_picked_up == 2){$class = 'drop-trash'; $status='Trashed';}

                                if($data->is_booking == 1&&$data->is_picked_up == 0) {$class = 'drop-danger'; $status='Booked';}
                                if($data->is_booking == 1&&$data->is_picked_up == 1) {$class = 'drop-success'; $status='Picked Up';}
                                if($data->is_booking == 0&&$data->is_picked_up == 0) {$class = 'drop-warning'; $status='Stand By';}
                                
                                return '<div class="action-list"><a class="'.$class.'">'.__($status).'</a></div>';
                            })
                            ->addColumn('action', function(Storage $data) {
                                $is_super = (Auth::guard('admin')->user()->role_id == 0)?1:0;
                                $is_edit_tire = Auth::guard('admin')->user()->sectionCheck('change_tire_info')?1:0;
                                $is_change_location = Auth::guard('admin')->user()->sectionCheck('change_storage_location')?1:0;
                                $is_delete_tire = Auth::guard('admin')->user()->sectionCheck('delete_tire')?1:0;
                                $action_edit = '';
                                $action_delete = '';
                                if($is_super==1 || $is_edit_tire==1 || $is_change_location==1){
                                    $action_edit = '<a data-href="' . route('admin-storage-edit',$data->storage_idx) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a>';
                                }
                                if($is_super==1 || $is_delete_tire==1){
                                    $action_delete = '<a href="javascript:;" data-href="' . route('admin-storage-delete',$data->storage_idx) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                }
                                return '<div class="action-list"><a href="' . route('admin-storage-details',$data->storage_idx) . '"> <i class="fas fa-eye"></i>'.__('Details').'</a>'.$action_edit.$action_delete.'</div>';
                            })
                            ->rawColumns(['saving_months','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function condatatables_picked($id)
    {
         $datas = Storage::where('hotel_id','=',$id)
                        ->where('is_picked_up','=',1)
                        ->orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
                            })
                            ->addColumn('storage_id', function(Storage $data) {
                                return $data->storage_ID;
                            })
                            ->addColumn('saving_months', function(Storage $data) {
                                $class='';
                                $today = new DateTime(date("Y-m-d h:i:sa"));
                                $register_date = new DateTime($data->created_at);
                                $interval = $register_date->diff($today);
                                $diffInDays    = $interval->d; //21
                                $diffInMonths  = $interval->m; //4
                                $diffInYears   = $interval->y; //1
                                $pure_months = $diffInYears*12 + $diffInMonths;
                                if($pure_months<9)$class = 'drop-success';
                                else if($pure_months>=9 && $pure_months<12)$class = 'drop-warning';
                                else if($pure_months>=12)$class = 'drop-danger';
                                return '<div class="action-list"><a class="'.$class.'">'.$pure_months.' '.__('(Months)').'</a></div>';
                                // return $pure_months.' (months)';
                            })
                            ->addColumn('status', function(Storage $data) {
                                $class='';
                                $status='';
                                if($data->is_picked_up == 2){$class = 'drop-trash'; $status='Trashed';}
                                if($data->is_booking == 1&&$data->is_picked_up == 0) {$class = 'drop-danger'; $status='Booked';}
                                if($data->is_booking == 1&&$data->is_picked_up == 1) {$class = 'drop-success'; $status='Picked Up';}
                                if($data->is_booking == 0&&$data->is_picked_up == 0) {$class = 'drop-warning'; $status='Stand By';}
                                
                                return '<div class="action-list"><a class="'.$class.'">'.__($status).'</a></div>';
                            })
                            ->addColumn('action', function(Storage $data) {
                                $is_super = (Auth::guard('admin')->user()->role_id == 0)?1:0;
                                $is_edit_tire = Auth::guard('admin')->user()->sectionCheck('change_tire_info')?1:0;
                                $is_change_location = Auth::guard('admin')->user()->sectionCheck('change_storage_location')?1:0;
                                $is_delete_tire = Auth::guard('admin')->user()->sectionCheck('delete_tire')?1:0;
                                $action_edit = '';
                                $action_delete = '';
                                if($is_super==1 || $is_edit_tire==1 || $is_change_location==1){
                                    $action_edit = '<a data-href="' . route('admin-storage-edit',$data->storage_idx) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a>';
                                }
                                if($is_super==1 || $is_delete_tire==1){
                                    $action_delete = '<a href="javascript:;" data-href="' . route('admin-storage-delete',$data->storage_idx) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                }
                                return '<div class="action-list"><a href="' . route('admin-storage-details',$data->storage_idx) . '"> <i class="fas fa-eye"></i>'.__('Details').'</a>'.$action_edit.$action_delete.'</div>';
                            })
                            ->rawColumns(['saving_months','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.storage.index');
    }
    public function conindex($id)
    {
        $hotel_id = $id;
        return view('admin.storage.conindex',compact('hotel_id'));
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        $hotel_data = HotelStorage::where('hotel_id','=',$hotel_id)->first();
        $custom_email = $hotel_data->email;
        $customer_name = $hotel_data->customer_name;
        $recomend_ID = "";
        $max_id = DB::table('storages')->select(DB::raw('max(storage_ID) as max_ID'))->where('storage_ID','not like','T0%')->first();
        if($max_id){
            $max_storage_ID = Storage::where('storage_ID','=',$max_id->max_ID)->first();
            
            $result = $max_storage_ID->storage_ID;
            $recomend_num = substr($result,1);
            $recomend_buffer = $recomend_num +1 ;
            if($recomend_buffer<100000)$recomend_ID = "B100001";
            // $recomend_ID = "B".str_pad($recomend_buffer, 5, "0", STR_PAD_LEFT);
            else $recomend_ID = "B".$recomend_buffer;
        } else {$recomend_ID = "B100001";}
        return view('admin.storage.create',compact('hotel_id','recomend_ID','custom_email','customer_name'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        $rules = [
            'photos' => 'mimes:jpeg,jpg,png,svg'
                 ];
        $customs = [
            'photos.mimes' => 'Icon Type is Invalid.'
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        
        $input = $request->all();
        $input['is_picked_up'] = 3;
        if ($file = $request->file('photos'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/storage',$name);
            $input['photos'] = $name;
        }
        //$data->fill($input)->save();
        $data=Storage::create($input);
        //--- Logic Section Ends
        $log_arr = array();
        $recent_id = Storage::max('storage_idx');
        $log_arr['storage_idx'] = $recent_id;
        $log_arr['content'] = 'Newly Registered';
        $log_arr['staff_id'] = $request->staff_id;
        $log = Log::create($log_arr);
        //--- Redirect Section
        $send_data['msg'] = 'New Data Added Successfully.';
        $send_data['storage_idx'] = $recent_id;
        return response()->json($send_data);
        //--- Redirect Section Ends
    }

    public function details($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();
        $data_detail = $data->hotel_storage;
        $data_logs = $data->logs()->get();
        $data_hotel = $data->hotel_storage;
        return view('admin.storage.details',compact('data','data_detail','data_logs','data_hotel'));
    }
    public function log($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();
        $data_logs = $data->logs()->get();
        $data_hotel = $data->hotel_storage;
        return view('admin.storage.log',compact('data','data_logs','data_hotel'));
    }
    //*** GET Request
    public function edit($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();
        return view('admin.storage.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'photos' => 'mimes:jpeg,jpg,png,svg'
                 ];
        $customs = [
            'photos.mimes' => 'Icon Type is Invalid.'
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);


        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        if ($file = $request->file('photos'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/storage',$name);
            $input['photos'] = $name;
        }
        //--- Logic Section
        $data = Storage::where('storage_idx','=',$id)->update($input);
        
        if($request->is_changed=='changed'){
            $log_arr = array();
            $log_arr['storage_idx'] = $id;
            $log_arr['staff_id'] = $request->staff_id;
            $log_arr['content'] = 'Changed Storage Loction';
            $log = Log::create($log_arr);
        }
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = Storage::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }
    
    public function backtoNew($id,$staff)
    {
        $data['is_picked_up'] = 3;
        $data['is_booking'] = 0;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['content'] = 'Back To New.';
        $log_arr['staff_id'] = $staff;
        $log = Log::create($log_arr);

        $msg = 'The Tire has backed to New Successfully.';
        return response()->json($msg);
    }

    public function standBy($id,$staff)
    {
        $data['is_picked_up'] = 0;
        $data['is_booking'] = 0;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['content'] = 'Stand By';
        $log_arr['staff_id'] = $staff;
        $log = Log::create($log_arr);

        $msg = 'The Tire You Want has been Stand By Successfully.';
        return response()->json($msg);
    }
    public function pickup($id,$staff)
    {
        $data['is_picked_up'] = 1;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['content'] = 'Picked Up';
        $log_arr['staff_id'] = $staff;
        $log = Log::create($log_arr);

        $msg = 'The Tire You Want has been Picked Up Successfully.';
        return response()->json($msg);
    }
    public function booking($id,$staff)
    {
        $data['is_booking'] = 1;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Booked appointment';
        $log = Log::create($log_arr);

        $msg = 'Your Booking is Successfully.';
        return response()->json($msg);
    }
    public function backstand($id,$staff)
    {
        $data['is_booking'] = 0;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Back to Stand by.';
        $log = Log::create($log_arr);

        $msg = 'The status of this tire backed to STAND BY.';
        return response()->json($msg);
    }

    public function backbook($id,$staff)
    {
        $data['is_picked_up'] = 0;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Back to Booked.';
        $log = Log::create($log_arr);

        $msg = 'The status of this tire backed to BOOKED.';
        return response()->json($msg);
    }
    public function backStandTrash($id,$staff)
    {
        $data['is_picked_up'] = 0;
        $data['is_booking'] = 0;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Back to Stand by from Trashed.';
        $log = Log::create($log_arr);

        $msg = 'The status of this tire backed to Stand by from Trashed.';
        return response()->json($msg);
    }
    public function saving(Request $request,$id,$staff)
    {
        $data['paid'] = $request->paid;
        $data['invoice_number'] = $request->invoice_number;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Input Invoice Number and Piad Amount';
        $log = Log::create($log_arr);

        $msg = 'Inputing Invoice Number and Paid Amounts';
        return response()->json($msg);
    }
    public function locationsaving(Request $request,$id,$staff)
    {
        $data['location'] = $request->location;
        
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Set the Location of This Tire.';
        $log = Log::create($log_arr);

        $msg = 'The Location of this tire has been set.';
        return response()->json($msg);
    }
    public function trash($id,$staff)
    {
        $data['is_picked_up'] = 2;
        $data = Storage::where('storage_idx','=',$id)->update($data);

        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['staff_id'] = $staff;
        $log_arr['content'] = 'Trashed';
        $log = Log::create($log_arr);

        $msg = 'This tire is trashed.';
        return response()->json($msg);
    }
    public function print_sticker($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();
        $data_detail = $data->hotel_storage;
        return view('admin.storage.printsticker',compact('data','data_detail'));
    }
    public function print_ticket($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();
        $data_detail = $data->hotel_storage;
        return view('admin.storage.printticket',compact('data','data_detail'));
    }
    public function emailsub(Request $request,$id,$staff)
    {
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = 0;
            $datas = [
                    'to' => $request->to,
                    'cname' => $request->cname,
                    'number_plate' => $request->number_plate,
                    'subject' => $request->subject,
                    'body' => $request->message,
                    'storage_id' => $request->storage_id,
                    'location' => $request->location,
                    'mng' => $request->mng,
                    'size' => $request->size,
                    'brand' => $request->brand,
                    'qty' => $request->qty,
                    'reg_date' => $request->reg_date,
                    'is_rim' => $request->is_rim,
                    'weather' => $request->weather
            ];

            $mailer = new GeniusMailer();
            $mail = $mailer->sendCustomMail($datas);
            if($mail) {
                $data = 1;
            }
        }
        else
        {
            $data = 0;
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            $mail = mail($request->email,$request->subject,$request->message,$headers);
            if($mail) {
                $data = 1;
            }
        }
        $log_arr = array();
        $log_arr['storage_idx'] = $id;
        $log_arr['content'] = 'Sent E-Mail for new tire register';
        $log_arr['staff_id'] = $staff;
        $log = Log::create($log_arr);
        return response()->json($data);
    }

    public function pickedemailsub(Request $request,$id,$staff)
    {
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = 0;
            $datas = [
                    'to' => $request->to,
                    'cname' => $request->cname,
                    'number_plate' => $request->number_plate,
                    'car_make' => $request->car_make,
                    'subject' => $request->subject,
                    'body' => $request->message,
                    'storage_ID' => $request->storage_ID,
                    'tire_size' => $request->tire_size,
                    'tire_brand' => $request->tire_brand,
                    'reg_date' => $request->reg_date,
                    'is_rim' => $request->is_rim,
                    'qty' => $request->qty,
                    'weather' => $request->weather,
            ];

            $mailer = new GeniusMailer();
            $mail = $mailer->sendPickedMail($datas);
            if($mail) {
                $data = 1;
            }
        }
        else
        {
            $data = 0;
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            $mail = mail($request->email,$request->subject,$request->message,$headers);
            if($mail) {
                $data = 1;
            }
        }
        
        return response()->json($data);
    }
    //*** GET Request
    public function load($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Storage::where('storage_idx','=',$id)->first();

        if($data->photos == null){
            Storage::where('storage_idx','=',$id)->delete();
            //--- Redirect Section
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/storage/'.$data->photos)) {
            unlink(public_path().'/assets/images/storage/'.$data->photos);
        }
        
 
        Storage::where('storage_idx','=',$id)->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
