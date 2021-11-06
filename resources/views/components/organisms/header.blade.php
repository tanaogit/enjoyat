<header class="flex bg-gray-100 h-20 md:h-24">
    <div class="mx-auto w-10/12 md:w-11/12 flex justify-between">
        {{-- Enjoyatのロゴ --}}
        <x-atoms.service-logo></x-atoms.service-logo>

        {{-- SP表示におけるハンバーガメニュー --}}
        <x-atoms.hamburger-menu></x-atoms.hamburger-menu>

        {{-- PC表示におけるメニュー --}}
        <div class="z-20 hidden md:block">
            <x-atoms.pc-header-menu></x-atoms.pc-header-menu>
        </div>
    </div>
</header>
