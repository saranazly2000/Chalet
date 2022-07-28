<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Chalet;
use App\Image;
use App\Comment;
use App\Detail;
use App\Rate;
use App\Member;
use App\Reservation;
use App\Service;
use \Carbon\Carbon;
use App\ChaletService;
use App\ChaletDetail;
use App\Price;
//use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\EditReservationRequest;
use App\Http\Requests\ChaletRequest;
use App\Http\Requests\RateRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use \GuzzleHttp\Client;

class FirstController extends Controller
{

  public function createmember()
  {

    return view('createmember');
  }


  public function storemember(UserRequest $request)
  {
    $phone = $request['memberphone'];
    $type = $request['membertype'];
    $name = $request['name'];
    $member = new Member();
    $member->phone = $phone;
    $member->type = $type;
    $member->name = $name;
    $member->save();
    return redirect()->back();
  }

  public function indexmember()
  {
    $members = Member::select('*')->get();
    return view('members')->with('members', $members);
  }
  public function editemember($id)
  {
    $member = Member::where('id', $id)->first();
    return view('editmember')->with('member', $member);
  }
  public function updatemember(UserRequest $request, $id)
  {
    $phone = $request['memberphone'];
    $type = $request['membertype'];
    $name = $request['name'];
    $member = Member::where('id', $id)->first();
    $member->phone = $phone;
    $member->type = $type;
    $member->name = $name;
    $member->save();
    return redirect()->back();
  }
  public function destroymember($id)
  {
    $result = Member::where('id', $id)->delete();
    return redirect()->back();
  }



  public function createchalet()
  {
    $members = Member::select('id', 'phone')->where('type', 1)->get();
    $services = Service::select('*')->get();
    $details = Detail::select('*')->get();
    return view('createchalet')->with('members', $members)->with('services', $services)->with('details', $details);
  }


