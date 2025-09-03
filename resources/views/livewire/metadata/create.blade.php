@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Metadata',
        'parentRoute' => 'metadata',
        'page' => 'create',
    ])
@endsection

<form wire:submit.prevent="store" class="body">
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
            <label class="form-label" for="carousel_for">Page Name</label>
            <input wire:model="page_name" type="text" class="form-control @error('page_name') is-invalid @enderror" name="page_name" id="page_name" placeholder="Page Name" value="{{ old('page_name') }}" required>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="description">Description</label>
            <textarea wire:model="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="keywords">Keywords</label>
            <textarea wire:model="keywords" type="text" class="form-control @error('keywords') is-invalid @enderror" name="keywords" id="keywords" placeholder="Separated by comma (,)">{{ old('keywords') }}</textarea>
            @error('keywords')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>