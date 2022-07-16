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
                                    
                                    <th><strong>Name</strong></th>
                                    <th><strong>Phone</strong></th>
                                    <th><strong>Price</strong></th>
                                    <th><strong>Address</strong></th>
                                    <th><strong>Latitude</strong></th>
                                    <th><strong>Longitude</strong></th>
                                    <th><strong>Cover Image</strong></th>
                                    <th><strong>Owner Phone</strong></th>
                                    <th><strong>Evening Period Price</strong></th>
                                    <th><strong>Weekend Morning  Price</strong></th>
                                    <th><strong>Weekend Evening  Price</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($details as $chalet)
                                    <td>{{$chalet->name}}</td>
                                    <td>{{$chalet->phone}}</td>
                                    <td>{{$chalet->price}}</td>
                                    <td>{{$chalet->address}}</td>
                                    <td>{{$chalet->latitude}}</td>
                                    <td>{{$chalet->longitude}}</td>
                                    <td>
                                        @php
                                        $icon_link =  Storage::url($chalet->cover_image);
                                           $chalet->cover_image = $icon_link;
                                       @endphp
                                        <img src="{{$chalet->cover_image}}" alt="" style="width: 50px;"></td>
                                    <td>@if(!empty($chalet->member)){{$chalet->member->phone}} @endif</td>
                                    @if(!empty($chalet->prices  ))
                                    @foreach($chalet->prices as $price)
                                    <td>{{$price->evening }}</td>
                                    <td>{{$price->weekend_morning }}</td>
                                    <td>{{$price->weekend_evening }}</td>
                                    @endforeach
                                    @endif
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ URL('chalet/edit/' . $chalet->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                     
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <form method="POST" action="{{ URL('chalet/delete/' . $chalet->id) }}">
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
@elseif(isset($message))
<p>{{$message}}</p>
@endif
</div>
@endsection