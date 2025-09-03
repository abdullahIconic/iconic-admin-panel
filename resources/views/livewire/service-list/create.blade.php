@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Service List',
        'parentRoute' => 'service-list',
        'page' => 'create',
    ])
@endsection

<form class="body" action="{{ route('service-list.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-md-1">
            <label class="form-label" for="service_for">Page</label>
            <select class="form-control @error('service_for') is-invalid @enderror" name="service_for" required>
                <option value="home">Home</option>
                <option value="solution">Solution</option>
                <option value="about">About</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="identifier">Identifier</label>
            <input type="text" class="form-control @error('identifier') is-invalid @enderror" name="identifier" id="identifier" placeholder="Identifier" value="{{ old('identifier') }}" required>
            @error('identifier')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-1">
            <label class="form-label" for="visible">Visible?</label>
            <select class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('visible')
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
        <div class="col-12">
            <label class="form-label" for="services">Services</label>
            <textarea type="text" class="form-control @error('services') is-invalid @enderror" name="services" id="services" placeholder="Separated by (,)">{{ old('services') }}</textarea>
            @error('services')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="overview">Overview</label>
            <textarea type="text" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Description">{{ old('overview') }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="caption">Caption</label>
            <textarea type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" id="caption" placeholder="Caption">{{ old('caption') }}</textarea>
            @error('caption')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>