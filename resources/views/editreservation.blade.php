@extends('layouts.temp')
@section('content')


<div class="content-body">
    <div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Chalet Reservation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL('reservation/update/' . $reservation->id .'/'. $reservation->chalet_id) }}" >
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
                            <label for="reservation_date"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Reservation Date') }}</label>

                            <div class="col-md-6">
                                <input id="reservation_date" type="text" class="form-control" name="reservation_date"
                                    value="{{ $reservation->reservation_date }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reservation_period"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Reservation Period') }}</label>

                       
                            
                          <div class="col-md-6">
                            <select name="reservation_period" class="form-control" required>
                                <option > </option>
                                <option value=1>{{'morning'}}</option>
                                <option value=2>{{'evening'}}</option>
                          </select>
                          </div>
                            </div>
                                    <div class="form-group row">
                                        <label for="reservation_price"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Edit Reservation Price') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="reservation_price" type="text" class="form-control" name="reservation_price"
                                                value="{{ $reservation->price }}" >
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
</div>
</div>
</div>
@endsection