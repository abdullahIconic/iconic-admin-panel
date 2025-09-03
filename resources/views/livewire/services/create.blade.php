@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Services',
        'parentRoute' => 'services',
        'page' => 'create',
    ])
@endsection

<form class="body" action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="slogan">Slogan</label>
            <input type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" id="slogan" placeholder="Slogan" value="{{ old('slogan') }}" required>
            @error('slogan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">Url</label>
            <input wire:model="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="Url" value="{{ old('url') }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="highlighted">Highlighted?</label>
            <select class="form-control @error('highlighted') is-invalid @enderror" name="highlighted" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            @error('highlighted')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select wire:model="visible" class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-5">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input wire:model="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{ old('meta_title') }}">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="category">Category</label>
            <select wire:model="category" class="form-control @error('category') is-invalid @enderror" name="category" id="category" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
            <small class="text-muted">Recommended Size: 500px x 500px</small>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12" wire:ignore>
            <label class="form-label" for="article">Article</label>
            <textarea class="form-control tinymce" name="article" placeholder="Article">{{ old('article') }}</textarea>
            @error('article')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea wire:model="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_keywords">Meta keywords</label>
            <textarea wire:model="meta_keywords" type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="Meta keywords">{{ old('meta_keywords') }}</textarea>
            @error('meta_keywords')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>