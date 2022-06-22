<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{route('dashboard')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Records</li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('places.main')}}">
        <i class="menu-icon mdi mdi-folder-multiple-image"></i>
        <span class="menu-title">Places</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('reviews.main')}}">
        <i class="menu-icon mdi mdi-comment-plus-outline"></i>
        <span class="menu-title">Reviews</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('dev')}}">
        <i class="menu-icon mdi mdi-account-multiple"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('dev')}}">
        <i class="menu-icon mdi mdi-help-circle"></i>
        <span class="menu-title">Tips</span>
      </a>
    </li>
    <li class="nav-item nav-category">EndPoints</li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('endpoints.main')}}">
        <i class="menu-icon mdi mdi-code-tags"></i>
        <span class="menu-title">APIs</span>
      </a>
    </li>
  </ul>
</nav>