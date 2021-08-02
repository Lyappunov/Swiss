<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\HotelStorage;
use App\Models\Storage;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

class HotelStorageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = HotelStorage::orderBy('hotel_id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('register', function(HotelStorage $data) {
                                $status = '';
                                $class = '';
                                $is=null;
                                if($data->storage()->get()!=null) $is=$data->storage()->get();
                                if($is!=null || $is!=0){
                                    $status = 'Registered';
                                    $count =  $data->storage()->count();
                                    // $count =  0;
                                    $class = 'drop-success';
                                }else{
                                    $status = 'Not Register';
                                    $class = 'drop-danger';
                                }
                                return '<div class="action-list"><a class="'.$class.'">'.__($status).'('.$count.')</a></div>';
                            })
                            ->addColumn('detail', function(HotelStorage $data) {
                                $detail = '';
                                $is=null;
                                if($data->storage()->get()!=null) $is=$data->storage()->get();
                                if($is!=null || $is!=0){
                                    
                                    $detail = '<a href="' . route('admin-storage-conindex',$data->hotel_id) . '"> <i class="fas fa-eye"></i>'.__('Details').'</a>';
                                    
                                }
                                return '<div class="action-list">'.$detail.'</div>';
                            })
                            ->addColumn('action', function(HotelStorage $data) {
                                $is_super = (Auth::guard('admin')->user()->role_id == 0)?1:0;
                                $is_add_tire = Auth::guard('admin')->user()->sectionCheck('input_tire_info')?1:0;
                                $is_edit_customer = Auth::guard('admin')->user()->sectionCheck('change_customer_info')?1:0;
                                $is_delete_customer = Auth::guard('admin')->user()->sectionCheck('delete_customer')?1:0;
                                $action_add = '';
                                $action_edit = '';
                                $action_delete = '';
                                if($is_super==1 || $is_add_tire==1){
                                    $action_add = '<a href="' . route('admin-storage-create',$data->hotel_id) . '" class="edit" > <i class="fas fa-plus"></i>'.__('Add Tire').'</a>';
                                }
                                if($is_super==1 || $is_edit_customer==1){
                                    $action_edit = '<a data-href="' . route('admin-hotel-edit',$data->hotel_id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a>';
                                }
                                if($is_super==1 || $is_delete_customer==1){
                                    $action_delete = '<a href="javascript:;" data-href="' . route('admin-hotel-delete',$data->hotel_id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                }
                                return '<div class="action-list">'.$action_add.$action_edit.$action_delete.'</div>';
                                
                            })
                            ->rawColumns(['register','detail','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.hotelstorage.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.hotelstorage.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        //--- Logic Section
        $data = new HotelStorage();
        $input = $request->all();
        //--- Validation Section
        $rules = [
            'email' => 'required|email'
                ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = HotelStorage::where('hotel_id','=',$id)->first();
        return view('admin.hotelstorage.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'email' => 'required|email'
                ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all();
        $data = HotelStorage::where('hotel_id','=',$id)->update($input);
        //--- Logic Section Ends

        $log_arr = array();
        $storage_data = Storage::where('hotel_id','=',$id);
        if($storage_data->exists()){
            $storage_data_data = $storage_data->get();
            foreach($storage_data_data as $storage){
                $log_arr['storage_idx'] = $storage->storage_idx;
                $log_arr['content'] = 'Changed Customer Info';
                $log_arr['staff_id'] = $request->staff_id;
                $log = Log::create($log_arr);
            }
        }

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = HotelStorage::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = HotelStorage::where('hotel_id','=',$id)->first();

        if($data->storage->count() > 0)
        {
        //--- Redirect Section
        $msg = 'Remove the Storage(Tires) first !';
        return response()->json($msg);
        //--- Redirect Section Ends
        }


        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
