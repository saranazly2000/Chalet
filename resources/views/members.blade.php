@extends('layouts.temp')
@section('content')

<div class="content-body">
  <div class="container-fluid">
     
      <!-- row -->

      <div class="row">
<div class="col-lg-12">
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">Members Info</h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-responsive-md">
                  <thead>
                      <tr>
                          
                          <th><strong>Member Phone</strong></th>
                          <th><strong>Member Type</strong></th>
                          <th><strong> Name</strong></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($members as $member)
                          <td>{{$member->phone}}</td>
                          @if($member->type == 1)
                          <td>{{"owner"}}</td>
                          @endif
                          @if($member->type == 2)
                          <td>{{"user"}}</td>
                          @endif
                          <td>{{$member->name}}</td>
                          <td>
                            <div class="d-flex">
                                <a href="{{ URL('member/edit/' . $member->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                         
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <form method="POST" action="{{ URL('member/delete/' . $member->id) }}">
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