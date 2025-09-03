@extends('layouts.panel')

@section('navbar')
    @livewire('layout.navbar')
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-light p-4 br1em">
                <div class="d-flex flex-column justify-content-between align-items-start gap-2">
                    <div class="fw-bold fs-3">
                        <small class="fw-normal text-muted">{{$services['visible']}}</small>
                        -
                        {{$services['hidden']}}
                    </div>
                    <div class="text-muted fs-6">Services</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#444" class="bi bi-basket3" viewBox="0 0 16 16">
                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z" />
                </svg>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-light p-4 br1em">
                <div class="d-flex flex-column justify-content-between align-items-start gap-2">
                    <div class="fw-bold fs-3">
                        <small class="fw-normal text-muted">{{$products['visible']}}</small>
                        -
                        {{$products['hidden']}}
                    </div>
                    <div class="text-muted fs-6">Products</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#444" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                </svg>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-light p-4 br1em">
                <div class="d-flex flex-column justify-content-between align-items-start gap-2">
                    <div class="fw-bold fs-3">
                        <small class="fw-normal text-muted">{{$blogs['visible']}}</small>
                        -
                        {{$blogs['hidden']}}
                    </div>
                    <div class="text-muted fs-6">Blog Posts</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#444" class="bi bi-book-half" viewBox="0 0 16 16">
                    <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                </svg>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-light p-4 br1em">
                <div class="d-flex flex-column justify-content-between align-items-start gap-2">
                    <div class="fw-bold fs-3">
                        <small class="fw-normal text-muted">{{$activities['visible']}}</small>
                        -
                        {{$activities['hidden']}}
                    </div>
                    <div class="text-muted fs-6">Activities</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#444" class="bi bi-activity" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
                </svg>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-light p-4 br1em">
                <div class="d-flex flex-column justify-content-between align-items-start gap-2">
                    <div class="fw-bold fs-3">
                        <small class="fw-normal text-muted">{{$offers['visible']}}</small>
                        -
                        {{$offers['hidden']}}
                    </div>
                    <div class="text-muted fs-6">Offers</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#444" class="bi bi-lightning" viewBox="0 0 16 16">
                    <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1H6.374z" />
                </svg>
            </div>
        </div>
    </div>
@endsection