@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('setting.update',$setting->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">
                    
                        <div class="form-group col-md-4">
                            <label for="appname">Nama Aplikasi</label>
                            <input type="text" class="form-control @error('appname') is-invalid @enderror" id="appname" name="appname"
                                value="{{  old('appname', $setting->appname) }}" placeholder="Nama Aplikasi">
                            @error('appname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Telp</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                value="{{  old('phone', $setting->phone) }}" placeholder="Telp">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="site">Website Aplikasi</label>
                            <input type="text" class="form-control @error('site') is-invalid @enderror" id="site" name="site"
                                value="{{  old('site', $setting->site) }}" placeholder="Website">
                            @error('site')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                    
                        <div class="form-group col-md-4">
                            <label for="address">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $setting->address) }}</textarea>
                            
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>


                </form>
            </div>
        </div>
    </div>

</div>

@endsection