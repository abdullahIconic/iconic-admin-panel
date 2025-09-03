@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Happy Clients',
        'parentRoute' => 'happy-clients',
        'page' => 'create',
    ])
@endsection

<form class="body" action="{{ route('happy-clients.store') }}" method="post" enctype="multipart/form-data">
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
            <label class="form-label" for="happy_for">Happy For?</label>
            <select class="form-control @error('happy_for') is-invalid @enderror" name="happy_for" required>
                <option value="lightning-protection-system">LPS</option>
                <option value="products">Products</option>
                <option value="calibration">Calibration</option>
                <option value="rental">Rental</option>
            </select>
            @error('happy_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="designation">Designation</label>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Designation" value="{{ old('designation') }}" required>
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="company">Company</label>
            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company" placeholder="Company" value="{{ old('company') }}" required>
            @error('company')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="comment">Comment</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" placeholder="Comment" required>{{ old('comment') }}</textarea>
            @error('comment')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>