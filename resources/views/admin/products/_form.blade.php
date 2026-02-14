@csrf

<div class="space-y-4 text-sm">
    <div>
        <label class="block text-xs font-medium mb-1">Nom *</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="input-soft">
        @error('name')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-xs font-medium mb-1">Slug (optionnel)</label>
        <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="input-soft">
        @error('slug')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-xs font-medium mb-1">Catégorie *</label>
        <select name="category_id" required class="input-soft">
            <option value="">-- Choisir --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-medium mb-1">Prix (€) *</label>
            <input type="number" step="0.01" min="0" name="price"
                value="{{ old('price', $product->price ?? '') }}" required class="input-soft">
            @error('price')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block text-xs font-medium mb-1">Stock *</label>
            <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 0) }}"
                required class="input-soft">
            @error('stock')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- <div>
        <label class="block text-xs font-medium mb-1">Image (URL ou chemin storage)</label>
        <input type="text" name="image_path"
               value="{{ old('image_path', $product->image_path ?? '') }}" class="input-soft">
        @error('image_path')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
    </div> --}}

    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-medium mb-1">Image (fichier)</label>
            <input type="file" name="image_file" accept="image/*"
                class="block w-full text-xs text-slate-200
                      file:mr-3 file:py-1.5 file:px-3
                      file:rounded-full file:border-0
                      file:text-xs file:font-semibold
                      file:bg-slate-800 file:text-slate-100
                      hover:file:bg-slate-700">
            @error('image_file')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-[11px] text-slate-500">
                JPG, PNG, max 2 Mo.
            </p>
        </div>
        <div>
            <label class="block text-xs font-medium mb-1">Ou URL d’image</label>
            <input type="text" name="image_path" value="{{ old('image_path', $product->image_path ?? '') }}"
                class="input-soft">
            @error('image_path')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-[11px] text-slate-500">
                Si un fichier est téléchargé, il sera utilisé à la place de l’URL.
            </p>
        </div>
    </div>

    <div>
        <label class="block text-xs font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="input-soft">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-5 flex justify-end gap-3">
    <a href="{{ route('admin.products.index') }}" class="text-xs text-slate-400 hover:text-slate-200">
        Annuler
    </a>
    <x-button>
        Enregistrer
    </x-button>
</div>
