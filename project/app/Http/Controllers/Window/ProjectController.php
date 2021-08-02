<?php

namespace App\Http\Controllers\Window;

use App\Models\Childcategory;
use App\Models\Subcategory;
use App\Models\Admin;
use Datatables;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\HotelStorage;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;
use Auth;
use DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Project::all();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Project $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->addColumn('administrator', function(Project $data) {
                                $administrator = Admin::where('id', $data->admin_id)->first();
                                return $administrator->name;
                            })
                            ->addColumn('customer', function(Project $data) {
                                $customer = Customer::where('id', $data->customer_id)->first();
                                return $customer->name;
                            })
                            ->addColumn('status', function(Project $data) {
                                $class = "drop-warning";
                                if($data->status == 1)
                                    $class = "drop-warning";
                                else if($data->status == 2)
                                    $class = "drop-success";
                                else if($data->status == 3)
                                    $class = "drop-danger";

                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 2 ? 'selected' : '';
                                $ms = $data->status == 3 ? 'selected' : '';

                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('project-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>In Work</option><option data-val="2" value="'. route('project-status',['id1' => $data->id, 'id2' => 2]).'" '.$ns.'>Closed</option><option data-val="3" value="'. route('project-status',['id1' => $data->id, 'id2' => 3]).'" '.$ms.'>Offerphase</option></select></div>';
                            })
                            ->addColumn('action', function(Project $data) {
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('project-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson();
    }

    public function datatables_working()
    {
         $datas = Project::where('status',1)->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Project $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->addColumn('administrator', function(Project $data) {
                                $administrator = Admin::where('id', $data->admin_id)->first();
                                return $administrator->name;
                            })
                            ->addColumn('customer', function(Project $data) {
                                $customer = Customer::where('id', $data->customer_id)->first();
                                return $customer->name;
                            })
                            ->addColumn('status', function(Project $data) {
                                $class = "drop-warning";
                                if($data->status == 1)
                                    $class = "drop-warning";
                                else if($data->status == 2)
                                    $class = "drop-success";
                                else if($data->status == 3)
                                    $class = "drop-danger";

                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 2 ? 'selected' : '';
                                $ms = $data->status == 3 ? 'selected' : '';

                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('project-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>In Work</option><option data-val="2" value="'. route('project-status',['id1' => $data->id, 'id2' => 2]).'" '.$ns.'>Closed</option><option data-val="3" value="'. route('project-status',['id1' => $data->id, 'id2' => 3]).'" '.$ms.'>Offerphase</option></select></div>';
                            })
                            ->addColumn('action', function(Project $data) {
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('project-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson();
    }

    public function datatables_offer()
    {
        $datas = Project::where('status',3)->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Project $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->addColumn('administrator', function(Project $data) {
                                $administrator = Admin::where('id', $data->admin_id)->first();
                                return $administrator->name;
                            })
                            ->addColumn('customer', function(Project $data) {
                                $customer = Customer::where('id', $data->customer_id)->first();
                                return $customer->name;
                            })
                            ->addColumn('status', function(Project $data) {
                                $class = "drop-warning";
                                if($data->status == 1)
                                    $class = "drop-warning";
                                else if($data->status == 2)
                                    $class = "drop-success";
                                else if($data->status == 3)
                                    $class = "drop-danger";

                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 2 ? 'selected' : '';
                                $ms = $data->status == 3 ? 'selected' : '';

                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('project-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>In Work</option><option data-val="2" value="'. route('project-status',['id1' => $data->id, 'id2' => 2]).'" '.$ns.'>Closed</option><option data-val="3" value="'. route('project-status',['id1' => $data->id, 'id2' => 3]).'" '.$ms.'>Offerphase</option></select></div>';
                            })
                            ->addColumn('action', function(Project $data) {
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('project-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson();
    }

    public function datatables_closed()
    {
        $datas = Project::where('status',2)->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Project $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                return  $name.'<br>'.$id;
                            })
                            ->addColumn('administrator', function(Project $data) {
                                $administrator = Admin::where('id', $data->admin_id)->first();
                                return $administrator->name;
                            })
                            ->addColumn('customer', function(Project $data) {
                                $customer = Customer::where('id', $data->customer_id)->first();
                                return $customer->name;
                            })
                            ->addColumn('status', function(Project $data) {
                                $class = "drop-warning";
                                if($data->status == 1)
                                    $class = "drop-warning";
                                else if($data->status == 2)
                                    $class = "drop-success";
                                else if($data->status == 3)
                                    $class = "drop-danger";

                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 2 ? 'selected' : '';
                                $ms = $data->status == 3 ? 'selected' : '';

                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('project-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>In Work</option><option data-val="2" value="'. route('project-status',['id1' => $data->id, 'id2' => 2]).'" '.$ns.'>Closed</option><option data-val="3" value="'. route('project-status',['id1' => $data->id, 'id2' => 3]).'" '.$ms.'>Offerphase</option></select></div>';
                            })
                            ->addColumn('action', function(Project $data) {
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('project-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson();
    }
    

    //*** JSON Request
    public function deactivedatatables()
    {
         $datas = Product::where('status','=',0)->orderBy('id','desc')->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Product $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                                $id2 = $data->user_id != 0 ? ( count($data->user->products) > 0 ? '<small class="ml-2"> VENDOR: <a href="'.route('admin-vendor-show',$data->user_id).'" target="_blank">'.$data->user->shop_name.'</a></small>' : '' ) : '';

                                $id3 = $data->type == 'Physical' ?'<small class="ml-2"> SKU: <a href="'.route('front.product', $data->slug).'" target="_blank">'.$data->sku.'</a>' : '';

                                return  $name.'<br>'.$id.$id3.$id2;
                            })
                            ->editColumn('price', function(Product $data) {
                                $sign = Currency::where('is_default','=',1)->first();
                                $price = round($data->price * $sign->value , 2);
                                $price = $sign->sign.$price ;
                                return  $price;
                            })
                            ->editColumn('stock', function(Product $data) {
                                $stck = (string)$data->stock;
                                if($stck == "0")
                                return "Out Of Stock";
                                elseif($stck == null)
                                return "Unlimited";
                                else
                                return $data->stock;
                            })
                            ->addColumn('status', function(Product $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-prod-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-prod-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Product $data) {
                                $catalog = $data->type == 'Physical' ? ($data->is_catalog == 1 ? '<a href="javascript:;" data-href="' . route('admin-prod-catalog',['id1' => $data->id, 'id2' => 0]) . '" data-toggle="modal" data-target="#catalog-modal" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a>' : '<a href="javascript:;" data-href="'. route('admin-prod-catalog',['id1' => $data->id, 'id2' => 1]) .'" data-toggle="modal" data-target="#catalog-modal"> <i class="fas fa-plus"></i> Add To Catalog</a>') : '';
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a>'.$catalog.'<a data-href="' . route('admin-prod-feature',$data->id) . '" class="feature" data-toggle="modal" data-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    public function status($id1,$id2)
    {
        $data = Project::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    public function edit($id)
    {
        $data = Project::findOrFail($id);
        $table_info = Storage::disk('public')->get($data->project_table);
        $table = json_decode($table_info);

        $order_table_info = Storage::disk('public')->get($data->order_table);
        $order_table = json_decode($order_table_info);
        $customers = Customer::all();
        
        return view('window.projects.edit',compact('data','table','order_table','customers'));
    }

    public function index()
    {
        return view('window.projects.index');
    }

    public function new()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();

        return view('window.projects.create', compact('new_index','customers'));
    }
    public function working()
    {
        return view('window.projects.working');
    }
    
    public function offer()
    {
        return view('window.projects.offer');
    }

    public function closed()
    {
        return view('window.projects.closed');
    }

    public function invoices()
    {
        return view('window.projects.blank');
    }
    public function offerte_bestellung()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.offerte_bestellung', compact('new_index','customers'));
    }
    public function einkauf()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.einkauf', compact('new_index','customers'));
    }
    public function offerte_and_Vertrag()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.offerte_and_Vertrag', compact('new_index','customers'));
    }
    public function rechnung()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.rechnung', compact('new_index','customers'));
    }
    public function kommunikation()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.kommunikation', compact('new_index','customers'));
    }
    public function termine()
    {
        $last = Project::orderBy('id', 'DESC')->first();
        $new_index = $last->id + 1;
        $new_index = sprintf("%'.08d",$new_index);
        $customers = Customer::all();
        return view('window.projects.termine', compact('new_index','customers'));
    }
    public function new_event()
    {
        return view('window.projects.blank');
    }
    public function all_events()
    {
        return view('window.projects.blank');
    }
    public function guaratees()
    {
        return view('window.projects.blank');
    }
    public function create_new(Request $request)
    {
        //--- Validation Section
        $rules = [
            'photo'      => 'required',
            'file'       => 'mimes:zip'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Project;
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();

        // Check File
        if ($file = $request->file('file')) {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/files',$name);
            $input['file'] = $name;
        }

        $image = $request->photo;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time().str_random(8).'.png';
        $path = 'assets/images/projects/'.$image_name;
        file_put_contents($path, $image);
        $input['photo'] = $image_name;

        // Save Data
        $data->fill($input)->save();


        // Set Thumbnail
        $prod = Project::find($data->id);
        $img = Image::make(public_path().'/assets/images/projects/'.$prod->photo)->resize(285, 285);
        $thumbnail = time().str_random(8).'.jpg';
        $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
        $prod->thumbnail  = $thumbnail;
        $prod->update();

        // Add To Gallery If any
        $lastid = $data->id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                if(in_array($key, $request->galval))
                {
                    $gallery = new Gallery;
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/galleries',$name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery['project_id'] = $lastid;
                    $gallery->save();
                }
            }
        }

        $table_info = json_decode($request->project_table_info);
        $table_json_file_name = time().str_random(8).'.json';
        $prod = Project::find($data->id);
        $prod->project_table  = $table_json_file_name;
        $prod->update();
        Storage::disk('public')->put($table_json_file_name, json_encode($table_info));

        $project_order_table_info = json_decode($request->project_order_table_info);
        $table_json_file_name = time().str_random(8).'_order.json';
        $prod = Project::find($data->id);
        $prod->order_table  = $table_json_file_name;
        $prod->update();
        Storage::disk('public')->put($table_json_file_name, json_encode($project_order_table_info));
        
        $msg = 'New Product Added Successfully.';
        return response()->json($msg);
    }
    public function update(Request $request,$id)
    {
        $rules = [
            'file'       => 'mimes:zip'
             ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends


        //-- Logic Section
        $data = Project::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();

            //Check Types
        if($request->type_check == 1)
        {
            $input['link'] = null;
        }
        else
        {
            if($data->file!=null){
                    if (file_exists(public_path().'/assets/files/'.$data->file)) {
                    unlink(public_path().'/assets/files/'.$data->file);
                }
            }
            $input['file'] = null;
        }

        $rules = ['sku' => 'min:8|unique:products,sku,'.$id];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
                   
        $data->update($input);
        //-- Logic Section Ends


        

        $table_info = json_decode($request->project_table_info);
        $table_json_file_name = time().str_random(8).'.json';
        $prod = Project::find($data->id);
        $prod->project_table  = $table_json_file_name;
        $prod->update();
        Storage::disk('public')->put($table_json_file_name, json_encode($table_info));

        $project_order_table_info = json_decode($request->project_order_table_info);
        $table_json_file_name = time().str_random(8).'_order.json';
        $prod = Project::find($data->id);
        $prod->order_table  = $table_json_file_name;
        $prod->update();
        Storage::disk('public')->put($table_json_file_name, json_encode($project_order_table_info));

        //--- Redirect Section
        $msg = 'Product Updated Successfully.';
        return response()->json($msg);
    }
}