  public function store2(ChaletRequest $request)
  {
    $name = $request['chaletname'];
    $phone = $request['chaletphone'];
    $price = $request['chaletprice'];
    $member_id = $request['member_id'];
    $address = $request['chaletaddress'];
    $chaletlatitude = $request['chaletlatitude'];
    $chaletlongitude = $request['chaletlongitude'];
    $chaletspace = $request['chaletspace'];
    $number_of_people_allowed = $request['number_of_people_allowed'];
    $morning_period_start = $request['morning_period_start'];
    $morning_period_end = $request['morning_period_end'];
    $evening_period_start = $request['evening_period_start'];
    $evening_period_end = $request['evening_period_end'];

    $image =  $request->file('coverimage');
    $path = 'uploads/images/';
    $imageName = time() + rand(1, 1000000000) . '.' . $image->getClientOriginalExtension();
    Storage::disk('local')->put($path . $imageName, file_get_contents($image));
    $chalet = new Chalet();
    $chalet->name = $name;
    $chalet->phone = $phone;
    $chalet->price = $price;
    $chalet->chalet_space = $chaletspace;
    $chalet->number_of_people_allowed = $number_of_people_allowed;
    $chalet->morning_period_start = $morning_period_start;
    $chalet->morning_period_end = $morning_period_end;
    $chalet->evening_period_start = $evening_period_start;
    $chalet->evening_period_end = $evening_period_end;
    $chalet->member_id = $member_id;
    $chalet->address = $address;
    $chalet->latitude = $chaletlatitude;
    $chalet->longitude = $chaletlongitude;
    $chalet->cover_image =  $path . $imageName;
    $chalet->save();
    $images = $request->file('file');
    $imageName = '';
    $error_message= '';
    if (count($images) > 3) {
      $error_message = "shoud be 3 images ";
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
    $evening = $request['evening'];
    $weekend_morning = $request['weekend_morning'];
    $weekend_evening = $request['weekend_evening'];
    $price = new Price();
    $price->evening = $evening;
    $price->weekend_morning = $weekend_morning;
    $price->weekend_evening = $weekend_evening;
    $price->chalet_id = $chalet->id;
    $price->save();


    $services = implode(',', $request->input('services'));
    $services_ids = explode(',', $services);
    foreach ($services_ids as $service_id) {
        $chalet_services = new ChaletService();
        $chalet_services->service_id = $service_id;
        $chalet_services->chalet_id = $chalet->id;
        $chalet_services->save();
    }

    $details = implode(',', $request->input('details'));
    $details_ids = explode(',', $details);
    foreach ($details_ids as $details_id) {
        $chalet_details = new ChaletDetail();
        $chalet_details->detail_id = $details_id;
        $chalet_details->chalet_id = $chalet->id;
        $chalet_details->save();
    }
    return redirect()->back()->with(['message' =>  $error_message]);
  }



  public function index3()
  {
    $images = Image::select('*')->get();
    foreach ($images as $image) {
      $img_link = Storage::url($image->name);
      $image->name =  $img_link;
    }
    return view('chalet')->with('images', $images);
  }

  public function index4()
  {
    $chalets = Chalet::with('images')->with('comments')->with('rates')->select('*')->get();
    $members = Member::select('*')->get();
    foreach ($chalets as $chalet) {
      $img_link = Storage::url($chalet->cover_image);
      $chalet->cover_image =  $img_link;
      foreach ($chalet->images as $images) {
        $img_link = Storage::url($images->image_name);
        $images->image_name =  $img_link;
      }
    }
    return view('chalet')->with('chalets', $chalets)->with('members', $members);
  }

  public function index5()
  {
    $chalets = Chalet::with('images')->with('member')->with('prices')->with('comments')->with('rates')->select('*')->get();
    // dd($chalets->toArray());
    foreach ($chalets as $chalet) {
      $img_link = Storage::url($chalet->cover_image);
      $chalet->cover_image =  $img_link;
    }
    return view('chalets')->with('chalets', $chalets);
  }
  public function destroy($id)
  {
    $result = Chalet::where('id', $id)->delete();
    return redirect()->back();
  }



  public function chaletdetails($id)
  {

    $chalet = Chalet::with('images')->with('chaletservices')->with('prices')->with('comments')->with('rates')->where('id', $id)->first();
    $img_link = Storage::url($chalet->cover_image);
    $chalet->cover_image =  $img_link;
    foreach ($chalet->images as $images) {
      $img_link = Storage::url($images->image_name);
      $images->image_name =  $img_link;
    }
    if(!empty($chalet->chaletservices)){
      foreach($chalet->chaletservices as $chaletservice){
        if(!empty($chaletservice->service)){
            $img_link2 = Storage::url($chaletservice->service->service_icon);
            $chaletservice->service->service_icon=  $img_link2;
          
        }
      }
   }

    $member = Member::select('*')->where('id', $chalet->member_id)->first();
    return view('chaletdetails')->with('chalet', $chalet)->with('member', $member);
  }
  public function edit($id)
  {
    $chalet = Chalet::with('prices')->with('chaletservices')->with('chaletservices.service')->where('id', $id)->first();
    $img_link = Storage::url($chalet->cover_image);
    $chalet->cover_image =  $img_link;
    $member = Member::select('*')->where('id', $chalet->member_id)->first();
    return view('editchalet')->with('chalet', $chalet)->with('member', $member);
  }
  public function update(Request $request, $id)
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
    $chalet = Chalet::where('id', $id)->first();
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
    $evening = $request['evening'];
    $weekend_morning = $request['weekend_morning'];
    $weekend_evening = $request['weekend_evening'];
    $price = Price::where('chalet_id', $id)->first();
    $price->evening = $evening;
    $price->weekend_morning = $weekend_morning;
    $price->weekend_evening = $weekend_evening;

    $services = implode(',', $request->input('services'));
    $services_ids = explode(',', $services);
    foreach ($services_ids as $service_id) {
        $chalet_services = ChaletService::where('chalet_id', $id)->first();
        $chalet_services->service_id = $service_id;
        $chalet_services->chalet_id = $chalet->id;
        $chalet_services->save();
    }
    $price->save();
    $chalet->save();
    return redirect()->back();
  }





  /*   COMMENT CODE */




  public function indexcomments()
  {
    $comments = Comment::with('chalet')->with('member')->select('*')->get();
    return view('comments')->with('comments', $comments);
  }


  public function editcomment($id)
  {
    $comment = Comment::where('id', $id)->first();
    return view('editcomment')->with('comment', $comment);
  }



  public function updatecomment(Request $request, $id)
  {
    $commentcontent = $request['commentcontent'];
    $comment = Comment::where('id', $id)->first();
    $comment->comment_content = $commentcontent;
    $comment->save();
    return redirect()->back();
  }


