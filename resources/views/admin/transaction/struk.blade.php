{{-- @dump($transaction) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt {{ $setting->appname }}</title>
    <style>
        * {
        font-size: 12px;
        font-family: 'Times New Roman';
        }
        
        td,
        th,
        tr,
        table {
        border-top: 1px solid black;
        border-collapse: collapse;
        }
        
        td.description,
        th.description {
        width: 75px;
        max-width: 75px;
        }
        
        td.quantity,
        th.quantity {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
        }
        
        td.price,
        th.price {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
        }
        
        .centered {
        text-align: center;
        align-content: center;
        }
        
        .ticket {
        width: 155px;
        max-width: 155px;
        }
        
        img {
        max-width: inherit;
        width: inherit;
        }
        
        @media print {
        .hidden-print,
        .hidden-print * {
        display: none !important;
        }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="./logo.png" alt="Logo" style="display: none;">
        <p class="centered">{{ $setting->appname }}
            <br>{{ $setting->address }}
        </p>
        <table>
            <thead>
                <tr>
                    <th class="quantity">Q.</th>
                    <th class="description">Description</th>
                    <th class="price">Rp.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->trxdetail as $item)
                    
                
                <tr>
                    <td class="quantity">{{ $item->product_qty }}</td>
                    <td class="description">{{ $item->product_name }}</td>
                    <td class="price">{{ number_format($item->product_price) }}</td>
                </tr>
                @endforeach
                
                <tr>
                    <td class="quantity"></td>
                    <td class="description">SUBTOTAL</td>
                    <td class="price">{{ number_format($transaction->subtotal) }}</td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">PPN</td>
                    <td class="price">{{ number_format($transaction->tax) }}</td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TOTAL</td>
                    <td class="price">{{ number_format($transaction->total) }}</td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Terimakasih telah menjadi pelanggan setia kami
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
        window.print();
        });
    </script>
</body>

</html>