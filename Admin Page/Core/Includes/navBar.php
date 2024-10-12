<div class="container-fluid shadow-sm mb-4 bg-body-tertiary rounded">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand fs-4 fw-bold mx-2" href="#" style="color: #003c3c;">Simbag sa Pag-Asenso Inc.</a>

        <!-- Notification Bell and Calendar Layout aligned horizontally and left of profile image -->
        <div class="d-flex align-items-center ms-auto">

            <div class="profile position-relative d-flex align-items-center gap-2">
                <a href="../../App/View/notification.php"><i class="bi bi-app-indicator" style="font-size: 1.5rem; color: #003c3c;"></i></a>
                <!-- Calendar Layout -->
                <div class="d-flex align-items-center shadow-sm" style="height: 40px; width: 170px; background-color: #fff; border-radius: 12px; padding-left: 6px;">
                    <i class="bi bi-calendar2-week me-2" style="font-size: 1.3rem; color: #003c3c;"></i> <!-- Calendar Icon -->
                    <span id="currentDate" class="fs-6 fw-bold" style="color: #003c3c;"></span> <!-- Date -->
                </div>
                <img src="../../public/assets/images/profile.jpg" style="height: 40px;" class="rounded-circle" alt="profile" id="profile-img">
                <i class="bi bi-chevron-down" id="dropdown-toggle" style="color: #000000;"></i>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu p-2 m-2" id="dropdown-menu" style="display: none; position: absolute; top: 50px; right: 0; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                    <a href="../../App/View/scholar_profile.php" class="list-group-item list-group-item-action p-2"><i class="bi bi-person"></i>&nbsp;Profile</a>
                    <a href="#" class="list-group-item list-group-item-action p-2"><i class="bi bi-gear"></i>&nbsp;Settings</a>
                    <a href="../../../Assets/logout.php" class="list-group-item list-group-item-action p-2"><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a>
                </div>
            </div>
        </div>

        <!-- Hamburger for Mobile -->
        <button class="navbar-toggler" type="button" id="hamburger" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <style>
            /* Hover effect for dropdown items */
            .list-group-item-action:hover {
                background-color: #003c3c;
                color: white;
            }
        </style>
    </nav>
</div>

<script>
    // Dropdown toggle functionality
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const profileImg = document.getElementById('profile-img');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const hamburger = document.getElementById('hamburger');

    function toggleDropdown() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    }

    dropdownToggle.addEventListener('click', toggleDropdown);
    profileImg.addEventListener('click', toggleDropdown);

    // Hamburger toggle functionality for mobile
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
    });
</script>

<script>
    // JavaScript to dynamically display the current date
    const date = new Date();
    const options = {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    };
    document.getElementById('currentDate').innerText = date.toLocaleDateString(undefined, options);
</script>