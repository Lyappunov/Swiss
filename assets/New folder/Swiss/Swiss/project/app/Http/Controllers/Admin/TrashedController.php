<?php

namespace App\Http\Controllers\Admin;
use App\Classes\GeniusMailer;
use Datatables;
use App\Models\HotelStorage;
use App\Models\Storage;
//use App\Models\Log;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;

class TrashedController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        
        $now_date = date("Y-m-d");
        // $datas = Storage::whereRaw('TIMESTAMPDIFF(month, storages.created_at,"'.$now_date.'") >= ?', [18])
        //                 ->where('is_booking','=',0)
        //                 ->where('is_picked_up','=',0)
        //                 ->get();

        $datas = Storage::where('is_picked_up','=',2)->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                               return $data->hotel_storage->customer_name;
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
        return view('admin.trashed.index');
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        return view('admin.storage.create',compact('hotel_id'));
    }

    
}
