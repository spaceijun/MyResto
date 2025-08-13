<div class="form-row">

    <div class="form-group col-md-6">
        <label for="username">Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
            value="{{  old('username', $user->username) }}" placeholder="Username" required>
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="name">Nama Pengguna</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{  old('name', $user->name) }}" placeholder="Nama Pengguna" required>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password" value="{{  old('password') }}" placeholder="password" required>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $button_name }}</button>