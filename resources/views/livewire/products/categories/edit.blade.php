@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $title,
        'parent' => 'Categories',
        'parentRoute' => 'products.categories',
        'page' => 'edit',
    ])
@endsection

<form action="{{route('products.categories.update', $category->id)}}" method="post" enctype="multipart/form-data" class="body">
    @csrf
    @method('patch')

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title', $category->title) }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{ old('meta_title', $category->meta_title) }}">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">Url</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="Url" value="{{ old('url', $category->url) }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="visible">Visible?</label>
            <select class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1" {{$category->visible == 1 ? "selected" : ""}}>Yes</option>
                <option value="0" {{$category->visible == 0 ? "selected" : ""}}>No</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image_1">Image 1</label>
            <input type="file" class="form-control @error('image_1') is-invalid @enderror" name="image_1" id="image_1">
            @error('image_1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image_2">Image 2</label>
            <input type="file" class="form-control @error('image_2') is-invalid @enderror" name="image_2" id="image_2">
            @error('image_2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="description">Description</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description', $category->description) }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Meta Description">{{ old('meta_description', $category->meta_description) }}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="meta_keywords">Meta keywords</label>
            <textarea type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="Meta keywords">{{ old('meta_keywords', $category->meta_keywords) }}</textarea>
            @error('meta_keywords')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>