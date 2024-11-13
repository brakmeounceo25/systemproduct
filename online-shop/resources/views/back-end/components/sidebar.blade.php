<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="{{ asset('back-end/assets/images/faces/face8.jpg') }}" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ (Auth::check()) ? Auth::user()->name : 'Example' }}</p>
            <p class="designation">{{ (Auth::check()) == 1 ? 'Admin' : 'User' }}</p>
          </div>
        </a>
      </li>
      <li class="nav-item nav-category">Main Menu</li>
      {{-- Dashboard --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      {{-- Products --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('product.index') }}">
          <i class="menu-icon typcn typcn-shopping-bag"></i>
          <span class="menu-title">Products</span>
        </a>
      </li>
      {{-- Category --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('category.index') }}">
          <i class="menu-icon typcn typcn-th-large-outline"></i>
          <span class="menu-title">Categories</span>
        </a>
      </li>
      {{-- Branding --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('brand.index') }}">
          <i class="menu-icon typcn typcn-th-large-outline"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>
      {{-- Products --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('color.index') }}">
          <i class="menu-icon typcn typcn-th-large-outline"></i>
          <span class="menu-title">Colors</span>
        </a>
      </li>
    </ul>
  </nav>
  