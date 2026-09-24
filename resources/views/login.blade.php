<x-layouts.livewire> 
    <div class="mx-auto max-w-md p-6">

        <h1 class="mb-6 text-2xl font-bold">
            ログイン
        </h1>

        <form
            method="POST"
            action="{{ route('login') }}"
            class="space-y-5 rounded-xl border bg-white p-6 shadow-sm"
        >
            @csrf

            <div>
                <label for="email" class="mb-1 block font-medium">
                    メールアドレス
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full rounded border p-2"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block font-medium">
                    パスワード
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="w-full rounded border p-2"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full rounded bg-black px-4 py-2 text-white"
            >
                ログイン
            </button>
        </form>
    </div>
</x-layouts.livewire>