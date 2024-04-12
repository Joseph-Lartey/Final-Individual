<?php
include "../settings/core.php";
include "../action/getuserDetails.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="../css/Bookings.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                <li>
                    <a href="../view/Dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li >
                    <a href= "../view/Profile.php">
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

                <li class="active">
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
                    <input type="text" id="searchInput" onkeyup="filterProperties()" placeholder="Search properties">
                    <ion-icon name="search-outline"></ion-icon>
                </div>

                <div class="user">
                    <?php echo getUserProfileImage(); ?>
                </div>
            </div>
            
            <div class="outer-card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Property</th>
                        <th>Date</th>
                        <th>Time</th>

                    </tr>
                </thead>
                <tbody>
                <?php include_once "../action/Retrieve_booking_action.php"?>

                </tbody>
            </table>



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
            document.addEventListener('DOMContentLoaded', function () {
                const urlParams = new URLSearchParams(window.location.search);
                const message = urlParams.get('msg');
                if (message) {
                    Swal.fire("Notice", message, "info");
                }
            });
    </script>

    <script>
        function filterBookings() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const bookings = document.querySelectorAll('tbody tr');

    bookings.forEach(booking => {
        const name = booking.querySelector('td:nth-child(1)').innerText.toLowerCase();
        const contact = booking.querySelector('td:nth-child(2)').innerText.toLowerCase();
        const property = booking.querySelector('td:nth-child(3)').innerText.toLowerCase();
        const date = booking.querySelector('td:nth-child(4)').innerText.toLowerCase();
        const time = booking.querySelector('td:nth-child(5)').innerText.toLowerCase();

        // Determine if the current booking matches the search criteria
        const matchesSearch = name.includes(searchInput) ||
                              contact.includes(searchInput) ||
                              property.includes(searchInput) ||
                              date.includes(searchInput) ||
                              time.includes(searchInput);

        // Toggle visibility based on match result
        if (matchesSearch) {
            booking.style.display = '';
        } else {
            booking.style.display = 'none';
        }
    });
}

document.getElementById('searchInput').addEventListener('keyup', filterBookings);

    </script>



    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>