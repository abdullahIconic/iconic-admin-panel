@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'Happy Clients',
        'parentRoute' => 'happy-clients',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('happy-clients.update', $client->id) }}" method="post" enctype="multipart/form-data">
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
            <label class="form-label" for="happy_for">Happy For?</label>
            <select class="form-control @error('happy_for') is-invalid @enderror" name="happy_for" required>
                <option value="lightning-protection-system" {{$client->happy_for == 'lightning-protection-system' ? 'selected' : ''}}>LPS</option>
                <option value="products" {{$client->happy_for == 'products' ? 'selected' : ''}}>Products</option>
                <option value="calibration" {{$client->happy_for == 'calibration' ? 'selected' : ''}}>Calibration</option>
                <option value="rental" {{$client->happy_for == 'rental' ? 'selected' : ''}}>Rental</option>
            </select>
            @error('happy_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name', $client->name) }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="designation">Designation</label>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Designation" value="{{ old('designation', $client->designation) }}" required>
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="company">Company</label>
            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company" placeholder="Company" value="{{ old('company', $client->company) }}" required>
            @error('company')
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
        <div class="">
            <label class="form-label" for="comment">Comment</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" placeholder="Comment" required>{{ old('comment', $client->comment) }}</textarea>
            @error('comment')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>