<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterWithDefaultPasswordMail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request){
        
    }

    public function customers(Request $request){
        $search = User::orderBy('updated_at', 'desc');

        if($request->has('keyword1')) {
            $keyword = $request->input('keyword1');
            if(isset($keyword)){
                $search = $search->where('full_name', 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
            }

            $customers = $search->paginate(10);
            return view('admin.users.customers')
                ->with([
                    'customers' => $customers
                ]);
            // return response()->json([
            //     'view' => view('admin.users.customer-table')->with(['customers' => $customers])->render(),
            //     'pagination' => $customers->links('pagination::bootstrap-4')->render(),
            // ]);
        } else {
            $customers = $search->paginate(10);
            return view('admin.users.customers')
                ->with([
                    'customers' => $customers
                ]);
        }
    }

    public function createNewCustomer(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'location' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        // Create a new customer record
        $customer = new User([
            'full_name' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'location' => $validatedData['location'],
            'is_active' => true,
            'password' => Hash::make($validatedData['password']),
        ]);

        // Save the customer record to the database
        $customer->save();

        // Send Mail

        Toastr::success(__('Customer created successfully.'));
        // Optionally, you can return a success response
        return redirect()->back()->with('success', 'New User created successfully');
    }

    public function showCustomer($id)
    {
        $customer = User::find($id);
        return response()->json($customer);
    }

    public function editCustomer(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id', // Ensure the customer exists
            'fullName' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'location' => 'nullable',
            'is_active' => 'required|boolean',
            // Add other validation rules for your fields
        ]);

        // Find the customer by ID
        $customer = User::findOrFail($validatedData['id']);
        $customer->full_name = $validatedData['fullName'];
        $customer->email = $validatedData['email'];
        $customer->location = $validatedData['location'];
        $customer->is_active = $validatedData['is_active'];
        // Check if a new password is provided and update it
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $customer->save();
        Toastr::success(__('User updated successfully'));
        return redirect()->back()->with('success', 'User updated successfully');

    }

    public function removeCustomer($id) {
        User::where('id', $id)->delete();
        return response()->json(['msg' => 'User has been removed!' ]);
    }

    public function getUsersBykey(Request $request) {
        $keyword = $request->input('username');
        if ($request->input('isMatch') == "1") {
            $users = User::where('username', $keyword)->get();
        } else {
            $users = User::where('username', 'like', '%'.$keyword.'%')->get();
        }
        return response()->json($users);
    }

    public function searchCustomer(Request $request)
    {
        // Get the input value from the request
        $customerName = $request->input('customerName');

        // Perform the search query (you can customize this based on your database structure)
        $results = User::where('first_name', 'like', "%$customerName%")->get();

        // Return the results as JSON
        return response()->json($results);
    }

    public function validateCustomer(Request $request)
    {
        $customerEmail = $request->input('customerEmail');

        $exists = User::where('email', $customerEmail)->exists();

        return response()->json(!$exists);
    }

    public function createCustomerViaAjax(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'location' => 'nullable|string',
        ]);

        // Create a new customer record
        $customer = new User([
            'full_name' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'location' => $validatedData['location'],
            'is_active' => true,
            'password' => Hash::make('Access2000'),
        ]);

        // Save the customer record to the database
        $customer->save();

        Mail::to($validatedData['email'])->send(new RegisterWithDefaultPasswordMail([
            'subject' => 'Welcome to Elite Providers',
            'html' => $validatedData['fullName']
        ]));

        return response()->json($customer);
    }

    public function update(Request $request, $id) {
        $user = User::find(Auth::id());

        $user->my_side = $request->side;
        $user->my_banner = $request->banner;
        $user->layout = $request->layout;
        $user->my_content = $request->content;
        $user->my_background = $request->my_background;
        $user->save();
        
        $user = User::find(Auth::id());
        return view('frontend.account.profile')->with([
            'banner' => $user->my_banner,
            'side' => $user->my_side,
            'layout' => $user->layout,
            'content' => $user->my_content,
            'my_background' => $user->my_background
        ]);;
    }

    public function updateDetail(Request $request) {
        $user = User::find(Auth::id());
        $user->full_name = $request->fullname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->city = $request->city;
        $user->country = $request->country;
        // $user->username = $request->username;  // username is not allowed to change
        $user->avatar = $request->avatar;
        $user->gender = $request->gender;
        $user->save();
        return response()->json(['msg' => 'Password has been changed.', 'success' => true ]);
        // return redirect()->route('detail');
    }

    public function updatePassword(Request $request) {
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['msg' => 'Password has been changed.', 'success' => true ]);
    }

    public function updatePrivatePassword(Request $request) {
        $user = User::find(Auth::id());
        $user->private_password = Hash::make($request->password);
        $user->save();
        return response()->json(['msg' => 'Password has been changed.', 'success' => true ]);
    }

    public function updatePrivateContent(Request $request) {
        $user = User::find(Auth::id());
        if(isset($request->password)) {
            if($request->password == $request->confirmpassword) {
                $user->private_password = Hash::make($request->password);
                $user->save();
            } else {
                Toastr::error(__('Password does not match.'));
                return back()->withInput();
            }
        }

        if ($user->private_password != null) {
            $user->private_content = $request->content;
            $user->save();
            Toastr::success(__('Your content updated successfuly!'));
            return redirect()->route('private');
        } else {
            Toastr::error(__('Please set up your password for your Protected Content.'));
            return back()->withInput();
        }
    }
}
