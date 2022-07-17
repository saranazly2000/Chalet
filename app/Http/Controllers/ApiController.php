<?php

namespace App\Http\Controllers;

use App\Price;
use App\Chalet;
use App\Image;
use App\Comment;
use App\Rate;
use App\Member;
use App\Reservation;
use App\Service;
use App\ChaletService;
use App\Detail;
use App\ChaletDetail;
use App\FavoriteChalet;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
  //TenantApis

  //ReservationsApis
  public function getuserreservations(Request $request)
  {
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $reservations = Reservation::select('id', 'reservation_date', 'chalet_id', 'state', 'is_active')->where('member_id', $member_id)->with('chalet:id,name')->get();
    foreach ($reservations as $reservation) {
      if ($reservation->is_active  == 0) {
        $reservation->state = "Deleted";
      } elseif ($reservation->is_active  == 1 && Carbon::now()->toDateString() > $reservation->reservation_date) {
        $reservation->state = "Done";
      }
    }
    return response()->json($reservations);
  }

  public function storereservation(Request $request)
  {
    $reservation_date = $request['reservation_date'];
    $reservation_period = $request['reservation_period'];
    $chalet_id = $request['chalet_id'];
    $member_id = $request['member_id'];
    if (empty($reservation_date) || empty($reservation_period) || empty($chalet_id) || empty($member_id)) {
      return response()->json(['msg' => 'All fields are required']);
    }

    $chalet = Chalet::where('id', $chalet_id);
    if (empty($chalet)) {
      return response()->json(['msg' => 'There is no chalet for this chalet id']);
    }

    $member = Member::where('id', $member_id);
    if (empty($member)) {
      return response()->json(['msg' => 'There is no member for this member id']);
    }

    $dateNow = Carbon::now();
    if ($reservation_date < $dateNow) {
      return response()->json(['msg' => 'The time of booking does not have to be in the past']);
    }

    $reservation = Reservation::where('chalet_id', $chalet_id)->where('reservation_date', $reservation_date)->where('reservation_period', $reservation_period)->first();
    if (!empty($reservation)) {
      return response()->json(['msg' => 'The chalet is booked']);
    }

    if ($reservation_period != 1 && $reservation_period != 2) {
      return response()->json(['msg' => 'Reservation period should be 1 or 2']);
    }

    $newReservation = new Reservation();
    $newReservation->reservation_period = $reservation_period;
    $newReservation->chalet_id = $chalet_id;
    $newReservation->member_id = $member_id;
    $newReservation->reservation_date = $reservation_date;

    $day = Carbon::createFromFormat('Y-m-d', $reservation_date)->format('l');
    if ($day == "Thursday" || $day == "Friday" || $reservation_period == 2) {
      $chalet = Price::where('chalet_id', $chalet_id)->first();
      if ($day == "Thursday" || $day == "Friday") {
        if ($reservation_period == 1) {
          $newReservation->price = $chalet->weekend_morning;
        } elseif ($reservation_period == 2) {
          $newReservation->price = $chalet->weekend_evening;
        }
      } else {
        $newReservation->price = $chalet->evening;
      }
    } else {
      $chalet = Chalet::where('id', $chalet_id)->first();
      $newReservation->price = $chalet->price;
    }

    $result = $newReservation->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status, 'day' => $day]);
  }

  //favoritechalets

  public function getfavoritechalets(request $request)
  {
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $favorite_chalets = FavoriteChalet::with('chalet')->where('member_id', $member_id)->get();
    return response()->json($favorite_chalets);
  }

  public function storefavoritechalet(request $request)
  {
    $chalet_id = $request['chalet_id'];
    $member_id  =  $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $chalet = Chalet::where('id', $chalet_id)->first();
    if ($chalet == null) {
      return response()->json(['err' => "chalet_id does not exist"]);
    }
    $favorite_chalet = new FavoriteChalet();
    $favorite_chalet->member_id = $member_id;
    $favorite_chalet->chalet_id = $chalet_id;
    $result = $favorite_chalet->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  public function deletefavoritechalet(request $request)
  {
    $favoritechalet_id = $request['favoritechalet_id'];
    $favoritechalet = FavoriteChalet::where('id', $favoritechalet_id)->first();
    if ($favoritechalet == null) {
      return response()->json(['err' => "favoritechalet_id does not exist"]);
    }
    $chalet = FavoriteChalet::where('id', $favoritechalet_id)->delete();
    if ($chalet) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  //chaletsrRate

  public function storerate(Request $request)
  {
    $chalet_rate = $request['rate'];
    $chalet_id = $request['chalet_id'];
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $chalet = Chalet::where('id', $chalet_id)->first();
    if ($chalet == null) {
      return response()->json(['err' => "chalet_id does not exist"]);
    }
    if ($chalet_rate < 0 || $chalet_rate > 5) {
      return response()->json(['err' => "chalet_rate should be between 0-5"]);
    }
    $rate = new Rate();
    $rate->chalet_rate = $chalet_rate;
    $rate->chalet_id = $chalet_id;
    $rate->member_id = $member_id;
    $result = $rate->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  public function getuserrates(Request $request)
  {
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $rates = Rate::where('member_id', $member_id)->with('chalet:id,name')->get(['id', 'chalet_rate', 'chalet_id']);
    return response()->json($rates);
  }

  public function getchaletrates(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $chalet = Chalet::where('id', $chalet_id)->first();
    if ($chalet == null) {
      return response()->json(['err' => "chalet_id does not exist"]);
    }
    //$rates = Rate::where('chalet_id', $chalet_id)->with('member:id,name')->get(['id','chalet_rate','member_id']);
    $rates = Rate::select('id', 'chalet_rate', 'member_id')->where('chalet_id', $chalet_id)->with('member:id,name')->get();
    return response()->json($rates);
  }

  //chaletApi

  public function getchalets()
  {
    $chalets = Chalet::select('*')->get();
    foreach ($chalets as $chalet) {
      $img_link = Storage::url($chalet->cover_image);
      $chalet->cover_image =  $img_link;
    }
    return response()->json(['status' => true, 'data' => $chalets]);
  }

  public function getchaletdetails(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $chalet = Chalet::where('id', $chalet_id)->first();
    if ($chalet == null) {
      return response()->json(['err' => "chalet_id does not exist"]);
    }
    $chalet = Chalet::where('id', $chalet_id)->first();
    $img_link = Storage::url($chalet->cover_image);
    $chalet->cover_image =  $img_link;
    return response()->json(['message' => "chalet data retrieved successfully", 'data' => $chalet]);
  }

  //ChaletOwnerApis

  //ChaletApis
  public function getownerchalets(Request $request)
  {
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    $chalets = Chalet::where('member_id', $member_id)->select('id', 'name')->get();
    return response()->json($chalets);
  }


  //ReservationApis
  public function getownerchaletsreservation(Request $request)
  {
    $member_id = $request['member_id'];
    $user = Member::where('id', $member_id)->first();
    if ($user == null) {
      return response()->json(['err' => "member_id does not exist"]);
    }
    //chalet:id,name,member_id
    $reservations = Reservation::with('member:id,name')
      ->has('chalet')->with('chalet:id,member_id')->where('member_id', $user->id)
      ->select('id', 'reservation_date', 'chalet_id', 'state', 'is_active', 'member_id')->get();
    foreach ($reservations as $reservation) {
      if ($reservation->is_active  == 0) {
        $reservation->state = "Deleted";
      } elseif ($reservation->is_active  == 1 && Carbon::now()->toDateString() > $reservation->reservation_date) {
        $reservation->state = "Done";
      }
    }
    return response()->json($reservations);
  }

  public function getsreservationdetails(Request $request)
  {
    $reservation_id = $request['reservation_id'];
    $reservation = Reservation::where('id', $reservation_id)->first();
    if ($reservation == null) {
      return response()->json(['err' => "reservation_id does not exist"]);
    }
    //chalet:id,name,member_id
    $reservation = Reservation::with('member:id,name,phone')->where('id', $reservation_id)->select('id', 'reservation_date', 'chalet_id', 'state', 'is_active', 'member_id', 'price', 'reservation_period')->first();
    if ($reservation->is_active  == 0) {
      $reservation->state = "Deleted";
    } elseif ($reservation->is_active  == 1 && Carbon::now()->toDateString() > $reservation->reservation_date) {
      $reservation->state = "Done";
    }
    return response()->json($reservation);
  }

  public function storeimage(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $images = $request->file('imagefile');
    $imageName = '';
    foreach ($images as $image) {
      $path = 'uploads/images/';
      $imageName =  time() + rand(1, 1000000000) . '.' . $image->getClientOriginalExtension() . ' ';
      Storage::disk('local')->put($path . $imageName, file_get_contents($image));
      foreach (explode(' ', $imageName) as $images) {
        $image = new Image();
        $image->image_name = $images;
        if ($image->image_name != '') {
          $image->image_name = $path . $images;
          $image->chalet_id = $chalet_id;
          $result = $image->save();
          if ($result) {
            $status = true;
          } else {
            $status = false;
          }
          return response()->json(['status' => $status]);
        }
      }
    }
    return response()->json(['status' => $images]);
  }



  public function storechalet(Request $request)
  {
    $name = $request['chaletname'];
    $phone = $request['chaletphone'];
    $ownerid = $request['member_id'];
    $address = $request['chaletaddress'];
    $chaletlatitude = $request['chaletlatitude'];
    $chaletlongitude = $request['chaletlongitude'];
    $price = $request['price'];
    $coverimage =  $request->file('coverimage');
    $path = 'uploads/images/';
    $imageName = time() + rand(1, 1000000000) . '.' . $coverimage->getClientOriginalExtension();
    Storage::disk('local')->put($path . $imageName, file_get_contents($coverimage));
    $chalet_space = $request['chalet_space'];
    $number_of_people_allowed = $request['number_of_people_allowed'];
    $morning_period_start = $request['morning_period_start'];
    $morning_period_end = $request['morning_period_end'];
    $evening_period_start = $request['evening_period_start'];
    $evening_period_end = $request['evening_period_end'];
    $service_ids =  $request['service_ids'];
    $detail_ids =  $request['detail_ids'];
    $images = $request->file('images');

    $chalet = new Chalet();
    $chalet->name = $name;
    $chalet->phone = $phone;
    $chalet->member_id = $ownerid;
    $chalet->address = $address;
    $chalet->latitude = $chaletlatitude;
    $chalet->longitude = $chaletlongitude;
    $chalet->cover_image =  $path . $imageName;
    $chalet->price = $price;
    $chalet->chalet_space = $chalet_space;
    $chalet->number_of_people_allowed = $number_of_people_allowed;
    $chalet->morning_period_start = $morning_period_start;
    $chalet->morning_period_end = $morning_period_end;
    $chalet->evening_period_start = $evening_period_start;
    $chalet->evening_period_end = $evening_period_end;
    $result = $chalet->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }

    $imageName = '';
    if (count($images) > 3) {
      return response()->json(['err' => "shoud be 3 images"]);
    }
    foreach ($images as $image) {
      $path = 'uploads/images/';
      $imageName =  time() + rand(1, 1000000000) . '.' . $image->getClientOriginalExtension() . ' ';
      Storage::disk('local')->put($path . $imageName, file_get_contents($image));
      foreach (explode(' ', $imageName) as $images) {
        $image = new Image();
        $image->image_name = $images;
        if ($image->image_name != '') {
          $image->image_name = $path . $images;
          $image->chalet_id = $chalet->id;
          $image->save();
        }
      }
    }

    foreach ($service_ids as $service_id) {
      $check_chalet_service = ChaletService::where('chalet_id', $chalet->id)->where('service_id', $service_ids[0])->get();
      if (!$check_chalet_service->isEmpty()) {
        return response()->json(['err' => "service already added to this chalet"]);
      }
      $chalet_service = new ChaletService();
      $chalet_service->service_id = $service_id[0];
      $chalet_service->chalet_id = $chalet->id;
      $chalet_service_result = $chalet_service->save();
    }

    foreach ($detail_ids as $detail_id) {
      $check_chalet_detali = ChaletDetail::where('chalet_id', $chalet->id)->where('detail_id', $detail_ids[0])->get();
      if (!$check_chalet_detali->isEmpty()) {
        return response()->json(['err' => "detail already added to this chalet"]);
      }
      $chalet_detail = new ChaletDetail();
      $chalet_detail->detail_id = $detail_id[0];
      $chalet_detail->chalet_id = $chalet->id;
      $result2 = $chalet_detail->save();
    }

    return response()->json(['status' => $status]);
  }

  /*public function storechalet(Request $request)
  {
    $name = $request['chaletname'];
    $phone = $request['chaletphone'];
    $price = $request['chaletprice'];
    $email = $request['chaletemail'];
    $member_id = $request['member_id'];
    $address = $request['chaletaddress'];
    $chaletlatitude = $request['chaletlatitude'];
    $chaletlongitude = $request['chaletlongitude'];
    $chaletservices = $request['chaletservices'];
    $image =  $request->file('coverimage');
    $path = 'uploads/images/';
    $imageName = time() + rand(1, 1000000000) . '.' . $image->getClientOriginalExtension();
    Storage::disk('local')->put($path . $imageName, file_get_contents($image));
    $chalet = new Chalet();
    $chalet->name = $name;
    $chalet->phone = $phone;
    $chalet->price = $price;
    $chalet->email = $email;
    $chalet->member_id = $member_id;
    $chalet->address = $address;
    $chalet->latitude = $chaletlatitude;
    $chalet->longitude = $chaletlongitude;
    $chalet->services = $chaletservices;
    $chalet->cover_image =  $path . $imageName;
    $result = $chalet->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
     $images = $request->file('file');
        $imageName = '';
         foreach($images as $image){
          $path = 'uploads/images/';
           $imageName =  time()+rand(1,1000000000) .'.' . $image->getClientOriginalExtension() . ' ';
           Storage::disk('local')->put($path.$imageName ,file_get_contents($image));
           foreach(explode(' ',$imageName) as $images){
            $image = new Image();
            $image->image_name = $images;
            if( $image->image_name != ''){
             $image->image_name = $path.$images;
             $image->chalet_id = $chalet->id;
              $image->save();
            } 
         }
         }
    // return redirect()->back();
  }*/


  public function indexchalets()
  {
    $chalets = Chalet::select('*')->get();
    foreach ($chalets as $chalet) {
      $img_link = Storage::url($chalet->cover_image);
      $chalet->cover_image =  $img_link;
    }
    return response()->json(['status' => true, 'message' => "chalet data retrieved successfully", 'data' => $chalets, 'error' => ""]);
    
  }

  public function chaletdetails(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $chalet = Chalet::where('id', $chalet_id)->first();
    $img_link = Storage::url($chalet->cover_image);
    $chalet->cover_image =  $img_link;
    return response()->json(['message' => "chalet data retrieved successfully", 'data' => $chalet]);
  }

  public function updatechalet(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $name = $request['chaletname'];
    $phone = $request['chaletphone'];
    $ownerid = $request['member_id'];
    $address = $request['chaletaddress'];
    $chaletlatitude = $request['chaletlatitude'];
    $chaletlongitude = $request['chaletlongitude'];
    $price = $request['price'];
    $coverimage =  $request->file('coverimage');
    $path = 'uploads/images/';
    $imageName = time() + rand(1, 1000000000) . '.' . $coverimage->getClientOriginalExtension();
    Storage::disk('local')->put($path . $imageName, file_get_contents($coverimage));
    $chalet_space = $request['chalet_space'];
    $number_of_people_allowed = $request['number_of_people_allowed'];
    $morning_period_start = $request['morning_period_start'];
    $morning_period_end = $request['morning_period_end'];
    $evening_period_start = $request['evening_period_start'];
    $evening_period_end = $request['evening_period_end'];
    $service_ids =  $request['service_ids'];
    $detail_ids =  $request['detail_ids'];
    $images = $request->file('images');

    $chalet =  Chalet::where('id', $chalet_id)->first();
    $chalet->name = $name;
    $chalet->phone = $phone;
    $chalet->member_id = $ownerid;
    $chalet->address = $address;
    $chalet->latitude = $chaletlatitude;
    $chalet->longitude = $chaletlongitude;
    $chalet->cover_image =  $path . $imageName;
    $chalet->price = $price;
    $chalet->chalet_space = $chalet_space;
    $chalet->number_of_people_allowed = $number_of_people_allowed;
    $chalet->morning_period_start = $morning_period_start;
    $chalet->morning_period_end = $morning_period_end;
    $chalet->evening_period_start = $evening_period_start;
    $chalet->evening_period_end = $evening_period_end;
    $result = $chalet->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }

    return response()->json(['status' => $status]);
  }


  public function destroychalet(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $chalet = Chalet::where('id', $chalet_id)->delete();
    if ($chalet) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }



  public function indeximages(request $request)
  {
    $chalet_id = $request['chalet_id'];
    $images = Image::where('chalet_id', $chalet_id)->get();
    foreach ($images as $image) {
      $img_link = Storage::url($image->image_name);
      $image->image_name =  $img_link;
    }
    return response()->json($images);
  }



  public function storecomment(Request $request)
  {
    $commentcontent = $request['commentcontent'];
    $chalet_id = $request['chalet_id'];
    $member_id = $request['member_id'];
    $comment = new Comment();
    $comment->comment_content = $commentcontent;
    $comment->chalet_id = $chalet_id;
    $comment->member_id = $member_id;
    $result = $comment->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  public function getcomment(Request $request)
  {
    $comment_id = $request['comment_id'];
    $comments = Comment::where('id', $comment_id)->first();
    return response()->json($comments);
  }

  public function updatecomment(Request $request)
  {
    $commentcontent = $request['commentcontent'];
    $comment_id = $request['comment_id'];
    $comment = Comment::where('id', $comment_id)->first();
    $comment->comment_content = $commentcontent;
    $result = $comment->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }



  public function getcomments(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $comments = Comment::select('*')->where('chalet_id', $chalet_id)->get();
    return response()->json($comments);
  }


  public function destroycomment(Request $request)
  {
    $comment_id = $request['comment_id'];
    $comment = Comment::where('id', $comment_id)->delete();
    $result = $comment;
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  public function updaterate(Request $request)
  {
    $chalet_rate = $request['rate'];
    $rate_id = $request['rate_id'];
    $rate = Rate::where('id', $rate_id)->first();
    $rate->chalet_rate = $chalet_rate;
    $result = $rate->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }
  public function getrate(Request $request)
  {
    $rate_id = $request['rate_id'];
    $rates = Rate::where('id', $rate_id)->first();
    return response()->json($rates);
  }


  /*public function getchaletrates()
  {
    $rates = Rate::select('*')->get();
    return response()->json($rates);
  }*/

  public function destroyrate(Request $request)
  {
    $rate_id = $request['rate_id'];
    $rate = Rate::where('id', $rate_id)->delete();
    if ($rate) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }



  public function edit($id)
  {
    $chalet = Chalet::where('id', $id)->first();
    $img_link = Storage::url($chalet->cover_image);
    $chalet->cover_image =  $img_link;
    $member = Member::select('*')->where('id', $chalet->member_id)->first();
    return response()->json(['message' => "chalet data retrieved successfully", 'data' => $chalet]);
  }

  public function getreservationchalet(Request $request)
  {
    $chalet_id = $request['chalet_id'];
    $reservation = Reservation::select('*')->where('chalet_id', $chalet_id)->with('member:id,phone,name')->get();
    return response()->json($reservation);
  }
  public function addnewservice(request $request)
  {
    $service_name = $request['service_name'];
    $service_icon = $request->file('service_icon');;
    $path = 'uploads/images/';
    $iconName = time() + rand(1, 1000000000) . '.' . $service_icon->getClientOriginalExtension();
    Storage::disk('local')->put($path . $iconName, file_get_contents($service_icon));
    $service = new Service();
    $service->service_name = $service_name;
    $service->service_icon = $path . $iconName;
    $result = $service->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }
  public function addnewdetail(request $request)
  {
    $detail_name = $request['detail_name'];
    $detail_icon = $request->file('detail_icon');;
    $path = 'uploads/images/';
    $iconName = time() + rand(1, 1000000000) . '.' . $detail_icon->getClientOriginalExtension();
    Storage::disk('local')->put($path . $iconName, file_get_contents($detail_icon));
    $detail = new Detail();
    $detail->detail_name = $detail_name;
    $detail->detail_icon = $path . $iconName;
    $result = $detail->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }

  public function getservices()
  {
    $services = Service::select('*')->get();
    return response()->json($services);
  }
  public function getdetails()
  {
    $details = Detail::select('*')->get();
    return response()->json($details);
  }

  public function storeservices($chalet_id, $service_ids)
  {
    foreach ($service_ids as $service_id) {
      $check_chalet_service = ChaletService::where('chalet_id', $chalet_id)->where('service_id', $service_ids[0])->get();
      if (!$check_chalet_service->isEmpty()) {
        return response()->json(['err' => "service already added to this chalet"]);
      }
      $chalet_service = new ChaletService();
      $chalet_service->service_id = $service_id[0];
      $chalet_service->chalet_id = $chalet_id;
      $result = $chalet_service->save();
      if ($result) {
        $status = true;
      } else {
        $status = false;
      }
    }
    return response()->json(['status' => $status]);
  }

  public function storedetails(request $request)
  {
    $chalet_id = $request['chalet_id'];
    $detail_ids =  $request['detail_ids'];
    foreach ($detail_ids as $detail_id) {
      $check_chalet_detali = ChaletDetail::where('chalet_id', $chalet_id)->where('detail_id', $detail_ids[0])->get();
      if (!$check_chalet_detali->isEmpty()) {
        return response()->json(['err' => "detail already added to this chalet"]);
      }
      $chalet_detail = new ChaletDetail();
      $chalet_detail->detail_id = $detail_id[0];
      $chalet_detail->chalet_id = $chalet_id;
      $result = $chalet_detail->save();
      if ($result) {
        $status = true;
      } else {
        $status = false;
      }
    }
    return response()->json(['status' => $status]);
  }

  public function addnewmember(Request $request)
  {
    $phone = $request['phone'];
    $type = $request['type'];
    $name = $request['name'];
    $member = new Member();
    $member->phone = $phone;
    $member->type = $type;
    $member->name = $name;
    $result = $member->save();
    if ($result) {
      $status = true;
    } else {
      $status = false;
    }
    return response()->json(['status' => $status]);
  }
  
}
