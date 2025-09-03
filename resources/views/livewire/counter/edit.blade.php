@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $label,
        'parent' => 'Counter',
        'parentRoute' => 'counter',
        'page' => 'edit',
    ])
@endsection

<form wire:submit.prevent="update" class="body">
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="label">Label</label>
            <input wire:model="label" type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" placeholder="Label" value="{{ old('label') }}" required>
            @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="digit">Digit</label>
            <input wire:model="digit" type="text" class="form-control @error('digit') is-invalid @enderror" name="digit" id="digit" placeholder="Digit" value="{{ old('digit') }}" required>
            @error('digit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="counter_for">Counter For</label>
            <input wire:model="counter_for" type="text" class="form-control @error('counter_for') is-invalid @enderror" name="counter_for" required>
            @error('counter_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>