@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
            </div>
            <div class="card-body">
               <form autocomplete="off" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    @include('admin.category._form')
                
                
                </form>
            </div>
        </div>
    </div>

</div>

@endsection