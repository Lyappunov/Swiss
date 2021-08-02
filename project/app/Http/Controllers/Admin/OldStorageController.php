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
use DateTime;

class OldStorageController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
        
        $now_date = date("Y-m-d");
        $datas = Storage::whereRaw('TIMESTAMPDIFF(month, storages.created_at,"'.$now_date.'") >= ?', [18])
                        ->where('is_booking','=',0)
                        ->where('is_picked_up','=',0)
                        ->get();

        // $datas = Storage::where('is_picked_up','=',2)->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('customer_name', function(Storage $data) {
                               return $data->hotel_storage->customer_name;
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
                                return '<div class="action-list"><a class="'.$class.'">'.$pure_months.' (Months)</a></div>';
                            })
                            ->addColumn('action', function(Storage $data) {
                                
                                return '<div class="action-list"><a href="' . route('admin-storage-details',$data->storage_idx) . '"> <i class="fas fa-eye"></i>Details</a></div>';
                            })
                            ->rawColumns(['saving_months','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.oldstorage.index');
    }

    //*** GET Request
    public function create($id)
    {
        $hotel_id = $id;
        return view('admin.storage.create',compact('hotel_id'));
    }

    
}
