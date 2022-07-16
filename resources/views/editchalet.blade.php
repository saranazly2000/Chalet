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
          <h4 class="card-title">Edit Chalet</h4>
      </div>   
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ URL('chalet/update/' . $chalet->id) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style=" position: absolute;
                                        top: 850px;
                                        left: 350px;
                                                ">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="chaletname"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Name') }}</label>

                            <div class="col-md-6">
                                <input id="chaletname" type="text" class="form-control" name="chaletname"
                                    value="{{ $chalet->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletphone"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Phone') }}</label>

                            <div class="col-md-6">
                                <input id="chaletphone" type="text" class="form-control" name="chaletphone"
                                    value="{{ $chalet->phone }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletprice"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Price') }}</label>

                            <div class="col-md-6">
                                <input id="chaletprice" type="text" class="form-control" name="chaletprice"
                                    value="{{ $chalet->price }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletemail"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Email') }}</label>

                            <div class="col-md-6">
                                <input id="chaletemail" type="text" class="form-control" name="chaletemail"
                                    value="{{ $chalet->email }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletaddress"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Address') }}</label>

                            <div class="col-md-6">
                                <input id="chaletaddress" type="text" class="form-control" name="chaletaddress"
                                    value="{{ $chalet->address }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletlatitude"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="chaletlatitude" type="text" class="form-control" name="chaletlatitude"
                                    value="{{ $chalet->latitude }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chaletlongitude"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="chaletlongitude" type="text" class="form-control" name="chaletlongitude"
                                    value="{{ $chalet->longitude }}" required>
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label for="coverimage"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Image') }}</label>

                            <div class="col-md-6">
                                <input id="coverimage" type="file" class="form-control" name="coverimage" 
                                value="{{ $chalet->cover_image }}" required>
                            </div>
                        </div>
                        @if(!empty($chalet->prices))
                        @foreach($chalet->prices as $price)
                        <div class="form-group row">
                            <label for="evening"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Evening Period Price') }}</label>

                            <div class="col-md-6">
                                <input id="evening" type="text" class="form-control" name="evening"
                                    value="{{$price->evening }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weekend_morning"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Weekend Morning  Price') }}</label>

                            <div class="col-md-6">
                                <input id="weekend_morning" type="text" class="form-control" name="weekend_morning"
                                    value="{{ $price->weekend_morning }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weekend_evening"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Weekend Evening  Price') }}</label>

                            <div class="col-md-6">
                                <input id="weekend_evening" type="text" class="form-control" name="weekend_evening"
                                    value="{{ $price->weekend_evening }}" >
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="form-group row">
                            <label for="chaletservices"
                               class="col-md-4 col-form-label text-md-right">{{ __('Services available in the chalet') }}</label>
                            <div class="col-md-8 col-form-label text-md-left">
                                @if(!empty($chalet->chaletservices))
                                @foreach($chalet->chaletservices as $service)
                               <input type="checkbox" id="{{$service->id}}" name="services[]" value="{{$service->service_name}}">
                               <label for="{{$service->id}}"> value ="{{$service->service_name}}"</label>
                               @endforeach
                               @endif
                            </div>
                         </div>
                        
                        <div class="form-group row">
                            <label for="member_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Owner') }}</label>

                            <div class="col-md-6">
                            <select name="member_id" class="form-control" required>
                                <option value="{{$member->id}}">{{$member->phone}}  </option>
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