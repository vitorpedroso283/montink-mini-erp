<?php

namespace App\Livewire;

use App\Models\ProductVariation;
use Livewire\Component;

class CartManager extends Component
{
    public array $cart = [];

    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function refreshCart(): void
    {
        $this->cart = session('cart', ['items' => []]);
    }

    public function addToCart($variationId): void
    {
        $variation = ProductVariation::with('product')->findOrFail($variationId);

        $cart = session()->get('cart', ['items' => []]);

        $existingIndex = collect($cart['items'])->search(fn($item) => $item['variation_id'] === $variation->id);

        if ($existingIndex !== false) {
            $cart['items'][$existingIndex]['quantity'] += 1;
        } else {
            $cart['items'][] = [
                'variation_id' => $variation->id,
                'product_name' => $variation->product->name . ' - ' . $variation->name,
                'price' => $variation->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->cart = $cart;

        $this->dispatch('cartUpdated');
        session()->flash('success', 'Produto adicionado ao carrinho!');
    }

    public function increase($variationId): void
    {
        foreach ($this->cart['items'] as &$item) {
            if ($item['variation_id'] === $variationId) {
                $item['quantity']++;
                break;
            }
        }
        session()->put('cart', $this->cart);
        $this->dispatch('cartUpdated');
    }

    public function decrease($variationId): void
    {
        foreach ($this->cart['items'] as $i => &$item) {
            if ($item['variation_id'] === $variationId) {
                if ($item['quantity'] <= 1) {
                    unset($this->cart['items'][$i]);
                } else {
                    $item['quantity']--;
                }
                break;
            }
        }
        $this->cart['items'] = array_values($this->cart['items']); // reindexa
        session()->put('cart', $this->cart);
        $this->dispatch('cartUpdated');
    }

    public function removeItem($variationId): void
    {
        $this->cart['items'] = array_filter($this->cart['items'], fn($item) => $item['variation_id'] !== $variationId);
        $this->cart['items'] = array_values($this->cart['items']); // reindexa
        session()->put('cart', $this->cart);
        $this->dispatch('cartUpdated');
    }

    public function getSubtotalProperty(): int
    {
        return collect($this->cart['items'])->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function getFreightProperty(): int
    {
        $subtotal = $this->subtotal;

        return match (true) {
            $subtotal > 20000 => 0,
            $subtotal >= 5200 && $subtotal <= 16659 => 1500,
            default => 2000,
        };
    }

    public function getTotalProperty(): int
    {
        return $this->subtotal + $this->freight;
    }

    public function render()
    {
        return view('livewire.cart-manager', [
            'cart' => $this->cart,
            'subtotal' => $this->subtotal,
            'freight' => $this->freight,
            'total' => $this->total,
        ]);
    }
}
