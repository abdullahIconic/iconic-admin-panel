@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Industries',
        'parentRoute' => 'industries',
        'page' => 'create',
    ])
@endsection

<form action="{{ route('industries.store') }}" class="body" enctype="multipart/form-data" method="post">
    @csrf

    <div class="row g-3">

        <div class="col-md-4">
            <label class="form-label" for="slogan">Slogan</label>
            <input class="form-control @error('slogan') is-invalid @enderror" id="slogan" name="slogan" placeholder="Slogan" required type="text" value="{{ old('slogan') }}" wire:model="slogan">
            @error('slogan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" required type="text" value="{{ old('title') }}" wire:model="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" placeholder="Meta Title" type="text" value="{{ old('meta_title') }}" wire:model="meta_title">
            @error('meta_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="url">Url</label>
            <input class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Url" required type="text" value="{{ old('url') }}" wire:model="url">
            @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select class="form-control @error('visible') is-invalid @enderror" name="visible" required wire:model="visible">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('visible')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label" for="category">Category</label>
            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required wire:model="category">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label" for="image">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" required type="file" wire:model="image">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-12" wire:ignore>
            <label class="form-label" for="article">Article</label>
            <textarea class="form-control tinymce" name="article" placeholder="Article" wire:model="article">{{ old('article') }}</textarea>
            @error('article')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description" type="text" wire:model="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" placeholder="Meta Description" type="text" wire:model="meta_description">{{ old('meta_description') }}</textarea>
            @error('meta_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_keywords">Meta keywords</label>
            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="Meta keywords" type="text" wire:model="meta_keywords">{{ old('meta_keywords') }}</textarea>
            @error('meta_keywords')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit" wire:loading.remove>Store</button>
</form>
