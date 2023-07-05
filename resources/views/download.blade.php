@extends('layouts.app')

@push('css')
   <style>
       .container {
           margin: 0px;
           margin-bottom: 20px;
           padding: 0;
           max-width: none;
       }

       .wrapper {
           margin: 0 auto;
           max-width: 1300px;
           padding: 0 2em;
           width: 100%;
       }

       .heading {
           padding: 32px 0;
           text-align: center;
           background-color: var(--background-secondary);
           position: relative;
           margin-bottom: 20px;
       }

       .title {
           margin-bottom: 8px;
           position: relative;
           z-index: 2;
       }

       .download-container {
           background-color: var(--background-light);
           width: -webkit-fit-content;
           width: -moz-fit-content;
           width: fit-content;
           min-width: min(100%, 500px);
           max-width: min(100%, 800px);
           margin: 10px auto;
           padding: 10px;
           border-radius: 10px;
           display: flex;
           flex-direction: column;
           gap: 20px;
       }

       .tabs {
           display: flex;
           gap: 10px;
           justify-content: center;
       }

       .tab:not(.selected) {
           background-color: var(--background-secondary);
       }

       .divider {
           width: 75%;
           margin: 0 auto;
           height: 1px;
           background-color: var(--text-color);
       }

       .buttons {
           display: flex;
           gap: 10px;
           justify-content: center;
       }

       .warning {
           width: -webkit-fit-content;
           width: -moz-fit-content;
           width: fit-content;
           margin: 0 auto;
           border: 1px solid rgba(240, 178, 50, 1);
           border-radius: 5px;
           padding: 10px;
           background-color: rgba(240, 178, 50, 0.1);
       }
       .manual h2 {
           margin-bottom: 20px;
       }

       .manual p {
           margin: 16px 0px;
       }
   </style>
@endpush

@section('content')
    <main class="container">
        <div class="heading">
            <div class="wrapper">
                <h1 class="title">Download Replugged</h1>
                <div x-data="downloadData" class="download-container">
                    <div class="tabs">
                        <template x-for="os in operatingSystems" :key="os.os">
                            <button
                                @click="selectedOS = os"
                                class="tab button"
                                :class="{ 'selected': os.os === selectedOS.os }"
                                x-text="os.name"
                            ></button>
                        </template>
                    </div>
                    <div class="divider"></div>
                    <div class="buttons">
                        <template x-for="file in selectedOS.files" :key="file.file">
                            {{-- I'd love to use x-button here but I do not think that'll play well. --}}
                            <a
                                class="button"
                                :href="DOWNLOAD_URL_BASE + '/' + file.file"
                                x-text="file.label"
                                target="_blank"
                                download
                            />
                        </template>
                    </div>
                    <template x-if="selectedOS.warning">
                        <div class="warning" x-html="selectedOS.warning"></div>
                    </template>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <section id="manual" class="manual">
                <h2>Manual Installation</h2>
                <h3>Prerequisites</h3>
                <p>
                    <ul>
                        <li>
                            <a href="https://git-scm.com/downloads" target="_blank">
                                Git
                            </a>
                        </li>
                        <li>
                            <a href="https://nodejs.org/en" target="_blank">
                                Node.js
                            </a>
                        </li>
                        <li>
                            <a href="https://pnpm.io/installation" target="_blank">pnpm</a>
                            : <x-code>npm install -g pnpm</x-code>
                        </li>
                        <li>
                            <a href="https://discord.com/download" target="_blank">
                                Discord
                            </a>
                        </li>
                    </ul>
                </p>
                <h3>Installation</h3>
                <p>
                    <ol>
                        <li>
                            Clone the repository: <x-code>git clone https://github.com/replugged-org/replugged</x-code>
                        </li>
                        <li>
                            <code>cd</code> into the repository: <x-code>cd replugged</x-code>
                        </li>
                        <li>
                            Install dependencies: <x-code>pnpm i</x-code>
                        </li>
                        <li>
                            Build Replugged: <x-code>pnpm run bundle</x-code>
                        </li>
                        <li>Fully quit Discord</li>
                        <li>
                            Plug into Discord: <x-code>pnpm run plug --production</x-code>
                            <br />
                            If you want to specify a specific Discord version to plug into, you can add the platform as
                            an argument: <x-code>pnpm run plug --production [stable|ptb|canary|development]</x-code>
                        </li>
                        <li>Reopen Discord</li>
                    </ol>
                    You can verify it's installed by going into Discord settings and looking for the
                    "Replugged" tab.
                </p>
                <h3>Troubleshooting</h3>
                <p>
                    If you're having issues, please reinstall Discord and try steps 5-7 again.
                    <br />
                    <br />
                    Still having issues? Please <a href="{{ RoutePro::DICKSWORD() }}" target="_blank">join our Discord</a>
                    and create a thread in <a href="https://discord.com/channels/1000926524452647132/1006383180309352538" target="_blank">#support</a>
                    with any errors you're getting and any other information you think might be helpful.
                </p>
            </section>
        </div>
    </main>
@endsection

@push('head-js')
    <script>
        const currentPlatform = (window.navigator.userAgentData?.platform || window.navigator.platform || "").toLowerCase()
        const operatingSystems = [
            {
                os: 'windows',
                detect: () => currentPlatform.includes('win'),
                name: 'Windows',
                warning: `If you get a warning that the app can't be opened, click "Run Anyways". You may need to click "more info" to see this option.`,
                files: [
                    {
                        label: 'Download',
                        file: 'replugged-installer-windows.exe'
                    }
                ]
            },
            {
                os: "macos",
                detect: () => currentPlatform.includes("mac"),
                name: "macOS",
                warning: `If you get a warning that the app can't be opened, right click on the app and select "Open". See <a href="https://support.apple.com/guide/mac-help/apple-cant-check-app-for-malicious-software-mchleab3a043/mac" target="_blank">this article</a> from Apple for more information.`,
                files: [
                    {
                        label: "Download for Intel",
                        file: "replugged-installer-macos.zip",
                    },
                    {
                        label: "Download for Apple Silicon",
                        file: "replugged-installer-macos-arm64.zip",
                    },
                ],
            },
            {
                os: "linux",
                detect: () => currentPlatform.includes("linux"),
                name: "Linux",
                warning: `If the installer is not able to find your installation or you are using Flatpak, please follow the <a href="#manual">manual installation instructions</a>.`,
                files: [
                    {
                        label: "Download for x86",
                        file: "replugged-installer-linux.AppImage",
                    },
                    {
                        label: "Download for arm64",
                        file: "replugged-installer-linux-arm64.AppImage",
                    },
                ],
            },
        ]
        const defaultOS = (operatingSystems.find(os => os.detect()) || operatingSystems[0])

        const downloadData = {
            DOWNLOAD_URL_BASE: "https://github.com/replugged-org/electron-installer/releases/latest/download",
            selectedOS: defaultOS,
            currentPlatform,
            operatingSystems,
        }
    </script>
@endpush
