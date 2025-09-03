@extends('layouts.panel')

@section('content')

@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Product Promotions',
        'parentRoute' => 'products.promotions',
        'page' => 'create',
    ])
@endsection

<form action="{{route('products.promotions.store')}}" method="POST" class="body" enctype="multipart/form-data">
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
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>
@endsection