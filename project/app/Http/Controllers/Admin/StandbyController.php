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

class StandbyController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Storage::where(['is_booking'=>0,'is_picked_up'=>0])
                            ->orderBy('storage_idx','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                                return $data->hotel_storage->customer_name;
                            })
                            ->addColumn('storage_id', function(Storage $data) {
                                return $data->storage_ID;
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
        return view('admin.standby.index');
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        return view('admin.storage.create',compact('hotel_id'));
    }

    
}
