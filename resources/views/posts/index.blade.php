<x-insta-layout>
    <h2 class="text-2xl font-bold mb-4"></h2>

    @forelse ($posts as $post)
        <div class="bg-white shadow mb-6 overflow-hidden max-w-[470px]">
            <div class="p-4 border-b">
                <p class="text-sm text-gray-700">Diposting oleh <strong>{{ $post->user->name }}</strong> pada {{ $post->created_at->diffForHumans() }}</p>
            </div>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" 
                class="w-full max-w-[470px] object-cover mx-auto shadow">
            @endif
            <div class="p-4">
                @if ($post->user_id === auth()->id())
                    <div class="text-sm space-x-2">
                        <a href="/posts/{{ $post->id }}/edit" class="text-black-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182L6.75 19.963 3 21l1.037-3.75L16.862 3.487z" />
                            </svg>
                        </a>
                        <form method="POST" action="/posts/{{ $post->id }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-black-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18.75A2.25 2.25 0 008.25 21h7.5A2.25 2.25 0 0018 18.75V7.5H6v11.25zM9.75 10.5v6m4.5-6v6M15.75 6V4.875A1.875 1.875 0 0013.875 3h-3.75A1.875 1.875 0 008.25 4.875V6h7.5z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
                <p class="mb-2">{{ $post->caption }}</p>

                <div class="flex items-center gap-4 mb-4">
                    <form method="POST" action="/posts/{{ $post->id }}/like">
                        @csrf
                        <button class="text-sm text-gray-600 hover:underline">
                            ❤️
                        </button>
                        <div class="text-sm text-gray-600">
                            {{ $post->likes->count() }} Suka
                        </div>
                    </form>
                </div>

                <div class="border-t pt-2">
                    <h4 class="font-semibold text-sm mb-1">Komentar:</h4>
                    @foreach ($post->comments as $comment)
                        <div class="mb-1">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                        </div>
                    @endforeach

                    <form method="POST" action="/posts/{{ $post->id }}/comments" class="mt-2">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <input type="text" name="content" placeholder="Tulis komentar..." class="flex-grow px-3 py-2 border rounded-md" />
                            <button type="submit" class="btn btn-purple shadow-lg text-black px-4 py-2 rounded-md hover:bold hover:bg-gray-300 transition duration-300">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-600">Belum ada post.</p>
    @endforelse
</x-insta-layout>
