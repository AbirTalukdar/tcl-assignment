@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Button for registering an investor -->
            <a href="{{ route('investors.register') }}" class="btn btn-primary mt-3">
                Register Investor
            </a>
            </div>
        </div>
        <table id="users-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('home') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
            ]
        });
    });
</script>
@endsection
