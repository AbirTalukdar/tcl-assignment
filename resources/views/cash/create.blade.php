@extends('layouts.main')
@section('title'){{ 'Cash Create' }}@endsection
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
                        <h3>Cash Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('cash.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="clientId">Select Client</label>
                                            <select class="form-control" id="clientId" name="clientId" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('clientId') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectId">Select Project</label>
                                            <select class="form-control" id="projectId" name="projectId" required>
                                                <option value="">Select Project</option>
                                                <!-- Project options will be dynamically loaded here -->
                                            </select>
                                            <span class="text-danger"><b>{{ $errors->first('projectId') }}</b></span>
                                        </div>
                                        <div id="cash-fields-container">
                                            <!-- Project dropdown and associated fields will be dynamically added here -->
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('cash.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mb-3">
                                <button id="addProjectBtn" class="btn btn-success">Add Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer.js')
<script>
    $(document).ready(function () {
        // Function to load projects based on the selected client
        $('#clientId').change(function () {
            var clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: "{{ route('projects.by_client') }}",
                    type: "GET",
                    data: {
                        clientId: clientId
                    },
                    success: function (response) {
                        var select = $('#projectId');
                        select.empty();
                        select.append('<option value="">Select Project</option>');
                        $.each(response, function (index, project) {
                            select.append('<option value="' + project.id + '">' + project.name + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#projectId').empty();
            }
        });

        // Function to dynamically add cash amount and date fields for each selected project
        $('#projectId').change(function () {
            var projectId = $(this).val();
            if (projectId) {
                var cashFields = '<div class="mb-3">';
                cashFields += '<label for="cashAmount_' + projectId + '">Cash Amount</label>';
                cashFields += '<input class="form-control" id="cashAmount_' + projectId + '" name="cashAmount[]" type="text" placeholder="Enter Cash Amount">';
                cashFields += '<label for="cashDate_' + projectId + '">Date</label>';
                cashFields += '<input class="form-control" id="cashDate_' + projectId + '" name="cashDate[]" type="date">';
                cashFields += '<button class="btn btn-danger btn-sm delete-btn" type="button">Delete</button>'; // Add a delete button
                cashFields += '</div>';
                $('#cash-fields-container').append(cashFields); // Append the cash fields to the container
            }
        });

        // Function to delete dynamically added cash amount and date fields
        $(document).on('click', '.delete-btn', function () {
            $(this).parent().remove(); // Remove the parent div containing the fields
        });

        // Function to add another project dropdown and associated fields
        $('#addProjectBtn').click(function () {
            var projectDropdown = '<div class="mb-3">';
            projectDropdown += '<label for="projectId">Select Project</label>';
            projectDropdown += '<select class="form-control project-dropdown" name="projectId" required>';
            projectDropdown += '<option value="">Select Project</option>';
            projectDropdown += '</select>';
            projectDropdown += '</div>';

            var cashFields = '<div class="mb-3">';
            cashFields += '<label for="cashAmount_new">Cash Amount</label>';
            cashFields += '<input class="form-control" id="cashAmount_new" name="cashAmount[]" type="text" placeholder="Enter Cash Amount">';
            cashFields += '<label for="cashDate_new">Date</label>';
            cashFields += '<input class="form-control" id="cashDate_new" name="cashDate[]" type="date">';
            cashFields += '<button class="btn btn-danger btn-sm delete-btn" type="button">Delete</button>'; // Add a delete button
            cashFields += '</div>';

            $('#cash-fields-container').append(projectDropdown + cashFields); // Append the project dropdown and cash fields to the container

            // Populate project dropdown options
            var clientId = $('#clientId').val();
            var projectDropdown = $('.project-dropdown').last();
            loadProjects(clientId, projectDropdown);
        });

        // Function to load projects based on the selected client
        function loadProjects(clientId, dropdown) {
            if (clientId) {
                $.ajax({
                    url: "{{ route('projects.by_client') }}",
                    type: "GET",
                    data: {
                        clientId: clientId
                    },
                    success: function (response) {
                        dropdown.empty();
                        dropdown.append('<option value="">Select Project</option>');
                        $.each(response, function (index, project) {
                            dropdown.append('<option value="' + project.id + '">' + project.name + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                dropdown.empty();
                dropdown.append('<option value="">Select Project</option>');
            }
        }
    });
</script>
@endsection
