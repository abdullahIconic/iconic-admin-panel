@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Service Safety',
        'parentRoute' => 'services.safety',
        'page' => 'create',
    ])
@endsection

<form wire:submit.prevent="store" class="body">
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
            <label class="form-label" for="slogan">Slogan</label>
            <input wire:model.lazy="slogan" type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" id="slogan" placeholder="Slogan" value="{{ old('slogan') }}">
            @error('slogan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model.lazy="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">URL</label>
            <input wire:model.lazy="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="URL" value="{{ old('url') }}">
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="label">Label</label>
            <input wire:model.lazy="label" type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" placeholder="Label" value="{{ old('label') }}" required>
            @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="overview">Overview</label>
            <textarea wire:model.lazy="overview" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Overview" required>{{ old('overview') }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>