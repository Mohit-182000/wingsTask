@extends('layouts.app')

@section('title','User')

@section('page_title','User')

@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('user.index') }}"><i class="fa fa-arrow-left"></i> Back</a>

@endsection

@section('content')
 @include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" id="userForm" name="userForm">
                        @csrf

                            <div class="form-row">
                                <div class="col-md-12  pr-3">
                                    <div class="form-group">
                                        <label for="title">Name  <span class="text-danger">*</span> </label>
                                        <input type="text" name="name" maxLength="50" value="" data-rule-required="true" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Email  <span class="text-danger">*</span> </label>
                                        <input type="text" name="email" maxLength="50" value="" data-rule-required="true" class="form-control">
                                    </div>  
                                    
                                    <div class="form-group">
                                        <label for="title">Password  <span class="text-danger">*</span> </label>
                                        <input type="password" name="password" id="password" value="" data-rule-required="true" class="form-control">
                                    </div>  

                                    <div class="form-group">
                                        <label for="title">Confirm Password <span class="text-danger">*</span> </label>
                                        <input type="password" name="cpwd" data-rule-equalTo="#password" value="" data-rule-required="true" class="form-control">
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="float-right">      
                                <button type="submit" data-dismiss="modal" class="btn btn-sm btn-default">Cancle</button>
                                <button type="submit" class="btn btn-save-update btn-sm btn-success">Save</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/admin/js/validation/user-validation.js') }}"></script>
@endsection