  public function destroycomment($id)
  {
    $result = Comment::where('id', $id)->delete();
    return redirect()->back();
  }


  /* End  COMMENT CODE */


  /* RATE CODE */
  public function indexrates()
  {
    $rates = Rate::with('chalet')->with('member')->select('*')->get();
    return view('rates')->with('rates', $rates);
  }




  public function editrate($id)
  {
    $rate = Rate::where('id', $id)->first();
    return view('editrate')->with('rate', $rate);
  }



  public function updaterate(RateRequest $request, $id)
  {
    $chalet_rate = $request['rate'];
    $rate = Rate::where('id', $id)->first();
    $rate->chalet_rate = $chalet_rate;
    $error_messeag = "";
    if ($chalet_rate < 1 || $chalet_rate > 5) {
      $error_messeag = "rate must be from 1 and 5";
    } else {
      $rate->save();
    }
    return Redirect()->back()->with(['message' =>  $error_messeag]);
  }


  public function destroyrate($id)
  {
    $result = Rate::where('id', $id)->delete();
    return redirect()->back();
  }


  /* END  RATE CODE */




  public function indexprices()
  {
    $prices = Price::with('chalet')->select('*')->get();
    return view('prices')->with('prices', $prices);
  }


  public function editprice($id)
  {
    $price = Price::with('chalet')->where('id', $id)->first();
    return view('editprice')->with('price', $price);
  }



  public function updateprice(Request $request, $id)
  {
    $evening = $request['evening'];
    $weekend_morning = $request['weekend_morning'];
    $weekend_evening = $request['weekend_evening'];
    $price = Price::where('id', $id)->first();
    $price->evening = $evening;
    $price->weekend_morning = $weekend_morning;
    $price->weekend_evening = $weekend_evening;
    $price->save();
    return redirect()->back();
  }

  public function destroyprice($id)
  {
    $result = Price::where('id', $id)->delete();
    return redirect()->back();
  }




  public function createreservation()
  {
    $members = Member::select('id', 'phone')->where('type', 1)->get();
    $chalets = Chalet::select('*')->get();
    return view('createreservation')->with('members', $members)->with('chalets', $chalets);
  }


  public function indexreservations()
  {
    $reservations = Reservation::with('chalet')->with('member')->select('*')->get();
    foreach ($reservations as $reservation) {
      if ($reservation->is_active  == 0) {
        $reservation->state = "Deleted";
      } elseif ($reservation->is_active  == 1 && Carbon::now()->toDateString() > $reservation->reservation_date) {
        $reservation->state = "Done";
      }
    }
    // dd($reservations->toArray());
    return view('reservations')->with('reservations', $reservations);
  }


  public function storereservation(ReservationRequest $request)
  {
    $reservation_date = $request['reservation_date'];
    $reservation_period = $request['reservation_period'];
    $chalet_id = (int)$request['chalet_id'];
    $member_id = (int)$request['member_id'];

    $chalet = Chalet::where('id', $chalet_id);
    $dateNow = Carbon::now();
    $error_message = "";
    if ($reservation_date < $dateNow) {
      $error_message = 'The time of booking does not have to be in the past';
    }
    $reservation = Reservation::where('chalet_id', $chalet_id)->where('reservation_date', $reservation_date)->where('reservation_period', $reservation_period)->first();
    if (!empty($reservation)) {
      $error_message = 'The chalet is booked';
    }
    $newReservation = new Reservation();
    $newReservation->reservation_period = $reservation_period;
    $newReservation->chalet_id = $chalet_id;
    $newReservation->member_id = $member_id;
    $newReservation->reservation_date = $reservation_date;
    $day = Carbon::createFromFormat('Y-m-d', $reservation_date)->format('l');
    if ($day == "Thursday" || $day == "Friday" || $reservation_period == 2) {
      $chaletPrice = Price::where('chalet_id', $chalet_id)->first();
      if ($day == "Thursday" || $day == "Friday") {
        if ($reservation_period == 1) {
          $newReservation->price = $chaletPrice->weekend_morning;
        } elseif ($reservation_period == 2) {
          $newReservation->price = $chaletPrice->weekend_evening;
        }
      } else {
        $newReservation->price = $chaletPrice->evening;
      }
    } else {
      $chalet = Chalet::where('id', $chalet_id)->first();
      $newReservation->price = $chalet->price;
    }

    $result = $newReservation->save();
    return Redirect()->back()->with(['message' =>  $error_message]);
  }




