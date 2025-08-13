<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            background-color: #e8f4f8;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Transaksi</h2>

    @if (isset($startdate) && isset($enddate))
        <p style="text-align: center;">Periode: {{ $startdate }} sampai {{ $enddate }}</p>
    @endif
    <table>
        <thead>
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
                {{-- <th>
                    Status
                </th> --}}
                <th>
                    Dibuat
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
                    {{-- <td>
                        {{ ucfirst($transaction->status) }}
                    </td> --}}
                    <td>
                        {{ $transaction->created_at->format('Y-m-d H:i:s') }}
                    </td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4">
                    <strong>Grand Total</strong>
                </td>
                {{-- <td>
                    <strong>{{ number_format($transactions->sum('total')) }}</strong>
                </td> --}}
                <td colspan="3">
                    <strong>{{ number_format($transactions->sum('total')) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
