<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Http\Request;
use PDF;
use Exception;

class CustomerAuthController extends Controller
{

    private $customer , $orders;

    public function login()
    {
        return view('website.customer.login');
    }
    public function loginCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error($validator->getMessageBag()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $customer = User::where('email',$request->email)->first();
        if (isset($customer)){
            if ($customer->status == 1){
                $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        toastr()->success("Login Successfully");
                        return redirect()->route('customer.dashboard');
                    } else {
                        toastr()->error('Invalid email or password');
                        return redirect()->back();
                    }
            }
            else{
                toastr()->error('You Are Banned Contact With Admin For More Update.');
                return redirect()->back();
            }
        }
        else{
            toastr()->error('You Are Not Registered.');
            return redirect()->back();
        }

    }
    public function newCustomer(Request $request)
    {
        $this->customer = User::newCustomer($request);
        $customer = new Customer();
        $customer->user_id = $this->customer->id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile  = $request->mobile;
        $customer->save();

        toastr()->success('Registration Success.Please Login');
        return back();
    }
    public function newCustomerAdmin(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt($request->mobile);
        }
        $user->status = 1;
        $user->save();

        $this->customer = User::newCustomer($request);
        $customer = new Customer();
        $customer->user_id = $this->customer->id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile  = $request->mobile;
        $customer->save();

        toastr()->success('Registration Success.Please Login');
        return back();
    }
    public function logout()
    {
        Auth::logout();
        toastr()->success("Logout Successfully");
        return redirect('/');
    }
    public function editCustomer( Request $request)
    {
        //return  $request;
        $this->customer = Customer::updateCustomer($request);

        Session::put('customer_id',  $this->customer->id);
        Session::put('customer_name', $this->customer->name);

        return redirect('/my-dashboard')->with('message','Your Profile is Updated ');
    }
    public function customerOrder()
    {
        $this->orders = Order::where('customer_id', auth()->user()->id)
            ->orderBy('id','desc')
            ->paginate(10);
        return view('website.customer.order.order',[
            'orders' => $this->orders,
            'customer'=>$this->customer,
        ]);
    }
    public function orderDetails($code){
        $order = Order::where('order_code',$code)->first();
        $orderDetails = OrderDetail::where('order_id',$order->id)->get();
        return view('website.customer.order.order-details', compact('order','orderDetails'));
    }
    public function customerCancelOrder()
    {
        $this->orders = Order::where('customer_id', auth()->user()->id)->where('order_status','Cancel')
            ->orderBy('id','desc')
            ->paginate(10);
        return view('website.customer.order.cancel',[
            'orders' => $this->orders,
            'customer'=>$this->customer,
        ]);
    }
    public function showCustomerOrder($id)
    {
        $order = Order::where('order_code',$id)->first();
        $orderDetails = OrdersDetails::where('order_id',$order->id)->get();
        return view('customer.order.order-details', compact('order','orderDetails'));
    }
    public function showCustomerInvoice( string $id)
    {
        return view('website.customer.invoice-show',[
            'order' => Order::find($id)
        ]);
    }
    public function showCustomerDownload( string $id)
    {
//        $pdf = PDF::loadHTML('<h1>Test</h1>'); // make pdf
        $pdf = PDF::loadView('website.customer.invoice-download',[
            'order' => Order::find($id)
        ]); // make pdf
        return $pdf->stream(); // show pdf
//        $pdf = PDF::loadView('pdf.document', $data);
//        return $pdf->stream('document.pdf');

    }
    public function accountDetail(){
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        return view('website.customer.account.index', compact('customer'));
    }
    public function updateCustomerInfo(Request $request, $id){
        try{
            $validation = Validator::make($request->all(),[
                'name'     => 'string|min:3|max:64|nullable',
                'mobile'          => 'string|min:5|max:20|nullable',
                'company'        => 'string|min:3|max:100|nullable',
                'address' => 'string|min:3|max:255|nullable',
                'gender'         => 'string|min:3|max:10|nullable',
                'state'          => 'string|min:3|max:64|nullable',
                'post'           => 'string|min:3|max:64|nullable',
                'country'        => 'string|min:3|max:100|nullable',
                'ssn'            => 'string|min:3|max:64|nullable',
                'city'           => 'string|min:3|max:64|nullable',
                'email'          => 'string|min:3|max:255|nullable',
                'dob'            => 'string|min:3|max:20|nullable',
            ]);
            if($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors());
            }


            $user_table = User::find($id);
            $user_table->name = $request->name;
            $user_table->save();

            $customer = Customer::where('user_id',$id)->first();
            if($request->file('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time().'.'.$extension;
                $directory = 'uploads/customer-images/';
                $image->move($directory , $imageName);
                $imageUrl = $directory.$imageName;
                if(file_exists($customer->image)) {
                    unlink($customer->image);
                }
                $customer->image = $imageUrl;
            }

            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->company = $request->company;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->marital_status = $request->marital_status;
            $customer->blood_group = $request->blood_group;
            $customer->state = $request->state;
            $customer->post = $request->post;
            $customer->country = $request->country;
            $customer->ssn = $request->ssn;
            $customer->city = $request->city;
            $customer->website = $request->website;
            $customer->facebook = $request->facebook;
            $customer->linkedIn = $request->linkedIn;
            $customer->twitter = $request->twitter;
            $customer->youtube = $request->youtube;
            $customer->instagram = $request->instagram;
            $customer->date_of_birth = $request->dob;
            $customer->save();

            toastr()->success('Data updated');
            return redirect()->route('customer.account.details');
        }catch(Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function customerChangePassword(){
        return view('website.customer.password.index');
    }
    public function customerPasswordChange(Request $request, $id){
        try {
            $validate = Validator::make($request->all(),[
                'old_password' => 'required',
                'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            ]);

            if($validate->fails())
            {
                toastr()->error($validate->messages());
                return redirect()->back();

            }
            $customer = User::find($id);
            if ($customer) {
                if (password_verify($request->old_password, $customer->password)) {
                    $customer->password = bcrypt($request->new_password);
                    $customer->save();
                    toastr()->success('Password Change Successfully');
                    return back();
                } else {
                    toastr()->error('Old Password Mismatched');
                    return back();
                }
            }
            else {
                toastr()->error('data not found');
                return back();
            }
        }
        catch (Exception $e){
            toastr()->error('');
        }
    }
    public function dashboard()
    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyOrders = Order::where('customer_id', $user->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $monthlyPurchaseAmount = Order::where('customer_id', $user->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('order_total');

        $topProducts = OrderDetail::whereHas('order', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
        })
            ->select('product_id', DB::raw('SUM(product_qty) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->with('product')
            ->limit(5)
            ->get();
        return view('website.customer.home.index', compact('monthlyOrders', 'monthlyPurchaseAmount', 'topProducts'));
    }
}
