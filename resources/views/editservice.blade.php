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
                <div class="card-header">{{ __('Edit Chalet Service') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL('service/update/' . $service->id) }}"  enctype="multipart/form-data" >
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
                            <label for="service_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Service Name') }}</label>

                            <div class="col-md-6">
                                <input id="service_name" type="text" class="form-control" name="service_name"
                                @if(!empty($service->service_name))  value="{{ $service->service_name }}"  @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="service_icon"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Service Icon') }}</label>

                            <div class="col-md-6">
                                <input id="service_icon" type="file" class="form-control" name="service_icon" 
                                  value="{{ $service->service_icon }}"  required>
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