<style>
    .linkWrap {
        box-shadow: none;
        text-decoration: none;
        color: inherit;
        display: contents;
    }
</style>

@props(['item'])


<a class="linkWrap" href={{ RoutePro::STORE_ITEM($item->id) }}>
    <div class="item">
        <div>
            <h2 class="item-header">{{ $item->name }}</h2>
            <p class="item-author">by your mother</p>
            <p class="item-description">{{ $item->description }}</p>
        </div>
        <div class="item-button">
            <x-button to="{{ RoutePro::STORE_ITEM($item->id) }}" link>Details</x-button>
        </div>
    </div>
</a>
