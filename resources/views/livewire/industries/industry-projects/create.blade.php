@section('navbar')
@livewire('layout.navbar', [
'title' => 'Create',
'parent' => 'Industry Projects',
'parentRoute' => 'industries.projects',
'page' => 'create',
])
@endsection

<form class="body" action="{{ route('industries.projects.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input wire:model="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror"
                name="meta_title" id="meta_title" placeholder="Meta Title" value="{{ old('meta_title') }}">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">Url</label>
            <input wire:model="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                id="url" placeholder="Url" value="{{ old('url') }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="industry_id">Industry</label>
            <select wire:model="industry_id" class="form-control @error('industry_id') is-invalid @enderror" name="industry_id" id="industry_id" required>
                <option value="">-- Select Industry --</option>
                @foreach($industries as $industry)
                    <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                @endforeach
            </select>
            @error('industry_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="authored_by">Author</label>
            <select wire:model="authored_by" class="form-control @error('authored_by') is-invalid @enderror" name="authored_by" id="authored_by" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            @error('authored_by')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="isFeatured">Is Featured?</label>
            <select wire:model="isFeatured" class="form-control @error('isFeatured') is-invalid @enderror" name="isFeatured" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            @error('isFeatured')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="visible">Visible?</label>
            <select wire:model="visible" class="form-control @error('visible') is-invalid @enderror" name="visible"
                    required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12">
            <label class="form-label" for="image">Image</label>
            <input wire:model="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                id="image" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="description">Description</label>
            <textarea wire:model="description" type="text"
                class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                placeholder="Description">{{ old('description') }}</textarea>
            @error('description')
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
        <div class="col-md-12">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea wire:model="meta_description" type="text"
                class="form-control @error('meta_description') is-invalid @enderror" name="meta_description"
                id="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12">
            <label class="form-label" for="meta_keywords">Meta keywords</label>
            <textarea wire:model="meta_keywords" type="text"
                class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                placeholder="Meta keywords">{{ old('meta_keywords') }}</textarea>
            @error('meta_keywords')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button wire:loading.remove class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>
