@props(['icon', 'title', 'description', 'note', 'linkto', 'linklabel'])

<section class="feature">
    <div class="feature-icon">
        <x-icon name="{{ $icon }}" />
    </div>
    <h3 class="feature-title">{{ $title }}</h3>
    <p class="feature-description">{{ $description }}</p>
    @isset($note)
        <p class="note">{{ $note }}</p>
    @endisset
    @isset($linkto, $linklabel)
        <a href="{{ $linkto }}" class="feature-link">
            <x-icon name="arrow-right" />
            <span>{{ $linklabel }}</span>
        </a>
    @endisset
</section>
