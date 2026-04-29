<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <form method="POST" action="{{ route('admin.profil.update', $data->id) }}"
          id="form-profil" class="p-6">
        @csrf
        @method('PUT')

        <div class="space-y-5">

            {{-- Info Halaman --}}
            <div class="flex items-center gap-3 p-4 bg-sky-50 rounded-xl border border-sky-100">
                <div class="w-9 h-9 rounded-lg bg-sky-100 flex items-center justify-center text-lg">
                    {{ $icon ?? '📄' }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-sky-800">{{ $data->title }}</p>
                    <p class="text-xs text-sky-500">Slug: <code>/profil/{{ $data->slug }}</code></p>
                </div>
            </div>

            {{-- Toggle Aktif --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Tampilkan di halaman publik</p>
                    <p class="text-xs text-gray-400">Jika dimatikan, halaman ini tidak muncul di menu</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                           {{ $data->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer
                                peer-checked:bg-sky-500
                                peer-focus:ring-2 peer-focus:ring-sky-200
                                after:content-[''] after:absolute after:top-0.5 after:left-0.5
                                after:bg-white after:rounded-full after:h-5 after:w-5
                                after:transition-all peer-checked:after:translate-x-5">
                    </div>
                </label>
            </div>

            {{-- Konten CKEditor --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="15"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-colors
                                 @error('content') border-red-300 @enderror">{{ old('content', $data->content) }}</textarea>
                @error('content')
                    <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="#" onclick="window.history.back()"
               class="px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100
                      hover:bg-gray-200 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-semibold text-white bg-sky-500
                           hover:bg-sky-600 rounded-xl transition-colors shadow-sm shadow-sky-200">
                💾 Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    let myEditor;
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'id',
            placeholder: 'Tulis konten di sini...'
        })
        .then(editor => {
            myEditor = editor;
            document.getElementById('form-profil').addEventListener('submit', function () {
                document.querySelector('#content').value = myEditor.getData();
            });
        })
        .catch(error => console.error('CKEditor error:', error));
</script>
@endpush