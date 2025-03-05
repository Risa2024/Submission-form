<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            編集フォーム
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="p-4 rounded bg-blue-100 w-full">
                {{ session('message') }}
            </div>
        @endif
        <form method="post" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="件名を入力してください"
                        class="w-auto py-2 border border-gray-300 rounded-md"
                        value="{{ old('title', $post->title) }}"
                    >
                </div>
            </div>
                <!-- 本文入力欄 -->
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <textarea id="body" name="body" rows="5" placeholder="本文を入力してください" class="w-full py-2 border border-gray-300 rounded-md">{{ old('body', $post->body) }}</textarea>
                <div id="counter" class="text-right text-sm text-gray-500 mt-1">0 / 400文字</div>
            </div>

                <!-- 送信ボタン -->
            <x-primary-button class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bodyTextarea = document.getElementById('body');
            const counter = document.getElementById('counter');
            const maxLength = 400;
            updateCounter();
            // テキストエリアの内容が変更されたらカウンターを更新
            bodyTextarea.addEventListener('input', updateCounter);
            function updateCounter() {
                const currentLength = bodyTextarea.value.length;
                counter.textContent = `${currentLength} / ${maxLength}文字`;
            }
        });
    </script>
</x-app-layout>