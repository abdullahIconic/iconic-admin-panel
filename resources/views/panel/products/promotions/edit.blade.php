@extends('layouts.panel')

@section('content')

@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Edit' . ' - ' . $promotion->title,
        'parent' => 'Product Promotions',
        'parentRoute' => 'products.promotions',
        'page' => 'edit',
    ])
@endsection

<form action="{{route('products.promotions.update', $promotion->id)}}" method="POST" class="body" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div class="row g-3">
        
        <div class="col-md-2">
            <label class="form-label" for="visible">Visible?</label>
            <select wire:model="visible" class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                <option value="1" selected={{$promotion->visible}}>Yes</option>
                <option value="0" selected={{$promotion->visible}}>No</option>
            </select>
            @error('visible')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title', $promotion->title) }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Update</button>
</form>
@endsection