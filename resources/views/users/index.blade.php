@extends('layouts.app')


@section('content')
    {{-- card --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Users</h3>
                </div>
                @can('user-create')
                    <div class="col-md-6">
                        <div class="float-right">
                            @if (get_title('is_ad_login'))
                                <a href="{{ route('ad.sync') }}" class="btn btn-info pr-4">AD User Sync</a>
                            @endif
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>

                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                @if ($user->id != 1 && $user->id != 2)
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>


        </div>
    </div>
    <!-- /.card-body -->

    {!! $users->render() !!}
@endsection
