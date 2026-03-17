<style>
:root {
    --primary: #1f75d8;
    --primary-light: #f8f5ff;
    --primary-dark: #5a3d7a;
    --gray: #495057;
    --gray-light: #f8f9fa;
    --gray-lighter: #e9ecef;
    --gray-dark: #343a40;
    --white: #ffffff;
    --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.account-sidebar-card {
    background: var(--white);
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-lighter);
  padding: 0;
    transition: var(--transition);
}

.account-sidebar-card:hover {
    box-shadow: var(--shadow-md);
}

.account-sidebar-avatar {
    width: 72px;
    height: 72px;
  object-fit: cover;
  border-radius: 50%;
    border: 2px solid var(--white);
    box-shadow: var(--shadow-sm);
    background: var(--primary-light);
    font-size: 2rem;
    color: var(--primary);
  display: flex;
  align-items: center;
  justify-content: center;
    margin: 0 auto 0.75rem auto;
    transition: var(--transition);
}

.account-sidebar-avatar:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-md);
}

.account-sidebar-name {
    font-size: 1.1rem;
  font-weight: 600;
    color: var(--gray-dark);
    margin-bottom: 0.2rem;
    transition: color 0.3s ease;
}

.account-sidebar-email {
    color: var(--gray);
    font-size: 0.85rem;
  font-weight: 400;
    margin-bottom: 1.25rem;
}

.account-sidebar-edit-btn {
    font-size: 0.85rem;
    border-radius: 0.75rem;
    padding: 0.4rem 1rem;
  font-weight: 500;
    margin-bottom: 1.25rem;
    transition: var(--transition);
    border: 1px solid var(--primary);
    background: transparent;
    color: var(--primary);
}

.account-sidebar-edit-btn:hover {
    background: var(--primary);
    color: var(--white);
    transform: translateY(-1px);
}

.account-sidebar-nav {
    margin-top: 0.75rem;
}

.account-sidebar-link {
  display: flex;
  align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
    color: var(--gray);
    font-weight: 500;
    border-radius: 0.75rem;
    padding: 0.6rem 1rem;
    margin-bottom: 0.4rem;
    transition: var(--transition);
  text-decoration: none;
    position: relative;
    overflow: hidden;
}

.account-sidebar-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: var(--primary);
    border-radius: 0 3px 3px 0;
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.account-sidebar-link i {
    font-size: 1.1rem;
    color: var(--gray);
    transition: var(--transition);
    width: 20px;
    text-align: center;
}

.account-sidebar-link.active, 
.account-sidebar-link:hover {
    background: var(--primary-light);
    color: var(--primary);
    transform: translateX(3px);
}

.account-sidebar-link.active::before, 
.account-sidebar-link:hover::before {
    transform: scaleY(1);
}

.account-sidebar-link.active i, 
.account-sidebar-link:hover i {
    color: var(--primary);
    transform: scale(1.05);
}

.account-sidebar-logout {
    color: var(--gray) !important;
    background: var(--gray-light);
    border-radius: 0.75rem;
  font-weight: 500;
    margin-top: 0.75rem;
    padding: 0.6rem 1rem;
  border: none;
  width: 100%;
  text-align: left;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
}

.account-sidebar-logout:hover {
    background: var(--gray);
    color: var(--white) !important;
    transform: translateY(-1px);
}

.account-sidebar-logout i {
    color: inherit;
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

.account-sidebar-divider {
    height: 1px;
    background: var(--gray-lighter);
    margin: 1.25rem 0;
    opacity: 0.5;
}

@media (max-width: 991.98px) {
    .account-sidebar-card { 
        border-radius: 0.75rem;
        margin: 0.75rem;
    }
    
    .account-sidebar-avatar {
        width: 64px;
        height: 64px;
        font-size: 1.75rem;
    }
}
</style>

<div class="col-lg-4 col-xl-3">
    <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasSidebar">
        <div class="pb-2 offcanvas-header justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
        </div>
        <div class="p-3 offcanvas-body p-lg-0">
            <div class="account-sidebar-card">
                <div class="card-body p-3">
                    <div class="text-center mb-3">
                        <div class="position-relative d-inline-block mb-2">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="User Avatar" class="account-sidebar-avatar">
                            @else
                                <div class="account-sidebar-avatar">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-2 border-white" style="width: 14px; height: 14px;"></div>
                        </div>
                        <div class="account-sidebar-name">{{ auth()->user()->name }}</div>
                        <div class="account-sidebar-email">{{ auth()->user()->email }}</div>
                        <a href="profile" class="btn account-sidebar-edit-btn">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                    
                    <div class="account-sidebar-nav">
                        <a class="account-sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                            <i class="fas fa-th-large"></i>
                            <span>Dashboard</span>
                        </a>
                        <a class="account-sidebar-link {{ request()->is('profile') ? 'active' : '' }}" href="profile">
                            <i class="fas fa-user-circle"></i>
                            <span>My Profile</span>
                        </a>
                        <a class="account-sidebar-link {{ request()->is('my-bookings') ? 'active' : '' }}" href="my-bookings">
                            <i class="fas fa-calendar-check"></i>
                            <span>My Bookings</span>
                        </a>    
                        <a class="account-sidebar-link {{ request()->is('passenger-details') ? 'active' : '' }}" href="">
                            <i class="fas fa-users"></i>
                            <span>Passenger Details</span>
                        </a>
                        <a class="account-sidebar-link {{ request()->is('settings') ? 'active' : '' }}" href="settings">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                        <a class="account-sidebar-link {{ request()->is('delete-account') ? 'active' : '' }}" href="delete-account">
                            <i class="fas fa-trash-alt"></i>
                            <span>Delete Profile</span>
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="account-sidebar-logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