  public function editreservation($id)
  {
    $reservation = Reservation::with('chalet')->with('member')->where('id', $id)->first();
    $chalet_id = $reservation->chalet_id;
    return view('editreservation')->with('reservation', $reservation)->with('chalet_id', $chalet_id);
  }


  public function updatereservation(EditReservationRequest $request, $id, $chalet_id)
  {
    $reservation_date = $request['reservation_date'];
    $reservation_period = $request['reservation_period'];
    $reservation_price = $request['reservation_price'];
    $dateNow = Carbon::now();
    $error = "";
    if ($reservation_date < $dateNow) {
      $error = 'The time of booking does not have to be in the past';
    }
    $reservation = Reservation::where('chalet_id', $chalet_id)->where('reservation_date', $reservation_date)->where('reservation_period', $reservation_period)->first();
    if (!empty($reservation)) {
      $error = 'The chalet is booked';
    }
    if ($reservation_price < 0) {
      $error = 'The price should not be less than 0';
    }
    $reservation = Reservation::where('id', $id)->first();
    $reservation->reservation_period = $reservation_period;
    $reservation->reservation_date = $reservation_date;
    $reservation->price = $reservation_price;
    $reservation->save();
    return Redirect()->back()->with(['message' =>  $error]);
  }

  public function chaletreservation($id)
  {
    $reservations = Reservation::with('chalet')->with('member')->where('chalet_id', $id)->select('*')->get();
    return view('chaletreservation')->with('reservations', $reservations);
   // dd($reservation->toArray());
  }

  public function destroyreservation($id)
  {
    $result = Reservation::where('id', $id)->delete();
    return redirect()->back();
  }
  public function reservationsearch()
  {
    $q = Input::get('search');
    if ($q != "") {
    $chalet = Chalet::with('member')->with('reservations')->where('name', 'LIKE', '%' . $q . '%')->get();
      if (count($chalet) > 0)
        return view('reservationsearch')->withDetails($chalet)->withQuery($q);
    }
    return view('reservationsearch')->withMessage('No Reservation found. Try to search again !');
  }
  public function commentsearch()
  {
    $q = Input::get('search');
    if ($q != "") {
    $chalet = Chalet::with('member')->with('reservations')->where('name', 'LIKE', '%' . $q . '%')->get();
      if (count($chalet) > 0)
        return view('commentsearch')->withDetails($chalet)->withQuery($q);
    }
    return view('commentsearch')->withMessage('No Comment found. Try to search again !');
  }

  public function search()
  {
    $q = Input::get('search');
    if ($q != "") {
      $chalet = Chalet::with('member')->where('name', 'LIKE', '%' . $q . '%')->get();
      if (count($chalet) > 0)
        return view('searchchalet')->withDetails($chalet)->withQuery($q);
    }
    return view('searchchalet')->withMessage('No Chalet found. Try to search again !');
  }


  public function indeximages(request $request)
  {
    $images = Image::select('*')->get();
    foreach ($images as $image) {
      $img_link = Storage::url($image->image_name);
      $image->image_name =  $img_link;
    }
    return view('images')->with('images', $images);
  }


  public function creatrservices()
  {
    return view('creatrservices');
  }

  public function addnewservice(request $request)
  {
    $service_name = $request['service_name'];
    $service_icon = $request->file('service_icon');
    $path = 'uploads/images/';
    $iconName = time() + rand(1, 1000000000) . '.' . $service_icon->getClientOriginalExtension();
    Storage::disk('local')->put($path . $iconName, file_get_contents($service_icon));
    $service = new Service();
    $service->service_name = $service_name;
    $service->service_icon = $path . $iconName;
    $result = $service->save();
    return redirect()->back();
  }

  public function getservices(request $request)
  {
    $services = Service::select('*')->get();
    return $services;
  }

