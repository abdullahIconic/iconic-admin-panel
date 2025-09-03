@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'Solution Timeline',
        'parentRoute' => 'solutions.timeline',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('solutions.timeline.update', $timeline->id) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="row g-3">
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select wire:model="visible" class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('visible')
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
        <div class="w-full"></div>
        <div class="col-md-6">
            <label class="form-label" for="title_1">Title 1</label>
            <input wire:model="title_1" type="text" class="form-control @error('title_1') is-invalid @enderror" name="title_1" id="title_1" placeholder="Title" value="{{ old('title_1') }}" required>
            @error('title_1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="overview_1">Overview 1</label>
            <textarea wire:model="overview_1" type="text" class="form-control @error('overview_1') is-invalid @enderror" name="overview_1" id="overview_1" placeholder="Overview">{{ old('overview_1') }}</textarea>
            @error('overview_1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label" for="title_2">Title 2</label>
            <input wire:model="title_2" type="text" class="form-control @error('title_2') is-invalid @enderror" name="title_2" id="title_2" placeholder="Title" value="{{ old('title_2') }}" required>
            @error('title_2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="overview_2">Overview 2</label>
            <textarea wire:model="overview_2" type="text" class="form-control @error('overview_2') is-invalid @enderror" name="overview_2" id="overview_2" placeholder="Overview">{{ old('overview_2') }}</textarea>
            @error('overview_2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label" for="title_3">Title 3</label>
            <input wire:model="title_3" type="text" class="form-control @error('title_3') is-invalid @enderror" name="title_3" id="title_3" placeholder="Title" value="{{ old('title_3') }}" required>
            @error('title_3')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="overview_3">Overview 3</label>
            <textarea wire:model="overview_3" type="text" class="form-control @error('overview_3') is-invalid @enderror" name="overview_3" id="overview_3" placeholder="Overview">{{ old('overview_3') }}</textarea>
            @error('overview_3')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>