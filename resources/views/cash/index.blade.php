@extends('layouts.main')
@section('title'){{ 'Cash' }}@endsection
@section('header.css')
    <style>

    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Cash</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <!-- <li class="breadcrumb-item">Settings</li> -->
                            <li class="breadcrumb-item active">Cash</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <a href="{{ route('cash.create') }}" class="btn btn-md btn-info " ><i class="fa fa-plus"></i>Create New</a>
                            </div>
                            <div class="table-responsive">
                                <table id="cashTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('footer.js')
    <script>
        $(document).ready(function () {
            $('#cashTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('cash.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Project Name', data: 'project_name', name: 'project_name', className: "text-center", orderable: true, searchable: true},
                    {title: 'Client Name', data: 'client_name', name: 'client_name', className: "text-center", orderable: true, searchable: true},
                    {title: 'Invest Amount', data: 'amount', name: 'amount', className: "text-center", orderable: true, searchable: true},
                    {title: 'Invest Date', data: 'invest_date', name: 'invest_date', className: "text-center", orderable: true, searchable: true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id  + '" onclick="editCash(this)"><i class="fa fa-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteCash(this)"><i class="fa fa-trash"></i></a>';
                        }, orderable: false, searchable: false
                    }
                ]
            });
        });

        function editCash(x) {
            let btn = $(x).data('panel-id');
            let url = '{{route("cash.edit", ":id") }}';
            window.location.href = url.replace(':id', btn);
        }

        function deleteCash(x) {
            let id = $(x).data('panel-id');
            if(!confirm("Delete This Assigned Project?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: "{!! route('cash.delete') !!}",
                cache: false,
                data: {_token: "{{csrf_token()}}",'id': id},
                success: function (data) {
                    toastr.success('Assigned Project Deleted Successfully!');
                    $('#cashTable').DataTable().clear().draw();
                },
            });
        }
    </script>
@endsection
