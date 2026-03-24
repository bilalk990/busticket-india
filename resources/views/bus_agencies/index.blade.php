@extends('layouts.app')
@section('title', 'Bus Agencies')
@section('content')

<main class="main-top">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Bus Agencies</h2>
                <p class="text-muted">Browse all available bus agencies and their routes</p>
            </div>

            @if($agencies->count())
                <div class="row g-4">
                    @foreach($agencies as $agency)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3 gap-3">
                                        @if(!empty($agency->agency_logo))
                                            <img src="{{ $agency->agency_logo }}"
                                                 alt="{{ $agency->agency_name }}"
                                                 class="rounded-circle object-fit-cover"
                                                 style="width:56px;height:56px;">
                                        @else
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold fs-4"
                                                 style="width:56px;height:56px;flex-shrink:0;">
                                                {{ strtoupper(substr($agency->agency_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h5 class="mb-0 fw-bold">{{ $agency->agency_name }}</h5>
                                            @if(!empty($agency->agency_type))
                                                <small class="text-muted">{{ $agency->agency_type }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    @if(!empty($agency->agency_description))
                                        <p class="text-muted small mb-3">{{ Str::limit($agency->agency_description, 100) }}</p>
                                    @endif

                                    <div class="d-flex gap-3 mb-3 text-muted small">
                                        <span><i class="bi bi-geo-alt me-1"></i>{{ $agency->routes_count }} routes</span>
                                        @if(!empty($agency->contact_phone))
                                            <span><i class="bi bi-telephone me-1"></i>{{ $agency->contact_phone }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 px-4 pb-4">
                                    <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => \Illuminate\Support\Str::slug($agency->agency_name)]) }}"
                                       class="btn btn-primary w-100">
                                        <i class="bi bi-eye me-1"></i> View Agency
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-building fs-1 text-muted"></i>
                    <p class="mt-3 text-muted">No agencies found.</p>
                </div>
            @endif
        </div>
    </section>
</main>

@endsection
