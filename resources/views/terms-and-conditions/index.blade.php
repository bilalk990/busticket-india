@extends('layouts.app')

@section('content')
<div class="container">
    @if($termsAndCondition)
        <div class="card">
            <div class="card-body">
                <p class="card-text">{!! $termsAndCondition->terms !!}</p>
                <p class="card-text"><small class="text-muted">Status: {{ $termsAndCondition->statut }}</small></p>
            </div>
        </div>
    @else
        <p>No terms and conditions found.</p>
    @endif
</div>
@endsection 