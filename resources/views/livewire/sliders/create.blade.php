@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Sliders',
        'parentRoute' => 'sliders',
        'page' => 'create',
    ])
@endsection

<form class="body" action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-md-1">
            <label class="form-label" for="visible">Visible</label>
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
        <div class="col-md-3">
            <label class="form-label" for="page_name">Page</label>
            <input wire:model="page_name" type="text" class="form-control @error('page_name') is-invalid @enderror" name="page_name" required>
            @error('page_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="slogan">Slogan</label>
            <input wire:model="slogan" type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" id="slogan" placeholder="Slogan" value="{{ old('slogan') }}">
            @error('slogan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-label" for="overview">Overview</label>
            <textarea wire:model="overview" type="text" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Overview">{{ old('overview') }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="slogan_color">Slogan Color</label>
            <input wire:model="slogan_color" type="color" class="form-control @error('slogan_color') is-invalid @enderror" name="slogan_color" id="slogan_color" placeholder="Slogan" value="{{ old('slogan_color') }}">
            @error('slogan_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="slogan_color">Slogan Color</label>
            <input wire:model="slogan_color" type="color" class="form-control @error('slogan_color') is-invalid @enderror" name="slogan_color" id="slogan_color" placeholder="Slogan" value="{{ old('slogan_color') }}">
            @error('slogan_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="title_color">Title Color</label>
            <input wire:model="title_color" type="color" class="form-control @error('title_color') is-invalid @enderror" name="title_color" id="title_color" placeholder="Title" value="{{ old('title_color') }}">
            @error('title_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="overview_color">Overview Color</label>
            <input wire:model="overview_color" type="color" class="form-control @error('overview_color') is-invalid @enderror" name="overview_color" id="overview_color" placeholder="Overview" value="{{ old('overview_color') }}">
            @error('overview_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="button_color">Button Color</label>
            <input wire:model="button_color" type="color" class="form-control @error('button_color') is-invalid @enderror" name="button_color" id="button_color" value="{{ old('button_color') }}">
            @error('button_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="label_color">Label Color</label>
            <input wire:model="label_color" type="color" class="form-control @error('label_color') is-invalid @enderror" name="label_color" id="label_color" value="{{ old('label_color') }}">
            @error('label_color')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="w-100"></div>
        <div class="col-md-4">
            <label class="form-label" for="link">URL</label>
            <input wire:model="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link" placeholder="URL" value="{{ old('link') }}">
            @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="link_text">URL Label</label>
            <input wire:model="link_text" type="text" class="form-control @error('link_text') is-invalid @enderror" name="link_text" id="link_text" placeholder="Label" value="{{ old('link_text') }}">
            @error('link_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>