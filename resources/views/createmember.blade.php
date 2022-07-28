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
          <h4 class="card-title">Add Users</h4>
      </div>   
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
             

              <div class="card-body">
              <form method="POST" action="{{ URL('member/store') }}" >
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

               

                     
                      <div class="form-group row">
                          <label for="memberphone"
                              class="col-md-4 col-form-label text-md-right">{{ __('Member Phone') }}</label>

                          <div class="col-md-6">
                              <input id="memberphone" type="text" class="form-control" name="memberphone" required>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="membertype"
                            class="col-md-4 col-form-label text-md-right">{{ __('Member Type') }}</label>

                        <div class="col-md-6">
                            <select name="membertype" class="form-control" required>
                                <option > </option>
                                <option value=1>{{'owner'}}</option>
                                <option value=2>{{'user'}}</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Member Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required >
                        </div>
                    </div>

                  

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" value="Upload" class="btn btn-primary" >
                                {{ __('Save') }}
                            </button>

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