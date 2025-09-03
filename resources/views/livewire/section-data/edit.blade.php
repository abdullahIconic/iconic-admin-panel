@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $section->title,
        'parent' => 'Section Data',
        'parentRoute' => 'section-data',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('section-data.update', $section->id) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label" for="page">Page</label>
            <input type="text" class="form-control @error('page') is-invalid @enderror" name="page" value="{{ old('page', $section->page) }}" required readonly>
            @error('page')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="section">Section</label>
            <input type="text" class="form-control @error('section') is-invalid @enderror" name="section" id="section" placeholder="Section" value="{{ old('section', $section->section) }}" required readonly>
            @error('section')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title', $section->title) }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">URL</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="URL" value="{{ old('url', $section->url) }}">
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="label">Button Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" placeholder="Button Label" value="{{ old('label', $section->label) }}">
            @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="slogan">Slogan</label>
            <input type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" id="slogan" placeholder="Slogan" value="{{ old('slogan', $section->slogan) }}">
            @error('slogan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="image_alt">Image Alt</label>
            <input type="text" class="form-control @error('image_alt') is-invalid @enderror" name="image_alt" placeholder="Image Alt" value="{{ old('image_alt', $section->image_alt) }}">
            @error('image_alt')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12">
            <label class="form-label" for="overview">Overview</label>
            <textarea type="text" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Overview">{{ old('overview', $section->overview) }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>