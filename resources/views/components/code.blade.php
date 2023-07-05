@pushonce('css')
    <style>
        .codeContainer {
            display: inline-flex;
            align-items: center;
            margin: 3px 0;
        }

        .code {
            background-color: var(--background-secondary);
            border-radius: 5px;
            padding: 3px;
        }

        .copyButton {
            display: inline-flex;
            margin-left: 3px;
        }

        .copyCheck {
            color: var(--green);
        }
    </style>
@endpushonce
<div
    class="codeContainer"
    {{-- Boo hoo, inline syntax. Better than 60 script tags. --}}
    x-data="{
        copied: false,
        setCopied() {
            this.copied = true;
            setTimeout(() => {
                this.copied = false
            }, 1500)
        }
    }"
>
    <code class="code">{{ $slot }}</code>
    <button class="copyButton" @click="setCopied()" x-clipboard.raw="{{ $slot }}">
        <x-icon x-show="copied" name="check" class="icon copyCheck"></x-icon>
        <x-icon x-show="!copied" name="clipboard" class="icon"></x-icon>
    </button>
</div>
