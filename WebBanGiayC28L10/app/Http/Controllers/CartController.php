<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error','Đã xảy ra lỗi khi lưu dữ liệu');
            return back();
        }
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error','Đã xảy ra lỗi khi lưu dữ liệu');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = 1;
            $cart->amount=$cart->price*$cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Sản phẩm đã được thêm vào giỏ hàng');
        return back();
    }

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        // dd($request->quant[1]);


        $product = Product::where('slug', $request->slug)->first();
        if($product->stock <$request->quant[1]){
            return back()->with('error','Sản phẩm này đã hết hàng!');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Số lượng phải lớn hơn 1!');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Sản phẩm nãy đã hết hàng!');

            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = $request->quant[1];
            $cart->amount=($cart->price * $request->quant[1]);
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            //dd($cart);
            $cart->save();
        }
        request()->session()->flash('success','Sản phẩm đã được thêm vào giỏ hàng');
        return back();
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Xóa sản phẩm thành công');
            return back();
        }
        request()->session()->flash('error','Đã xảy ra lỗi không thể xóa');
        return back();
    }

    public function cartUpdate(Request $request){
        // dd($request->all());
        if($request->quant){
            $error = array();
            $success = '';
            // return $request->quant;
            foreach ($request->quant as $k=>$quant) {
                // return $k;
                $id = $request->qty_id[$k];
                // return $id;
                $cart = Cart::find($id);
                // return $cart;
                if($quant > 0 && $cart) {
                    // return $quant;

                    if($cart->product->stock < $quant){
                        request()->session()->flash('error','Out of stock');
                        return back();
                    }
                    $cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;
                    // return $cart;

                    if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $quant;
                    // return $cart->price;
                    $cart->save();
                    $success = 'Cập nhật dữ liệu thành công';
                }else{
                    $error[] = 'Đã xảy ra lỗi khi lưu dữ liệu';
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        }
    }

    public function checkout(Request $request){
        return view('frontend.pages.checkout');
    }

    public function postDatHang(Request $request)
    {
        $cart = Session('cart') ? Session('cart') : null;       
        $donhang = new Order();
        $product =Cart::where('user_id',auth()->user()->id)->get();
        $aray = ['DO', 'OD', 'DR', 'RD'];
        $madh = Arr::random($aray) . rand(10000, 99999);
        $donhang['mahd'] = $madh;
        $donhang['user_id']=Auth::user()->id;
        $donhang['email'] = $request->email;
        $donhang['hoten'] = $request->hoten;
        $donhang['phone'] = $request->phone;
        $donhang['diachi'] = $request->address_detail . ', ' . $request->ward . ', ' . $request->district . ', ' . $request->city;
        $donhang['ghichu'] = $request->ghichu;
        //dd(Helper::totalCartPrice());
        $donhang['tongtien'] =Helper::totalCartPrice();
      
        $donhang['ngaylap'] = Carbon::now('Asia/Ho_Chi_Minh');
        $donhang['httt'] = $request->payment;
        $donhang['trangthaitt'] = '1';
        $donhang['status'] = '1';
        $donhang->save();
        // Mail::to('kq909981@gmail.com')->send(new MailOrder($donhang));
        // Mail::to($request->email)->send(new MailOrderReponse($donhang));
        foreach ($product as $value) {

            // update số lượng khi đặt hàng
            // $updateSL = Product::find($key);
            // $updateSL->stock -= $value['quantity'];
            // $updateSL->save();

            $data = new OrderDetail();
            $data['id_donhang'] = $donhang->id;
            $data['product_id'] = $value->product_id;
            $data['soluong'] = $value->quantity;
            $data['giaban'] = $value->price;
            $data['thanhtien'] = $value->amount;
            $data['trangthai'] = '1';

            $sanpham=Product::where('id',$data->product_id)->get();
                foreach($sanpham as $sanphams){
                    $sanphams->stock=$sanphams->stock-$data->quantity;
                    $sanphams->save();
                }
                $data->save();
            $data->save();
            Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $donhang->id]);
            //$request->session()->forget('cart');
        }
        return redirect()->route('home')->with('success', 'Đặt Hàng Thành Công!');
        // return back();
    }
}
