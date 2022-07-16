@extends('layouts.temp')
@section('content')

<div class="content-body">
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Prices Chalets Info</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                        <th><strong>Chalet Name </strong></th>
                          <th><strong>Morning Period Price </strong></th>
                          <th><strong>Evening Period Price</strong></th>
                          <th><strong>Weekend Morning  Price</strong></th>
                          <th><strong>Weekend Evening  Price</strong></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($prices as $price)
                        
                        <td>{{$price->chalet->name}}</td>
                          <td>{{$price->chalet->price }}</td>
                          <td>{{$price->evening }}</td>
                          <td>{{$price->weekend_morning }}</td>
                          <td>{{$price->weekend_evening }}</td>
                       
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('price/edit/' . $price->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('price/delete/' . $price->id) }}">
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