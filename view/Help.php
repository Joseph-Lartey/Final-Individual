<?php
include "../setting/core.php";
include "../action/getuserDetails.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link rel="stylesheet" href="../css/Help.css">
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

                <li>
                    <a href="../view/Dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li >
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

                <li class="active">
                    <a href="../view/Help.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
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
                    <a href="../login/logout.php">
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


                <div class="user">
                    <?php echo getUserProfileImage(); ?>
                </div>
            </div>
            
            <div class="outer-card">
                <div id="help-tab" class="sidebar-tab">
                    <p>Welcome to the House Rental & Listing Platform! Below are some key features and tips to help you get started:</p>
                    <p>
                        <strong>Dashboard:</strong> <br>
                        Get an overview of available properties, ongoing bookings, and important notifications.
                    </p>
                    <p>
                        <strong>Rental Listings:</strong> <br>
                        List your property for rent or sale. Manage property details, pricing, availability, and images.
                    </p>
                    <p>
                        <strong>Booking System:</strong> <br>
                        Book open house tours for available properties. Manage your booked tours and receive confirmation details.
                    </p>
                    <p>
                        <strong>Search:</strong> <br>
                        Find houses to rent or buy based on location, price range, amenities, and more. Save favorite listings for quick access.
                    </p>
                    <p>
                        <strong>Reports:</strong> <br>
                        View analytics and insights about your listed properties, booking trends, and revenue generated.
                    </p>
                    <p>
                        <strong>Settings:</strong> <br>
                        Customize profile settings, notification preferences, and privacy options.
                    </p>
                    <p>
                        <strong>FAQs:</strong> <br>
                        Find answers to common questions about listing properties, booking tours, and using platform features.
                    </p>
                    <p>
                        <strong>Feedback:</strong> <br>
                        Share your feedback, suggestions, or report any issues encountered while using our platform.
                    </p>
                    <p>For further assistance or inquiries, contact our support team at <a href="mailto:support@houserentallisting.com">support@houserentallisting.com</a></p>
                    <p>Thank you for choosing our House Rental & Listing Platform. We hope it simplifies your property management and search processes!</p>

                    <h3>Tips for Effective Property Management:</h3>
                    <p>
                        <strong>Provide detailed property information:</strong> <br>
                        Include accurate descriptions, images, and amenities to attract potential renters or buyers.
                    </p>
                    <p>
                        <strong>Respond promptly to booking requests:</strong> <br>
                        Maintain good communication with interested parties to secure bookings or tours.
                    </p>
                    <p>
                        <strong>Regularly update property availability:</strong> <br>
                        Keep your listings current to avoid double bookings or outdated information.
                    </p>
                    <p>
                        <strong>Utilize search filters:</strong> <br>
                        Use advanced search options to refine property searches and target specific audiences.
                    </p>
                    <p>
                        <strong>Engage with user feedback:</strong> <br>
                        Address user suggestions or concerns to improve user satisfaction and platform usability.
                    </p>
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



    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>