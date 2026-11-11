<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Product::where('user_id', $userId);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $totalItems = Product::where('user_id', $userId)->count();
        $lowStockCount = Product::where('user_id', $userId)->where('stock', '<', 5)->count();
        $totalAssetValue = Product::where('user_id', $userId)
            ->selectRaw('SUM(price * stock) as total_val')
            ->value('total_val') ?? 0;

        $categories = Product::where('user_id', $userId)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('inventory.index', compact('products', 'totalItems', 'lowStockCount', 'totalAssetValue', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'sku' => $validated['sku'] ?: ('PRD-' . strtoupper(substr(uniqid(), -4))),
            'name' => $validated['name'],
            'category' => $validated['category'] ?: 'Umum',
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('inventory.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'sku' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'sku' => $validated['sku'] ?: $product->sku,
            'name' => $validated['name'],
            'category' => $validated['category'] ?: 'Umum',
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        return redirect()->route('inventory.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('inventory.index')->with('success', 'Produk berhasil dihapus!');
    }
}
