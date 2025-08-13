<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        extract(request()->query());
        $transactions = Transaction::whereIn('status', ['proses', 'selesai'])->latest()->take(25)->get();
        if ((@$date1 && @$date2) ?? false) {
            $transactions = $transactions->whereBetween('created_at', ["$date1 00:00:01", "$date2 23:59:59"]);
        }

        return view('admin/transaction/index', [
            'title' => 'Transaksi',
            'active' => 'transaction',
            'page' => 'Transaksi',
            'transactions' => $transactions,

        ]);
    }
    public function create()
    {
        return view('admin/transaction/create', [
            'title' => 'Buat Transaksi',
            'active' => 'transaction',
            'page' => 'Buat Transaksi',

        ]);
    }
    public function getTransByQR(Transaction $transaction)
    {

        return view('admin/transaction/formtrx', compact('transaction'));
    }
    public function struk(Transaction $transaction)
    {
        $setting = setdata();
        return view('admin/transaction/struk', compact('transaction', 'setting'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // dd($transaction);
        // dd($request);
        $transaction->update($request->only(['status', 'table_number']));
        return redirect('transaction')->with('success', 'Berhasil memproses transaksi');
    }
    public function edit(Transaction $transaction)
    {
        return view('admin/transaction/edit', [
            'title' => 'Buat Transaksi',
            'active' => 'transaction',
            'page' => 'Buat Transaksi',
            'transaction' => $transaction,

        ]);
    }

    public function store(Request $request)
    {   
        $cartItems = \Cart::getContent();
        $pemesan = $request->input('pemesan'); // Mengambil nilai "pemesan"
        $nohp = $request->input('nohp');       // Mengambil nilai "nohp"

       // dd($pemesan, $nohp);
        if (\Cart::isEmpty()) {
            session()->flash('success', 'Silahkan pesan kembali..');

            return redirect()->route('product.productList');
        }
        $subtotal = \Cart::getTotal();
        $ppn = ($subtotal * 10 / 100);
        $total = $ppn + $subtotal;
        $trx = Transaction::create([
            'total' => $total,
            'subtotal' => $subtotal,
            'tax' => $ppn,
            'status' => 'dipesan',
            'pemesan' => $pemesan,
            'no_hp' => $nohp,
        ]);
        $trxId = $trx->id;


        $trxDetail = [];
        foreach ($cartItems as $item) {
            $trxDetail[] = [
                'transaction_id' => $trxId,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'product_price' => $item->price,
                'product_qty' => $item->quantity,
                'product_subtotal' => $item->getPriceSum(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        TransactionDetail::insert($trxDetail);
        \Cart::clear();
        $transaction = Transaction::find($trxId);
        return view('front.checkout', compact('transaction'));
    }
    public function tesQR()
    {
        return QrCode::generate('Make me into a QrCode!');
    }

    public function cetakTransaction($startdate, $enddate)
    {   
        // Debugging: Menampilkan parameter
        //dd($startdate, $enddate);
   
        $transactions = Transaction::whereIn('status', ['proses', 'selesai'])->latest()->take(25)->get();

        // Filter berdasarkan tanggal jika tersedia
        if ((@$startdate && @$enddate) ?? false) {
            $transactions = $transactions->whereBetween('created_at', ["$startdate 00:00:01", "$enddate 23:59:59"]);
        }

        // Kirim data ke view untuk PDF
        $pdf = Pdf::loadView('admin.transaction.cetak-transaksi', [
            'transactions' => $transactions, 'startdate' => $startdate, 'enddate' => $enddate
        ]);

        // Unduh PDF
        return $pdf->download('transactions_'.$startdate.'_'.$enddate.'.pdf');
    }
}
