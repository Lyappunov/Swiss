<?php

namespace App\Http\Controllers\Admin;
use App\Classes\GeniusMailer;
use Datatables;
use App\Models\HotelStorage;
use App\Models\Storage;
use App\Models\Log;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;

class NewController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Storage::where(['is_booking'=>0,'is_picked_up'=>3])
                            ->orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
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
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.new.index');
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        return view('admin.storage.create',compact('hotel_id'));
    }

    
}
