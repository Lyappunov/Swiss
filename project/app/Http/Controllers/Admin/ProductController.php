<?php

namespace App\Http\Controllers\Admin;

use App\Models\Childcategory;
use App\Models\Subcategory;
use App\Models\Admin;
use Datatables;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Storage;
use App\Models\HotelStorage;
use App\Models\Project;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Validator;
use Image;
use Auth;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Product::where('product_type','=','normal')->orderBy('id','desc')->get();

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


    //*** JSON Request
    public function catalogdatatables()
    {
         $datas = Product::where('is_catalog','=',1)->orderBy('id','desc')->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('name', function(Product $data) {
                                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                                $id = '<small>ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';

                                $id3 = $data->type == 'Physical' ?'<small class="ml-2"> SKU: <a href="'.route('front.product', $data->slug).'" target="_blank">'.$data->sku.'</a>' : '';

                                return  $name.'<br>'.$id.$id3;
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
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-prod-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> View Gallery</a><a data-href="' . route('admin-prod-feature',$data->id) . '" class="feature" data-toggle="modal" data-target="#modal2"> <i class="fas fa-star"></i> Highlight</a><a href="javascript:;" data-href="' . route('admin-prod-catalog',['id1' => $data->id, 'id2' => 0]) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Remove Catalog</a></div></div>';
                            })
                            ->rawColumns(['name', 'status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.product.index');
    }

    //*** GET Request
    public function deactive()
    {
        return view('admin.product.deactive');
    }

    //*** GET Request
    public function catalogs()
    {
        return view('admin.product.catalog');
    }

    //*** GET Request
    public function types()
    {
        return view('admin.product.types');
    }

    //*** GET Request
    public function createPhysical()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.create.physical',compact('cats','sign'));
    }

    //*** GET Request
    public function createDigital()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.create.digital',compact('cats','sign'));
    }

    //*** GET Request
    public function createLicense()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.create.license',compact('cats','sign'));
    }

    //*** GET Request
    public function status($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request
    public function catalog($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->is_catalog = $id2;
        $data->update();
        if($id2 == 1) {
            $msg = "Product added to catalog successfully.";
        }
        else {
            $msg = "Product removed from catalog successfully.";
        }

        return response()->json($msg);

    }

    //*** POST Request
    public function uploadUpdate(Request $request,$id)
    {
        //--- Validation Section
        $rules = [
          'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Project::findOrFail($id);

        //--- Validation Section Ends
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time().str_random(8).'.png';
        $path = 'assets/images/projects/'.$image_name;
        file_put_contents($path, $image);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/projects/'.$data->photo)) {
                        unlink(public_path().'/assets/images/projects/'.$data->photo);
                    }
                }
                        $input['photo'] = $image_name;
         $data->update($input);
                if($data->thumbnail != null)
                {
                    if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail)) {
                        unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
                    }
                }

        $img = Image::make(public_path().'/assets/images/projects/'.$data->photo)->resize(285, 285);
        $thumbnail = time().str_random(8).'.jpg';
        $img->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
        $data->thumbnail  = $thumbnail;
        $data->update();
        return response()->json(['status'=>true,'file_name' => $image_name]);
    }

    //*** POST Request
    //*** POST Request
    public function store(Request $request)
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
        $data = new Product;
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
        $path = 'assets/images/products/'.$image_name;
        file_put_contents($path, $image);
        $input['photo'] = $image_name;


        // Check Physical
        if($request->type == "Physical")
        {

            //--- Validation Section
            $rules = ['sku'      => 'min:8|unique:products'];

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends


            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size
            if(empty($request->size_check ))
            {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            }
            else{
                if(in_array(null, $request->size) || in_array(null, $request->size_qty))
                {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                }
                else
                {
                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $input['size_price'] = implode(',', $request->size_price);
                }
            }


            // Check Whole Sale
            if(empty($request->whole_check ))
            {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            }
            else{
                if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
                }
                else
                {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if(empty($request->color_check))
            {
                $input['color'] = null;
            }
            else{
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "")
            {
                $input['measure'] = null;
            }

        }

        // Check Seo
        if (empty($request->seo_check))
        {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        }
        else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License

        if($request->type == "License")
        {

            if(in_array(null, $request->license) || in_array(null, $request->license_qty))
            {
                $input['license'] = null;
                $input['license_qty'] = null;
            }
            else
            {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }

        }

        // Check Features
        if(in_array(null, $request->features) || in_array(null, $request->colors))
        {
            $input['features'] = null;
            $input['colors'] = null;
        }
        else
        {
            $input['features'] = implode(',', str_replace(',',' ',$request->features));
            $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
        }

        //tags
        if (!empty($request->tags))
        {
            $input['tags'] = implode(',', $request->tags);
        }



        // Conert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        $input['previous_price'] = ($input['previous_price'] / $sign->value);



        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
          $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
          if (!empty($catAttrs)) {
            foreach ($catAttrs as $key => $catAttr) {
              $in_name = $catAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($catAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }

        if (!empty($request->subcategory_id)) {
          $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
          if (!empty($subAttrs)) {
            foreach ($subAttrs as $key => $subAttr) {
              $in_name = $subAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($subAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }
        if (!empty($request->childcategory_id)) {
          $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
          if (!empty($childAttrs)) {
            foreach ($childAttrs as $key => $childAttr) {
              $in_name = $childAttr->input_name;
              if ($request->has("$in_name")) {
                $attrArr["$in_name"]["values"] = $request["$in_name"];
                $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                if ($childAttr->details_status) {
                  $attrArr["$in_name"]["details_status"] = 1;
                } else {
                  $attrArr["$in_name"]["details_status"] = 0;
                }
              }
            }
          }
        }



        if (empty($attrArr)) {
          $input['attributes'] = NULL;
        } else {
          $jsonAttr = json_encode($attrArr);
          $input['attributes'] = $jsonAttr;
        }



        // Save Data
        $data->fill($input)->save();

        // Set SLug
        $prod = Product::find($data->id);
        if($prod->type != 'Physical'){
            $prod->slug = str_slug($data->name,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
        }
        else {
            $prod->slug = str_slug($data->name,'-').'-'.strtolower($data->sku);
        }

        // Set Thumbnail
        $img = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(285, 285);
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
                    $gallery->save();
                }
            }
        }
        //logic Section Ends

        //--- Redirect Section
        $msg = 'New Product Added Successfully.<a href="'.route('admin-prod-index').'">View Product Lists.</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** POST Request
    public function import(){

        return view('admin.product.productcsv');
    }

    public function importSubmit(Request $request)
    {
        $logs = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,xls,xlsx,txt',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $filename = '';
        if ($file = $request->file('csvfile'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->move('assets/temp_files',$filename);
        }

        //$filename = $request->file('csvfile')->getClientOriginalName();
        //return response()->json($filename);
        $datas = "";

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $i = 1;
        $yes_array=array();
        $no_array = array();
        $forbidden_array = array();
        while (($line = fgetcsv($file,100,',')) !== FALSE) {
            if($i != 1)
            {
                $domainName = '';
                $domainName = $line[1];
                $mainDomain = "https://".$domainName;
                $url = array();
                $url[0] = $mainDomain.'/contact';
                $url[1] = $mainDomain.'/contact-us';
                $url[2] = $mainDomain.'/#contact';
                $url[3] = $mainDomain.'/#contact-us';
                $url[4] = $mainDomain.'/contacts';
                for($k=0;$k<5;$k++){
                    $headers = @get_headers($url[$k]);
                    if($headers){
                        if(strpos($headers[0],'404') === false)
                        {
                            Log::Info("URL Exists // ".$url[$k]) ;
                            array_push($yes_array, $url[$k]);
                            break;
                        }
                        else
                        {
                            if($k==4){
                                Log::Info("URL Not Exists // ".$mainDomain) ;
                                array_push($no_array, $mainDomain);
                                break;
                            }else {
                                continue;
                            }
                        }
                    }
                    else {
                        Log::Info("URL is forbidden // ".$url[$k]) ;
                        array_push($forbidden_array, $url[$k]);
                        break;
                    }
                }
            }

            $i++;

        }
        // $msg = '';
        // $url = "https://facebook.com/";
        //         $headers = @get_headers($url);
        //         Log::Info("header info is ".$headers);
        //         if($headers){
        //             if(strpos($headers[0],'404') === false)
        //             {
        //                 $msg = "URL Exists";
                        
        //             }
        //             else
        //             {
        //                 $msg = "URL Not Exists";
                        
        //             }
        //         } else $msg = "The URL is forbidden to access";

        fclose($file);


        //--- Redirect Section
        $msg = 'the number of existance URL are '.sizeof($yes_array).'// the number of noexistance URL are'.sizof($no_array).' // the number of noexistance URL are '.sizof($forbidden_array);
        
        return response()->json($msg);
    }

    public function importSubmit_origin(Request $request)
    {
        $logs = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,xls,xlsx,txt',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $filename = '';
        if ($file = $request->file('csvfile'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            $file->move('assets/temp_files',$filename);
        }

        //$filename = $request->file('csvfile')->getClientOriginalName();
        //return response()->json($filename);
        $datas = "";

        $file = fopen(public_path('assets/temp_files/'.$filename),"r");
        $i = 1;
        while (($line = fgetcsv($file,1000,';')) !== FALSE) {
            if($i != 1)
            {
                $newDate = null;
                $pickedDate = null;
                $staff_id = null;
                $content = null;
                if(strlen($line[6])!=0){
                    $oldDate = $line[6];
                    $arr = explode('.', $oldDate);
                    
                    if(sizeof($arr) == 3){
                        if(strlen($arr[2])==2)$newDate = '20'.$arr[2].'-'.$arr[1].'-'.$arr[0].' '.rand(10,23).':'.rand(10,59).':'.rand(10,59);
                        else if(strlen($arr[2])==4)$newDate = $arr[2].'-'.$arr[1].'-'.$arr[0].' '.rand(10,23).':'.rand(10,59).':'.rand(10,59);
                    }
                }
                if(strlen($line[15])!=0){
                    $pickDate = $line[15];
                    $arr_pick = explode('.', $pickDate);
                    
                    if(sizeof($arr_pick) == 3){
                        if(strlen($arr_pick[2])==2)$pickedDate = '20'.$arr_pick[2].'-'.$arr_pick[1].'-'.$arr_pick[0].' '.rand(10,23).':'.rand(10,59).':'.rand(10,59);
                        else if(strlen($arr_pick[2])==4)$pickedDate = $arr_pick[2].'-'.$arr_pick[1].'-'.$arr_pick[0].' '.rand(10,23).':'.rand(10,59).':'.rand(10,59);
                    }
                }
                if(strlen($line[16])!=0){
                    $staff_id = Admin::where('name','=', $line[16])->first()->id; 
                }
                // $quantity = eval('return '.$line[8].';');
                $quantity = $line[8];
                if (Storage::where(['storage_ID'=>$line[4]])->count()==0 || Storage::where(['storage_ID'=>$line[4]])->count()==null){
                    //--- Validation Section Ends

                    //--- Logic Section
                    $data = new Storage;

                    $input['hotel_id'] = "";

                    //$hotelstorage = HotelStorage::where(DB::raw('lower(name)'), strtolower($line[1]));
                    $hotelstorage = HotelStorage::where("customer_name", $line[0]);

                    if($hotelstorage->count()!=0 || $hotelstorage->count()!=null){
                        $input_data['hotel_id'] = $hotelstorage->first()->hotel_id;
                        $input_data['storage_ID'] = ($line[4]);
                        $input_data['location'] = ($line[5]);
                        $input_data['quantity'] = $quantity;
                        $input_data['tire_size'] = ($line[9]);
                        $input_data['tire_brand'] = ($line[11]);
                        $input_data['weather'] = ($line[12])=='S'?1:0;
                        $input_data['is_rim'] = ($line[13])=='Já'?1:0;
                        $input_data['rim_size'] = ($line[10]);
                        $input_data['photos'] = 'upload.png';
                        $input_data['car_license'] = ($line[3]);
                        $input_data['car_make'] = ($line[7]);
                        $input_data['created_at'] = $newDate;
                        $input_data['updated_at'] = $pickedDate;
                        $inpurt_data['is_picked_up'] = 0;
                        $inpurt_data['is_booking'] = 0;
                        switch ($line[14]){
                            case 'Picked up':
                                $input_data['is_picked_up'] = 1;
                                $input_data['is_booking'] = 1;
                                $content = 'Picked Up';
                            break;
                            case 'Booked':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 1;
                                $content = 'Booked appointment';
                            break;
                            case 'Stand By':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 0;
                                $content = 'Newly Registered';
                            break;
                            case 'Trashed':
                                $input_data['is_picked_up'] = 2;
                                $input_data['is_booking'] = 0;
                                $content = 'Trashed';
                            break;
                        }
                    
                        $input_data['staff_id'] = Auth::guard("admin")->user()->id;
   
                    // Save Data
                        Storage::insert($input_data);
                        // $data->fill($input_data)->save();
                        $log_arr = array();
                        $recent_id = Storage::max('storage_idx');
                        $log_arr['storage_idx'] = $recent_id;
                        $log_arr['staff_id'] = $staff_id;
                        $log_arr['content'] = $content;
                        $log_arr['created_at'] = $pickedDate;
                        Log::insert($log_arr);

                    }
                    else{
                        $data_hotel = new HotelStorage;
                        $input_hotel['customer_name'] = $line[0];
                        $input_hotel['social_id'] = null;
                        $input_hotel['home_address'] = $line[1];
                        $input_hotel['phone'] = ($line[2]);
                        $input_hotel['created_at'] = $newDate;
                        $input_hotel['email'] = null;
                        
                        $input_hotel['staff_id'] = Auth::guard("admin")->user()->id;

                        // $data_hotel->fill($input_hotel)->save();
                        HotelStorage::insert($input_hotel);
                        
                        $input_data['hotel_id']='';
                        $data_storage  = new Storage;
                        $hotelstorage = HotelStorage::where("customer_name", $line[0])->first();
                        $input_data['hotel_id'] = $hotelstorage->hotel_id;
                        $input_data['storage_ID'] = ($line[4]);
                        $input_data['location'] = ($line[5]);
                        $input_data['quantity'] = $quantity;
                        $input_data['tire_size'] = ($line[9]);
                        $input_data['tire_brand'] = ($line[11]);
                        $input_data['weather'] = ($line[12])=='S'?1:0;
                        $input_data['is_rim'] = ($line[13])=='Já'?1:0;
                        $input_data['rim_size'] = ($line[10]);
                        $input_data['photos'] = 'upload.png';
                        $input_data['car_license'] = ($line[3]);
                        $input_data['car_make'] = ($line[7]);
                        $input_data['created_at'] = $newDate;
                        $input_data['updated_at'] = $pickedDate;
                        $input_data['is_picked_up'] = 0;
                        $input_data['is_booking'] = 0;
                        switch ($line[14]){
                            case 'Picked up':
                                $input_data['is_picked_up'] = 1;
                                $input_data['is_booking'] = 1;
                                $content = 'Picked Up';
                            break;
                            case 'Booked':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 1;
                                $content = 'Booked appointment';
                            break;
                            case 'Stand By':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 0;
                                $content = 'Newly Registered';
                            break;
                            case 'Trashed':
                                $input_data['is_picked_up'] = 2;
                                $input_data['is_booking'] = 0;
                                $content = 'Trashed';
                            break;
                        }
                        $input_data['staff_id'] = Auth::guard("admin")->user()->id;
                        // $data_storage->fill($input_data)->save();
                        Storage::insert($input_data);

                        $log_arr = array();
                        $recent_id = Storage::max('storage_idx');
                        $log_arr['storage_idx'] = $recent_id;
                        $log_arr['content'] = $content;
                        $log_arr['staff_id'] = $staff_id;
                        $log_arr['created_at'] = $pickedDate;
                        Log::insert($log_arr);
                    }

                }
                else
                {
                    // $logs .= "<br>Row No: ".$i." - Duplicate Product Code!<br>";
                    $input_data = array();
                    $input_hotel = array();
                    $exist_data = Storage::where(['storage_ID'=>($line[4])])->first();
                    $exist_hotel_id = $exist_data->hotel_storage->hotel_id;
                        $input_data['hotel_id'] = $exist_hotel_id;
                        $input_data['storage_ID'] = ($line[4]);
                        $input_data['location'] = ($line[5]);
                        $input_data['quantity'] = $quantity;
                        $input_data['tire_size'] = ($line[9]);
                        $input_data['tire_brand'] = ($line[11]);
                        $input_data['weather'] = $line[12]=='S'?1:0;
                        $input_data['is_rim'] = ($line[13])=='Já'?1:0;
                        $input_data['rim_size'] = ($line[10]);
                        $input_data['photos'] = 'upload.png';
                        $input_data['car_license'] = ($line[3]);
                        $input_data['car_make'] = ($line[7]);
                        $input_data['created_at'] = $newDate;
                        $input_data['updated_at'] = $pickedDate;
                        $inpurt_data['is_picked_up'] = 0;
                        $inpurt_data['is_booking'] = 0;
                        switch ($line[14]){
                            case 'Picked up':
                                $input_data['is_picked_up'] = 1;
                                $input_data['is_booking'] = 1;
                                $content = 'Picked Up';
                            break;
                            case 'Booked':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 1;
                                $content = 'Booked appointment';
                            break;
                            case 'Stand By':
                                $input_data['is_picked_up'] = 0;
                                $input_data['is_booking'] = 0;
                                $content = 'Newly Registered';
                            break;
                            case 'Trashed':
                                $input_data['is_picked_up'] = 2;
                                $input_data['is_booking'] = 0;
                                $content = 'Trashed';
                            break;
                            case 'Newly Registered':
                                $input_data['is_picked_up'] = 3;
                                $input_data['is_booking'] = 0;
                                $content = 'Newly Registered';
                            break;
                        }
                        $input_data['staff_id'] = Auth::guard("admin")->user()->id;
                    $update_data = Storage::where('storage_ID','=',($line[4]))
                                            ->update($input_data);

                    $input_hotel['customer_name'] = $line[0];
                    $input_hotel['social_id'] = null;
                    $input_hotel['home_address'] = $line[1];
                    $input_hotel['phone'] = ($line[2]);
                    $input_hotel['created_at'] = $newDate;
                    $input_hotel['email'] = null;
                    $input_hotel['staff_id'] = Auth::guard("admin")->user()->id;
                    $update_hotel = HotelStorage::where('hotel_id','=',$exist_hotel_id)
                                            ->update($input_hotel);
                    
                    $log_arr = array();
                    $log_arr['storage_idx'] = $exist_data->storage_idx;
                    $log_arr['content'] = $content;
                    $log_arr['staff_id'] = $staff_id;
                    $log_arr['created_at'] = $pickedDate;
                    Log::insert($log_arr);
                }

            }

            $i++;

        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Tires File Imported Successfully.<a href="'.route('admin-storage-index').'">View Storage(Tires) Lists.</a>'.$logs;
        return response()->json($msg);
    }

    public function exportSubmit(Request $request){
        $fileName = date("Y-m-d h:i:sa").'_'.'exported_tires.csv';
        $headers = array(
            "Content-type"        => "application/csv;",
            "Content-Encoding"    => "",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        echo "\xEF\xBB\xBF";
        $storage_data = Storage::all();
        
        $columns = array('Name', 'Home address', 'Mobile phone', 'Car numberplate', 'Storage ID', 'Storage Location', 'Date', 'Car', 'Qty', 'Size', 'Rim Size', 'Tire brand', 'S/V', 'On Rims','status','status date','user');
        $callback = function() use($storage_data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, ';');
            
            foreach($storage_data as $storage) {
                $weather = $storage->weather==1?'S':'V';
                $rim = $storage->is_rim == 1?'Já':'Nei';
                $status='';
                $status_date ='';
                $manager='';
                switch($storage->is_picked_up){
                    case 0:
                        $status = $storage->is_booking==0?'Stand By':'Booked';
                        $logs = $storage->logs()->get();
                        foreach($logs as $log){
                            if($status == 'Stand By'){
                                if($log->content=='Newly Registered'){
                                    $status_date = $log->created_at;
                                    if($log->staff_id != null)
                                    $manager = Admin::where('id', $log->staff_id)->first()->name;
                                }
                            }
                            else if($status == 'Booked'){
                                if($log->content=='Booked appointment'){
                                    $status_date = $log->created_at;
                                    if($log->staff_id != null)
                                    $manager = Admin::where('id', $log->staff_id)->first()->name;
                                }
                            }
                        }
                        break;
                    case 1:
                        $status  = "Picked up";
                        $logs = $storage->logs()->get();
                        foreach($logs as $log){
                            if($log->content == 'Picked Up'){
                                $status_date = $log->created_at;
                                if($log->staff_id != null)
                                $manager = Admin::where('id', $log->staff_id)->first()->name;
                            }
                        }
                        break;
                    case 2:
                        $status = 'Trashed';
                        $logs = $storage->logs()->get();
                        foreach($logs as $log){
                            if($log->content == 'Trashed'){
                                $status_date = $log->created_at;
                                if($log->staff_id != null)
                                $manager = Admin::where('id', $log->staff_id)->first()->name;
                            }
                        }
                        break;
                    case 3:
                        $status = 'Newly Registered';
                        $logs = $storage->logs()->get();
                        foreach($logs as $log){
                            if($log->content == 'Newly Registered'){
                                $status_date = $log->created_at;
                                if($log->staff_id != null)
                                $manager = Admin::where('id', $log->staff_id)->first()->name;
                            }
                        }
                        break;
                }
                $customer_data = $storage->hetel_storage;

                $reg_date_buffer = substr($storage->created_at,0,10);
                $reg_arr = explode('-', $reg_date_buffer);
                $regDate = null;
                if(sizeof($reg_arr) == 3){
                    if(strlen($reg_arr[0])==2)$regDate = $reg_arr[2].'.'.$reg_arr[1].'.'.'20'.$reg_arr[0];
                    else if(strlen($reg_arr[0])==4)$regDate = $reg_arr[2].'.'.$reg_arr[1].'.'.$reg_arr[0];
                }
 
                $status_date_buffer = substr($status_date,0,10);
                $status_arr = explode('-', $status_date_buffer);
                $statusDate = null;
                if(sizeof($status_arr) == 3){
                    if(strlen($status_arr[0])==2)$statusDate = $status_arr[2].'.'.$status_arr[1].'.'.'20'.$status_arr[0];
                    else if(strlen($status_arr[0])==4)$statusDate = $status_arr[2].'.'.$status_arr[1].'.'.$status_arr[0];
                }
                
                fputcsv($file, array($storage->hotel_storage->customer_name,$storage->hotel_storage->home_address,$storage->hotel_storage->phone,$storage->car_license,$storage->storage_ID,$storage->location,$regDate,$storage->car_make,$storage->quantity,$storage->tire_size,$storage->rim_size,$storage->tire_brand,$weather,$rim,$status,$statusDate,$manager),';');
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    //*** GET Request
    public function edit($id)
    {
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();


        if($data->type == 'Digital')
            return view('admin.product.edit.digital',compact('cats','data','sign'));
        elseif($data->type == 'License')
            return view('admin.product.edit.license',compact('cats','data','sign'));
        else
            return view('admin.product.edit.physical',compact('cats','data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
      // return $request;
        //--- Validation Section
        $rules = [
               'file'       => 'mimes:zip'
                ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends


        //-- Logic Section
        $data = Product::findOrFail($id);
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


            // Check Physical
            if($data->type == "Physical")
            {

                    //--- Validation Section
                    $rules = ['sku' => 'min:8|unique:products,sku,'.$id];

                    $validator = Validator::make(Input::all(), $rules);

                    if ($validator->fails()) {
                        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                    }
                    //--- Validation Section Ends

                        // Check Condition
                        if ($request->product_condition_check == ""){
                            $input['product_condition'] = 0;
                        }

                        // Check Shipping Time
                        if ($request->shipping_time_check == ""){
                            $input['ship'] = null;
                        }

                        // Check Size

                        if(empty($request->size_check ))
                        {
                            $input['size'] = null;
                            $input['size_qty'] = null;
                            $input['size_price'] = null;
                        }
                        else{
                                if(in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price))
                                {
                                    $input['size'] = null;
                                    $input['size_qty'] = null;
                                    $input['size_price'] = null;
                                }
                                else
                                {
                                    $input['size'] = implode(',', $request->size);
                                    $input['size_qty'] = implode(',', $request->size_qty);
                                    $input['size_price'] = implode(',', $request->size_price);
                                }
                        }



                        // Check Whole Sale
            if(empty($request->whole_check ))
            {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            }
            else{
                if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
                }
                else
                {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

                        // Check Color
                        if(empty($request->color_check ))
                        {
                            $input['color'] = null;
                        }
                        else{
                            if (!empty($request->color))
                             {
                                $input['color'] = implode(',', $request->color);
                             }
                            if (empty($request->color))
                             {
                                $input['color'] = null;
                             }
                        }

                        // Check Measure
                    if ($request->measure_check == "")
                     {
                        $input['measure'] = null;
                     }
            }


            // Check Seo
        if (empty($request->seo_check))
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
         else {
        if (!empty($request->meta_tag))
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);
         }
         }



        // Check License
        if($data->type == "License")
        {

        if(!in_array(null, $request->license) && !in_array(null, $request->license_qty))
        {
            $input['license'] = implode(',,', $request->license);
            $input['license_qty'] = implode(',', $request->license_qty);
        }
        else
        {
            if(in_array(null, $request->license) || in_array(null, $request->license_qty))
            {
                $input['license'] = null;
                $input['license_qty'] = null;
            }
            else
            {
                $license = explode(',,', $prod->license);
                $license_qty = explode(',', $prod->license_qty);
                $input['license'] = implode(',,', $license);
                $input['license_qty'] = implode(',', $license_qty);
            }
        }

        }
            // Check Features
            if(!in_array(null, $request->features) && !in_array(null, $request->colors))
            {
                    $input['features'] = implode(',', str_replace(',',' ',$request->features));
                    $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
            }
            else
            {
                if(in_array(null, $request->features) || in_array(null, $request->colors))
                {
                    $input['features'] = null;
                    $input['colors'] = null;
                }
                else
                {
                    $features = explode(',', $data->features);
                    $colors = explode(',', $data->colors);
                    $input['features'] = implode(',', $features);
                    $input['colors'] = implode(',', $colors);
                }
            }

        //Product Tags
        if (!empty($request->tags))
         {
            $input['tags'] = implode(',', $request->tags);
         }
        if (empty($request->tags))
         {
            $input['tags'] = null;
         }


         $input['price'] = $input['price'] / $sign->value;
         $input['previous_price'] = $input['previous_price'] / $sign->value;

         // store filtering attributes for physical product
         $attrArr = [];
         if (!empty($request->category_id)) {
           $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
           if (!empty($catAttrs)) {
             foreach ($catAttrs as $key => $catAttr) {
               $in_name = $catAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($catAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }

         if (!empty($request->subcategory_id)) {
           $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
           if (!empty($subAttrs)) {
             foreach ($subAttrs as $key => $subAttr) {
               $in_name = $subAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($subAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }
         if (!empty($request->childcategory_id)) {
           $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
           if (!empty($childAttrs)) {
             foreach ($childAttrs as $key => $childAttr) {
               $in_name = $childAttr->input_name;
               if ($request->has("$in_name")) {
                 $attrArr["$in_name"]["values"] = $request["$in_name"];
                 $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                 if ($childAttr->details_status) {
                   $attrArr["$in_name"]["details_status"] = 1;
                 } else {
                   $attrArr["$in_name"]["details_status"] = 0;
                 }
               }
             }
           }
         }



         if (empty($attrArr)) {
           $input['attributes'] = NULL;
         } else {
           $jsonAttr = json_encode($attrArr);
           $input['attributes'] = $jsonAttr;
         }


            if($data->type != 'Physical'){
                $data->slug = str_slug($data->name,'-').'-'.strtolower(str_random(3).$data->id.str_random(3));
            }
            else {
                $data->slug = str_slug($data->name,'-').'-'.strtolower($data->sku);
            }
         $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section
        $msg = 'Product Updated Successfully.<a href="'.route('admin-prod-index').'">View Product Lists.</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }


    //*** GET Request
    public function feature($id)
    {
            $data = Product::findOrFail($id);
            return view('admin.product.highlight',compact('data'));
    }

    //*** POST Request
    public function featuresubmit(Request $request, $id)
    {
        //-- Logic Section
            $data = Product::findOrFail($id);
            $input = $request->all();
            if($request->featured == "")
            {
                $input['featured'] = 0;
            }
            if($request->hot == "")
            {
                $input['hot'] = 0;
            }
            if($request->best == "")
            {
                $input['best'] = 0;
            }
            if($request->top == "")
            {
                $input['top'] = 0;
            }
            if($request->latest == "")
            {
                $input['latest'] = 0;
            }
            if($request->big == "")
            {
                $input['big'] = 0;
            }
            if($request->trending == "")
            {
                $input['trending'] = 0;
            }
            if($request->sale == "")
            {
                $input['sale'] = 0;
            }
            if($request->is_discount == "")
            {
                $input['is_discount'] = 0;
                $input['discount_date'] = null;
            }

            $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section
        $msg = 'Highlight Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends

    }

    //*** GET Request
    public function destroy($id)
    {

        $data = Project::findOrFail($id);
        if($data->galleries->count() > 0)
        {
            foreach ($data->galleries as $gal) {
                    if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                        unlink(public_path().'/assets/images/galleries/'.$gal->photo);
                    }
                $gal->delete();
            }

        }

        // if($data->reports->count() > 0)
        // {
        //     foreach ($data->reports as $gal) {
        //         $gal->delete();
        //     }
        // }

        // if($data->ratings->count() > 0)
        // {
        //     foreach ($data->ratings  as $gal) {
        //         $gal->delete();
        //     }
        // }
        // if($data->wishlists->count() > 0)
        // {
        //     foreach ($data->wishlists as $gal) {
        //         $gal->delete();
        //     }
        // }
        // if($data->clicks->count() > 0)
        // {
        //     foreach ($data->clicks as $gal) {
        //         $gal->delete();
        //     }
        // }
        // if($data->comments->count() > 0)
        // {
        //     foreach ($data->comments as $gal) {
        //     if($gal->replies->count() > 0)
        //     {
        //         foreach ($gal->replies as $key) {
        //             $key->delete();
        //         }
        //     }
        //         $gal->delete();
        //     }
        // }


        if (!filter_var($data->photo,FILTER_VALIDATE_URL)){
            if (file_exists(public_path().'/assets/images/projects/'.$data->photo)) {
                unlink(public_path().'/assets/images/projects/'.$data->photo);
            }
        }

        if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail) && $data->thumbnail != "") {
            unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
        }

        // if($data->file != null){
        //     if (file_exists(public_path().'/assets/files/'.$data->file)) {
        //         unlink(public_path().'/assets/files/'.$data->file);
        //     }
        // }
        $data->delete();
        //--- Redirect Section
        $msg = 'Product Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends

// PRODUCT DELETE ENDS
    }

    public function getAttributes(Request $request) {
      $model = '';
      if ($request->type == 'category') {
        $model = 'App\Models\Category';
      } elseif ($request->type == 'subcategory') {
        $model = 'App\Models\Subcategory';
      } elseif ($request->type == 'childcategory') {
        $model = 'App\Models\Childcategory';
      }

      $attributes = Attribute::where('attributable_id', $request->id)->where('attributable_type', $model)->get();
      $attrOptions = [];
      foreach ($attributes as $key => $attribute) {
        $options = AttributeOption::where('attribute_id', $attribute->id)->get();
        $attrOptions[] = ['attribute' => $attribute, 'options' => $options];
      }
      return response()->json($attrOptions);
    }
}
