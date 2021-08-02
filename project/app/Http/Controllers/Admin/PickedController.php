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

class PickedController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Storage::where(['is_picked_up'=>1])
                            ->orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
                            })
                            ->addColumn('storage_id', function(Storage $data) {
                                return $data->storage_ID;
                            })
                            ->addColumn('date', function(Storage $data) {
                                $log_data = $data->logs()->where(['content'=>'Picked Up'])->get();
                                $booking_date ='';
                                foreach($log_data as $log){
                                    $booking_date = $log->created_at;
                                }
                                return $booking_date;
                            })
                            ->addColumn('action', function(Storage $data) {
                                
                                return '<div class="action-list"><a href="' . route('admin-storage-details',$data->storage_idx) . '"> <i class="fas fa-eye"></i>Details</a></div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.picked.index');
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        return view('admin.storage.create',compact('hotel_id'));
    }

    
}
