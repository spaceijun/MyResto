<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $typeData = Category::get(['id', 'name']);
        // return $typeData;
        $dataAll = [];

        foreach ($typeData as $dt) {
            $catid = $dt->id;
            $catname = $dt->name;
            // ambil bulannya
            $months = Transaction::join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->join('products', 'products.id', '=', 'transaction_details.product_id')
                ->select(DB::raw("Month(transactions.created_at) as month"))
                ->whereYear('transactions.created_at', date('Y'))->where(['products.category_id' => $catid])->whereIn('status', ['selesai', 'proses'])
                ->groupBy(DB::raw("Month(transactions.created_at)"))
                ->pluck('month');
            // ambil trxnya
            $trx = Transaction::join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                ->join('products', 'products.id', '=', 'transaction_details.product_id')
                ->select(DB::raw('count(transactions.id) as count'))
                ->whereYear('transactions.created_at', date('Y'))->where(['products.category_id' => $catid])->whereIn('status', ['selesai', 'proses'])
                ->groupBy(DB::raw("Month(transactions.created_at)"))
                ->pluck('count');

            $datas = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            foreach ($months as $index => $month) {
                $datas[$month - 1] = (int)$trx[$index];
            }
            $dataAll[] = ['name' => $catname, 'data' => $datas];
        }
        // return $dataAll;
        return view('admin/dashboard/index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'page' => 'Dashboard',
            'breadcrumbs' => collect(['Dashboard']),
            'total_product' => Product::all()->count(),
            'total_category' => Category::all()->count(),
            'total_user' => User::all()->count(),
            'total_trx' => Transaction::whereIn('status', ['proses', 'selesai'])->count(),
            'chart' => $dataAll
        ]);
    }
}
