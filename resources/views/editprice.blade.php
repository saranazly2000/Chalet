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
                <div class="card-header">{{ __('Edit Chalet Price') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL('price/update/' . $price->id) }}" >
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
                            <label for="evening"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Evening Period Price') }}</label>

                            <div class="col-md-6">
                                <input id="evening" type="text" class="form-control" name="evening"
                                    value="{{ $price->evening }}" >
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
                    
                    </form>
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