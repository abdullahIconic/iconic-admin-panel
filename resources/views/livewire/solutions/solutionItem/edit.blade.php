@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'Solution Items',
        'parentRoute' => 'solutions.solution-items',
        'page' => 'edit',
    ])
@endsection

<form wire:submit.prevent="update" class="body">
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
            <input wire:model="slogan" type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" id="slogan" placeholder="Slogan" value="{{ old('slogan') }}" required>
            @error('slogan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="overview">Overview</label>
            <textarea wire:model="overview" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Overview" required>{{ old('overview') }}</textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>