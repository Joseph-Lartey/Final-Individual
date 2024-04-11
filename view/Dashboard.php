<?php
    include('../settings/core.php');
    include ("../action/getuserDetails.php");
    // include ("../action/get_All_stats_action.php");
    include ("../action/get_All_stats_action.php");
    include ("../action/Recent_Homeseeker.php");
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../view/Dashboard.php">
                        <span class="icon">
                            <ion-icon name="home"></ion-icon>
                        </span>
                        <span class="title"><h2>PropertyHub</h2></span>
                    </a>
                </li>

                <li class="active">
                    <a href="../view/Dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li>
                    <a href="../view/Profile.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="../view/listing.php">
                        <span class="icon">
                        <ion-icon name="card-outline"></ion-icon>
                        </span>
                        <span class="title">Rental and Listing</span>
                    </a>
                </li>


                <li>
                    <a href="../view/Bookings.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Booking</span>
                    </a>
                </li>
                <li>
                    <a href="../view/Properties.php">
                        <span class="icon">
                        <ion-icon name="business-outline"></ion-icon>
                        </span>
                        <span class="title">My Properties</span>
                    </a>
                </li>

                <li>
                    <a href="../view/Help.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="../login/Logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <?php echo getUserProfileImage(); ?>
                </div>
            </div>

            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo getTotalListings(); ?></div>
                        <div class="cardName">Listings</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="list-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo getTotalBookings($user_id= $_SESSION['user_id']); ?></div>
                        <div class="cardName">Bookings</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo getAvailablePropertiesCount(); ?></div>
                        <div class="cardName">Available Properties</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Stats</h2>
                    </div>

                    <canvas id="myBarChart" width="380"height="180"> </canvas>

                </div>

                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent HomeSeekers</h2>
                    </div>

                    <table>
                        <?php getRecentHomeSeekers($user_id);?>
                        <!-- <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg"alt=""></div>
                            </td>
                            <td>
                                <h4>David Italy</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit India</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David Italy</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit India</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David Italy</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit India</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David Italy</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="../images/1.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit India</h4>
                            </td>
                            <td>
                                <h4>0599755320</h4>
                            </td>
                        </tr>  -->
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        
            
        let list = document.querySelectorAll(".navigation li");

        function addHover() {
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            this.classList.add("hovered");
        }

        function removeHover() {
            this.classList.remove("hovered");
        }

        list.forEach((item) => {
            item.addEventListener("mouseover", addHover);
            item.addEventListener("mouseout", removeHover);
        });

        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function () {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };


    </script>
    <script>
        // PHP variables containing statistics
        let totalListings = <?php echo getTotalListings(); ?>;
        let totalBookings = <?php echo getTotalBookings($_SESSION['user_id']); ?>;
        let availablePropertiesCount = <?php echo getAvailablePropertiesCount(); ?>;

        // Data for the bar chart
        let data = {
            labels: ['Total Listings', 'Total Bookings', 'Available Properties'],
            datasets: [{
                label: 'Statistics',
                data: [totalListings, totalBookings, availablePropertiesCount],
                backgroundColor: [
                    'rgba(0, 0, 0, 0.2)', // Total Listings (black with opacity 0.2)
                    'rgba(0, 0, 0, 0.2)', // Total Bookings (black with opacity 0.2)
                    'rgba(0, 0, 0, 0.2)'   // Available Properties
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Options for the bar chart
        let options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Get the canvas element
        let ctx = document.getElementById('myBarChart').getContext('2d');

        // Create the bar chart
        let myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>


    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>