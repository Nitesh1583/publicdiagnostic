<!-- Menu -->
<section id="menu">
  <div class="header-container">
    <div class="header-navbar container padding-lr">
      <div class="left-section">
        <i data-lucide="menu" class="menu-icon" id="menuToggle"></i>
        <!-- <a href="#"><div class="app-logo"></div></a> -->
        <a href="#">
          <!-- Clinic / Hospital Name -->
          <h1 class="app-title red-text">{{ $doctor->clinic_name }}</h1> 
        </a>
      </div>

      <div class="right-section">
        <i data-lucide="bell" class="icon-btn"></i>
        @isset($doctor)
          <div class="profile">
              <a href="{{ route('doctors.profile.show', $doctor->id) }}">
                  {{-- DYNAMIC DOCTOR PHOTO - SAME AS PROFILE --}}
                  @if($doctor->photo)
                      <img src="{{ $doctor->photo_url ?: asset('storage/' . $doctor->photo) }}" 
                           alt="{{ $doctor->doctor_name }}" class="profile-img" />
                  @else
                      <img src="https://via.placeholder.com/40x40.png?text=D" 
                           alt="Doctor" class="profile-img" />
                  @endif
              </a>
          </div>
        @endisset
      </div>

    </div>
  </div>
</section>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <button class="close-btn" id="closeSidebar">
      <i data-lucide="x"></i>
    </button>

    {{-- DYNAMIC SIDEBAR PHOTO --}}
    
    @if(isset($doctor) && $doctor->photo)
      
      <img src="{{ $doctor->photo_url ?: asset('storage/' . $doctor->photo) }}" 
        alt="{{ $doctor->doctor_name }}" />
    
    @else
      
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" />
    
    @endif

    <h2>{{ isset($doctor) ? $doctor->doctor_name : '' }}</h2>

    <div class="subscription">
      Subscription expires on:
      <br /><span>28 Aug 2025</span>
    </div>

  </div>

  <ul class="menu">
    
    <a href="{{ route('doctors.profile.edit', $doctor->id) }}">
      <li>
        <i data-lucide="key"></i>
        <span>Change Password</span>
      </li>
    </a>

    <a href="#">
      <li>
        <i data-lucide="users"></i>
        <span>Refer and Earn</span>
      </li>
    </a>

    <a href="#">
      <li>
        <i data-lucide="gift"></i>
        <span>My Rewards</span>
      </li>
    </a>

    <a href="#">
      <li>
        <i data-lucide="share-2"></i>
        <span>Share</span>
      </li>
    </a>

    <a href="#">
      <li>
        <i data-lucide="info"></i>
        <span>About Us</span>
      </li>
    </a>
    
    <a href="#">
      <li>
        <i data-lucide="shield"></i>
        <span>Privacy Policy</span>
      </li>
    </a>

    <a href="#">
      <li>
        <i data-lucide="message-circle"></i>
        <span>Send Feedback</span>
      </li>
    </a>
    
    <a href="#">
      <li>
        <i data-lucide="sparkles"></i>
        <span>What's New</span>
      </li>
    </a>
    
    <li>
      <form method="POST" action="{{ route('doctors.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
            <i data-lucide="power"></i>
            <span>Logout</span>
        </button>
      </form>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="social-icons-container">
      <div>Version: 14.5.5</div>
      <div class="social-icons">
        <div>
          <a href="#">
            <img class="twitter-icon" src="assets/twitter.png" />
          </a>
        </div>
        <div>
          <a href="#">
            <img src="assets/facebook.png" />
          </a>
        </div>
        <div>
          <a href="#">
            <img src="assets/communication.png" />
          </a>
        </div>
      </div>
    </div>
  </div>
</aside>

<!-- OVERLAY -->
<div class="overlay" id="overlay"></div>