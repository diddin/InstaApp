<x-insta-layout>
    <h2 class="text-2xl font-bold mb-4"></h2>

    @forelse ($posts as $post)
        <div class="bg-white shadow rounded-lg mb-6 overflow-hidden">
            <div class="p-4 border-b">
                <p class="text-sm text-gray-700">Diposting oleh <strong>{{ $post->user->name }}</strong> pada {{ $post->created_at->diffForHumans() }}</p>
            </div>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full object-cover">
            @endif
            <div class="p-4">
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
        @if ($post->user_id === auth()->id())
            <div class="text-sm space-x-2">
                <a href="/posts/{{ $post->id }}/edit" class="text-blue-500 hover:underline">Edit</a>

                <form method="POST" action="/posts/{{ $post->id }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline">Hapus</button>
                </form>
            </div>
        @endif
    @empty
        <p class="text-gray-600">Belum ada post.</p>
    @endforelse
</x-insta-layout>
