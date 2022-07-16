@extends('layouts.temp')
@section('content')



<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <h4>Product Details</h4>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="first">
                                        <img class="img-fluid" src="{{$chalet->cover_image}}" alt="">
                                    </div>
                                </div>
                                <div class="tab-slide-content new-arrival-product mb-4 mb-xl-0">
                                    <!-- Nav tabs -->
                                    <ul class="nav slide-item-list mt-3" role="tablist">
                                       
                                        @foreach ($chalet->images as $images)
                                        @if (!empty($images))
                                    
                                        <li role="presentation" class="show">
                                            <a href="#first" role="tab" data-toggle="tab">
                                                <img class="img-fluid" src="{{$images->image_name}}" alt="">
                                            </a>
                                        </li>
                                                    
                                            @endif
    
                                        @endforeach
                                     
                                    </ul>
                                </div>
                            </div>
                            <!--Tab slider End-->
                            <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr">
                                        <h4>{{ $chalet->name}}</h4>
                                        @php
                                        $val = 0;
                                        $count = 0;
                                        @endphp
                                        @if(!empty($chalet->rates))
                                            @php $rates =$chalet->rates; @endphp
                                        @foreach ($rates as $rate)
                                        @php
                                        $val+=$rate->rate;
                                           $count++;
                                           @endphp
                                           @endforeach
                                           @endif
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
                                       </div>
                                        <p>Owner Phone: <span class="item">{{ $member->phone}} </span></p>
                                        <p>Chalet Name: <span class="item">{{ $chalet->name}}</span> </p>
                                        <p>Chalet Price: <span class="item">{{ $chalet->price}}</span> </p>
                                        <p>Chalet Address: <span class="item">{{ $chalet->address}}</span> </p>
                                       
                                       
                                        
                                        <p class="text-content">Chalet Description: <span class="item">{{ $chalet->description}}</span></p>
                                      
                                        
                                        <!--Quantity start-->
                                       
                                        <!--Quanatity End-->


                                        <div class="shopping-cart mt-3">
                                            <a class="btn btn-primary btn-lg" href="javascript:void(0)">
                                                Chalet Reservation</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         
            <!-- review -->
            <div class="modal fade" id="reviewModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Review</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="text-center mb-4">
                                    <img class="img-fluid rounded" width="78" src="./images/avatar/1.jpg" alt="DexignZone">
                                </div>
                                <div class="form-group">
                                    <div class="rating-widget mb-4 text-center">
                                        <!-- Rating Stars Box -->
                                        <div class="rating-stars">
                                            <ul id="stars">
                                                <li class="star" title="Poor" data-value="1">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                                <li class="star" title="Fair" data-value="2">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                                <li class="star" title="Good" data-value="3">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                                <li class="star" title="Excellent" data-value="4">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                                <li class="star" title="WOW!!!" data-value="5">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Comment" rows="5"></textarea>
                                </div>
                                <button class="btn btn-success btn-block">RATE</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection   
