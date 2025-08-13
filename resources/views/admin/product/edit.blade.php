@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data" id="fromProduct">
                    @csrf
                    @method('put')
                    @include('admin.product._form')


                </form>
            </div>
        </div>
    </div>

</div>

@endsection
