@extends('admin.layouts.app')
@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div class="custom-control custom-switch">
            <input type="checkbox" name="status" id="status" class="custom-control-input" {{ $user->active ? 'checked' : '' }}>
            <label for="status" id="check-label" class="custom-control-label">{{ $user->active ? 'Active' : 'Not Active' }}</label>
        </div>
        <div class="form-group">
            <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type" class="form-control">
                <option value="customer" {{ $user->user_type == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info">Save</button>

    </form>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#status').on('change', function () {
                if ($(this).is(':checked')){
                    $('#check-label').text('Active')
                }else {
                    $('#check-label').text('Not Active')
                }
            })
        })
    </script>
@endsection