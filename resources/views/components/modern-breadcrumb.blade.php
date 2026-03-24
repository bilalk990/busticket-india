@props(['steps' => []])

<div class="modern-breadcrumb-bar">
    <div class="container">
        <nav class="breadcrumb-nav">
            @foreach($steps as $index => $step)
                <span class="breadcrumb-step{{ $step['active'] ? ' active' : '' }}">
                    {{ $step['title'] }}
                </span>
                @if($index < count($steps) - 1)
                    <span class="breadcrumb-chevron">&gt;</span>
                @endif
            @endforeach
        </nav>
    </div>
</div>

<style>
.modern-breadcrumb-bar {
    background: #1f75d8;
    padding: 0.5rem 0;
    margin-bottom: 1.5rem;
}
.breadcrumb-nav {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 500;
    color: #fff;
}
.breadcrumb-step {
    color: rgba(255,255,255,0.8);
    font-weight: 400;
    transition: color 0.2s;
}
.breadcrumb-step.active {
    color: #fff;
    font-weight: 700;
}
.breadcrumb-chevron {
    color: rgba(255,255,255,0.7);
    font-size: 1.1em;
    margin: 0 0.25rem;
    user-select: none;
}
@media (max-width: 768px) {
    .breadcrumb-nav {
        font-size: 0.95rem;
        flex-wrap: wrap;
    }
}
</style> 