<x-insta-layout>
    <h2 class="text-2xl font-bold mb-4 py-4">Edit Postingan</h2>

    <form method="POST" action="/posts/{{ $post->id }}" class="bg-white shadow mb-6 overflow-hidden max-w-[470px]" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4 p-2">
            <label class="block text-sm font-medium text-gray-700">Caption</label>
            <textarea name="caption" rows="3" class="mt-1 block w-full rounded border-gray-100 shadow-sm focus:ring focus:ring-blue-200">{{ old('caption', $post->caption) }}</textarea>
            @error('caption')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 p-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
            <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="w-full max-w-[470px] rounded shadow mb-2">

            <label class="block text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>
            <input type="file" name="image" class="mt-1 block w-full text-sm">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end p-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Simpan Perubahan
            </button>
        </div>
    </form>
</x-insta-layout>
