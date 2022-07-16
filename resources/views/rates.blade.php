@extends('layouts.temp')
@section('content')

<div class="content-body">
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Rate Chalets Info</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                          <th><strong>Rate </strong></th>
                          <th><strong>Chalet Name</strong></th>
                          <th><strong>Owner Phone</strong></th>
                          
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          
                        @foreach ($rates as $rate)
                          <td>  @php
                            $val = 0;
                            $count = 0;
                            @endphp
                            @php
                            $val+=$rate->chalet_rate;
                               $count++;
                               @endphp
                               @php
                                   if($count==0){
                                    $count=1;
                                   }
                               $avgRate = $val/$count;
                               @endphp
                           <div>
                               @for($i = 0; $i < 5; $i++) @if($i<$avgRate) <span
                                   class="fa fa-star checked"></span>
                                   @else
                                   <span class="fa fa-star"></span>
                                   @endif
                                   @endfor</td>
                          <td>{{$rate->chalet->name}}</td>
                          <td>{{$rate->member->phone}}</td>
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('rate/edit/' . $rate->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('rate/delete/' . $rate->id) }}">
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