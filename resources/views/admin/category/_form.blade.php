<div class="form-row">

    <div class="form-group col-md-6">
        <label for="name">Nama Kategori</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{  old('name', $category->name) }}" placeholder="Nama Kategori">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $button_name }}</button>