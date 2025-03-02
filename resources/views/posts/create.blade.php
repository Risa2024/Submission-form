<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォーム
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif
        <form method="post" action="{{ route('posts.store') }}">
            @csrf
            <div class="mt-8">
                <div class="w-full flex flex-col">
                <!-- 件名入力欄 -->
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="件名を入力してください"
                        class="w-auto py-2 border border-gray-300 round-md"
                        value="{{ old('title') }}"
                    >
                </div>
            </div>
                <!-- 本文入力欄 -->
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    <textarea id="body" name="body" rows="5" placeholder="本文を入力してください" class="w-full py-2 border border-gray-300 rounded-md">{{ old('body') }}</textarea>
            </div>

                <!-- 送信ボタン -->
            <x-primary-button class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>