@extends('admin.layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>User Type</th>
                        <th>Subscribed</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->active ? 'Active' : 'Not Active' }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>{{ $user->subscribed('subscription') ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-info btn-sm">Edit</a>
                                {{--<form action="{{ route('admin.user.delete', $user) }}" method="post">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<button type="submit">Delete</button>--}}
                                {{--</form>--}}
                                <a href="#" class="btn btn-danger btn-sm delete-user" data-toggle="modal"
                                   data-userid="{{ $user->id }}"
                                   data-target="#deleteModal">
                                    <i class="fa fa-trash fa-fw fa-sm"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure you want to delete this user ? This cannot be undone</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <form method="post" action="" id="delete-from">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.delete-user').on('click', function () {
            var action = '{{ route('admin.user.delete', ':id') }}'.replace(':id', $(this).data('userid'));
            $('#delete-from').attr('action', action);
        })
    </script>
@endsection