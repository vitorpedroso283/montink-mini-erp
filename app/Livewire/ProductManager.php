<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariation;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $loadedVariations = [];
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadVariations($productId)
    {
        if (!isset($this->loadedVariations[$productId])) {
            $this->loadedVariations[$productId] = Product::with(['variations.stock'])
                ->find($productId)?->variations->sortBy('price');
        }
    }

    public function addToCart($variationId)
    {
        $variation = ProductVariation::with('product', 'stock')->findOrFail($variationId);

        if (!$variation->stock || $variation->stock->quantity < 1) {
            session()->flash('error', 'Produto sem estoque.');
            return;
        }

        $cart = session()->get('cart', []);

        $found = collect($cart['items'] ?? [])->firstWhere('variation_id', $variationId);

        if ($found) {
            $cart['items'] = array_map(function ($item) use ($variationId) {
                if ($item['variation_id'] === $variationId) {
                    $item['quantity']++;
                }
                return $item;
            }, $cart['items']);
        } else {
            $cart['items'][] = [
                'variation_id' => $variation->id,
                'product_name' => $variation->product->name . ' - ' . $variation->name,
                'price' => $variation->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->flash('success', 'Produto adicionado ao carrinho!');
    }

    public function render()
    {
        $products = Product::where('name', 'like', "%{$this->search}%")
            ->withCount('variations')
            ->paginate(9);

        return view('livewire.product-manager', [
            'products' => $products,
            'loadedVariations' => $this->loadedVariations,
        ]);
    }
}
