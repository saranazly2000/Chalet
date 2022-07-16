@extends('layouts.temp')
@section('content')
<div class="content-body">
    <div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Chalet Comment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL('comment/update/' . $comment->id) }}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style=" position: absolute;
                                        top: 210px;
                                        left: 350px;
                                                ">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="commentcontent"
                                class="col-md-4 col-form-label text-md-right">{{ __('Edit Comment') }}</label>

                            <div class="col-md-6">
                                <input id="commentcontent" type="text" class="form-control" name="commentcontent"
                                    value="{{ $comment->comment_content }}" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection