<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Rubbish;
use App\Models\RubbishItem;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\SuggestionMail;
use App\Models\Booking;
use App\Models\ServiceOption;
use App\Models\Setting;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Link;
use App\Models\News;
use App\Models\Message;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\ArtWork;
use App\Models\ArtWorkItem;
class RubbishSelectedItem
{
    public $name;
    public $qty;
}


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        //
        return view('frontend.account.index');
    }

    static public function dashboard()
    {
        $user = auth()->user();
        $livebookings = Booking::where('user_id', $user->id)->where('start_date', '>=', Carbon::today()->format('d-m-Y'))->count();
        $prevbookings = Booking::where('user_id', $user->id)->where('start_date', '<', Carbon::today()->format('d-m-Y'))->count();
        $liverubbishes = Rubbish::where('user_id', $user->id)->where('start_date', '>=', Carbon::today()->format('d-m-Y'))->count();
        $prevrubbishes = Rubbish::where('user_id', $user->id)->where('start_date', '<', Carbon::today()->format('d-m-Y'))->count();
        $discounts = Discount::where(['visibility' => 'Public', 'status' => 'Active'])->where('valid_from', '<=', Carbon::today()->format('Y-m-d'))->where('valid_until', '>=', Carbon::today()->format('Y-m-d'))->get();
        return view('frontend.account.dashboard')->with([
            'live' => $livebookings+$liverubbishes, 'prev' => $prevbookings+$prevrubbishes, 'discounts' => $discounts
        ]);
    }

    static public function bookings()
    {
        $user = auth()->user();
        $livebookings = Booking::where('user_id', $user->id)->where('start_date', '>=', Carbon::today()->format('d-m-Y'))->get();
        $prevbookings = Booking::where('user_id', $user->id)->where('start_date', '<', Carbon::today()->format('d-m-Y'))->get();
        $liverubbishes = Rubbish::where('user_id', $user->id)->where('start_date', '>=', Carbon::today()->format('d-m-Y'))->get();
        $prevrubbishes = Rubbish::where('user_id', $user->id)->where('start_date', '<', Carbon::today()->format('d-m-Y'))->get();
        return view('frontend.account.bookings')->with([
            'livebookings' => $livebookings, 'prevbookings' => $prevbookings, 'liverubbishes' => $liverubbishes, 'prevrubbishes' => $prevrubbishes
        ]);
    }

    static public function info()
    {
        $user = auth()->user();
        return view('frontend.account.info', compact('user'));
    }

    static public function notification()
    {
        return view('frontend.account.notification');
    }

    public function showBooking($id)
    {
        $setting = Setting::find(1);

        $booking = Booking::find($id);

        $services = explode(',', $booking->option_id);

        $service_values = explode(',', $booking->option_value);

        $options = ServiceOption::whereIn('id', $services)->get();

        $price = $booking->cost;

        $dateTime =  Carbon::parse($booking->created_at);

        $created_at = $dateTime->format('d-m-Y | H:i');

        $back_services = $options->filter(function($option){
            return $option->id <= 15;
        });
        $front_services = $options->filter(function($option){
            return $option->id > 15;
        });

        $data = [
            'id' => $booking->booking_id,
            'start_date' => date('d-m-Y', strtotime($booking->start_date)),
            'start_time' => $booking->start_time,
            'customer_name' => $booking->customer->first_name . ' ' . $booking->customer->last_name,
            'customer_email' => $booking->customer->email,
            'customer_phone' => $booking->customer->phone,
            'additional_comments' => $booking->comment,
            'address' => $booking->address,
            'garden' => $booking->garden,
            'back_services' => $back_services,
            'front_services' => $front_services,
            'hours' => $booking->recommend_hours,
            'price' => number_format($price, 2),
            'deposit' => 5,
            'ouststanding' => number_format($price - 5, 2),
            'status' => $booking->status,
            'created_at' => $created_at
        ];

        $html = "
            <p><strong>Booking ID : </strong>".$data['id']." <strong>   Status : </strong>".$data['status']."</p>
            <p><strong>Booking Date | Time : </strong>".$data['start_date']." | ".$data['start_time']."</p>
            <p><strong>Created At : </strong>".$data['created_at']."</p>
            <p><strong>Customer Name : </strong>".$data['customer_name']."</p>
            <p><strong>Customer Email : </strong>".$data['customer_email']."</p>
            <p><strong>Customer Phone : </strong>".$data['customer_phone']."</p>
            <p><strong>Additional Comments : </strong>".$data['additional_comments']."</p>
            <p><strong>Address : </strong>".$data['address']."</p>
            <p><strong>Garden : </strong></p>
            <ul>
                <li>"."Garden Type : ".($data['garden']->front_pres == 1 ? 'Front Garden' : '').",".($data['garden']->back_pres == 1 ? 'Back Garden' : '')."</li>
                <li>"."Condition : ".strtoupper(str_replace("-", " ", $data['garden']->condition))."</li>
                <li>".($data['garden']->front_pres == 1 ? 'Front Size : '.strtoupper($data['garden']->front_size) : '')."</li>
                <li>".($data['garden']->back_pres == 1 ? 'Back Size : '.strtoupper($data['garden']->back_size) : '')."</li>
            </ul>
            <p><strong>Services : </strong></p>
            <p>Back Garden : </p>
            <ul>
        ";

        foreach ($data['back_services'] as $service) {
            $index = array_search($service->id, $services);
            if ($index !== false) {
                $value = $service_values[$index];
                // Check if $value is not "on" before adding it to $html
                if ($value !== "on") {
                    $html .= "<li>" . $service->name . " : $value</li>";
                } else {
                    $html .= "<li>" . $service->name . "</li>";
                }
            }
        }

        $html .="</ul>
            <p>Front Garden : </p>
            <ul>
        ";

        foreach ($data['front_services'] as $service) {
            $index = array_search($service->id, $services);
            if ($index !== false) {
                $value = $service_values[$index];
                // Check if $value is not "on" before adding it to $html
                if ($value !== "on") {
                    $html .= "<li>" . $service->name . " : $value</li>";
                } else {
                    $html .= "<li>" . $service->name . "</li>";
                }
            }
        }

        $html .="</ul>
            <p><strong>Parking : </strong>".strtoupper($data['garden']->parking)."</p>
            <p><strong>Estimated  Hours : </strong>".$data['hours']."</p>
            <p><strong>Total Price : </strong>&pound;".$data['price']."</p>
            <p><strong>Deposit Price : </strong>&pound;".$data['deposit']."</p>
            <p><strong>Outstanding Price : </strong><b>&pound;".$data['ouststanding']."</b></p>
        ";


        return response()->json($html);
    }

    public function showRubbish($id)
    {
        $setting = Setting::find(1);

        $rubbish = Rubbish::find($id);

        $price = $rubbish->cost;

        $dateTime =  Carbon::parse($rubbish->created_at);

        $created_at = $dateTime->format('d-m-Y | H:i');

        $ids = explode(',', $rubbish->option_id);
        $values = explode(',', $rubbish->option_value);
        $selectedItems = [];
        foreach ($ids as $key => $item_id) {
            $rubbish_item = RubbishItem::find($item_id);
            $item = new RubbishSelectedItem();
            $item->name = $rubbish_item->name;
            $item->qty = $values[$key];
            array_push($selectedItems, $item);
        }

        $data = [
            'id' => $rubbish->rubbish_id,
            'start_date' => date('d-m-Y', strtotime($rubbish->start_date)),
            'start_time' => $rubbish->start_time,
            'customer_name' => $rubbish->user->first_name . ' ' . $rubbish->user->last_name,
            'customer_email' => $rubbish->user->email,
            'customer_phone' => $rubbish->user->phone,
            'additional_comments' => $rubbish->comment,
            'address' => $rubbish->address,
            'selectedItems' => $selectedItems,
            'price' => number_format($price, 2),
            'deposit' => 5,
            'ouststanding' => number_format($price - 5, 2),
            'status' => $rubbish->status,
            'created_at' => $created_at
        ];

        $html = "
            <p><strong>Booking ID : </strong>".$data['id']." <strong>   Status : </strong>".$data['status']."</p>
            <p><strong>Booking Date | Time : </strong>".$data['start_date']." | ".$data['start_time']."</p>
            <p><strong>Created At : </strong>".$data['created_at']."</p>
            <p><strong>Customer Name : </strong>".$data['customer_name']."</p>
            <p><strong>Customer Email : </strong>".$data['customer_email']."</p>
            <p><strong>Customer Phone : </strong>".$data['customer_phone']."</p>
            <p><strong>Additional Comments : </strong>".$data['additional_comments']."</p>
            <p><strong>Address : </strong>".$data['address']."</p>
            <p><strong>The Selected Items: </strong></p>
            <ul>
        ";

        foreach ($data['selectedItems'] as $item) {
            $html .= "<li><span>" . $item->name . "</span> <span>" . $item->qty . "x</span></li>";
        }

        $html .="</ul>
            <p><strong>Total Price : </strong>&pound;".$data['price']."</p>
        ";


        return response()->json($html);
    }

    static public function removeSuggestion(Request $request) {
        Mail::to("info@eliteproviders.uk")->send(new SuggestionMail([
            'subject' => 'Welcome to Elite Providers',
            'html' => $request['comment']
        ]));
        Toastr::success(__('Your request has been sent and our team will take care of your complete account removal for you.'));
        return redirect()->route('account.index');
    }

    public function detail(Request $request) {
        $user = auth()->user();
        return view('frontend.account.detail', compact('user'));
    }

    public function gallery(Request $request) {
        $userId = Auth::id();
        $galleries = Gallery::where('user_id', $userId)->get();
        return view('frontend.account.gallery')->with([
            'galleries' => $galleries
        ]);;
    }

    public function link(Request $request) {
        $userId = Auth::id();
        $links = Link::where('user_id', $userId)->get();
        return view('frontend.account.link')->with([
            'links' => $links
        ]);;
    }

    public function message(Request $request) {
        $totalMessagesCount = Message::where('sender_id', Auth::id())
                                ->orWhere('receiver_id', Auth::id())
                                ->count();

        $messages = Message::where('sender_id', Auth::id())
                           ->orWhere('receiver_id', Auth::id())
                            ->paginate(10);
                            
        return view('frontend.account.message', compact('messages', 'totalMessagesCount'));
    }

    public function news(Request $request) {
        $news = News::where('user_id', Auth::id())->get();
        return view('frontend.account.news', compact('news'));
    }

    public function private(Request $request) {
        $user = User::find(Auth::id());
        return view('frontend.account.private', compact('user'));
    }

    public function profile(Request $request) {
        $user = User::find(Auth::id());
        return view('frontend.account.profile')->with([
            'banner' => $user->my_banner,
            'side' => $user->my_side,
            'layout' => $user->layout,
            'content' => $user->my_content
        ]);;
    }

    public function upload($galleryId) {
        $userId = Auth::id();
        $items = ArtWork::where('gallery_id', $galleryId)->get();
        $gallery = Gallery::where('id', $galleryId)->first();
        return view('frontend.account.upload')->with([
            'items' => $items,
            'id' => $galleryId,
            'title' => $gallery->gallery_name
        ]);
    }

    public function wishlist(Request $request) {
        $userId = Auth::id();
        $wishlists = WishList::where('user_id', $userId)->get();
        return view('frontend.account.wishlist', compact('wishlists'));
    }

    public function uploadItems(Request $request)
    {
        \Log::info('CSRF Token:', ['token' => $request->header('X-CSRF-TOKEN')]);
        // Validate the request
        
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');

            // Define the path to save the image
            $destinationPath = public_path('uploads');

            // Ensure the uploads directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate a unique name for the image
            $imageName = Auth::id(). "-". time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the uploads directory
            $image->move($destinationPath, $imageName);

            // Generate the full path to the uploaded image
            $imagePath = asset('uploads/' . $imageName);

            // You can save the path to the database if needed
            // Example: Gallery::create(['thumbnail' => $path]);
            if ($request->has('user')) {
                $user = User::find(Auth::id());
                
                if ($request->input("user") == "main-banner") 
                    $user->my_banner = $imageName;
                else if($request->input("user") == "sidebar-banner") 
                    $user->my_side = $imageName;
                $user->save();
            }

            return response()->json(['message' => 'File uploaded successfully', 'path' => $imageName], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

    public function avatar(Request $request)
    {
        \Log::info('CSRF Token:', ['token' => $request->header('X-CSRF-TOKEN')]);
        // Validate the request
        
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');

            // Define the path to save the image
            $destinationPath = public_path('uploads');

            // Ensure the uploads directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate a unique name for the image
            $imageName = Auth::id(). "-". time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the uploads directory
            $image->move($destinationPath, $imageName);

            // Generate the full path to the uploaded image
            $imagePath = asset('uploads/' . $imageName);

            $user = User::find(Auth::id());
            $user->avatar = $imageName;
            $user->save();

            return response()->json(['message' => 'File uploaded successfully', 'path' => $imageName], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

    public function removeAvatar(Request $request)
    {
        $user = User::find(Auth::id());
        $user->avatar = null;
        $user->save();

        return response()->json(['message' => 'Avatar removed successfully'], 200);
    }
}
