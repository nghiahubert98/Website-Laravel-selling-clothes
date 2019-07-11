<?php

namespace App\Http\Controllers;


use App\Http\Requests\QtyRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CheckOutRequest;
use DB;
use Auth;
use App\User;
use App\Order;
use App\Order_detail;
use App\Contact;
use App\Product;
use Cart;
use Alert;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Hash;


class PageController extends Controller
{
    public function getIndex(){
        $product_related = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->orderBy('id','DESC')->take(4)->get();
        $product_bestseller = DB::table('order_details')
                                ->select('product_id', DB::raw('count(product_id) as seller'))
                                ->groupBy('product_id')
                                ->orderBy('seller', 'DESC')
                                ->take(4)
                                ->get();
    	return view('user.pages.home',compact('product_related','product_bestseller'));
    }
    public function productcategrandparent($id,$alias){
        $id_cate_parent = DB::table('categories')->select('id')->where('parent_id','=',$id)->get();
        $array_id_cate_parent = json_decode(json_encode($id_cate_parent), true);
        $product_cate = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                        ->select('products.*', 'categories.id as cate_id', 'categories.parent_id as parent_id')
                        ->whereIn('parent_id', $array_id_cate_parent)
                        ->orderBy('products.id','desc')->paginate(10);
        $product_related = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->orderBy('id','DESC')->take(4)->get();
        $product_bestseller = DB::table('order_details')
                                ->select('product_id', DB::raw('count(product_id) as seller'))
                                ->groupBy('product_id')
                                ->orderBy('seller', 'DESC')
                                ->take(3)
                                ->get();
        return view('user.pages.cate',compact('product_cate','product_related','product_bestseller','alias'));
    }
    public function productcateparent($id,$alias){
    	$product_cate = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                        ->select('products.*', 'categories.id as cate_id', 'categories.parent_id as parent_id')
                        ->where('parent_id', '=', $id)
                        ->orderBy('products.id','desc')
                        ->paginate(10);
    	$product_related = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->orderBy('id','DESC')->take(4)->get();
        $product_bestseller = DB::table('order_details')
                                ->select('product_id', DB::raw('count(product_id) as seller'))
                                ->groupBy('product_id')
                                ->orderBy('seller', 'DESC')
                                ->take(3)
                                ->get();
        return view('user.pages.cate',compact('product_cate','product_related','product_bestseller','alias'));
    }
    public function productcate($id,$alias){
        $product_cate = DB::table('products')->select('id','name','image','price','price_new','alias','status','cate_id','intro')->where('cate_id',$id)->paginate(3);
        $product_related = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->orderBy('id','DESC')->take(4)->get();
        $product_bestseller = DB::table('order_details')
                                ->select('product_id', DB::raw('count(product_id) as seller'))
                                ->groupBy('product_id')
                                ->take(3)
                                ->get();
        return view('user.pages.cate',compact('product_cate','product_related','product_bestseller','alias'));
    }
    public function productdetail($id){
    	$product_detail = DB::table('products')->where('id',$id)->first();
        $image = DB::table('product_images')->select('id','image')->where('product_id',$product_detail->id)->get();
        $size = DB::table('product_sizes')->select('id','size')->where('product_id',$product_detail->id)->get();
        $product_related = DB::table('products')->where('cate_id',$product_detail->cate_id)->where('id','<>',$id)->take(4)->get();
    	return view('user.pages.productdetail',compact('product_detail','image','size','product_related'));
    }
    public function myAccount(){
        if(Auth::check()){
            $user_detail = User::find(Auth::user()->id);
            return view('user.pages.myaccount',compact('user_detail'));
        }else{
            return redirect('login');
        }    
    }
    public function orderhistory(){
        $orders = DB::table('orders')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('user.pages.order-history',compact('orders'));
    }

    public function getEditAccount(){
        $user_edit = User::find(Auth::user()->id);
        return view('user.pages.edit-account',compact('user_edit'));
    }

