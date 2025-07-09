<x-insta-layout>
    <h2 class="text-2xl font-bold mb-4 py-4">Buat Postingan Baru</h2>

    <form method="POST" action="/posts" enctype="multipart/form-data" class="bg-white shadow mb-6 overflow-hidden max-w-[470px]">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 p-2">Caption</label>
            <textarea name="caption" rows="3" class="mt-1 block w-full rounded border-gray-100 shadow-sm focus:ring focus:ring-blue-200"></textarea>
            @error('caption')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="image" class="mt-1 block w-full text-sm">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Upload
            </button>
        </div>
    </form>
</x-insta-layout>
