@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $question,
        'parent' => 'Faq',
        'parentRoute' => 'faq',
        'page' => 'edit',
    ])
@endsection

<form wire:submit.prevent="update" class="body">
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="faq_for">FAQ For</label>
            <input wire:model="faq_for" type="text" class="form-control @error('faq_for') is-invalid @enderror" name="faq_for" id="faq_for" placeholder="products" value="{{ old('faq_for') }}" required>
            @error('faq_for')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label" for="question">Question</label>
            <input wire:model="question" type="text" class="form-control @error('label') is-invalid @enderror" name="question" id="question" placeholder="Question" value="{{ old('label') }}" required>
            @error('label')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <label class="form-label" for="answer">Answer</label>
            <textarea wire:model="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" id="answer" placeholder="Answer" required>{{ old('answer') }}</textarea>
            @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>