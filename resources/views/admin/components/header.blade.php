<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index.html">
                <img class="" id="logo_header_mobile" alt="" src="images/logo/logo.png"
                    data-light="images/logo/logo.png" data-dark="images/logo/logo-dark.png" data-width="154px"
                    data-height="52px" data-retina="images/logo/logo@2x.png" />
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>
        </div>

        <div class="header-grid">

            <div class="badge-date" id="liveDateTime">
                <i class="bi bi-calendar3"></i>
                <span id="liveDate">{{ now()->format('D, d M Y') }}</span>
                <span class="badge-date-sep">•</span>
                <i class="bi bi-clock"></i>
                <span id="liveTime">{{ now()->format('h:i:s A') }}</span>
            </div>

            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="images/avatar/user-1.png" alt="" />
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ auth()->user()->name }}</span>
                                <span class="text-tiny">{{ auth()->user()->role }}</span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="{{ url('/admin/settings') }}" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="user-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="icon">
                                    <i class="icon-log-out"></i>
                                </div>
                                <div class="body-title-2">Log out</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.header-dashboard .wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.header-dashboard .header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-dashboard .header-grid {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-dashboard .badge-date {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    background: #f5f6fa;
    font-size: 13px;
    font-weight: 500;
    color: #333;
    white-space: nowrap;
}

.header-dashboard .badge-date i {
    font-size: 14px;
    color: #6c63ff;
}

.header-dashboard .badge-date-sep {
    opacity: 0.4;
    margin: 0 2px;
}

.header-dashboard .popup-wrap.user .header-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-dashboard .popup-wrap.user .flex.flex-column {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.2;
}

.header-dashboard .popup-wrap.user .body-title.mb-2 {
    margin-bottom: 2px !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateLiveDateTime() {
        const now = new Date();

        const dateOptions = { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' };
        const dateStr = now.toLocaleDateString('en-GB', dateOptions).replace(',', '');

        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const hoursStr = hours.toString().padStart(2, '0');
        const timeStr = `${hoursStr}:${minutes}:${seconds} ${ampm}`;

        const dateEl = document.getElementById('liveDate');
        const timeEl = document.getElementById('liveTime');
        if (dateEl) dateEl.textContent = dateStr;
        if (timeEl) timeEl.textContent = timeStr;
    }

    updateLiveDateTime();
    setInterval(updateLiveDateTime, 1000);
});
</script>