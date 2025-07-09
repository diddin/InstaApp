<x-insta-layout>
    <h2 class="text-2xl font-bold mb-4">Edit Post</h2>

    <form method="POST" action="/posts/{{ $post->id }}" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Caption</label>
            <textarea name="caption" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-200">{{ old('caption', $post->caption) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Simpan
            </button>
        </div>
    </form>
</x-insta-layout>
