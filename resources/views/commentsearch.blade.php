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
                                    <th><strong>Comment Content</strong></th>
                                    <th><strong>Chalet Name</strong></th>
                                    <th><strong>Owner Phone</strong></th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                        @foreach ($details as $chalet )
                        @foreach($chalet->comments as $chaletcomments )
                        <td>@if(!empty($chaletcomments)){{$chaletcomments->comment_content}}@endif</td>
                        <td> @if(!empty($chalet)){{$chalet->name}} {{$chalet->address}} @endif</td>
                        <td> @if(!empty($chalet->member)){{$chalet->member->name}} {{$chalet->member->phone}} @endif</td>
                        <td>
                          <div class="d-flex">
                            @if(!empty($chaletcomments))
                              <a href="{{ URL('comment/edit/' . $chaletcomments->id ) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                              @endif
                          </div>
                      </td>
                      <td>
                          <div class="d-flex">
                            @if(!empty($chaletcomments))
                              <form method="POST" action="{{ URL('comment/delete/' . $chaletcomments->id) }}">
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