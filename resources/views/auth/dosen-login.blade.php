<form method="POST" action="{{ route('login.dosen.post') }}">
  @csrf
  <h2>Login Dosen</h2>
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
</form>
