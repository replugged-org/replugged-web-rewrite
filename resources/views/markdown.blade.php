@extends('layouts.app')

@push('css')
    <style>
        .markdown {
            /* Display block here to enable margin collapsing */
            display: block;
        }

        .markdown :is(h1, h2, h3, h4, h5, h6) code {
            font-size: 100%;
        }

        .markdown :is(h1, h2, h3):not(:first-child) {
            margin-top: 24px;
        }

        .markdown :is(h4, h5, h6):not(:first-child) {
            margin-top: 16px;
        }

        .markdown h2 {
            font-size: 1.85em;
        }

        .markdown h3 {
            font-size: 1.5em;
        }

        .markdown h4 {
            font-size: 1.2em;
        }

        .markdown h5 {
            font-size: 1em;
        }

        .markdown h6 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            background-color: var(--background-tertiary);
            padding: 8px 16px;
        }

        .markdown h6+ :is(table, .codeblock) {
            margin-top: 0;
        }

        .markdown :is(ul, ol) {
            margin-bottom: 0;
        }

        .markdown li {
            margin-bottom: 4px;
        }

        .markdown img {
            margin: 16px 0;
            max-width: 100%;
        }

        .markdown blockquote {
            white-space: pre-wrap;
            margin: 8px 0 8px 16px;
            position: relative;
        }

        .markdown blockquote::before {
            content: '';
            width: 4px;
            height: 100%;
            border-radius: 2px;
            position: absolute;
            top: 0;
            left: -16px;
            right: 0;
            background-color: var(--background-secondary);
        }

        .markdown blockquote p {
            margin: 0;
        }

        .markdown code.inline {
            padding: .2em;
            margin: -.2em 0;
            border-radius: 3px;
            background-color: var(--background-secondary);
            font-family: 'JetBrains Mono', sans-serif;
            font-size: 85%;
        }

        .markdown table {
            margin: 16px 0;
            border-collapse: collapse;
            width: 100%;
        }

        .markdown table thead {
            background-color: var(--background-secondary);
        }

        .markdown table tbody tr {
            background-color: #00000015;
        }

        .markdown table tbody tr:nth-child(2n) {
            background-color: #00000005;
        }

        .markdown table :is(td, th) {
            text-align: left;
            border: 1px var(--background-secondary) solid;
            font-size: 13px;
            opacity: .8;
            padding: 8px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .markdown table td {
            opacity: 1;
            text-transform: none;
            font-weight: normal;
            font-size: 14px;
        }

        code {
            padding: .2em;
            margin: -.2em 0;
            border-radius: 3px;
            background-color: var(--background-secondary);
            font-family: JetBrains Mono, sans-serif;
            font-size: 85%;
        }
    </style>
@endpush

@section('content')
    <main class="markdown">
        <?= $content ?>
    </main>
@endsection
