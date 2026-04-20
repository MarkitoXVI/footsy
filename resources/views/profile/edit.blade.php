<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Footsy Fantasy Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a5ee5;
            --primary-dark: #2a48c5;
            --primary-light: #5b7ae8;
            --secondary: #34c759;
            --danger: #e53e3e;
            --dark: #1a2238;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
            --gradient-light: linear-gradient(135deg, #e8edff, #dce4ff);
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--dark);
            background: linear-gradient(135deg, #f0f4ff 0%, #e8edff 50%, #f5f7ff 100%);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            position: relative;
        }
        
        /* Background decoration */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(58, 94, 229, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(58, 94, 229, 0.05) 0%, transparent 50%),
                repeating-linear-gradient(45deg, rgba(58, 94, 229, 0.02) 0px, rgba(58, 94, 229, 0.02) 2px, transparent 2px, transparent 8px);
            pointer-events: none;
            z-index: 0;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, #1e2a4a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 25px rgba(58, 94, 229, 0.15);
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .sidebar-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .sidebar-title {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .sidebar-nav {
            padding: 1.5rem 0;
        }
        
        .nav-item {
            list-style: none;
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0.875rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            white-space: nowrap;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-family: inherit;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(58, 94, 229, 0.2);
            color: white;
            border-left-color: var(--primary);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        .nav-link span {
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed .nav-link span {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.875rem 1rem;
        }
        
        /* Burger Menu Button */
        .burger-menu {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .burger-menu i {
            font-size: 1.2rem;
            color: var(--dark);
        }
        
        .burger-menu:hover {
            background: rgba(58, 94, 229, 0.1);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed);
        }
        
        /* Header */
        .header {
            height: var(--header-height);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(58, 94, 229, 0.08);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .page-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 12px;
            transition: all 0.3s;
        }
        
        .user-profile:hover {
            background: rgba(58, 94, 229, 0.05);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.2);
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        /* Profile Content */
        .profile-content {
            padding: 2rem;
            flex: 1;
        }
        
        /* Profile Header */
        .profile-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            border: 1px solid rgba(58, 94, 229, 0.1);
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(58, 94, 229, 0.3);
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-info h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .profile-info p {
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        /* Profile Grid */
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }
        
        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(58, 94, 229, 0.08);
            border: 1px solid rgba(58, 94, 229, 0.1);
            transition: all 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 12px 30px rgba(58, 94, 229, 0.12);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .card-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid rgba(58, 94, 229, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Open Sans', sans-serif;
            margin-bottom: 1rem;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 94, 229, 0.1);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(58, 94, 229, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(58, 94, 229, 0.4);
        }
        
        .btn-danger {
            background: white;
            color: var(--danger);
            border: 2px solid var(--danger);
        }
        
        .btn-danger:hover {
            background: rgba(229, 62, 62, 0.1);
            transform: translateY(-2px);
        }
        
        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(52, 199, 89, 0.1), rgba(52, 199, 89, 0.05));
            color: var(--secondary);
            border: 1px solid rgba(52, 199, 89, 0.3);
        }
        
        .delete-form {
            display: none;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(58, 94, 229, 0.1);
        }
        
        .delete-form.active {
            display: block;
        }
        
        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .user-name {
                display: none;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            .profile-content {
                padding: 1rem;
            }
            
            .header {
                padding: 0 1rem;
            }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card, .profile-header {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>
</head>
<body>

@php $user = Auth::user(); @endphp

<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">F</div>
        <div class="sidebar-title">Footsy</div>
    </div>

    <ul class="sidebar-nav">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fantasy-team.index') }}" class="nav-link">
                <i class="fas fa-users"></i><span>My Team</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('leagues.index') }}" class="nav-link">
                <i class="fas fa-trophy"></i><span>Leagues</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('statistics.index') }}" class="nav-link">
                <i class="fas fa-chart-line"></i><span>Statistics</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('transfers.index') }}" class="nav-link">
                <i class="fas fa-exchange-alt"></i><span>Transfers</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fixtures.index') }}" class="nav-link">
                <i class="fas fa-calendar-alt"></i><span>Fixtures</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('help') }}" class="nav-link">
                <i class="fas fa-question-circle"></i><span>Help and Support</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link active">
                <i class="fas fa-user"></i><span>Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link" style="background:none;border:none;width:100%;text-align:left;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </li>
    </ul>
</aside>

<!-- MAIN -->
<div class="main-content" id="mainContent">
    <header class="header">
        <div class="header-left">
            <button class="burger-menu" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="user-profile">
            <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
            <div class="user-name">{{ $user->name }}</div>
        </div>
    </header>

    <div class="profile-content">
        <!-- PROFILE HEADER -->
        <div class="profile-header">
            <div class="profile-avatar">{{ substr($user->name, 0, 1) }}</div>
            <div class="profile-info">
                <h1>{{ $user->name }}</h1>
                <p><i class="fas fa-calendar-alt"></i> Member since {{ $user->created_at->format('F Y') }}</p>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>

        <!-- ALERT -->
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Profile updated successfully
            </div>
        @endif

        <div class="profile-grid">
            <!-- PROFILE FORM -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-user-edit"></i> Profile Information</h2>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        @error('name')
                            <div class="alert alert-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        @error('email')
                            <div class="alert alert-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </form>
            </div>

            <!-- PASSWORD -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-lock"></i> Update Password</h2>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password" placeholder="Enter current password" required class="form-control">
                        @error('current_password')
                            <div class="alert alert-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="password" name="password" type="password" placeholder="Enter new password" required class="form-control">
                        @error('password')
                            <div class="alert alert-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm new password" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key"></i> Update Password
                    </button>
                </form>
            </div>

            <!-- DELETE ACCOUNT -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-trash-alt"></i> Delete Account</h2>
                </div>

                <div class="alert alert-warning" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05)); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.3); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Once your account is deleted, all of its resources and data will be permanently deleted.</span>
                </div>

                <button type="button" class="btn btn-danger" onclick="toggleDeleteForm()">
                    <i class="fas fa-trash-alt"></i> Delete Account
                </button>

                <div id="deleteForm" class="delete-form">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="form-group">
                            <label for="delete_password">Confirm Password</label>
                            <input id="delete_password" name="password" type="password" required placeholder="Enter your password to confirm deletion" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-exclamation-triangle"></i> Permanently Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS FIXES -->
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('mainContent');
    const overlay = document.getElementById('overlay');

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    } else {
        sidebar.classList.toggle('collapsed');
        main.classList.toggle('expanded');
    }
}

function closeMobileSidebar() {
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('overlay').classList.remove('active');
}

// Fixed mobile click bug
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('sidebar');

    if (
        window.innerWidth <= 768 &&
        !sidebar.contains(e.target) &&
        !e.target.closest('.burger-menu')
    ) {
        sidebar.classList.remove('mobile-open');
        document.getElementById('overlay').classList.remove('active');
    }
});

// Fixed delete toggle
function toggleDeleteForm() {
    document.getElementById('deleteForm').classList.toggle('active');
}

// Only hide success alerts
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.alert-success').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
</script>

</body>
</html>