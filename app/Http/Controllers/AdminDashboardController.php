<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Order;
use App\Models\PosOrder;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
  




private function getTopCategories($startDate, $limit = 4)
{
    $web = DB::table('order_items')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->where('orders.order_status', 'completed')
        ->where('orders.created_at', '>=', $startDate)
        ->select(
            'products.category_id',
            DB::raw('SUM(order_items.quantity) as qty')
        )
        ->groupBy('products.category_id');

    $pos = DB::table('pos_order_items')
        ->join('pos_orders', 'pos_orders.id', '=', 'pos_order_items.pos_order_id')
        ->join('products', 'products.id', '=', 'pos_order_items.product_id')
        ->where('pos_orders.created_at', '>=', $startDate)
        ->select(
            'products.category_id',
            DB::raw('SUM(pos_order_items.quantity) as qty')
        )
        ->groupBy('products.category_id');

    return DB::table('categories')
        ->joinSub(
            $web->unionAll($pos),
            'sales',
            function ($join) {
                $join->on('categories.id', '=', 'sales.category_id');
            }
        )
        ->select(
            'categories.name',
            DB::raw('SUM(sales.qty) as total_qty')
        )
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('total_qty')
        ->take($limit)
        ->get();
}


    


    public function index()
    {
        $posSales = PosOrder::sum('total_amount');
        $posOrders = PosOrder::count();

        $webSales = Order::where('order_status', 'completed')->sum('total');
        $webOrders = Order::count();

        $totalCustomers = Customer::count();
        $lowStockProducts = Product::with(['category', 'brand'])->where('available_qty', '<', 5)->get();
        $topProducts = Product::withCount('orderItems')->orderBy('order_items_count', 'desc')->take(5)->get();

        $topCategoriesWeek = $this->getTopCategories(
            Carbon::now()->subDays(6)->startOfDay()
        );

        $topCategoriesMonth = $this->getTopCategories(
            Carbon::now()->subDays(30)->startOfDay()
        );

        $topCategoriesYear = $this->getTopCategories(
            Carbon::now()->subYear()->startOfDay()
        );

        // 1. Weekly Sales Trend
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $posSalesByDate = PosOrder::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $webSalesByDate = Order::where('order_status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $salesTrendLabels = [];
        $salesTrendPos = [];
        $salesTrendWeb = [];

        for ($i = 6; $i >= 0; $i--) {
            $dateObj = Carbon::now()->subDays($i);
            $dateStr = $dateObj->toDateString();
            $salesTrendLabels[] = $dateObj->format('d M');
            
            $salesTrendPos[] = (float) ($posSalesByDate[$dateStr] ?? 0);
            $salesTrendWeb[] = (float) ($webSalesByDate[$dateStr] ?? 0);
        }

        // 2. Monthly Sales Trend (4 Weeks block)
        $salesTrendLabelsMonth = [];
        $salesTrendPosMonth = [];
        $salesTrendWebMonth = [];

        for ($i = 3; $i >= 0; $i--) {
            $start = Carbon::now()->subDays(($i + 1) * 7 - 1)->startOfDay();
            $end = Carbon::now()->subDays($i * 7)->endOfDay();
            
            $posTotal = PosOrder::whereBetween('created_at', [$start, $end])->sum('total_amount');
            $webTotal = Order::where('order_status', 'completed')
                ->whereBetween('created_at', [$start, $end])
                ->sum('total');
                
            $salesTrendLabelsMonth[] = $start->format('d M') . ' - ' . $end->format('d M');
            $salesTrendPosMonth[] = (float) $posTotal;
            $salesTrendWebMonth[] = (float) $webTotal;
        }

        // 3. Yearly Sales Trend (Last 12 Months)
        $driver = DB::connection()->getDriverName();
        if ($driver === 'sqlite') {
            $posSalesYear = PosOrder::where('created_at', '>=', Carbon::now()->subYear()->startOfMonth())
                ->selectRaw('strftime("%Y-%m", created_at) as month, SUM(total_amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();
            $webSalesYear = Order::where('order_status', 'completed')
                ->where('created_at', '>=', Carbon::now()->subYear()->startOfMonth())
                ->selectRaw('strftime("%Y-%m", created_at) as month, SUM(total) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();
        } else {
            $posSalesYear = PosOrder::where('created_at', '>=', Carbon::now()->subYear()->startOfMonth())
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();
            $webSalesYear = Order::where('order_status', 'completed')
                ->where('created_at', '>=', Carbon::now()->subYear()->startOfMonth())
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();
        }

        $salesTrendLabelsYear = [];
        $salesTrendPosYear = [];
        $salesTrendWebYear = [];

        for ($i = 11; $i >= 0; $i--) {
            $monthObj = Carbon::now()->subMonths($i);
            $monthStr = $monthObj->format('Y-m');
            $salesTrendLabelsYear[] = $monthObj->format('M Y');
            
            $salesTrendPosYear[] = (float) ($posSalesYear[$monthStr] ?? 0);
            $salesTrendWebYear[] = (float) ($webSalesYear[$monthStr] ?? 0);
        }

        return view('admin.pages.index', compact(
            'posSales',
            'webSales',
            'posOrders',
            'webOrders',
            'totalCustomers',
            'lowStockProducts',
            'topProducts',
            'topCategoriesWeek',
            'topCategoriesMonth',
            'topCategoriesYear',
            'salesTrendLabels',
            'salesTrendPos',
            'salesTrendWeb',
            'salesTrendLabelsMonth',
            'salesTrendPosMonth',
            'salesTrendWebMonth',
            'salesTrendLabelsYear',
            'salesTrendPosYear',
            'salesTrendWebYear'
        ));
    }
}
