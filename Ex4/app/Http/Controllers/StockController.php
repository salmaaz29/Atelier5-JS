<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Events\StockUpdated;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock = Stock::create($validated);
        broadcast(new StockUpdated($stock))->toOthers();

        return redirect()->route('stocks.index');
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock->update($validated);
        broadcast(new StockUpdated($stock))->toOthers();

        return redirect()->route('stocks.index');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        broadcast(new StockUpdated($stock))->toOthers();

        return redirect()->route('stocks.index');
    }
    public function chartData()
{
    $stocks = Stock::all();
    $data = [];
    
    foreach ($stocks as $stock) {
        $data[] = [
            'name' => $stock->product_name,
            'y' => $stock->quantity
        ];
    }
    
    return response()->json($data);
}
}