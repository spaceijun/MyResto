@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
            </div>
            <div class="card-body">
                <div style="width: 500px" id="reader"></div>
                <div id="tampung"></div>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
        
        function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        $.get(`/transaction/${decodedText}`,function(data){
            $('#tampung').html(data)
        })
        // ...
        html5QrcodeScanner.clear();
        // ^ this will stop the scanner (video feed) and clear the scan area.
        }
        
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush