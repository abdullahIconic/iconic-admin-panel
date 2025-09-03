@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Site Informations',
        'parent' => 'Dashboard',
        'parentRoute' => 'dashboard',
        'page' => 'index',
    ])
@endsection

<form wire:submit.prevent="update" class="body">
    <div class="row g-4">
        <div class="col-md-4">
            <label class="form-label" for="organization">Organization Name</label>
            <input wire:model="organization" type="text" class="form-control @error('organization') is-invalid @enderror" name="organization" placeholder="Organization" maxlength="255">
            @error('organization')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="mobile">Mobile</label>
            <input wire:model="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="mobile" maxlength="255">
            @error('mobile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="email">Email</label>
            <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email" maxlength="255">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="facebook">Facebook</label>
            <input wire:model="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" placeholder="facebook" maxlength="255">
            @error('facebook')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="twitter">Twitter</label>
            <input wire:model="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" placeholder="twitter" maxlength="255">
            @error('twitter')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="linkedin">LinkedIn</label>
            <input wire:model="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="linkedin" maxlength="255">
            @error('linkedin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="pinterest">Pinterest</label>
            <input wire:model="pinterest" type="text" class="form-control @error('pinterest') is-invalid @enderror" name="pinterest" placeholder="pinterest" maxlength="255">
            @error('pinterest')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="youtube">YouTube</label>
            <input wire:model="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" placeholder="youtube" maxlength="255">
            @error('youtube')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="whatsapp">WhatsApp</label>
            <input wire:model="whatsapp" type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" placeholder="whatsapp" maxlength="255">
            @error('whatsapp')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="instagram">Instagram</label>
            <input wire:model="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="instagram" maxlength="255">
            @error('instagram')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="tumblr">Tumblr</label>
            <input wire:model="tumblr" type="text" class="form-control @error('tumblr') is-invalid @enderror" name="tumblr" placeholder="tumblr" maxlength="255">
            @error('tumblr')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="portfolio">Portfolio</label>
            <input wire:model="portfolio" type="text" class="form-control @error('portfolio') is-invalid @enderror" name="portfolio" placeholder="Portfolio" maxlength="255">
            @error('portfolio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12">
            <label class="form-label" for="address">Corporate Headquarter</label>
            <input wire:model="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="address" maxlength="255">
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="address2">Display Center</label>
            <input wire:model="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" placeholder="address2" maxlength="255">
            @error('address2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="address3">Chattagram Office</label>
            <input wire:model="address3" type="text" class="form-control @error('address3') is-invalid @enderror" name="address3" placeholder="address3" maxlength="255">
            @error('address3')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="d-flex align-items-center gap-3 mt-3">
        <button type="submit" class="btn btn-dark px-5">Update</button>
        @if(session('success'))
            <span class="btn alert-success px-5" role="alert">
                <strong>{{ session('success') }}</strong>
            </span>
        @endif
    </div>
</form>