    public function postEditAccount(Request $request){
        $user = User::find(Auth::user()->id);
        if($request->input('txtPass')){
            $this->validate($request,
                [
                    'txtRePass' => 'required|same:txtPass'
                ],
                [
                    'txtRePass.required' => 'Please Enter RePassword',
                    'txtRePass.same'    => 'Two Password Don\'t Match'
                ]
            );
            $pass = $request->input('txtPass');
            $user->password = Hash::make($pass);
        }
        $user->fullname = $request->txtFName;
        $user->email = $request->txtEmail;
        $user->gender = $request->rdoGender;
        $user->address = $request->txtAddress;
        $user->phone = $request->txtPhone;
        if($request->input('rdoLevel')){
            $user->level = $request->rdoLevel;
        }
        $user->save();
        Alert::success('Chỉnh sửa tài khoản thành công!');
        return redirect('myaccount');
    }

    public function getContact(){
        return view('user.pages.contact');
    }
    public function postContact(ContactRequest $request){
        $contact = new Contact;
        $contact->name = $request->txtFname;
        $contact->email = $request->txtEmail;
        $contact->phone = $request->txtPhone;
        $contact->note = $request->txtContact;
        $contact->status = 0;
        $contact->save();
        Alert::success('Đã nhận được phản hồi của bạn.', 'Cảm ơn!')->persistent('Đóng');
        return redirect()->back();

    }

    public function postSearch(Request $request){
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $key_search  = $request->get('key_search');
        $product_search = DB::table('products')
        ->where(function($query) use ($key_search, $minPrice, $maxPrice){
            $query->where('name','like',"%$key_search%");
            $query->where('price_new','>',0);
            $query->whereBetween('price_new',[$minPrice, $maxPrice]);
        })
        ->orWhere(function($query) use ($key_search, $minPrice, $maxPrice){
            $query->where('name','like',"%$key_search%");
            $query->where('price_new',0);
            $query->whereBetween('price',[$minPrice, $maxPrice]);
        })
        ->paginate(10);
        
        $product_related = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->orderBy('id','DESC')->take(4)->get();
        $product_bestseller = DB::table('order_details')
                                ->select('product_id', DB::raw('count(product_id) as seller'))
                                ->groupBy('product_id')
                                ->take(3)
                                ->get();
        return view('user.pages.search',['product_search'=>$product_search,'key_search'=>$key_search,'product_related'=>$product_related,'product_bestseller'=>$product_bestseller,'min_price'=>$minPrice,'max_price'=>$maxPrice]);
    }

    public function addtocart($id){
        $product_buy = DB::table('products')->where('id',$id)->first();
        $size = DB::table('product_sizes')->where('product_id',$id)->first();
        if ($product_buy->price_new == 0) {
            $price = $product_buy->price;
        }else{
            $price = $product_buy->price_new;
        }
        if($product_buy->status == 1){
        Cart::add(array('id'=>$id,'name'=>$product_buy->name,'qty'=>1,'price'=>$price,'options'=>array('img'=>$product_buy->image,'size'=>$size->size,'alias'=>$product_buy->alias)));
        Alert::success('Thêm vào giỏ hàng thành công!');
        return redirect()->back();
        }
        else{
            Alert::fail('Thêm vào giỏ hàng lỗi!');
            return redirect()->back();
        }
    }
    public function cart(QtyRequest $request){
        if ($request->isMethod('post')) {
            $product_id = $request->get('product_id');
            $product = DB::table('products')->where('id',$product_id)->first();
            $size = $request->get('size');
            $qty = $request->quantity;
            if ($product->price_new == 0) {
                $price = $product->price;
            }else{
                $price = $product->price_new;
            }
            Alert::success('Thêm vào giỏ hàng thành công!');
            Cart::add(array('id'=>$product_id,'name'=>$product->name,'qty'=>$qty,'price'=>$price,'options'=>array('img'=>$product->image,'size'=>$size,'alias'=>$product->alias)));
        }
        return redirect()->back();
    }
    public function cartinfo(){
        $content = Cart::content();
        return view('user.pages.shopping-cart',compact('content'));
    }
    public function detetecart($id){
        Cart::remove($id);
        return redirect()->route('cartinfo');
    }
    public function updatecart(Request $request){
        if ($request->ajax()) {
            $id = $request->get('id');
            $qty = (int)$request->get('qty');
            Cart::update($id,$qty);
            echo "oke";
        }
    }
    public function checkout(){
        return view('user.pages.checkout');
    }

