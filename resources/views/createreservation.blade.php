@extends('layouts.temp')
@section('content')

<div class="content-body">
  <div class="container">


   
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Add Reservation') }}</div>

              <div class="card-body">
              <form method="POST" action="{{ URL('reservation/store') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                  <div class="form-group row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" value="Upload" class="btn btn-primary" style=" position: absolute;
                              top: 200px;
                              left: 350px;
                                      ">
                                  {{ __('Save') }}
                              </button>

                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="reservation_date"
                              class="col-md-4 col-form-label text-md-right">{{ __('Reservation Date') }}</label>

                          <div class="col-md-6">
                              <input id="reservation_date" type="text" placeholder="Date Format Should be YYYY-mm-dd" class="form-control" name="reservation_date" >
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="reservation_period"
                              class="col-md-4 col-form-label text-md-right">{{ __('Reservation Period') }}</label>

                          <div class="col-md-6">
                            <select name="reservation_period" class="form-control">
                                <option > </option>
                                <option value=1>{{'morning'}}</option>
                                <option value=2>{{'evening'}}</option>
                          </select>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="chalet_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Chalet Name') }}</label>

                            <div class="col-md-6">
                              <select name="chalet_id" class="form-control">
                                      <option></option>
                                      @foreach($chalets as $chalet)
                                      <option value="{{$chalet->id}}">{{$chalet->name}} - {{$chalet->address}}</option>
                                      @endforeach
                                </select>
                              </div>
                    </div>
                      <div class="form-group row">
                          <label for="member_id"
                              class="col-md-4 col-form-label text-md-right">{{ __('Member Phone') }}</label>

                              <div class="col-md-6">
                                <select name="member_id" class="form-control">
                                        <option></option>
                                        @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->phone}}</option>
                                        @endforeach
                                </select>
                                </div>
                      </div>
                
                  </form>
              </div>
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
                
          </div>
      </div>
  </div>
</div> 

</div>


@endsection