 <div class="sidebar">
        <h2 class="logo">DASHBOARD</h2>

     <a href="index.php" class="menu-link">👤 Users</a>
     <a href="products.php" class="menu-link">📦 Products</a>

     <div class="sidebar-footer">
            <small>Logged in: <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></small>
            <a href="logout.php" class="menu-link logout-link">🚪 Logout</a>
        </div>
    </div>


