@extends('layouts.temp')
@section('content')
<div class="content-body">
@if(isset($details))
<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>The search result</p>
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
                        @foreach ($details as $chalet )
                        @foreach($chalet->reservations as $chaletreservations )
                        <td>@if(!empty($chaletreservations)){{$chaletreservations->reservation_date}}@endif</td>
                        <td>@if(!empty($chaletreservations))@if ($chaletreservations->reservation_period == 1)
                          {{'morning'}} @else{{'evening'}}  @endif
                          @endif
                        </td>
                        <td> @if(!empty($chalet)){{$chalet->name}} {{$chalet->address}} @endif</td>
                        <td> @if(!empty($chalet->member)){{$chalet->member->name}} {{$chalet->member->phone}} @endif</td>
                        <td>@if(!empty($chaletreservations)){{$chaletreservations->price}}@endif</td>
                        <td>@if(!empty($chaletreservations)){{$chaletreservations->state}}@endif</td>
                        <td>
                          <div class="d-flex">
                            @if(!empty($chaletreservations))
                              <a href="{{ URL('reservation/edit/' . $chaletreservations->id ) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                              @endif
                          </div>
                      </td>
                      <td>
                          <div class="d-flex">
                            @if(!empty($chaletreservations))
                              <form method="POST" action="{{ URL('reservation/delete/' . $chaletreservations->id) }}">
                                @endif
                                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <button  class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                          </form>
                          </div>
                      </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
@elseif(isset($message))
<p>{{$message}}</p>
@endif
</div>
@endsection