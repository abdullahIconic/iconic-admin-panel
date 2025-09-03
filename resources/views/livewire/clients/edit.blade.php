@section('navbar')
@livewire('layout.navbar', [
'title' => 'Edit',
'parent' => 'Clients',
'parentRoute' => 'clients',
'page' => 'edit',
])
@endsection

<form class="body" action="{{ route('clients.update', $client->id) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="row g-3">
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1" {{$client->visible == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$client->visible == 0 ? 'selected' : ''}}>No</option>
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
                <option value="lightning-protection-system" {{$client->client_for == 'lightning-protection-system' ?
                    'selected' : ''}}>LPS</option>
                <option value="products" {{$client->client_for == 'products' ? 'selected' : ''}}>Products</option>
                <option value="calibration" {{$client->client_for == 'calibration' ? 'selected' : ''}}>Calibration
                </option>
                <option value="rental" {{$client->client_for == 'rental' ? 'selected' : ''}}>Rental</option>
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
                placeholder="Name" value="{{ old('name', $client->name) }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="website">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" id="website"
                placeholder="Ex: https://pico.com.bd" value="{{ old('website', $client->website) }}">
            @error('website')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>