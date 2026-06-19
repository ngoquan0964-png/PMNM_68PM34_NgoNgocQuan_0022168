<style>
    .header {
        width: 100%;
        height: 65px;
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
        box-sizing: border-box;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }
    .header .logo {
        color: var(--primary-color);
        font-size: 20px;
        font-weight: 700;
        text-decoration: none;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .header .logo::before {
        content: "🎓";
        font-size: 24px;
    }
    .header .nav-container {
        display: flex;
        align-items: center;
        gap: 30px;
    }
    .header .nav-links {
        display: flex;
        gap: 8px;
    }
    .header .nav-links a {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: var(--radius-sm);
        transition: var(--transition);
    }
    .header .nav-links a:hover {
        color: var(--primary-color);
        background-color: rgba(79, 70, 229, 0.05);
    }
    .header .nav-links a.active {
        color: var(--primary-color);
        background-color: rgba(79, 70, 229, 0.1);
        font-weight: 600;
    }
    .header .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 1px solid var(--border-color);
        padding-left: 20px;
        font-size: 14px;
    }
    .header .user-name {
        font-weight: 600;
        color: var(--text-color);
    }
    .header .logout-btn {
        color: var(--danger-color);
        text-decoration: none;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: var(--radius-sm);
        border: 1px solid rgba(225, 29, 72, 0.2);
        transition: var(--transition);
    }
    .header .logout-btn:hover {
        background-color: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }
    
    <?php
        $current_uri = $_SERVER['REQUEST_URI'];
        $is_lophoc = (strpos($current_uri, '/lophoc') !== false);
        $is_sinhvien = (strpos($current_uri, '/sinhvien') !== false || $current_uri == '/');
    ?>
</style>
<div class="header">
    <a href="/sinhvien/index" class="logo">EduManager</a>
    <div class="nav-container">
        <div class="nav-links">
            <a href="/sinhvien/index" class="<?php echo $is_sinhvien ? 'active' : ''; ?>">Quản lý sinh viên</a>
            <a href="/lophoc/index" class="<?php echo $is_lophoc ? 'active' : ''; ?>">Quản lý lớp học</a>
        </div>
        
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <span>Chào, <span class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span></span>
                <!-- Let's add a logout functionality. Normally logout goes to /auth/logout or /home/logout -->
                <!-- We can look at how auth is handled, or we can check if they have a logout endpoint. -->
                <a href="/home/login" class="logout-btn" onclick="return confirm('Bạn muốn đăng xuất?');">Đăng xuất</a>
            </div>
        <?php endif; ?>
    </div>
</div>