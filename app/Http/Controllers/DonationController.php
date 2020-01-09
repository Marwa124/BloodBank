<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = DonationRequest::latest()->paginate(5);
        $paginate = pagePagination($donations);
        return view('donations.index', compact('donations', 'paginate'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = DonationRequest::find($id);
        $output = '<div class="card-body text-right">
        <ul class="list-group">
            <li class="list-group-item active font-weight-bold">الأسم: &nbsp;' .
              $donation->patient_name . '</li>
            <li class="list-group-item">السن: &nbsp;' . $donation->age . '</li>
            <li class="list-group-item">عدد الاكياس: &nbsp;' . $donation->bags_num . '</li>
            <li class="list-group-item">اسم المستشفي: &nbsp;' . $donation->hospital_name . '</li>
            <li class="list-group-item">عنوان المستشفي: &nbsp;' . $donation->hospital_address . '</li>
            <li class="list-group-item">التليفون: &nbsp;' . $donation->phone . '</li>
            <li class="list-group-item">فصيله الدم: &nbsp;' . $donation->bloodType()->first()->name . '</li>
            <li class="list-group-item">المدينه: &nbsp;' . $donation->city()->first()->name . '</li>
            <li class="list-group-item">اسم العميل: &nbsp;' . $donation->client()->first()->name . '</li>
            <li class="list-group-item">ملحوظه: &nbsp;' . $donation->notes . '</li>
          </ul>
      </div>';
      return response($output);

        //return view('donations.show', compact('donation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = DonationRequest::findOrFail($id);

        if($donation)
        {
          /* can't delete cause of the relation between donation and notificaion
          * also it's belongsto to hasone so i can't use detach()
          */
          $donation->delete();
          return response()->json([
            'status' => 1,
            'message' => 'تم الحذف',
            'id' => $id
          ]);
        }else {
          return response()->json([
            'status' => 0,
            'message' => 'حدث خطأ'
          ]);
        }
        return back();
    }
}
