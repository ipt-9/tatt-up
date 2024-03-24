
@extends('layouts.app')

@section('content')
    <div>
        <h1>Create New User</h1>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="tattooer">Tattooer</option>
                <option value="designer">Designer</option>
            </select><br><br>

            <button type="submit">Create User</button>
        </form>
    </div>
@endsection
