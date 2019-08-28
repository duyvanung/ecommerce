<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Category;
use App\User;
use App\Orders;
use Auth;

class UserController extends Controller
{
    public function __construct(
                    Category $category,
                    Orders $order
                )
    {
        $this->category = $category;
        $this->order = $order;
    }
    public function showProfile(){
    	return view('pages.profile', [
    		'categories' => $this->category->getAllWithUrl(),
            'orders' => $this->order->getOrdersByUserId(Auth::id())
    	]);
    }

    public function updateProfile(Request $req){
    	$id = Auth::id();
    	$validator = Validator::make($req->all(), [
    			'name' => 'min:5',
                'phone' => 'regex:/(0)[0-9]{9}/',
                'user_name' => 'min:5',
                'password' => 'min:3|confirmed',
            ], 
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute quá ngắn',
                'max' => ':attribute quá dài',
                'numeric' => 'Số điện thoại không đúng',
                'regex' => ':attribute không đúng',
                'confirmed' => ':attribute không khớp'
            ],
            [
                'name' => 'Tên',
                'phone' => 'Số điện thoại',
                'user_name' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
                'password2' => 'Mật khẩu',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'errors'=>$validator->errors()->all()]);
        }
        
        if ($req->isPw == 0){
        	// update profile
        	if ($req->hasFile('file')) {
			    $file = $req->file('file');
		    	$name = $file->getClientOriginalName();
		    	$file->move(public_path().'/uploads/users/', $name);
		    	User::find($id)->update([
		        	'avatar' => $name
		        ]);
			}
        	User::find($id)->update([
	        	'name' => $req->name,
	        	'phone' => $req->phone,
	        	'sex' => $req->sex,
	        	'address' => $req->address
	        ]);
        }
        else if ($req->isPw == 1){
        	// save to DB
        	User::find($id)->update([
        		'password' => bcrypt($req->password)
        	]);
        	Auth::logout();
        }
       return response()->json(['status' => 1]);
    }

    public function getOrderHistory(Request $req){
        $data = $this->order->getOrderById($req->order_id);
        return response()->json(['order_data' => $data]);
    }
}
