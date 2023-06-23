<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerDataRequest;
use App\Http\Requests\TshirtUploadRequest;
use App\Models\Order;
use App\Models\Tshirt;
use App\Models\Price;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user): View
    {
        $customer = Customer::find($user->id);

        if ($customer == NULL){
            $this->store($user->id);
            $customer = Customer::find($user->id);
        }

        return view('customers.index', compact('user', 'customer'));
    }

    public function store($id)
    {
        $newCustomer = new Customer();
        $newCustomer->id = $id;

        $newCustomer->save();

        return;
    }

    public function orders(User $user): View
    {
        $ordersQuery = Order::query();
        $ordersQuery->where('customer_id',$user->id);
        $orders = $ordersQuery->paginate(20);

        return view('customers.orders',compact('orders'));
    }

    public function upload(Request $request, User $user): View
    {
        $filterByName = $request->name ?? '';
        $privateTshirtsQuery = Tshirt::query();
        $privateTshirtsQuery->where('customer_id',$user->id);

        if ($filterByName != '') {
            $privateTshirtsQuery->where('name','like',"%$filterByName%");
        }
        
        $privateTshirts = $privateTshirtsQuery->paginate(20);
        return view('customers.upload',compact('privateTshirts'));
    }

    public function uploadImage(TshirtUploadRequest $request, User $user): RedirectResponse
    {
        $formData = $request->validated();

        $tshirt = DB::transaction(function () use ($formData, $request, $user) {
            $newTshirt = new Tshirt();

            $newTshirt->name = $formData['name'];
            $newTshirt->description = $formData['description'];
            $newTshirt->customer_id = $user->id;

            $path = $request->photo->store('tshirt_images_private');

            $newTshirt->image_url = basename($path);
            $newTshirt->save();

            return $newTshirt;
        });

        $htmlMessage = "Image successfully uploaded!";

        return redirect()->route('upload', $user)
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }

    public function updateUser(CustomerDataRequest $request, User $user): RedirectResponse
    {
        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData, $user) {
            $user->name = $formData['name'];
            $user->email = $formData['email'];
        
            if (isset($formData['password'])) {
                $user->password = Hash::make($formData['password']);
            }
            
            $user->save();
            return $user;
        });
            
        $htmlMessage = "User <strong>\"{$user->name}\"</strong> successfully updated!";

        return redirect()->route('profile', $user->id)
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }

    public function updateCustomer(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $formData = $request->validated();

        $customer = DB::transaction(function () use ($formData, $customer) {
            
            if (isset($formData['nif'])) {
                $customer->nif = $formData['nif'];
            }

            if (isset($formData['address'])) {
                $customer->address = $formData['address'];
            }

            if (isset($formData['default_payment_type'])) {
                $customer->default_payment_type = $formData['default_payment_type'];
            }

            if (isset($formData['default_payment_ref'])) {
                $customer->default_payment_ref = $formData['default_payment_ref'];
            }
            
            $customer->save();
            return $customer;
        });
            
        $htmlMessage = "Data successfully updated!";

        return redirect()->route('profile', Auth::user())
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }
}
