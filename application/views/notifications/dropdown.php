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
        <a href="<?= base_url('notifications') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
    </div>
</li>

<script>
// Load notifications when dropdown is shown
document.getElementById('notificationDropdown').addEventListener('shown.bs.dropdown', function () {
    loadNotifications();
});

// Load notifications
function loadNotifications() {
    fetch('<?= base_url('notifications') ?>', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateNotificationCount(data.unread_count);
            renderNotifications(data.data);
        }
    });
}

// Update notification count
function updateNotificationCount(count) {
    const badge = document.getElementById('notification-count');
    badge.textContent = count;
    if (count > 0) {
        badge.style.display = 'inline';
    } else {
        badge.style.display = 'none';
    }
}

// Render notifications in dropdown
function renderNotifications(notifications) {
    const container = document.getElementById('notification-list');
    
    if (notifications.length === 0) {
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
        
        html += `
        <a href="${notification.url || '#'}" class="dropdown-item ${isUnread ? 'bg-light' : ''}" data-id="${notification.id}">
            <div class="media">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                        ${notification.title}
                        ${isUnread ? '<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>' : ''}
                    </h3>
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
    fetch(`<?= base_url('notifications/read/') ?>${notificationId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateNotificationCount(data.unread_count);
        }
    });
}

// Mark all as read
document.getElementById('mark-all-read')?.addEventListener('click', function(e) {
    e.preventDefault();
    
    fetch('<?= base_url('notifications/read-all') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateNotificationCount(0);
            loadNotifications();
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
        fetch('<?= base_url('notifications/unread') ?>', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateNotificationCount(data.count || 0);
        });
    }
}, 30000);
</script>

<style>
/* Notification dropdown styling */
.dropdown-menu-lg {
    width: 25rem;
}

.dropdown-item {
    white-space: normal;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.bg-light {
    background-color: #f8f9fa !important;
}

/* Animation for new notifications */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
}

.pulse {
    animation: pulse 2s infinite;
    border-radius: 50%;
}
</style>
