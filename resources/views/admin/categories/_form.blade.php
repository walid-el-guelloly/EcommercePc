@csrf

<div class="space-y-4 text-sm">
    <div>
        <label class="block text-xs font-medium mb-1">Nom *</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="input-soft">
        @error('name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-xs font-medium mb-1">Slug (optionnel)</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="input-soft">
        @error('slug')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-xs font-medium mb-1">Description</label>
        <textarea name="description" rows="3" class="input-soft">{{ old('description', $category->description) }}</textarea>
        @error('description')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="mt-5 flex justify-end gap-3">
    <a href="{{ route('admin.categories.index') }}" class="text-xs text-slate-400 hover:text-slate-200">
        Annuler
    </a>
    <x-button>
        Enregistrer
    </x-button>
</div>