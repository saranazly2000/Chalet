@extends('layouts.temp')
@section('content')

<div class="content-body">
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Chalet Details</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                        <th><strong>Detail Name </strong></th>
                          <th><strong>Detail Icon </strong></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($details as $detail)
                        
                        <td>{{$detail->detail_name}}</td>
                          <td><img src="{{$detail->detail_icon }}" alt="" style="width: 70px;"></td>
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('detail/edit/' . $detail->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('detail/delete/' . $detail->id) }}">
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