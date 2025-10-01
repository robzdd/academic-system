<form method="POST" action="{{ route('login.mahasiswa.post') }}">
    @csrf
    <h2>Login Mahasiswa</h2>

    <!-- Email -->
    <div>
        <input 
            type="email" 
            name="email" 
            placeholder="Email" 
            value="{{ old('email') }}" 
            required
            autofocus
        >
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            required
        >
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit -->
    <div>
        <button type="submit">Login</button>
    </div>

    <!-- General error (misal email/password salah) -->
    @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
        <div style="color: red;">{{ $errors->first() }}</div>
    @endif
</form>
