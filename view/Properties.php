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
    <title>My Properties</title>
    <link rel="stylesheet" href="../css/Properties.css">
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
                
                <div class="search">
                    <input type="text" id="searchInput" onkeyup="filterProperties()" placeholder="Search properties">
                    <ion-icon name="search-outline"></ion-icon>
                </div>

                <div class="user">
                    <?php echo getUserProfileImage(); ?>
                </div>
            </div>
            
            <div class="outer-card">
                <?php include "../action/getUserProperties_action.php"?>

                <div id="statusModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeStatusModal()">&times;</span>
                        <h2>Update Status</h2>
                        <form id="updateStatusForm" action="../action/update_status_action.php" method="POST">
                            <input type="hidden" id="propertyId" name="propertyId" value="">
                            <div class="form-group">
                                <label for="status">Select Status:</label>
                                <select id="status" name="status">
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <button onclick="updateStatus(<?php echo $row['property_id']; ?>)" class="book-btn">Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleForm() {
        var form = document.getElementById("propertyForm");
        form.style.display === "none" ? form.style.display = "block" : form.style.display = "none";
    }

    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".navigation");
    let main = document.querySelector(".main");

    toggle.onclick = function () {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
    };

    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('msg');
        if (message) {
            Swal.fire("Notice", message, "info");
        }
    });

    
    </script>

    <script>
        function openStatusModal(propertyId) {
            document.getElementById('propertyId').value = propertyId;
            document.getElementById('statusModal').style.display = 'block';
        }

        function closeStatusModal() {
            document.getElementById('statusModal').style.display = 'none';
        }
    </script>

<script>
    function updateStatus(propertyId) {
        fetch('../action/update_status_action.php', {
            method: 'POST',
            body: new FormData(),
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

 <script>
    function filterProperties() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const searchValue = parseFloat(searchInput); 

    document.querySelectorAll('.house-card').forEach(card => {
        const cardDetails = card.querySelector('.house-details').innerText.toLowerCase(); 
        const cardValues = cardDetails.match(/\d+(\.\d+)?/g); 

        let matches = false;

        if (!isNaN(searchValue)) {
            if (cardValues) {
                matches = cardValues.some(value => parseFloat(value) === searchValue);
            }
        } else {
            matches = cardDetails.includes(searchInput);
        }

        card.style.display = matches ? '' : 'none';
    });
}
 </script>



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
