<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
    {{-- CHAPTER10で追加 --}}
        @if(session('message'))
            <div class="p-4 m-2 rounded bg-blue-100">
                {{session('message')}}
            </div>
        @endif
        @foreach($posts as $post)
        <div class="mt-8 p-8 mx-auto max-w-7xl bg-white rounded-2xl">
            <h1 class="p-4 text-lg font-semibold">
                件名：
                <a href="{{ route('posts.show', $post) }}"
                class="text-blue-600 hover:text-blue-700">
                    {{ $post->title }}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{ $post->body }}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}} / {{$post->user->name}}
                </p>
            </div>
        </div>
        @endforeach
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>