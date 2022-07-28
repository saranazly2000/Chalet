@extends('layouts.temp')
@section('content')
<div class="content-body">
<div class="container-fluid">
<div class="container">
   <div class="col-6">
      @foreach ($errors->all() as $message)
      <div class="alert alert-danger">{{$message}}</div>
      @endforeach
      @if(session('message'))
      <div  class="alert alert-danger">
         {{session('message')}}
      </div>
      @endif
   </div>
</div>
<div class="row">
<div class="col-lg-12">
   <div class="card">
      <div class="card-header">
         <h4 class="card-title">Add Chalet</h4>
      </div>
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
               <div class="card-body">
                  <form method="POST" action="{{ URL('chalet/store') }}" enctype="multipart/form-data">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                           <button type="submit" value="Upload" class="btn btn-primary" style=" position: absolute;
                              top: 1050px;
                              left: 350px;
                              ">
                           {{ __('Save') }}
                           </button>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="chaletname"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Name') }}</label>
                        <div class="col-md-6">
                           <input id="chaletname" type="text" class="form-control" name="chaletname" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="chaletphone"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Phone') }}</label>
                        <div class="col-md-6">
                           <input id="chaletphone" type="text" class="form-control" name="chaletphone"  required >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="chaletprice"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Price') }}</label>
                        <div class="col-md-6">
                           <input id="chaletprice" type="text" class="form-control" name="chaletprice" required >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="chaletspace"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet space') }}</label>
                        <div class="col-md-6">
                           <input id="chaletspace" type="text" class="form-control" name="chaletspace" required>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="number_of_people_allowed"
                           class="col-md-4 col-form-label text-md-right">{{ __('number of people allowed') }}</label>
                        <div class="col-md-6">
                           <input id="number_of_people_allowed" type="text" class="form-control" name="number_of_people_allowed" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="chaletaddress"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Address') }}</label>
                        <div class="col-md-6">
                           <input id="chaletaddress" type="text" class="form-control" name="chaletaddress" required
                              >
                        </div>
                     </div>
                     
                     <div class="form-group row">
                        <label for="morning_period_start"
                           class="col-md-4 col-form-label text-md-right">{{ __('morning from') }}</label>
                        <div class="col-md-2">
                           <input id="morning_period_start" type="text" class="form-control" name="morning_period_start" required>
                        </div>
                        <label for="morning_period_end"
                        class="col-md-2 col-form-label text-md-left">{{ __('to') }}</label>
                     <div class="col-md-2" style="margin-left: -65px">
                        <input id="morning_period_end" type="text" class="form-control" name="morning_period_end" required>
                     </div>
                     </div>

                     <div class="form-group row">
                        <label for="evening_period_start"
                           class="col-md-4 col-form-label text-md-right">{{ __('evening period start') }}</label>
                        <div class="col-md-2">
                           <input id="evening_period_start" type="text" class="form-control" name="evening_period_start" required>
                        </div>
                        <label for="evening_period_end"
                           class="col-md-2 col-form-label">{{ __('to') }}</label>
                        <div class="col-md-2"  style="margin-left: -65px">
                           <input id="evening_period_end" type="text" class="form-control" name="evening_period_end" required>
                        </div>
                     </div>

                     
                     <div class="form-group row">
                        <label for="chaletlatitude"
                           class="col-md-3 col-form-label text-md-right">{{ __('Latitude') }}</label>
                        <div class="col-md-3" style="margin-left: -10px">
                           <input id="chaletlatitude" type="text" class="form-control" name="chaletlatitude" required>
                        </div>
                        <label for="chaletlongitude"
                        class="col-md-3 col-form-label">{{ __('Longitude') }}</label>
                     <div class="col-md-3" style="margin-left: -65px">
                        <input id="chaletlongitude" type="text" class="form-control" name="chaletlongitude" required>
                     </div >
                     </div>
                     <div class="form-group row">
                        <label for="chaletservices"
                           class="col-md-4 col-form-label text-md-right">{{ __('Services available in the chalet') }}</label>
                        <div class="col-md-8 col-form-label text-md-left">
                           @if(!empty($services))
                           @foreach($services as $service)
                           <input type="checkbox" id="{{$service->id}}" name="services[]" value="{{$service->id}}">
                           <label for="{{$service->id}}">{{$service->service_name}}</label>
                           @endforeach
                           @endif
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="chaletdetails"
                           class="col-md-4 col-form-label text-md-right">{{ __('Details available in the chalet') }}</label>
                        <div class="col-md-8 col-form-label text-md-left">
                           @if(!empty($details))
                           @foreach($details as $detail)
                           <input type="checkbox" id="{{$detail->id}}" name="details[]" value="{{$detail->id}}">
                           <label for="{{$detail->id}}">{{$detail->detail_name}}</label>
                           @endforeach
                           @endif
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="coverimage"
                           class="col-md-4 col-form-label text-md-right">{{ __('Cover Image') }}</label>
                        <div class="col-md-6">
                           <input id="coverimage" type="file" class="form-control" name="coverimage" required
                              >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="file"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Images') }}</label>
                        <div class="col-md-6">
                           <input type="file" name="file[]" id="file" accept="image/*" multiple required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="evening"
                           class="col-md-4 col-form-label text-md-right">{{ __('Evening Period Price') }}</label>
                        <div class="col-md-6">
                           <input id="evening" type="text" class="form-control" name="evening" required
                              >
                        </div >
                     </div>
                     <div class="form-group row">
                        <label for="weekend_morning"
                           class="col-md-4 col-form-label text-md-right">{{ __('Weekend Morning Price') }}</label>
                        <div class="col-md-6">
                           <input id="weekend_morning" type="text" class="form-control" name="weekend_morning" required
                              >
                        </div >
                     </div>
                     <div class="form-group row">
                        <label for="weekend_evening"
                           class="col-md-4 col-form-label text-md-right">{{ __('Weekend Evening  Price') }}</label>
                        <div class="col-md-6">
                           <input id="weekend_evening" type="text" class="form-control" name="weekend_evening" required
                              >
                        </div >
                     </div>
                     <div class="form-group row">
                        <label for="member_id"
                           class="col-md-4 col-form-label text-md-right">{{ __('Chalet Owner') }}</label>
                        <div class="col-md-6">
                           <select name="member_id" class="form-control" required>
                           <option value="-1"></option>
                           @foreach($members as $member)
                           <option value="{{$member->id}}">{{$member->phone}}</option>
                           @endforeach
                        </div>
                     </div>
                  </form>               
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection