<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" id="notificationDropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge" id="notification-count">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">Notifikasi Terbaru</span>
        <div id="notification-list">
            <div class="dropdown-item">
                <div class="media">
                    <div class="media-body">
                        <p class="text-sm">Memuat notifikasi...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer" id="mark-all-read">Tandai semua sudah dibaca</a>
        <a href="<?= base_url('notification') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
    </div>
</li>

<script>
// Load notifications when dropdown is shown
document.getElementById('notificationDropdown').addEventListener('shown.bs.dropdown', function () {
    loadNotifications();
});

// Load notifications
function loadNotifications() {
    $.ajax({
        url: '<?= base_url('notification') ?>',
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            if (response.status === 'success') {
                updateNotificationCount(response.unread_count);
                renderNotifications(response.data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading notifications:', error);
        }
    });
}

// Update notification count
function updateNotificationCount(count) {
    const badge = document.getElementById('notification-count');
    if (badge) {
        badge.textContent = count;
        if (count > 0) {
            badge.style.display = 'inline';
        } else {
            badge.style.display = 'none';
        }
    }
}

// Render notifications in dropdown
function renderNotifications(notifications) {
    const container = document.getElementById('notification-list');
    if (!container) return;
    
    if (!notifications || notifications.length === 0) {
        container.innerHTML = `
            <div class="dropdown-item">
                <div class="media">
                    <div class="media-body">
                        <p class="text-sm">Tidak ada notifikasi</p>
                    </div>
                </div>
            </div>`;
        return;
    }

    let html = '';
    notifications.forEach(notification => {
        const isUnread = notification.is_read === 0;
        const timeAgo = timeSince(new Date(notification.created_at));
        
        const senderHtml = notification.sender_name ? `<p class="text-sm font-italic text-secondary">Dari: ${notification.sender_name}</p>` : '';
        html += `
        <a href="${notification.url || '#'}" class="dropdown-item ${isUnread ? 'bg-light' : ''}" data-id="${notification.id}">
            <div class="media">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                        ${notification.title}
                        ${isUnread ? '<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>' : ''}
                    </h3>
                    ${senderHtml}
                    <p class="text-sm">${notification.message}</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${timeAgo}</p>
                </div>
            </div>
        </a>
        <div class="dropdown-divider"></div>`;
    });
    
    container.innerHTML = html;

    // Add click handlers for notifications
    document.querySelectorAll('#notification-list .dropdown-item[data-id]').forEach(item => {
        item.addEventListener('click', function(e) {
            const notificationId = this.getAttribute('data-id');
            if (notificationId) {
                markAsRead(notificationId);
            }
        });
    });
}

// Mark notification as read
function markAsRead(notificationId) {
    $.ajax({
        url: `<?= base_url('notification/markAsRead/') ?>${notificationId}`,
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        success: function(response) {
            if (response.status === 'success') {
                updateNotificationCount(response.unread_count);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error marking notification as read:', error);
        }
    });
}

// Mark all as read
document.getElementById('mark-all-read')?.addEventListener('click', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: '<?= base_url('notification/markAsRead') ?>',
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        success: function(response) {
            if (response.status === 'success') {
                updateNotificationCount(0);
                loadNotifications();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error marking all as read:', error);
        }
    });
});

// Helper function to format time since
function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    
    let interval = Math.floor(seconds / 31536000);
    if (interval >= 1) return interval + ' tahun yang lalu';
    
    interval = Math.floor(seconds / 2592000);
    if (interval >= 1) return interval + ' bulan yang lalu';
    
    interval = Math.floor(seconds / 86400);
    if (interval >= 1) return interval + ' hari yang lalu';
    
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) return interval + ' jam yang lalu';
    
    interval = Math.floor(seconds / 60);
    if (interval >= 1) return interval + ' menit yang lalu';
    
    return 'Baru saja';
}

// Check for new notifications every 30 seconds
setInterval(() => {
    const dropdown = document.querySelector('.dropdown-menu.show');
    if (!dropdown) { // Only check if dropdown is not open
        $.ajax({
            url: '<?= base_url('notification/unreadCount') ?>',
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                updateNotificationCount(response.count || 0);
            },
            error: function(xhr, status, error) {
                console.error('Error checking for new notifications:', error);
            }
        });
    }
}, 30000);
</script>
