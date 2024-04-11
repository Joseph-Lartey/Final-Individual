<?php
include("../settings/core.php");
include ("../action/getuserDetails.php");

checkLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing and Rentals</title>
    <link rel="stylesheet" href="../css/listing.css">
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

                <li>
                    <a href="../view/Profile.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li class="active">
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
            
            <div class="outer-card">

                <div class="floating-btn" onclick="toggleForm()">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </div>

           
                <div class="property-form" id="propertyForm" style="display: none;">
                    <span class="close-btn" onclick="toggleForm()">&times;</span>
                    <form action="../action/add_listing_action.php" method="POST" enctype="multipart/form-data">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                        
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required></textarea>
                        
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required>
                        
                        <label for="propertyType">Property Type:</label>
                        <input type="text" id="propertyType" name="propertyType" required>
                        
                        <label for="bedrooms">Bedrooms:</label>
                        <input type="number" id="bedrooms" name="bedrooms" required>
                        
                        <label for="sizeSqft">Size (sqft):</label>
                        <input type="number" id="sizeSqft" name="sizeSqft" required>
                        
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                        
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                        
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" required>


                        <label for="propertyImage">Image:</label>
                        <input type="file" id="propertyImage" name="propertyImage" accept="image/*" required>
                        
                        <button type="submit">Submit</button>
                    </form>
                </div>
                
                
                <?php include "../action/Get_properties_action.php"  ?>
                <!-- <div class="house-card">
                    <div class="house-image">
                        <img src="../images/1.jpg" alt="House 1">
                    </div>
                    <div class="house-details">
                        <h3>House 1</h3>
                        <p>Description of House 1...</p>
                        <ul>
                            <li><strong>Property Type:</strong> Residential</li>
                            <li><strong>Size:</strong> XXX sqft</li>
                            <li><strong>Location:</strong> City, State</li>
                            <li><strong>Price:</strong> $XXXXX</li>
                        </ul>
                        <button class="book-btn">Book</button>
                    </div>
                </div> -->
                
                <div id="bookingModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <form id="bookingForm" action="../action/book_house.php" method="POST">
                            <h2>Bookings</h2>
                            <label for="booking_date">Booking Date:</label>
                            <input type="date" id="booking_date" name="booking_date" required>

                            <label for="booking_time">Booking Time:</label>
                            <input type="time" id="booking_time" name="booking_time" required>

                            <!-- Hidden input field to store property ID -->
                            <input type="hidden" id="property_id" name="property_id">

                            <input type="submit" value="Book">
                        </form>
                    </div>
                </div>


            </div>
        </div>

        <script>
            function toggleForm() {
                var form = document.getElementById("propertyForm");
                form.style.display === "none" ? form.style.display = "block" : form.style.display = "none";
            }
        </script>

        <script>        
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function () {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };
            
        </script>

        <script>
            // Function to open modal and set property_id in the hidden input field
            function openModal(propertyId) {
                // Set the property_id in the hidden input field of the booking form
                document.getElementById("property_id").value = propertyId;
                // Display the booking modal
                document.getElementById("bookingModal").style.display = "block";
            }

            // Function to close modal
            function closeModal() {
                document.getElementById("bookingModal").style.display = "none";
            }

            // Function to listen for click on Book button and open modal with property_id
            document.querySelectorAll('.book-btn').forEach(item => {
                item.addEventListener('click', event => {
                    // Get the property_id from the data-property-id attribute of the clicked button
                    const propertyId = item.getAttribute('data-property-id');
                    // Open the modal with the property_id
                    openModal(propertyId);
                })
            });
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

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
