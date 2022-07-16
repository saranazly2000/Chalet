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
          <h4 class="card-title">Edit Chalet Rate </h4>
      </div>   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             

                <div class="card-body">
                    <form method="POST" action="{{ URL('rate/update/' . $rate->id) }}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style=" position: absolute;
                                        top: 210px;
                                        left: 350px;
                                                ">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="rate"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Rate') }}</label>

                            <div class="col-md-6">
                                <input id="rate" type="text" class="form-control" name="rate"
                                    value="{{ $rate->chalet_rate }}" >
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