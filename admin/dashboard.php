<?php 
include('../assets/template/admin/sidebar.php');
?>
    <link rel="stylesheet" href="../assets/CSS/adminCSS/admindashboard.css">

<!-- Main Section Starts Here -->
    <main >
        <h1>Dashboard</h1>

        <!-- Top Section Starts Here-->

        <!-- Date -->
        <div class="date">
            <input type="date">
        </div>

        <!-- Insights -->
        <div class="insights">
            <div class="sales" >
                <span class="material-icons-sharp">analytics</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Sales</h3>
                        <h1>$25,500</h1>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx='38' cy='38' r='36'></circle>
                        </svg>
                        <div class="number">
                            <p>81%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Last 24 Hours</small>
            </div>
            <!-- End Of Salse -->
        </div>
        <!-- Top Sections Ends Here -->

    </main>
<!-- Main Section Ends Here -->

</div>

<?php 
include('../assets/template/admin/footer.php');
?>