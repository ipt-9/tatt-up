<form method="POST" action="/register">
    @csrf
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="tattooer">Tattooer</option>
            <option value="designer">Designer</option>
        </select>
    </div>
    <button type="submit">Register</button>
</form>
