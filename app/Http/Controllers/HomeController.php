<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Redirect,Response,DB;
use File;
use PDF;
class HomeController extends Controller{
// {
//     public $product;
//     public function index(){
//         return view('frontEnd.home.home');
//     }
//     public function addProduct(Request $request){
//         $validator = Validator::make($request->all(),[
//             'p_email'=>'required',
//             'p_password'=>'required',
//             'p_image'=>'required',
//         ]);
//         if($validator->fails()){
//             return response()->json([
//                 'status'=>400,
//                 'error'=>$validator->messages()
//             ]);
//         }else{
//                 $product = new Product();
//                 $product->p_email=$request->p_email;
//                 $product->p_password=bcrypt($request->p_password);
//                 if($request->hasFile('p_image')){
//                     $file = $request->file('p_image');
//                     $extension = $file->getClientOriginalExtension();
//                     $fileName = time().'.'.$extension;
//                     $file->move('upload/ProductImage/',$fileName);
//                     $product->p_image=$fileName;
//                 }
//                 $product->save();
//                 return response()->json([
//                     'status'=>200,
//                     'message'=>'succesfully'
//                 ]);
//         }
//     }

//     public function feachProduct(){
//         $product=Product::all();
//         return response()->json([
//             'product'=>$product,
//         ]);
//     }
//     public function updateData(Request $request){
//         $data = Product::find($request->input('ep_id'));
//         $product->p_email=$request->p_email;
//         $product->p_password=bcrypt($request->p_password);
//         if($request->hasFile('p_image')){
//             $file = $request->file('p_image');
//             $extension = $file->getClientOriginalExtension();
//             $fileName = time().'.'.$extension;
//             $file->move('upload/ProductImage/',$fileName);
//             $product->p_image=$fileName;
//         }
//         $product->save();

//         return response()->json(['success' => 'Data updated successfully']);
//     }
//     public function editData($id){
//         $data = Product::find($id);

//         return response()->json($data);
//     }

    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Product::select('*'))
            ->addColumn('action', 'product-button')
            ->addColumn('image', 'image')
            ->rawColumns(['action','image'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('frontEnd.home.home');
    }

    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

        $productId = $request->product_id;

        $details = ['title' => $request->title, 'product_code' => $request->product_code, 'description' => $request->description];

        if ($files = $request->file('image')) {

           //delete old file
           File::delete('public/product/'.$request->hidden_image);

           //insert new file
           $destinationPath = 'public/product/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $details['image'] = "$profileImage";
        }

        $product   =   Product::updateOrCreate(['id' => $productId], $details);

        return Response::json($product);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = Product::where($where)->first();

        return Response::json($product);
    }
    public function destroy($id)
    {
        $data = Product::where('id',$id)->first(['image']);
        File::delete('public/product/'.$data->image);
        $product = Product::where('id',$id)->delete();

        return Response::json($product);
    }

}
