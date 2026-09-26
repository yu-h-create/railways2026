<x-layouts.livewire>
    <div class="mx-auto max-w-3xl p-6">

        <h1 class="mb-2 text-2xl font-bold">
            架空鉄道
        </h1>

        <p class="mb-8 text-gray-600">
            ようこそ、{{ Auth::user()->name }}さん
        </p>

        <a
            href="{{ route('railway') }}"
            class="block rounded-xl border bg-white p-6 shadow-sm"
        >
            <h2 class="text-xl font-bold">
                時刻表を検索する
            </h2>

            <p class="mt-2 text-gray-500">
                出発駅・到着駅・時刻から列車を検索します。
            </p>
        </a>
    </div>
</x-layouts.livewire>