@extends('layouts.temp')
@section('content')
<div class="content-body">
  <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Add Detail</h4>
              </div>   
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                     
        
                      <div class="card-body">
                   <form method="POST" id="" action="{{ URL('detail/store') }}"  enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                       
                        <div class="form-group row">
                            <label for="detail_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Detail Name') }}</label>
  
                            <div class="col-md-6">
                                <input id="detail_name" type="text" class="form-control" name="detail_name" required>
                            </div>
                        </div>

                         <div class="form-group row">
                          <label for="detail_icon"
                             class="col-md-4 col-form-label text-md-right">{{ __('Detail Icon') }}</label>
                          <div class="col-md-6">
                             <input id="detail_icon" type="file" class="form-control" name="detail_icon" required
                                >
                          </div>
                       </div>
  
                      <div class="form-group row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" value="Uplode" class="btn btn-primary" >
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