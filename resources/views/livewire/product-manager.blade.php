<div>
    <h2 class="mb-4 h4">Cadastro de Produtos</h2>

    {{-- ALERTA --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM DE PRODUTO --}}
    <form wire:submit.prevent="saveProduct">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" wire:model="product.nome" class="form-control">
            @error('product.nome') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" id="preco" wire:model="product.preco" class="form-control">
            @error('product.preco') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Variações --}}
        <h5 class="mt-4">Variações</h5>

        @foreach ($variacoes as $index => $variacao)
            <div class="row mb-2">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nome da variação" wire:model="variacoes.{{ $index }}.nome">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Estoque" wire:model="variacoes.{{ $index }}.estoque">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger" wire:click="removeVariacao({{ $index }})">Remover</button>
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-secondary btn-sm mb-3" wire:click="addVariacao">+ Adicionar variação</button>

        <div class="mt-4">
            <button class="btn btn-primary">Salvar Produto</button>
        </div>
    </form>

    {{-- LISTAGEM DE PRODUTOS --}}
    <hr class="my-5">
    <h4>Produtos Cadastrados</h4>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Variações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>
                        <ul class="mb-0">
                            @foreach ($produto->variacoes as $v)
                                <li>{{ $v->nome }} ({{ $v->estoque }} unid)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" wire:click="editProduto({{ $produto->id }})">Editar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
