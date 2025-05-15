<div>
    <h1 class="mb-4">Produtos</h1>

    <input wire:model.debounce.500ms="search" type="text" class="form-control mb-3" placeholder="Buscar produto...">

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Variações</th>
                <th>Preço mínimo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            @php
            $minPrice = $product->variations->min('price') ?? 0;
            @endphp
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->variations_count }}</td>
                <td>R$ {{ number_format($minPrice / 100, 2, ',', '.') }}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="collapse"
                        wire:click="loadVariations({{ $product->id }})"
                        data-bs-target="#variacoes-{{ $product->id }}">
                        Ver opções
                    </button>
                </td>
            </tr>
            <tr class="collapse" id="variacoes-{{ $product->id }}">
                <td colspan="4">
                    @if (isset($loadedVariations[$product->id]))
                    @foreach ($loadedVariations[$product->id] as $variation)
                    <div class="border-top pt-2 mt-2">
                        <strong>{{ $variation->name }}</strong><br>
                        Preço: R$ {{ number_format($variation->price / 100, 2, ',', '.') }}<br>
                        Estoque: {{ $variation->stock->quantity ?? 0 }}<br>
                        <button class="btn btn-sm btn-primary mt-1"
                            wire:click="addToCart({{ $variation->id }})"
                            @if (($variation->stock->quantity ?? 0) < 1) disabled @endif>
                                Comprar
                        </button>
                    </div>
                    @endforeach
                    @else
                    <div class="text-muted">Carregando variações...</div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>