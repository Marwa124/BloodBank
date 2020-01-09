<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function governorates()
    {

        $governorates = Governorate::all();

        return apiResponse(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {

        $cities = City::where(function ($query) use ($request) {
            if ($request->has('governorate_id')) {
                $query->where('governorate_id', $request->governorate_id);
            }
            //else it'll return the whole cities.
        })->get();

        return apiResponse(1, 'success', $cities);
    }

    public function categories()
    {
        $categories = Category::all();

        return apiResponse(1, 'success', $categories);
    }

    public function bloodTypes()
    {
        $bloodtypes = BloodType::all();

        return apiResponse(1, 'success', $bloodtypes);
    }

    public function settings()
    {
        $settings = Setting::first();

        return apiResponse(1, 'success', $settings);
    }

    public function contactUs()
    {
        $contact = request()->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'subject' => 'required|max:70',
            'message' => 'required|max:500',
        ]);

        Mail::to($contact['email'])
            ->cc("marwatest124@gmail.com")
        //->bcc("marwatest124@gmail.com")
            ->send(new ContactUs($contact));

        if ($contact) {
            return apiResponse(1, 'Check Your mail', [
                'contact' => $contact,
                'fails'   => Mail::failures(),
                'client'  => $contact['email'],
            ]);
        } else {
            // error when $contact fails doesn't has any response message.
            return apiResponse(0, '$contact->errors()->first(), $contact->errors()');
        }
    }

    /**If category is one to many then in if($request->has('category_id)){
     *    $query->whereCategoryID($request->category_id);
     *   }
     */
    public function posts(Request $request)
    {
        $posts = Post::where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->whereHas('categories', function ($category) use ($request) {
                    $category->where('categories.id', $request->category_id);
                });
            }
            if ($request->has('keyword')) {
                $query->where('title', 'LIKE', '%' . $request->keyword . '%');
            }
        })->with('categories')->paginate(10);
        return apiResponse(1, 'success', $posts);
    }
    //Posts -> with Search as post request

    public function post(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        return apiResponse(1, 'success', $post);
    }

    public function favoriteList(Request $request)
    {
        $posts = $request->user()->posts()->paginate(10);
        return apiResponse(1, 'list of favorite posts.', $posts);
    }

    public function favoritePost(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'post_id' => 'required|exists:posts,id',
        ]);
        if ($validation->fails()) {
            return apiResponse(0, 'cant');
        }
        $favorable = $request->user()->posts()->toggle($request->post_id);
        return apiResponse(1, 'success', $favorable);
    }

    /** Notification for Donation requests */
    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(10);
        return apiResponse(1, 'success', $notifications);
    }

    public function profile(Request $request)
    {
        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }
        $request->user()->update($request->all());

        return apiResponse(1, 'success', $request->user()->load('city.governorate'));
    }

    public function getNotificationSettings(Request $request)
    {
        $data = [
            'governorate' => $request->user()->governorates()->pluck('governorates.id'),
            'blood_type'  => $request->user()->bloodTypes()->pluck('blood_types.id'),
        ];

        return apiResponse(1, 'success', $data);
    }

    public function notificationSettings(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'governorates' => 'array',
            'blood_types'  => 'array',
        ]);

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        // $request->blood_types جايه من ال $validation variable  Uppove
        $request->user()->governorates()->sync($request->governorates);
        $request->user()->bloodTypes()->sync($request->blood_types);

        $data = [

            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'blood_types'  => $request->user()->bloodTypes()->pluck('blood_types.id')->toArray(),
        ];

        return apiResponse(1, 'success', $data);

    }

    public function createDonation(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'patient_name'     => 'required',
            'patient_age'      => 'required|between:18,59|numeric',
            'bags_num'         => 'required|digits:1',
            'hospital_name'    => 'required',
            'hospital_address' => 'required',
            'latitude'         => 'required',
            'longitude'        => 'required',
            'phone'            => 'required',
            // 'phone'            => 'required|digits:11|regex:/^(01)[0-9]{9}/',
            'blood_type_id'    => 'required|exists:blood_types,id',
            'city_id'          => 'required|exists:cities,id',
        ]);
        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        $donation = $request->user()->donationRequests()->create($request->all());
        //find clients suitable for this donation request
        $clients_id = $donation->city->governorate->clients()
            ->whereHas('bloodTypes', function ($query) use ($donation) {
                $query->where('blood_types.id', $donation->blood_type_id);
            })->pluck('clients.id')->toArray();
        //dd($clients_id);
        if (count($clients_id)) {
            // Create a notification on database
            // create() function saves the data in database automatically.
            $notification = $donation->notification()->create([
                'title'   => 'يوجد حاله تبرع قريبه منك',
                'content' => optional($donation->bloodType)->name . ' محتاج متبرع للفصيله',
            ]);

            //attach clients to this notification
            $notification->clients()->attach($clients_id);

            $tokens = Token::whereIn('client_id', $clients_id)
                ->where('token', '!=', null)->pluck('token')->toArray();
                //dd($tokens);
            if (count($tokens)) {
                $title = $notification->title;
                $body  = $notification->content;
                $data  = [
                    'donation_request_id' => 13,
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                //dd($send);
                info('firebase result: ' . $send);
            }


        }
        return apiResponse(1, 'success', $donation);

//$donation->notification()->where('client_id', $request->id)->then is_read = 1;

    }

    public function testNotification(Request $request)
    {
        $tokens = $request->id;
        $title  = $request->title;
        $body   = $request->body;
        $send   = notifyByFirebase($title, $body, $tokens);
        info("firebase result: " . $send);

        return response()->json([
            'status' => 1,
            'msg'    => 'تم الارسال بنجاح',
            'send'   => json_decode($send),
        ]);
    }

// مدام السرفيس get
    // يبقي مش هعمل validations ***
    public function donationList(Request $request)
    {
        //Search according to blood types
        //Search according to city
        $donations = DonationRequest::where(function ($q) use ($request) {
            if ($request->has('city_id')) {
                $q->where('city_id', $request->city_id);
            }
            if ($request->has('blood_type')) {
                $q->where('blood_type_id', $request->blood_type);
            }
        })->paginate(10);
        return apiResponse(1, 'success', $donations);
    }

    public function donation(Request $request)
    {
        $donation = DonationRequest::find($request->donation_id);
        //dd($donation_details);
        if(!empty($donation)){
          if ($request->user()->notifications()->where('donation_request_id',$donation->id)->first())
          {
              $request->user()->notifications()->updateExistingPivot($donation->notification->id, [
                  'is_read' => 1
              ]);
          }
        return apiResponse(1, 'success', $donation);
    }
  else{
        return apiResponse(0,'donation not fond');
  }
    }
  }
