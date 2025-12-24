<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount   = Product::count();
        $categoriesCount = Category::count();
        $ordersCount     = Order::count();
        $usersCount      = User::count();

        $totalSales = Order::where('status', 'completed')
            ->sum('total_price');

        $pendingOrdersCount = Order::where('status', 'pending')->count();

        $monthlySales = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        $averageOrderValue = $ordersCount > 0 ? $totalSales / $ordersCount : 0;

        $latestOrders = Order::latest()->take(5)->get();

        // Sales data for chart (last 12 months)
        $salesLabels = [];
        $salesData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $salesLabels[] = $date->format('M Y');
            $salesData[] = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_price');
        }

        // Top products
        $topProducts = OrderItems::with('product')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();


        $locale = app()->getLocale();
        $topProductsLabels = $topProducts->map(function ($item) use ($locale) {
            $name = json_decode($item->product->name, true); // فك JSON
            return $name[$locale] ?? 'N/A';
        })->toArray();
        $topProductsData = $topProducts->pluck('total_sold')->toArray();

        return view('backend.dashboard', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'totalSales',
            'pendingOrdersCount',
            'usersCount',
            'monthlySales',
            'averageOrderValue',
            'latestOrders',
            'salesLabels',
            'salesData',
            'topProductsLabels',
            'topProductsData'
        ));
    }
}
