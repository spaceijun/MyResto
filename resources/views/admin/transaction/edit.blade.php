@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
            </div>
            <div class="card-body">
                <div id="tampung"></div>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script>
   $.get(`/transaction/{{ $transaction->id }}`,function(data){
$('#tampung').html(data)
})
</script>
@endpush