@extends('layouts.temp')
@section('content')

<div class="content-body">

    
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Reservation Chalets Info</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                          <th><strong>Reservation Date </strong></th>
                          <th><strong>Reservation Period</strong></th>
                          <th><strong>Chalet Name</strong></th>
                          <th><strong>member phone</strong></th>
                          <th><strong>Reservation Price</strong></th>
                          <th><strong>Reservation State</strong></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($reservations as $reservation)
                          <td>{{$reservation->reservation_date}}</td>
                          <td>@if ($reservation->reservation_period == 1)
                            {{'morning'}} @else{{'evening'}}  @endif</td>
                          <td> @if(!empty($reservation->chalet)){{$reservation->chalet->name}} {{$reservation->chalet->address}} @endif</td>
                          <td> @if(!empty($reservation->member)){{$reservation->member->name}} {{$reservation->member->phone}} @endif</td>
                          <td>{{$reservation->price}}</td>
                          <td>{{$reservation->state}}</td>
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('reservation/edit/' . $reservation->id ) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('reservation/delete/' . $reservation->id) }}">
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