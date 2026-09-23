<div class="mx-auto max-w-3xl p-6">

    <h1 class="mb-6 text-2xl font-bold">
        架空鉄道 時刻表検索
    </h1>

    <form wire:submit="search" class="mb-8 space-y-4 rounded-xl border bg-white p-6 shadow-sm">

        <div>
            <label class="mb-1 block font-medium">
                出発駅
            </label>

            <select wire:model="departureStationId" class="w-full rounded border p-2">

                <option value="">選択してください</option>

                @foreach ($stations as $station)
                    <option value="{{ $station->id }}">
                        {{ $station->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="button" wire:click="swapStations" class="rounded border px-4 py-2">
                ⇄ 入れ替え
            </button>
        </div>

        <div>
            <label class="mb-1 block font-medium">
                到着駅
            </label>

            <select wire:model="arrivalStationId" class="w-full rounded border p-2">

                <option value="">選択してください</option>

                @foreach ($stations as $station)
                    <option value="{{ $station->id }}">
                        {{ $station->name }}
                    </option>
                @endforeach
            </select>

            @error('arrivalStationId')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label class="mb-1 block font-medium">
                出発希望時刻
            </label>

            <input type="time" wire:model="departureTime" class="w-full rounded border p-2">
        </div>

        <button type="submit" class="w-full rounded bg-black px-4 py-2 text-white">
            検索する
        </button>

    </form>

    @if (count($results) > 0)

        <h2 class="mb-4 text-xl font-semibold">
            検索結果
        </h2>

        <div class="space-y-4">

            @foreach ($results as $result)
                <div class="rounded-xl border bg-white p-4 shadow-sm">

                    <p class="text-sm text-gray-500">
                        列車番号 {{ $result['train_no'] }}
                    </p>

                    <p class="mt-2 text-lg font-semibold">
                        {{ $result['departure_time'] }}
                        →
                        {{ $result['arrival_time'] }}
                    </p>

                </div>
            @endforeach

        </div>

        <div class="mt-6 text-center">
            <button type="button" wire:click="loadMore" class="rounded border px-4 py-2">
                次の5本を見る
            </button>
        </div>

    @endif

</div>
