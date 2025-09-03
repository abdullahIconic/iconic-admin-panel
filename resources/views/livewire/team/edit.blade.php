@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit',
        'parent' => 'Team',
        'parentRoute' => 'team',
        'page' => 'edit',
    ])
@endsection

<form class="body" action="{{ route('team.update', $team->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

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
        <div class="col-md-1">
            <label class="form-label" for="expert">Is Expert</label>
            <select wire:model="expert" class="form-control @error('expert') is-invalid @enderror" name="expert" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            @error('expert')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="expert_in">Expert In</label>
            <select wire:model="expert_in" class="form-control @error('expert_in') is-invalid @enderror" name="expert_in" required>
                <option value="">Select</option>
                <option value="product">Product</option>
                <option value="service">Service</option>
                <option value="lightning-protection-system">LPS</option>
                <option value="calibration">Calibration</option>
            </select>
            @error('expert_in')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="name">Name</label>
            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="designation">Designation</label>
            <input wire:model="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Designation" value="{{ old('designation') }}">
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="image">Image</label>
            <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
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
        <div class="col-md-4">
            <label class="form-label" for="email">Email</label>
            <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="phone">Phone</label>
            <input wire:model="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="facebook">Facebook</label>
            <input wire:model="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" placeholder="Facebook" value="{{ old('facebook') }}">
            @error('facebook')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="twitter">Twitter</label>
            <input wire:model="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" id="twitter" placeholder="Facebook" value="{{ old('twitter') }}">
            @error('twitter')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="linkedin">LinkedIn</label>
            <input wire:model="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" id="linkedin" placeholder="Facebook" value="{{ old('linkedin') }}">
            @error('linkedin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="support">Support</label>
            <select wire:model="support" class="form-control @error('support') is-invalid @enderror" name="support" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('support')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="contact">Contact</label>
            <select wire:model="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

         <div class="col-md-4">
            <label class="form-label" for="button_text">Button Text</label>
            <input wire:model="button_text" type="text" class="form-control @error('button_text') is-invalid @enderror" name="button_text" id="button_text" placeholder="Button Text" value="{{ old('button_text') }}">
            @error('button_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label" for="contact_url">Contact Url</label>
            <input wire:model="contact_url" type="text" class="form-control @error('contact_url') is-invalid @enderror" name="contact_url" id="contact_url" placeholder="Contact Url" value="{{ old('contact_url') }}">
            @error('contact_url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label" for="support_text">Support Text</label>
            <textarea wire:model="support_text" type="text" class="form-control @error('support_text') is-invalid @enderror" name="support_text" id="support_text" placeholder="support text">{{ old('support_text') }}</textarea>
            @error('support_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>