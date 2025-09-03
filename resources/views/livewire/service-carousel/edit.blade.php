@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $title,
        'parent' => 'Service Carousel',
        'parentRoute' => 'service-carousel',
        'page' => 'edit',
    ])
@endsection

<form wire:submit.prevent="update" class="body">
    <div class="row g-3">
        
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">Target URL</label>
            <input wire:model="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="Target URL" value="{{ old('url') }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="carousel_for">Carousel For</label>
            <select wire:model="carousel_for" class="form-control @error('carousel_for') is-invalid @enderror" name="carousel_for" required>
                <option value="home">Home</option>
                <option value="solution">Solution</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
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
        <div class="">
            <label class="form-label" for="overview">Overview</label>
            <textarea wire:model="overview" type="text" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Description">{{ old('overview') }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>