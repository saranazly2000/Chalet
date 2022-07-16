

        @extends('layouts.temp')
@section('content')
                        <div class="content-body">
                            <div class="container-fluid">
                                <div class="page-titles">
                                    <h4>Chalets</h4>
                                </div>
                               
                                <div class="row">
                                    @foreach ($chalets as $chalet)
                                    <div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
                                      
                                        <div class="card" >  
                                          
                                            <div class="card-body">
                                               
                                                <div class="new-arrival-product">
                                                   
                                                    <div class="new-arrivals-img-contnent">
                                                       
                                                        <img class="img-fluid" src="{{$chalet->cover_image}}" alt="" >
                                                     
                                                    </div>
                                                    <div class="new-arrival-content text-center mt-3">
                                                        <h4><a href="{{URL('chaletdetails/' . $chalet->id )}}">{{ $chalet->name}}</a></h4>
                                                        <td>  @php
                                                        $val = 0;
                                                        $count = 0;
                                                        @endphp
                                                        @if(!empty($chalet->rates))
                                                            @php $rates =$chalet->rates; @endphp
                                                        @foreach ($rates as $rate)
                                                        @php
                                                        $val+=$rate->chalet_rate;
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
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            
                                        </div>
                                       
                                    </div> 
                                    @endforeach    
                                </div>
                               
                               
                            </div>
                        </div>
                    
                     


                       
                        @endsection   
