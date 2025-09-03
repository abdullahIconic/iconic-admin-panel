@section('navbar')
@livewire('layout.navbar', [
'title' => 'Create',
'parent' => 'Clients',
'parentRoute' => 'clients',
'page' => 'create',
])
@endsection

<form class="body" action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-md-2">
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
        <div class="col-md-2">
            <label class="form-label" for="client_for">Clienr For?</label>
            <select class="form-control @error('client_for') is-invalid @enderror" name="client_for" required>
                <option value="lightning-protection-system">LPS</option>
                <option value="products">Products</option>
                <option value="calibration">Calibration</option>
                <option value="rental">Rental</option>
            </select>
            @error('client_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Name" value="{{ old('name') }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="website">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" id="website"
                placeholder="Ex: https://pico.com.bd" value="{{ old('website') }}">
            @error('website')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image"
                required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>