  public function services(request $request)
  {
    $services = Service::select('*')->get();
    foreach ($services as $service) {
      $img_link = Storage::url($service->service_icon);
      $service->service_icon =  $img_link;
    }
    return view('services')->with('services',$services);
  }
  public function editservice($id)
  {
    $service = Service::where('id', $id)->first();
    $img_link = Storage::url($service->service_icon);
    $service->service_icon =  $img_link;
    return view('editservice')->with('service', $service);
  }


  public function editchaletservice($id)
  {
  $chaletservices = ChaletService::with('service')->where('chalet_id', $id)->get();
  foreach ($chaletservices as $chaletservice){
  if (!empty($chaletservice->service)){
          $img_link = Storage::url($chaletservice->service->service_icon);
          $chaletservice->service->service_icon=  $img_link;
    }
 }
 // dd($chaletservices->toArray());
    return view('editchaletservice')->with('chaletservices', $chaletservices);
  }

  public function destroychaletservice($id)
  {
    $chaletservice = ChaletService::where('id', $id)->delete();
    return redirect()->back();
  }


  public function createchaletservice($id)
  {
    $chalet = Chalet::where('id', $id)->with('chaletservices')->first();
    $chaletservice = Service::whereNotIn('id', $chalet->chaletservices->pluck('service_id'))->get();
    dd($chaletservice->toArray());
  }
  






  public function updateservice(Request $request, $id)
  {
    $service_name = $request['service_name'];
    $service_icon = $request->file('service_icon');
    $path = 'uploads/images/';
    $iconName = time() + rand(1, 1000000000) . '.' . $service_icon->getClientOriginalExtension();
    Storage::disk('local')->put($path . $iconName, file_get_contents($service_icon));
    $service = Service::where('id', $id)->first();
    $service->service_name = $service_name;
    $service->service_icon = $path . $iconName;
    $service->save();
    return redirect()->back();
  }

  public function destroyservice($id)
  {
    $service = Service::where('id', $id)->delete();
    return redirect()->back();
  }

  public function creatrdetail()
  {
    return view('creatrdetail');
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
    return redirect()->back();
  }


  public function details()
  {
    $details = Detail::select('*')->get();
    foreach ($details as $detail) {
      $img_link = Storage::url($detail->detail_icon);
      $detail->detail_icon =  $img_link;
    }
    return view('details')->with('details',$details);
  }
  public function editdetail($id)
  {
    $detail = Detail::where('id', $id)->first();
    $img_link = Storage::url($detail->detail_icon);
    $detail->detail_icon =  $img_link;
    return view('editdetail')->with('detail', $detail);
  }


  public function updatedetail(Request $request, $id)
  {
    $detail_name = $request['detail_name'];
    $detail_icon = $request->file('detail_icon');
    $path = 'uploads/images/';
    $iconName = time() + rand(1, 1000000000) . '.' . $detail_icon->getClientOriginalExtension();
    Storage::disk('local')->put($path . $iconName, file_get_contents($detail_icon));
    $detail = Detail::where('id', $id)->first();
    $detail->detail_name = $detail_name;
    $detail->detail_icon = $path . $iconName;
    $detail->save();
    return redirect()->back();
  }
  
  public function destroydetail($id)
  {
    $detail = Detail::where('id', $id)->delete();
    return redirect()->back();
  }


  /*public function storeservices(request $request)
  {
    $chalet_id = $request['chalet_id'];
    $services =  $request->input('services');
    foreach($services as $service){
      $chalet_service = new chalet_services();
    $chalet_service->service_id = $services ;
    $chalet_service->chalet_id =$chalet_id;
    $service->save(); 
    }*/

  /* $chalet_id = $request['chalet_id'];
    $inputValue = $request->input('services');
    $arrayToString = implode(',', $request->input('services'));
    $inputValue['services'] = $arrayToString;
    $service = new Service();
    $service->chalet_services =$inputValue['services'];
    $service->chalet_id =$chalet_id;
    $service->save(); */
  /*$chalet_id = $request['chalet_id'];
    $services =  $request->input('services');
    foreach($services as $service){
       $serviceName =  $service . ' ';
      
       foreach(explode(' ',$serviceName) as $services){
        $service = new Service();
        $service->chalet_services = $services;
        if( $service->chalet_services != ''){
          $service->chalet_services =$services;
         $service->chalet_id = $chalet_id;
          $service->save();
        } 
     }
     }
    return redirect()->back();
  }
*/
}
