<!DOCTYPE html>
<html>
<head>
    <title>TCL ASSIGNMENT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <div>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Home
    </a>
    </div>
     <br/>
    <table class="table table-bordered data-table">
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
</body>
   
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
    
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.data-table').on('click', '.invest-btn', function() {
            var projectId = $(this).data('project-id');
            $('#investModal').modal('show');
            $('#project_id').val(projectId);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
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
</html>