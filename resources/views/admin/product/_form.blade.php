<div class="form-row">

    <div class="form-group col-md-6">
        <label for="name">Nama Produk</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{  old('name', $product->name) }}" placeholder="Nama Produk">
        
        <div class="invalid-feedback" id="name_error"></div>
    </div>
    <div class="form-group col-md-6">
        <label for="category_id">Kategori</label>
        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $c)
            <option value="{{ $c->id }}" @if ($product->category_id==$c->id) selected @endif>{{ $c->name }}</option>
                
            @endforeach
        </select>
        
        <div class="invalid-feedback" id="category_id_error"></div>
    </div>
    <div class="form-group col-md-6">
        <label for="price">Harga</label>
        <input type="number" min="1" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
            value="{{  old('price', $product->price) }}" placeholder="Harga Produk">
       <div class="invalid-feedback" id="price_error"></div>
    </div>
    
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description"
            placeholder="Deskripsi Produk">{{ old('description', $product->description) }}</textarea>
        <div class="invalid-feedback" id="description_error"></div>
    </div>
    <div class="form-group col-md-6">
        <label for="file">Gambar</label>
        <input type="file" name="file" id="file" class="filepond">
        <div class="invalid-feedback" id="file_error"></div>
    
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $button_name }}</button>
@push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        $(document).ready(function () {
                pond = FilePond.create(
                    document.querySelector('#file'), {
                        allowMultiple: false, //true if multiple
                        instantUpload: false,
                        allowImagePreview: true,
                        allowProcess: false
                    });
            
                $("#fromProduct").submit(function (e) {
                    e.preventDefault();
                    var fd = new FormData(this);
                    // append files array into the form data
                    pondFiles = pond.getFiles();
                    for (var i = 0; i < pondFiles.length; i++) {
                        fd.append('file', pondFiles[i].file);
                    }
            
                    $.ajax({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: fd,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                //    todo the logic
                                if(data.status=='success'){
                                    mynotif(data.msg);
                                    setTimeout(function() { 
                                      window.location.href="{{ route('product.index') }}";
                                    }, 3000);
                                }
                                // remove the files from filepond, etc
                            },
                            error: function(response,exception) {
                                $('.is-invalid').removeClass('is-invalid');
                                $('.invalid-feedback').text('');
                                        $.each(response.responseJSON, function(key, val) {
                                            $(`#${key}`).addClass('is-invalid');
                                            $(`#${key}_error`).text(val);
                                        });
                                    },
                        }
                    );
                });
            })
    </script>
@endpush