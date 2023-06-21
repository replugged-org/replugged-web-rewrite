@extends('layouts.app')

@push('css')
    <style>
        .main {
            margin-bottom: 30px;
        }

        .header {
            margin-bottom: 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 24px;
        }

        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .text-field {
            display: block;
            width: 100%;
            border: 1px solid var(--background-tertiary);
            background-color: var(--background-secondary);
            outline: none;
            font: inherit;
            color: inherit;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 8px;
        }

        .search {
            grid-column-end: -1;
        }

        .full-grid {
            grid-column: 1 / -1;
        }

        .item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: var(--background-secondary);
            border-radius: 4px;
            padding: 15px;
            transition: transform 0.2s ease-in-out;
        }

        .item:hover,
        .item:focus {
            transform: scale(1.05);
        }

        .item-header {
            font-size: 1.5em;
        }

        .item-author {
            font-size: 1em;
            font-weight: 400;
            color: var(--text-dark);
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .item-description {
            font-size: 1em;
            line-height: 1.5em;
            font-weight: 400;
            margin-top: 8px;
        }

        .item-button {
            margin-top: 12px;
            align-self: flex-end;
            display: flex;
            gap: 16px;
        }

        .load-more-wrapper {
            display: flex;
            justify-content: center;
        }

        .load-more-button {
            margin-top: 24px;
            align-self: center;
        }

        .scroll-buttons {
            display: flex;
            gap: 8px;
        }
    </style>
@endpush

@section('content')
    <main class="main">
        <h1 class="header">Replugged {{ ucfirst($kind) }}</h1>
        <div class="grid">
            @if (count($addons) > 0)
                <input class="text-field search" type="text" placeholder="Search" />
            @endif
            @foreach ($addons as $addon)
                <x-store.item :item="$addon" />
            @endforeach
        </div>
        {{ $addons->links() }}
    </main>
@endsection
