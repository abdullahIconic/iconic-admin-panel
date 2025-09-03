@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'LPS Cards',
        'parentRoute' => 'lps.cards',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('lps.cards.update', $card->id) }}" method="post" enctype="multipart/form-data">
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
        <div class="col-md-2">
            <label class="form-label" for="page_name">LPS Type</label>
            <select wire:model="page_name" class="form-control @error('page_name') is-invalid @enderror" name="page_name" required>
                <option value="conventional">Conventional</option>
                <option value="digital">Digital</option>
            </select>
            @error('page_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="card_for">Card For</label>
            <select wire:model="card_for" class="form-control @error('card_for') is-invalid @enderror" name="card_for" required>
                <option value="">Select</option>
                <option value="design-consultency">Design & Consultency</option>
                <option value="installation">Installation</option>
                <option value="repair-maintenance">Repair & Maintenance</option>
                <option value="lps-videos">LPS Videos</option>
            </select>
            @error('card_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-1">
            <label class="form-label" for="card_type">Card Type</label>
            <select wire:model="card_type" class="form-control @error('card_type') is-invalid @enderror" name="card_type" required>
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>
            @error('card_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-5">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        @if($card_type == 'image')
        <div class="col-md-6">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @else
        <div class="col-md-6">
            <label class="form-label" for="url">YT Video Url</label>
            <input wire:model="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="https://www.youtube.com/watch?v=t8pPdKYpowI">
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @endif

        <div class="col-md-12">
            <label class="form-label" for="overview">Overview</label>
            <textarea wire:model="overview" type="text" class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" placeholder="Overview"></textarea>
            @error('overview')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>