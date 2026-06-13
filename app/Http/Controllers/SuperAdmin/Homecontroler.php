<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homecontroler extends Controller
{
    public function index()
    {
        $totalSkus = \App\Models\Sku::count();
        $totalInputSlips = \App\Models\InputSlip::count();
        $totalOutputSlips = \App\Models\OutputSlip::count();

        $lowStockSkus = \App\Models\Sku::where('track_inventory', true)
            ->join('warehouse_inventories', 'skus.id', '=', 'warehouse_inventories.sku_id')
            ->whereColumn('warehouse_inventories.quantity', '<=', 'skus.min_quantity')
            ->count();

        $totalRevenue = \App\Models\OutputSlip::where('status', 'completed')->sum('total_amount');
        $totalInputCost = \App\Models\InputSlip::where('status', 'completed')->sum('total_amount');

        return view('super-admin.dashboard', compact(
            'totalSkus',
            'totalInputSlips',
            'totalOutputSlips',
            'lowStockSkus',
            'totalRevenue',
            'totalInputCost'
        ));
    }
}
