@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>User Profile</h4>
        <span class="badge bg-{{ match($user->role) {
            'admin' => 'danger',
            'staff' => 'warning',
            default => 'primary',
        } }}">
            {{ ucfirst($user->role) }}
        </span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" 
                         class="rounded-circle" width="150" height="150">
                </div>
                @if($user->id === auth()->id())
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i> Edit Profile
                    </a>
                @endif
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Registered</th>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Last Login</th>
                        <td>{{ $user->last_login_at?->diffForHumans() ?? 'Never' }}</td>
                    </tr>
                    <tr>
                        <th>Account Status</th>
                        <td>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-warning">Unverified</span>
                            @endif
                        </td>
                    </tr>
                    @can('viewAdminSection', $user)
                    <tr>
                        <th>System Role</th>
                        <td>
                            <form action="{{ route('users.update-role', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select form-select-sm d-inline w-auto" 
                                        onchange="this.form.submit()" 
                                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endcan
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Users
                    </a>
                    
                    @if(auth()->user()->can('delete', $user))
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Permanently delete this user?')">
                            <i class="bi bi-trash"></i> Delete Account
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection