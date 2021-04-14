@extends('layouts.app')
@section('title','Ticket')
@section('page_title','Ticket')

@section('button')
    <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('ticket.create') }}">
        <i class="fa fa-plus"></i> Add Ticket
    </a>
@endsection

@section('content')
@include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Filter</h3>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Subject </label>           
                            <select class="form-control select2-subject" data-placeholder="Search Subject" data-url="{{ route('get.subject') }}" name="subject" id="subject"></select>
                        </div> 
                        <div class="col-md-3 form-group">
                            <label>Priority </label>           
                            <select class="form-control select2" data-placeholder="Search Priority" data-url="{{ route('get.prority') }}" name="priority" id="priority"></select>
                        </div>   
                        <div class="col-md-3 form-group">
                            <label>Status </label>           
                            <select class="form-control select2" data-placeholder="Search Satus" data-url="{{ route('get.status') }}" name="status" id="status"></select>
                        </div>  
                        <div class="col-md-3 form-group">
                            <label>Assign User </label>           
                            <select class="form-control select2" data-placeholder="Search User" data-url="{{ route('get.user') }}" name="user" id="user"></select>
                        </div>     
                        <div class="col-md-3 mt-4 form-group margin_custome">
                            <button class="btn btn-danger " type="button" id="btn_clear" name="btn_clear" >Clear</button>
                            <button type="submit" id="search" class="btn btn-success "><i class="fa fa-search"></i>&nbsp;Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="heading-layout1 p-2">
                        <div class="item-title">
                            <h3>All Ticket</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                            <table id="ticketTable" data-url="{{ route('ticket.list') }}" class="table table-hover w-100 display nowrap ">
                                <tr>
                                    <thead class="gray-light">
                                        <th width="15">id</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>User</th>
                                        <th width="5%" data-orderable="false" class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>
<div id="load-modal"></div>
@endsection


@section('script')
<script src="{{asset('assets/admin/js/datatables/tickets-datatable.js')}}" type="text/javascript"></script>
@endsection