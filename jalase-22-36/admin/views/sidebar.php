<div class="sidebar">
    <div class="sidebar-header">
        <h2>Welcome <?php echo "admin" ?></h2>
    </div >
    <ul class="menu">
        <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" >⏲ Dashboard</a></li>
        <li><a href="blog.php" class="<?= basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : '' ?>">Blog</a>
            <ul class="submenu">
                <li><a href="blog.php" class="<?= basename($_SERVER['PHP_SELF']) == 'blogs.php' ? 'active' : '' ?>">Show Blogs</a></li>
                <li><a href="created_blog.php?from_menu=true" class="<?= basename($_SERVER['PHP_SELF']) == 'created_blog.php' ? 'active' : '' ?>">Add New Post</a></li>
            </ul>
        </li>
        <li><a href="page.php" class="<?= basename($_SERVER['PHP_SELF']) == 'page.php' ? 'active' : '' ?>">Page</a></li>
        <li><a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">Users</a></li>
        <li><a href="media.php" class="<?= basename($_SERVER['PHP_SELF']) == 'media.php' ? 'active' : '' ?>">Media</a></li>
       
        <li><a href="">Commerce Hub</a>
        <ul class="submenu">
                <li><a href="products.php" class="<?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>">Products</a></li>
                <li><a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">Orders</a></li>
                <li><a href="customers.php" class="<?= basename($_SERVER['PHP_SELF']) == 'customers.php' ? 'active' : '' ?>">Customers</a></li>
                <li><a href="reports.php" class="<?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : '' ?>">📊 Reports</a></li>
                <li><a href="" class="<?= basename($_SERVER['PHP_SELF']) == 'store_settings.php' ? 'active' : '' ?>">Store Settings</a></li>
                <li><a href="" class="<?= basename($_SERVER['PHP_SELF']) == 'discounts_copouns.php' ? 'active' : '' ?>">Discounts and Copouns</a></li>
                <li><a href="" class="<?= basename($_SERVER['PHP_SELF']) == 'messages_notifications.php' ? 'active' : '' ?>">Messages and Notifications</a></li>
                <li><a href="" class="<?= basename($_SERVER['PHP_SELF']) == 'extensions.php' ? 'active' : '' ?>">Extensions</a></li>
            </ul>
         </li>

    
        <li><a href="settings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">Settings</a></li>
    </ul>
</div>