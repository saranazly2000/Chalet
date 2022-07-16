
  @extends('layouts.temp')
  @section('content')

  <div class="content-body">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <form action="/search" method="get" role="search">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="input-group search-area d-lg-inline-flex d-none">
                            <input type="text" class="form-control" name="search" placeholder="Search here...">
                        
                                <span class="input-group-prepend">
                                    <button class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                                </span>
                            
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
       
        <!-- row -->

        <div class="row">
            
<div class="col-lg-12">
    
    <div class="card">
        
        <div class="card-header">
            <h4 class="card-title">Chalet Control</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-md">
                    <thead>
                        <tr>
                            
                            <th><strong>الاسم</strong></th>
                            <th><strong>رقم الجوال</strong></th>
                            <th><strong>السعر</strong></th>
                            <th><strong>العنوان</strong></th>
                            <th><strong>صورة الشاليه</strong></th>
                            <th><strong>رقم المالك</strong></th>
                            <th><strong>سعر فترة مسائية</strong></th>
                            <th><strong>Weekend Morning  Price</strong></th>
                            <th><strong>Weekend Evening  Price</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($chalets as $chalet)
                            <td>{{$chalet->name}}</td>
                            <td>{{$chalet->phone}}</td>
                            <td>{{$chalet->price}}</td>
                            <td>{{$chalet->address}}</td>
                            <td><img src="{{$chalet->cover_image}}" alt="" style="width: 70px;"></td>
                            <td>@if(!empty($chalet->member)){{$chalet->member->phone}} @endif</td>
                            @if(!empty($chalet->prices))
                            @foreach($chalet->prices as $price)
                            <td>{{$price->evening }}</td>
                            <td>{{$price->weekend_morning }}</td>
                            <td>{{$price->weekend_evening }}</td>
                            @endforeach
                            @endif
                          
                            <td>
                                <div class="d-flex">
                                    <a href="{{ URL('chalet/reservation/' . $chalet->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1" style="width: 70px;">حجوزات</a>
                             
                                </div>
                            </td>
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
</div>
@endsection