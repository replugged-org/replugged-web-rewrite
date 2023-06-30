<style>
    .linkWrap {
        box-shadow: none;
        text-decoration: none;
        color: inherit;
        display: contents;
    }
</style>

@props(['item'])

@php
    // Of course, I'd much more prefer to have this elsewhere, but who really cares?
    use App\Services\RPStoreService;
    $item->STORE_AUTHORS_STRING = RPStoreService::formatAuthors($item->author);
@endphp

<a class="linkWrap" href={{ RoutePro::STORE_ITEM($item->id) }}>
    <div class="item">
        <div>
            <h2 class="item-header">{{ $item->name }}</h2>
            <p class="item-author">by {{ $item->STORE_AUTHORS_STRING }}</p>
            <p class="item-description">{{ $item->description }}</p>
        </div>
        <div class="item-button">
            <x-button to="{{ RoutePro::STORE_ITEM($item->id) }}" link>Details</x-button>
            <x-button @click="installAddon('{{ $item->id }}')">Install</x-button>
        </div>
    </div>
</a>
