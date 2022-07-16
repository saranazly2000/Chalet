




@extends('layouts.temp')
@section('content')

<div class="content-body">

    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <form action="commentsearch" method="get" role="search">
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
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Comments Chalet Info</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                          <th><strong>Comment Content</strong></th>
                          <th><strong>Chalet Name</strong></th>
                          <th><strong>Owner Phone</strong></th>
                          
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($comments as $comment)
                          <td>{{$comment->comment_content}}</td>
                          <td>{{$comment->chalet->name}}</td>
                          <td>{{$comment->member->phone}}</td>
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('comment/edit/' . $comment->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('comment/delete/' . $comment->id) }}">
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