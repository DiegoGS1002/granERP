<div class="nx-form-page" style="max-width:960px;">

    <div class="nx-form-header">
        <a href="{{ route('products.index') }}" class="nx-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Voltar para Produtos
        </a>
        <h1 class="nx-form-title">{{ $isEditing ? 'Editar Produto' : 'Adicionar Produto' }}</h1>
        <p class="nx-form-subtitle">{{ $isEditing ? 'Atualize os dados do produto' : 'Preencha os dados do novo produto' }}</p>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form wire:submit="save" enctype="multipart/form-data">

        <div class="nx-form-card">

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Informacoes Basicas</h3>
                </div>
                <div class="grid grid-2">
                    <div class="nx-field">
                        <label>Nome do Produto</label>
                        <input type="text" wire:model.blur="name" placeholder="Nome do produto" required>
                    </div>
                    <div class="nx-field">
                        <label>Codigo de Barras (GTIN/EAN)</label>
                        <input type="text" wire:model.blur="ean" placeholder="Ex: 7891234567890" required>
                    </div>
                </div>
            </div>

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Descricao</h3>
                </div>
                <div class="nx-field">
                    <label>Descricao do Produto</label>
                    <input type="text" wire:model.blur="description" placeholder="Descreva brevemente o produto" required>
                </div>
            </div>

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/><path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Classificacao</h3>
                </div>
                <div class="grid grid-2">
                    <div class="nx-field">
                        <label>Unidade de Medida</label>
                        <select wire:model.blur="unit_of_measure" required>
                            <option value="">Selecione a unidade</option>
                            <option value="unidade">Unidade</option>
                            <option value="kg">Kg</option>
                            <option value="litro">Litro</option>
                            <option value="metro">Metro</option>
                        </select>
                    </div>
                    <div class="nx-field">
                        <label>Categoria</label>
                        <select wire:model.blur="category" required>
                            <option value="">Selecione a categoria</option>
                            <option value="eletronico">Eletronico</option>
                            <option value="alimentos">Alimentos</option>
                            <option value="vestuario">Vestuario</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Estoque e Precificacao</h3>
                </div>
                <div class="grid grid-3">
                    <div class="nx-field">
                        <label>Preco de Venda</label>
                        <input type="number" step="0.01" wire:model.blur="sale_price" placeholder="0,00" required>
                    </div>
                    <div class="nx-field">
                        <label>Estoque</label>
                        <input type="number" wire:model.blur="stock" placeholder="0" required>
                    </div>
                    <div class="nx-field">
                        <label>Data de Validade</label>
                        <input type="date" wire:model.blur="expiration_date">
                        <small>Deixe em branco para produtos sem validade</small>
                    </div>
                </div>
            </div>

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Fornecedores</h3>
                </div>
                <div class="nx-field">
                    <label>Fornecedores Associados</label>
                    <select wire:model="supplier_ids" multiple style="height:120px;">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->corporate_name ?? $supplier->social_name }}</option>
                        @endforeach
                    </select>
                    <small>Segure CTRL para selecionar mais de um fornecedor</small>
                </div>
            </div>

            <div class="nx-form-section">
                <div class="nx-form-section-header">
                    <div class="nx-form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    <h3 class="nx-form-section-title">Imagem do Produto</h3>
                </div>
                <div style="display:flex;align-items:flex-start;gap:20px;flex-wrap:wrap;">
                    @if($isEditing && $product?->image)
                        <div>
                            <label style="margin-bottom:8px;display:block;">Imagem atual</label>
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:1px solid #E2E8F0;">
                        </div>
                    @endif
                    <div class="nx-field" style="flex:1;min-width:200px;">
                        <label>{{ $isEditing ? 'Trocar Imagem (opcional)' : 'Foto do Produto' }}</label>
                        <input type="file" wire:model="image" accept="image/*">
                        <small>{{ $isEditing ? 'Deixe em branco para manter a imagem atual' : 'Formatos aceitos: JPG, PNG, WEBP. Tamanho maximo: 2MB.' }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="nx-form-footer">
            <a href="{{ route('products.index') }}" class="nx-btn nx-btn-ghost">Cancelar</a>
            <button type="submit" class="nx-btn nx-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                {{ $isEditing ? 'Salvar Alteracoes' : 'Salvar Produto' }}
            </button>
        </div>
    </form>
</div>

