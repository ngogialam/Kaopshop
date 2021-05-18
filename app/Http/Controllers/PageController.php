<?php

namespace App\Http\Controllers;

// use BadMethodCallException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\User;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Validate;



class PageController extends Controller
{
    //
    public function getIndex()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(4);
        $sanpham_khuyenmai = Product::where('promotion_price', '<>', 0)->paginate(8);
        // return view('page.trangchu',['slide'=>$slide]);
        return view('page.trangchu', compact('slide', 'new_product', 'sanpham_khuyenmai'));
    }
    public function mot()
    {
        return view('page.dat_hang');
    }
    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id', $type)->first();
        return view('page.loai_sanpham', compact('sp_theoloai', 'sp_khac', 'loai', 'loai_sp'));
    }
    public function getChitiet(Request $req)
    {
        $sanpham = Product::where('id', $req->id)->first();
        $sp_tuongtu = Product::where('id_type', $sanpham->id_type)->paginate(6);
        return view('page.chitiet_sanpham', compact('sanpham', 'sp_tuongtu'));
    }
    public function getlienhe()
    {
        return view('page.lienhe');
    }
    public function getgioithieu()
    {
        return view('page.gioithieu');
    }
    public function getAddtoCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }
    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        // if(count($cart -> items)>0){
        //     Session::put('cart',$cart);
        // }
        // else{
        //     Session::forget('cart');
        // }
        Session::put('cart', $cart);
        return redirect()->back();
    }
    public function getCheckout()
    {
        if (Session::has('cart')) {

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            // $cart = Session::get('cart');
            // dd($cart);
            return view('page.dat_hang', ['product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'toyalQty' => $cart->totalQty]);
            // $view->with(['cart' => Session::get('cart'), 'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'toyalQty' => $cart->totalQty]);
        }
    }
    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        // return redirect()->back();
        return view('Page.dathang_thanhcong');
    }
    public function getdathang()
    {
        return view('Page.dathang_thanhcong');
    }
    public function getLogin()
    {
        return view('Page.dangnhap');
    }
    public function postLogin(Request $req){
    //    [
    //     'email'=>'requeired|email',
    //     'password'=>'requeired|min:6|max:20'
    // ],
    // [
    //     'email.required' => 'Vui long nhap lại email',
    //             // 'email.email' => 'khong dung dinh dang email',
    //             'email.requeired' => 'Email da co nguoi du dung',
    //             'password.required' => 'Vui lòng nhập lại mật khẩu',
    //             // 're_password.same' => 'Mật khẩu không giống nhau',
    //             'password.min' => 'Mật khẩu ít nhất 6 kí tự',
    //             'password.max' => 'Mật khẩu nhỏ hơn 25 kí tự'
    // ]
    }
    public function getSignin()
    {
        return view('page.dangky');
    }
    public function postSignin(Request $req)
    {
        // return view('Page.dangky');
        $this->validate($req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'requeired|min:6|max:20',
                'full_name' => 'requeired',
                'address' => 'requeired',
                'phone' => 'requeired',
                // 're_password' => 'requeired|same:password',
            ],
            [
                'email.required' => 'Vui long nhap lại email',
                'email.email' => 'khong dung dinh dang email',
                'email.unique' => 'Email da co nguoi du dung',
                'password.required' => 'Vui lòng nhập lại mật khẩu',
                're_password.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                // 'password.max' => 'Mật khẩu nhỏ hơn 25 kí tự',
            ]
        );
       
        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();

         
        // if ($req->isMethod('post')) {
        //     $full_name = $req->input("full_name");
        //     $email = $req->input("email");
        //     $phone = $req->input("phone");
        //     $address = $req->input("address");
        //     $password = $req->input("password");
        //     $user = new User();
        //     $user->full_name=$full_name;
        //     $user->email = $email;
        //     $user->phone = $phone;
        //     $user->address = $req->address;
        //     $user->password = $password;
        //     $user->save();
        // }
        return redirect()->back()->with('thanhcong','Bạn đã tạo tài khoản thành công');
        
    }
}

