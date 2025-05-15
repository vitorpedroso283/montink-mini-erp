<div class="card">
    <div class="card-header">
        <strong>Carrinho</strong>
    </div>
    <div class="card-body">
        @forelse ($cart['items'] as $item)
        <div class="mb-2 border-bottom pb-2">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $item['product_name'] }}</strong><br>
                    R$ {{ number_format($item['price'] / 100, 2, ',', '.') }} x {{ $item['quantity'] }}
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-secondary" wire:click="decrease({{ $item['variation_id'] }})">-</button>
                    <button class="btn btn-sm btn-outline-secondary" wire:click="increase({{ $item['variation_id'] }})">+</button>
                    <button class="btn btn-sm btn-danger" wire:click="removeItem({{ $item['variation_id'] }})">&times;</button>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Carrinho vazio.</p>
        @endforelse

        <div class="mt-3">
            <p>Subtotal: <strong>R$ {{ number_format($subtotal / 100, 2, ',', '.') }}</strong></p>
            <p>Frete: <strong>R$ {{ number_format($freight / 100, 2, ',', '.') }}</strong></p>
            <p>Total: <strong>R$ {{ number_format($total / 100, 2, ',', '.') }}</strong></p>

            <button class="btn btn-success mt-2" @if(empty($cart['items'])) disabled @endif>
                Finalizar Pedido
            </button>
        </div>
    </div>
</div>