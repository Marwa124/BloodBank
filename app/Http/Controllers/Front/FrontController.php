<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mapper;

class FrontController extends Controller
{
  public function logout()
  {
    auth()->guard('client')->logout();
    return redirect(route('master'));
  }

    public function home(Request $request)
    {
      $client = Client::where('phone', $request->phone)->first();
      $posts = Post::where('created_at', '<=', Carbon::now()->toDateString())->take(9)->get();

      return view('front.home', compact('posts'));
    }

    public function clientDonation()
    {
      $donationRequests = auth('client')->user()->donationRequests()->paginate(10);
      return view('front.client-donation', compact('donationRequests'));
    }

    public function posts()
    {
      return view('front.posts');
    }

    public function postSearch(Request $request)
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

    public function postDetails($id)
    {
      $post = Post::findOrFail($id);
      return view('front.post-details', compact('post'));
    }

    public function donationDetails($id)
    {
      $donation = DonationRequest::findOrFail($id);
      $client = auth('client')->user();
      $notification = $client->notifications()->where('donation_request_id',$id)->first();
      if ($notification)
          {
            $client->notifications()->updateExistingPivot($notification->id, [
                'is_read' => 1
            ]);
          }

      // $donationRequests = count($donationRequests)-1;
      return view('front.donation-details', compact('donation'));
    }

    public function toggleFavorite(Request $request)
    {
      $favorable = $request->user()->posts()->toggle($request->post_id);
      return apiResponse(1, 'success', $favorable);
    }

    public function about()
    {
      return view('front.about');
    }

    public function donation()
    {
      $donations = DonationRequest::latest()->paginate(10);
      return view('front.donation', compact('donations'));
    }

    public function donationSearch(Request $request)
    {
      $donations = DonationRequest::where(function($q) use($request){
        if($request['blood_type']){
          $q->where('blood_type_id', $request->blood_type);
        }
        if($request['governorate']){
          $q->whereHas('city', function($q) use($request){
            $q->where('cities.governorate_id', $request->governorate);
          });
        }
      })->latest()->paginate(5);

      return view('front.donation', compact('donations'));
    }

    public function notificationSetting($id)
    {
      $client = auth('client')->user()->where('id', $id)->first();

      return view('front.notification-settings', compact('client'));
    }

    public function saveNotificationSetting(Request $request, $id)
    {
      $client = Client::findOrFail($id);
      $request->user()->governorates()->sync($request->governorates);
      $request->user()->bloodTypes()->sync($request->bloodTypes);
      $client->update($request->all());
      // dd($request->all());
      toast('well done', 'success');
      return redirect(route('master'));
    }

    public function CreateDonation()
    {
      Mapper::map(53.381128999999990000, -1.470085000000040000);

      return view('front.create-donation');
    }

    public function saveDonation(Request $request)
    {
      $rules = [
        'patient_name'     => 'required',
        'patient_age'      => 'required|between:18,59|numeric',
        'bags_num'         => 'required|digits:1',
        'hospital_name'    => 'required',
        'hospital_address' => 'required',
        // 'latitude'         => 'required',
        // 'longitude'        => 'required',
        'phone'            => 'required',
        // 'phone'            => 'required|digits:11|regex:/^(01)[0-9]{9}/',
        'blood_type_id'    => 'required|exists:blood_types,id',
        'city_id'          => 'required|exists:cities,id',
      ];
      $this->validate($request, $rules);

      $donation = request()->user()->donationRequests()->create($request->all());

      //find clients suitable for this donation request
      $clients_id = $donation->city->governorate->clients()
      ->whereHas('bloodTypes', function ($query) use ($donation) {
          $query->where('blood_types.id', $donation->blood_type_id);
      })->pluck('clients.id')->toArray();

      if (count($clients_id)) {
        $notification = $donation->notification()->create([
          'title'   => 'يوجد حاله تبرع قريبه منك',
          'content' => optional($donation->bloodType)->name . ' محتاج متبرع للفصيله',
          ]);

          $notification->clients()->attach($clients_id);
      }
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

      return apiResponse(1, 'success', $donation);
      // toast('done', 'success');
      // return redirect(route('master'));
    }

}