    public function payWithPaypal(Request $request){
        $provider = new ExpressCheckout;
        $invoiceId = uniqid();
        $data = $this->cartData($invoiceId);
        $response = $provider->setExpressCheckout($data);

         // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }
    protected function cartData($invoiceId){
        $data = [];
        $data['items'] = [];

        foreach(Cart::content() as $key => $cart){
            $itemDetail=[
                'name' => $cart->name,
                'price' => $cart->price,
                'qty' => $cart->qty
            ];
            $data['items'][] = $itemDetail;
        }
        $data['invoice_id'] = $invoiceId;
        $data['invoice_description'] = "Test invoice";
        $data['return_url'] = route('payment.paypalSuccess');
        $data['cancel_url'] = route('cartinfo');
        
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;
        return $data;
    }

    public function paypalSuccess(Request $request){
        $provider = new ExpressCheckout;
        $token = $request->token;
        $PayerID = $request->PayerID;
        $response = $provider->getExpressCheckoutDetails($token);
        $invoiceId = $response['BILLINGAGREEMENTID']??uniqid();
        $data = $this->cartData($invoiceId);

        $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

        $payment = $response['PAYMENTINFO_0_PAYMENTTYPE'];
        //dd($response);
        $cartInfor = Cart::content();
        if(Cart::count() != 0){
            if(Auth::check()){
                $bill = new Order;
                $bill->user_id = Auth::user()->id;
                $bill->date_order = date('Y-m-d H:i:s');
                $bill->total = str_replace(',', '', Cart::total());
                if (!empty($request->get('note'))) {
                    $bill->note = $request->get('note');
                }else{
                    $bill->note = '';
                }
                $bill->status = 0;
                $bill->payment = $payment;
                $bill->save();

                if (count($cartInfor) > 0) {
                    foreach ($cartInfor as $key => $item) {
                        $billDetail = new Order_detail;
                        $billDetail->order_id = $bill->id;
                        $billDetail->product_id = $item->id;
                        $billDetail->quantity = $item->qty;
                        $billDetail->unit_price = $item->price;
                        $billDetail->size = $item->options['size'];
                        $billDetail->save();
                    }
                }
                Cart::destroy();
                Alert::success('Cảm ơn bạn đã đặt hàng!');
                return redirect('index');

            }else{
                $sid = DB::table('users')->select('id')->orderBy('id','DESC')->take(1)->first();
                $ids = $sid->id + 1;
                
                $user = new User;
                $user->username = 'Guest'.$ids;
                $user->fullname = $request->get('txtFname');
                $user->email = $request->get('txtEmail');
                $user->password = $request->get('txtPhone');
                $user->gender = 0;
                $user->address = $request->get('txtAddress');
                $user->phone = $request->get('txtPhone');
                $user->level = 2;
                $user->status = 'Offline';
                $user->save();

                $bill = new Order;
                $bill->user_id = $user->id;
                $bill->date_order = date('Y-m-d H:i:s');
                $bill->total = str_replace(',', '', Cart::total());
                if (!empty($request->get('note'))) {
                    $bill->note = $request->get('note');
                }else{
                    $bill->note = '';
                }
                $bill->status = 0;
                $bill->payment = $request->get('payment');
                $bill->save();

                if (count($cartInfor) > 0) {
                    foreach ($cartInfor as $key => $item) {
                        $billDetail = new Order_detail;
                        $billDetail->order_id = $bill->id;
                        $billDetail->product_id = $item->id;
                        $billDetail->quantity = $item->qty;
                        $billDetail->unit_price = $item->price;
                        $billDetail->size = $item->options['size'];
                        $billDetail->save();
                    }
                }
                Cart::destroy();
                Alert::success('Cảm ơn bạn đã đặt hàng!');
                return redirect('index');
            }

        }else{
            Alert::error('Có lỗi', 'Rất tiếc!');
            return redirect()->route('cartinfo');
        }
        
    }
    public function getBillDetail($id){
        $customerInfo = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone')
                        ->orderBy('orders.id','desc')
                        ->where('orders.id', '=', $id)
                        ->first();
        $billInfo = DB::table('orders')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
                    ->where('orders.id', '=', $id)
                    ->select('orders.*', 'order_details.*', 'products.name as product_name')
                    ->get();
        return view('user.pages.billdetail',compact('customerInfo','billInfo'));
    }
    public function postCheckout(Request $request){
        $cartInfor = Cart::content();
        if(Cart::count() != 0){
            if(Auth::check()){
                $bill = new Order;
                $bill->user_id = Auth::user()->id;
                $bill->date_order = date('Y-m-d H:i:s');
                $bill->total = str_replace(',', '', Cart::total());
                if (!empty($request->get('note'))) {
                    $bill->note = $request->get('note');
                }else{
                    $bill->note = '';
                }
                $bill->status = 0;
                $bill->payment = $request->get('payment');
                $bill->save();

                if (count($cartInfor) > 0) {
                    foreach ($cartInfor as $key => $item) {
                        $billDetail = new Order_detail;
                        $billDetail->order_id = $bill->id;
                        $billDetail->product_id = $item->id;
                        $billDetail->quantity = $item->qty;
                        $billDetail->unit_price = $item->price;
                        $billDetail->size = $item->options['size'];
                        $billDetail->save();
                    }
                }
                Cart::destroy();
                Alert::success('Cảm ơn bạn đã đặt hàng!');
                return redirect('index');

            }else{
                $sid = DB::table('users')->select('id')->orderBy('id','DESC')->take(1)->first();
                $ids = $sid->id + 1;
                
                $user = new User;
                $user->username = 'Guest'.$ids;
                $user->fullname = $request->get('txtFname');
                $user->email = $request->get('txtEmail');
                $user->password = $request->get('txtPhone');
                $user->gender = 0;
                $user->address = $request->get('txtAddress');
                $user->phone = $request->get('txtPhone');
                $user->level = 2;
                $user->status = 'Offline';
                $user->save();

                $bill = new Order;
                $bill->user_id = $user->id;
                $bill->date_order = date('Y-m-d H:i:s');
                $bill->total = str_replace(',', '', Cart::total());
                if (!empty($request->get('note'))) {
                    $bill->note = $request->get('note');
                }else{
                    $bill->note = '';
                }
                $bill->status = 0;
                $bill->payment = $request->get('payment');
                $bill->save();

                if (count($cartInfor) > 0) {
                    foreach ($cartInfor as $key => $item) {
                        $billDetail = new Order_detail;
                        $billDetail->order_id = $bill->id;
                        $billDetail->product_id = $item->id;
                        $billDetail->quantity = $item->qty;
                        $billDetail->unit_price = $item->price;
                        $billDetail->size = $item->options['size'];
                        $billDetail->save();
                    }
                }
                Cart::destroy();
                Alert::success('Cảm ơn bạn đã đặt hàng!');
                return redirect('index');
            }

        }else{
            Alert::error('Có lỗi', 'Rất tiếc!');
            return redirect()->route('cartinfo');
        }
        
    }
}
