@extends('layouts.app')

@section('content')
<div class="container">
    @if($privacyPolicy)
        <div class="card">
            <div class="card-body">
                <p class="card-text">{!! $privacyPolicy->privacy_policy !!}</p>
                <p class="card-text"><small class="text-muted">Status: {{ $privacyPolicy->statut }}</small></p>
            </div>
        </div>
    @else
        <p>No privacy policy found.</p>
    @endif
</div>
@endsection 