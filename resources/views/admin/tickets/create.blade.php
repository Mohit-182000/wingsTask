@extends('layouts.app')

@section('title','Tickets')

@section('page_title','Tickets')

@section('button')

    <a class="btn btn-default btn-sm float-right mr-2" href="{{ route('ticket.index') }}"><i class="fa fa-arrow-left"></i> Back</a>

@endsection

@section('content')
 @include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ticket.store') }}" method="post" id="userForm" name="userForm">
                        @csrf

                            <div class="form-row">
                                <div class="col-md-12  pr-3">
                                    <div class="form-group">
                                        <label for="title">Subject  <span class="text-danger">*</span> </label>
                                        <input type="text" name="subject" maxLength="50" value="" data-rule-required="true" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6  pr-3">
                                    <div class="form-group">
                                        <label for="title">Prority  <span class="text-danger">*</span> </label>
                                         <select name="priority_id" data-url="{{ route('get.prority') }}" data-placeholder="Search Priority" data-rule-required="true" class="select form-control"></select>
                                    </div>
                                </div>

                                <div class="col-md-6  pr-3">
                                    <div class="form-group">
                                        <label for="title">Status  <span class="text-danger">*</span> </label>
                                         <select name="status_id" data-url="{{ route('get.status') }}" data-placeholder="Search Status" data-rule-required="true" class="select form-control"></select>
                                    </div>
                                </div>

                                <div class="col-md-6  pr-3">
                                    <div class="form-group">
                                        <label for="title">User  <span class="text-danger">*</span> </label>
                                         <select name="user_id" data-url="{{ route('get.user') }}" data-placeholder="Search User" data-rule-required="true" class="select form-control"></select>
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
<script src="{{ asset('assets/admin/js/validation/tickets-validation.js') }}"></script>
@endsection