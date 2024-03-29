@extends('layouts.app-admin')

@section('title', 'FAQ')

@section('admin')
    <div class="lg:ml-5 mt-3">
        <div class="flex gap-3 items-center">
            <x-link to="{{ url('admin/faq') }}" size="lg" icon="fa-chevron-left mr-1" text="Kembali" padding="py-2 px-4"
                color="blue" />
            <div class="text-lg font-medium">{{ isset($item) ? 'Edit' : 'Tambah' }} Pertanyaan FAQ</div>
        </div>

        <div class="max-w-2xl mt-3 p-4 bg-white shadow-md rounded-md">
            <form class="space-y-4" action="{{ isset($item) ? url('/admin/faq/' . $item->id) : url('/admin/faq') }}"
                method="POST" enctype="multipart/form-data">
                @if (isset($item))
                    @method('PUT')
                @endif
                @csrf
                <div>
                    <div class="space-y-2">
                        <div>
                            <label for="question" class="block mb-2 text-sm font-medium text-slate-900">Pertanyaan</label>
                            <textarea name="question" id="editor1">{{ isset($item) ? $item->question : '' }}</textarea>
                            @error('question')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="answer" class="block mb-2 text-sm font-medium text-slate-900">Jawaban</label>
                            <textarea name="answer" id="editor2">{{ isset($item) ? $item->answer : '' }}</textarea>
                            @error('answer')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    <span><i class="fa-solid fa-check mr-1"></i></span>
                    Submit
                </button>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
    </script>
@endpush
