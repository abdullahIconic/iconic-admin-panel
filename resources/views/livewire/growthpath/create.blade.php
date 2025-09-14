@section('navbar')
@livewire('layout.navbar', [
'title' => 'Create',
'parent' => 'Growth Path',
'parentRoute' => 'growthpaths',
'page' => 'create',
])
@endsection

<form class="body" action="{{ route('growthpaths.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
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
             <div class="col-md-1">
            <label class="form-label" for="year">Year</label>
            <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year"
                placeholder="Ex: 2020" value="{{ old('year') }}">
            @error('year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-5">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-5">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image"
                required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12">
            <label class="form-label" for="image">Description</label>
            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>
