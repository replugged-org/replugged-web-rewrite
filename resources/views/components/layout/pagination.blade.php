@if($paginator->hasPages())
    <div class="scroll-buttons">
        @if($paginator->onFirstPage())
            <x-button class="load-more-button" disabled>&lsaquo; Previous</x-button>
        @else
            <x-button class="load-more-button" to="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo; Previous
            </x-button>
        @endif

        @if($paginator->hasMorePages())
            <x-button class="load-more-button" to="{{ $paginator->nextPageUrl() }}" rel="next">Next &rsaquo;</x-button>
        @else
            <x-button class="load-more-button" disabled>Next &rsaquo;</x-button>
        @endif
    </div>
@endif
