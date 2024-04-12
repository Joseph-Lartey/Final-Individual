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
    <title>Profile</title>
    <link rel="stylesheet" href="../css/Profile.css">
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

                <li class="active">
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
            
            <div class="outer-profile">

                <div id="profile-page">
                    <div class="profile-info">
                    <!-- <img src="../images/3.jpg" alt="Profile Picture"> -->
                       <?php echo getUserProfileImage(); ?>
                
                        <div class="user-details">
                            <?php echo getUserProfileDetails(); ?>

                            <!-- <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Email:</strong> johndoe@example.com</p>
                            <p><strong>Date of Birth:</strong> January 1, 1990</p>
                            <p><strong>Phone Number :</strong> 059977320</p> -->
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="Edit" id="Edit">Edit Username</button>
                        <button class="Editemail" id="Editemail">Change Email</button>
                        <button class = "ChangePassword" id="ChangePassword">Change Password</button>
                        <button class="AddImage" id="AddImage">Add Image</button>
                    </div>
                </div>
            </div>

    <div id="editUsernameModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../action/editUsername_action.php" method="POST">
                <label for="Firstname">Firstname:</label>
                <input type="text" id="Firstname" name="Firstname">
                <label for="username">Lastname:</label>
                <input type="text" id="username" name="username">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <div id="editEmailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../action/editEmail_action.php" method="POST">
                <label for="oldEmail">Old Email:</label>
                <input type="email" id="oldEmail" name="old_email">
                <label for="newEmail">New Email:</label>
                <input type="email" id="newEmail" name="new_email">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>


    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../action/ChangePassword_action.php" method="POST">
                <label for="currentPassword">Current Password:</label>
                <input type="password" id="currentPassword" name="currentPassword" required>
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <div id="addImageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../action/Add_image_action.php" method="POST" enctype="multipart/form-data">
                <label for="image">Choose Image:</label>
                <input type="file" id="image" name="image">
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>

    <script>
        
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");

        toggle.onclick = function () {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };

        let editUsernameModal = document.getElementById("editUsernameModal");
        let editEmailModal = document.getElementById("editEmailModal");
        let changePasswordModal = document.getElementById("changePasswordModal");
        let addImageModal = document.getElementById("addImageModal");

        let editUsernameBtn = document.getElementById("Edit");
        let editEmailBtn = document.getElementById("Editemail");
        let changePasswordBtn = document.getElementById("ChangePassword");
        let addImageBtn = document.getElementById("AddImage");

        let closeBtns = document.querySelectorAll(".close");

        function openModal(modal) {
            modal.style.display = "block";
        }

        function closeModal(modal) {
            modal.style.display = "none";
        }

        editUsernameBtn.addEventListener("click", () => openModal(editUsernameModal));
        editEmailBtn.addEventListener("click", () => openModal(editEmailModal));
        changePasswordBtn.addEventListener("click", () => openModal(changePasswordModal));
        addImageBtn.addEventListener("click", () => openModal(addImageModal));

        closeBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                closeModal(editUsernameModal);
                closeModal(editEmailModal);
                closeModal(changePasswordModal);
                closeModal(addImageModal);
            });
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
</body>

</html>