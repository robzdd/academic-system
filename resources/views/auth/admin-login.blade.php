<form method="POST" action="{{ route('login.admin.post') }}">
  @csrf
  <h2>Login Admin BAAK</h2>
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
</form>
