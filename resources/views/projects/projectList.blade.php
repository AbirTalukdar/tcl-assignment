@extends('layouts.app')

@section('content')  

    <div class="col-lg-10 grid-margin stretch-card mt-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ALL PROJECT</h4>
            </div>
            <table class="table table-striped data-table ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
     </div>

<div class="modal fade" id="investModal" tabindex="-1" role="dialog" aria-labelledby="investModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investModalLabel">Invest in Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="investmentForm">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Investment Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                        <input type="hidden" id="project_id" name="project_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Invest</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('projects.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    $('.data-table').on('click', '.invest-btn', function() {
        var projectId = $(this).data('project-id');
        $('#investModal').modal('show');
        $('#project_id').val(projectId);
    });
    
    $('#investmentForm').submit(function(e) {
        e.preventDefault();
        var projectId = $('#project_id').val();
        var amount = $('#amount').val();
        $.ajax({
            type: 'POST',
            url: "{{ route('investments.store') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'project_id': projectId,
                'amount': amount
            },
            success: function(response) {
                alert('Investment added successfully.');
                $('#investModal').modal('hide');
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('Error - ' + errorMessage);
            }
        });
    });
  });
</script>

@endsection
