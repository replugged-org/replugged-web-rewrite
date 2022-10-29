<style>
    .footer-container {
        display: flex;
        padding: 8px 16px;
        flex-shrink: 0;
        align-items: flex-start;
        background-color: var(--background-secondary);
        font-size: .85rem;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .section {
        display: flex;
        column-gap: 16px;
    }

    .section:first-child {
        flex-direction: column;
    }

    .section:last-child {
        display: flex;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid var(--background-tertiary);
        width: 100%;
        flex-wrap: wrap;
    }

    .footer-link {
        color: var(--text-color);
    }

    @media screen and (min-width: 890px) {
        .footer-container {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .section:first-child {
            flex-direction: row;
        }
    }

    @media screen and (min-width: 1440px) {
        .footer-container .section {
            flex-direction: row;
            width: auto;
            margin: 0;
            padding: 0;
            border: none;
        }
    }
</style>

<footer class="footer-container">
    <div class="section">
        <span>Copyright &copy; 2022-{{ date('Y') }} Replugged</span>
        <span>Replugged is not affiliated or endorsed by Discord. Discord is a trademark of Discord Inc.</span>
    </div>
    <div class="section">
        <a class="footer-link" href="{{ RoutePro::DOCS() }}">Docs</a>
        <a class="footer-link" href="{{ RoutePro::STATS() }}">Stats</a>
        <a class="footer-link" href="{{ RoutePro::BRANDING() }}">Branding</a>
        <a class="footer-link" href="{{ RoutePro::GITHUB() }}" target="_blank" rel='noreferrer'>GitHub</a>
        <a class="footer-link" href="{{ RoutePro::TRANSLATIONS() }}" target="_blank" rel='noreferrer'>Translations</a>
        <a class="footer-link" href="{{ RoutePro::TERMS() }}">Terms</a>
        <a class="footer-link" href="{{ RoutePro::PRIVACY() }}">Privacy</a>
    </div>
</footer>
