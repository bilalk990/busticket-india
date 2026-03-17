@extends('layouts.app')
@section('content')
<main class="main-top">
 @include('bus.partials.search-form')
    <section class="results-section">
        <div class="container-fluid px-4">
            <div class="row g-4">
                <!-- Filters Column -->
                <div class="col-lg-3 col-xl-3 filters-column">
                    <div class="sticky-top" style="top: 20px;">
                 @include('bus.partials.filters') 
            </div>
                </div>
                
                <!-- Results List Column -->
                <div class="col-lg-6 col-xl-6 results-list-column">
                    <!-- Results Header -->
                    <div class="results-header mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="results-title">
                                <h4 class="mb-1 fw-bold">Available Buses</h4>
                                <p class="text-muted mb-0">
                                    <span class="results-count">{{ count($schedules) }} buses found</span>
                                    from <strong>{{ request('origin') }}</strong> to <strong>{{ request('destination') }}</strong>
                                </p>
                            </div>
                            <div class="quick-filters d-flex gap-2">
                            <button class="btn btn-quick-filter active" type="button" data-filter="all">
                                    <i class="bi bi-grid me-1"></i>All
                            </button>
                            <button class="btn btn-quick-filter" type="button" data-filter="cheapest">
                                    <i class="bi bi-tag me-1"></i>Cheapest
                                    @if(isset($cheapest_fare))
                                    <span class="badge bg-success-subtle text-success ms-1">{{ $cheapest_fare }}</span>
                                @endif
                            </button>
                            <button class="btn btn-quick-filter" type="button" data-filter="fastest">
                                    <i class="bi bi-lightning me-1"></i>Fastest
                                @if(isset($fastest_duration))
                                <span class="badge bg-info-subtle text-info ms-1">{{ $fastest_duration }}</span>
                                @endif
                            </button>
                            <button class="btn btn-quick-filter" type="button" data-filter="rating">
                                    <i class="bi bi-star me-1"></i>Top Rated
                                    </button>
                            </div>
                        </div>
                    </div>

                    <!-- Results Container -->
                    <div class="results-container">
                        @include('bus.partials.result_list')
            </div>
                </div>
                
                <!-- Map Column -->
                <div class="col-lg-3 col-xl-3 map-column">
                    <div class="sticky-top" style="top: 20px;">
                @include('bus.partials.bus-results-map')
        </div>
    </div>
            </div>
        </div>
    </section>
</main>

    <style>
    /* General Styles */
    .main-top {
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .results-section {
        padding: 2rem 0 3rem;
    }
    
/* Results Header */
    .results-header {
    background: #fff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
.results-title h4 {
    color: #1f75d8;
}

/* Quick Filters */
.quick-filters {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-quick-filter {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    color: #6c757d;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-quick-filter:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}

.btn-quick-filter.active {
    background: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

.btn-quick-filter .badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    border-radius: 6px;
}

/* Results Container */
    .results-container {
        /* max-height: calc(100vh - 300px); */
        /* overflow-y: auto; */
        scrollbar-width: thin;
        scrollbar-color: #6c757d #f8f9fa;
        padding-right: 10px;
    }
    
    .results-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .results-container::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 10px;
    }
    
    .results-container::-webkit-scrollbar-thumb {
        background-color: #6c757d;
        border-radius: 10px;
    }
    
/* Schedule Card */
.schedule-card {
    background: #fff;
        border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.schedule-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Badges */
.badge {
        font-weight: 500;
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    border-radius: 6px;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1);
}

.text-success {
    color: #198754 !important;
}

.text-info {
    color: #0dcaf0 !important;
        }
    
/* Loading State */
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    border-radius: 12px;
    backdrop-filter: blur(2px);
    transition: opacity 0.3s ease;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #0d6efd;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        /* .results-container, .results-map {
            max-height: 60vh;
            height: 60vh;
        } */
        
        .sticky-top {
            position: relative !important;
            top: 0 !important;
        }
        
        .results-section {
            padding: 1.5rem 0 2rem;
        }

    .quick-filters {
        overflow-x: auto;
        white-space: nowrap;
        padding: 1rem;
    }

    .btn-quick-filter {
        white-space: nowrap;
        }
    }
    
    @media (max-width: 767.98px) {
        .results-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .results-header .d-flex {
            margin-top: 1rem;
            width: 100%;
            justify-content: space-between;
        }

    .btn-sort {
        min-width: 140px;
    }

    .results-subtitle {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.schedule-card {
    animation: fadeIn 0.3s ease-out;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Show loading overlay
    function showLoading() {
        const overlay = document.createElement('div');
        overlay.className = 'loading-overlay';
        overlay.innerHTML = '<div class="loading-spinner"></div>';
        document.querySelector('.results-container').appendChild(overlay);
    }

    // Hide loading overlay
    function hideLoading() {
        const overlay = document.querySelector('.loading-overlay');
        if (overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => overlay.remove(), 200);
        }
    }

    // Helper: Update results count
    function updateResultsCount() {
        const visible = document.querySelectorAll('.results-container .schedule-card:not([style*="display: none"])').length;
        const resultsCount = document.querySelector('.results-count');
        if (resultsCount) {
            resultsCount.textContent = `${visible} buses found`;
        }
    }

    // Quick filter logic
    function applyQuickFilter(filterType) {
        const schedules = document.querySelectorAll('.schedule-card');
        schedules.forEach(schedule => {
            let show = true;
            switch(filterType) {
                case 'cheapest':
                    const minFare = Math.min(...Array.from(schedules).map(s => parseFloat(s.dataset.convertedFare)));
                    show = parseFloat(schedule.dataset.convertedFare) === minFare;
                    break;
                case 'fastest':
                    const minDuration = Math.min(...Array.from(schedules).map(s => parseInt(s.dataset.duration)));
                    show = parseInt(schedule.dataset.duration) === minDuration;
                    break;
                case 'rating':
                    const maxRating = Math.max(...Array.from(schedules).map(s => parseFloat(s.dataset.rating) || 0));
                    show = parseFloat(schedule.dataset.rating) === maxRating;
                    break;
                case 'all':
                default:
                    show = true;
            }
            schedule.style.display = show ? 'block' : 'none';
            if (show) {
                schedule.style.animation = 'fadeIn 0.3s ease-out';
            }
        });
        updateResultsCount();
    }

    // Add click event listeners to quick filter buttons
    document.querySelectorAll('.btn-quick-filter').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.btn-quick-filter').forEach(btn => {
                btn.classList.remove('active');
            });
            // Add active class to clicked button
            this.classList.add('active');
            // Apply filter
            applyQuickFilter(this.dataset.filter);
        });
    });
});
</script>

@endsection
