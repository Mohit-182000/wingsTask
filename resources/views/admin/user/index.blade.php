@extends('layouts.app')
@section('title','User')
@section('page_title','User')

@section('button')
    <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('user.create') }}">
        <i class="fa fa-plus"></i> Add Product
    </a>
@endsection

@section('content')
@include('component.error')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="heading-layout1 p-2">
                        <div class="item-title">
                            <h3>All User</h3>
                        </div>
                    </div>

                    <div class="table">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                            <table id="userTable" data-url="{{ route('user.list') }}" class="table table-hover w-100 display nowrap ">
                                <tr>
                                    <thead class="gray-light">
                                        <th width="15">id</th>
                                        <th>Name</th>
                                        <th>Email</th>
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
<script src="{{asset('assets/admin/js/datatables/user-datatable.js')}}" type="text/javascript"></script>
@endsection