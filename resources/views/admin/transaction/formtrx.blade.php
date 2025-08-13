<form autocomplete="off" action="{{ route('transaction.update',$transaction->id) }}" method="POST">
    @csrf
    @method('put')

    <table class="table">
        <thead class=" text-primary">
            <tr>
                <th>
                    No
                </th>
                <th>
                    Pesanan
                </th>
                <th>
                    Harga
                </th>
                <th>
                    Jumlah
                </th>
                <th>
                    Subtotal
                </th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->trxdetail as $item)
    
    
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $item->product_name }}
                </td>
                <td>
                    {{ number_format($item->product_price) }}
                </td>
                <td>
                    {{ $item->product_qty }}
                </td>
                <td>
                    {{ number_format($item->product_subtotal) }}
                </td>
                
            </tr>
            @endforeach
    
        </tbody>
    </table>
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="total">Total</label>
        <input type="text" class="form-control" value="{{ $transaction->total }}" readonly>

    </div>
    <div class="form-group col-md-6">
        <label for="total">SubTotal</label>
        <input type="text" class="form-control" value="{{ $transaction->subtotal }}" readonly>

    </div>
    <div class="form-group col-md-6">
        <label for="total">Ppn</label>
        <input type="text" class="form-control" value="{{ $transaction->tax }}" readonly>

    </div>
    <div class="form-group col-md-6">
        <label for="table_number">Nomor Meja</label>
        <input type="number" min="1" name="table_number" class="form-control" value="{{ $transaction->table_number }}" required>

    </div>
    <div class="form-group col-md-6">
        <label for="status">Status Pesanan</label>
        <select class="form-control" id="status" name="status" required>
            <option value="">Pilih Status</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
           
        </select>

    </div>
    

</div>

<button type="submit" class="btn btn-primary">Proses Pesanan</button>
</form>

