@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
                <hr>
                <a class="btn btn-sm btn-success float-right" href="{{ route('transaction.create') }}">Scan QR Transaksi</a>
                @if(request('date1') && request('date2'))
                    <a class="btn btn-sm btn-primary float-right" href="{{ route('transaction.cetak', ['startdate' => request('date1'), 'enddate' => request('date2')]) }}" target="_blank">Cetak Transaksi</a>
                @endif
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                    <div class="mb-2 mr-sm-2">
                        <input type="date" class="form-control" name="date1" value="{{ request('date1') }}" required>
                    </div>
                   
                    <div class="mb-2 mr-sm-2">
                        <input type="date" class="form-control" name="date2" value="{{ request('date2') }}" required>
                    </div>
                   
                    <div class="mb-2">
                        <button type="submit" class="ml-2 btn btn-primary btn-sm">Filter</button>
                        
                    </div>
                
                
                </form>
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    ID QR
                                </th>
                                
                                <th>
                                    Subtotal
                                </th>
                                <th>
                                    Pajak
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Nomor Meja
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Dibuat
                                </th>

                                <th class="text-center">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $transaction->id }}
                                </td>
                                
                                <td>
                                    {{ number_format($transaction->subtotal) }}
                                </td>
                                <td>
                                    {{ number_format($transaction->tax) }}
                                </td>
                                <td>
                                    {{ number_format($transaction->total) }}
                                </td>
                                <td>
                                    {{ $transaction->table_number }}
                                </td>
                                <td>
                                    {{ $transaction->status }}
                                </td>
                                
                                <td>
                                    {{ $transaction->created_at }}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">

                                      <a href="{{ route('transaction.edit',$transaction->id) }}"
                                            class="btn btn-sm btn-primary m-1">Ubah</a>
                                      <a target="_blank" href="{{ route('transaction.struk',$transaction->id) }}"
                                            class="btn btn-sm btn-successs m-1">Struk</a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection