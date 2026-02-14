@extends('layouts.admin')

@section('header', 'Catégories')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-semibold">Liste des catégories</h2>
        <a href="{{ route('admin.categories.create') }}">
            <x-button size="sm">Nouvelle catégorie</x-button>
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-soft">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-800/80 text-slate-300 text-[11px] uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach($categories as $category)
                    <tr class="hover:bg-slate-800/60 transition">
                        <td class="px-4 py-3 text-slate-100 font-medium">
                            {{ $category->name }}
                        </td>
                        <td class="px-4 py-3 text-slate-400 text-xs">
                            {{ $category->slug }}
                        </td>
                        <td class="px-4 py-3 text-slate-300 text-xs max-w-md">
                            {{ \Illuminate\Support\Str::limit($category->description, 80) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-xs text-brand-300 hover:underline mr-2">
                                Éditer
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer cette catégorie ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
@endsection