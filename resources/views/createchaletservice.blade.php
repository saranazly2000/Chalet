@extends('layouts.temp')
@section('content')

<div class="content-body">

  
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">

        <td>
            <div class="d-flex">
                @foreach ($chaletservices as $chaletservice)    
                <a href="{{ URL('chaletservice/store/' . $chaletservice->chalet_id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"  style=" position: absolute;
                top: 100px;
                left: 1200px;
                "><i class="fa fa-add"></i></a>
          @endforeach
            </div>
            
        </td>
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Services Chalet </h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                          <th><strong>Service Name</strong></th>
                          <th><strong>Service Icon</strong></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($chaletservices as $chaletservice)    
                        @if (!empty($chaletservice->service))
                        <td>{{$chaletservice->service->service_name}}</td>
                        <td>  <img  src="{{$chaletservice->service->service_icon}}" alt="" style="width: 40px;">  </td>
                          @endif
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('chaletservice/delete/' . $chaletservice->id) }}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button  class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                            </form>
                            </div>
                        </td>
                      
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</div>
@endsection