@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'Popup',
        'parentRoute' => 'popup',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('popup.update', $popup->id) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="row g-3">
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1" {{ $popup->visible == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $popup->visible == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title', $popup->title) }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-5">
            <label class="form-label" for="url">Url</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="Url" value="{{ old('url', $popup->url) }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="starting_date">Starting Date</label>
            <input type="date" class="form-control @error('starting_date') is-invalid @enderror" name="starting_date" id="starting_date" placeholder="Price" value="{{ old('starting_date', $popup->starting_date) }}" required>
            @error('starting_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="ending_date">Ending Date</label>
            <input type="date" class="form-control @error('ending_date') is-invalid @enderror" name="ending_date" id="ending_date" placeholder="Discount" value="{{ old('ending_date', $popup->ending_date) }}" required>
            @error('ending_date')
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