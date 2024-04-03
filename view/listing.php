<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing and Rentals</title>
    <link rel="stylesheet" href="../css/listing.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            
            <div class="outer-card">

                <div class="floating-btn" onclick="toggleForm()">
                    <ion-icon name="add-circle-outline"></ion-icon>
                </div>

           
                <div class="property-form" id="propertyForm" style="display: none;">
                    <span class="close-btn" onclick="toggleForm()">&times;</span>
                    <form>
                        <label for="propertyImage">Property Image:</label>
                        <input type="file" id="propertyImage" name="propertyImage" accept="image/*" required>
                        
                        <label for="propertyLocation">Location:</label>
                        <input type="text" id="propertyLocation" name="propertyLocation" required>
                        
                        <label for="propertyName">Name:</label>
                        <input type="text" id="propertyName" name="propertyName" required>
                        
                        <label for="propertyPrice">Price:</label>
                        <input type="number" id="propertyPrice" name="propertyPrice" required>
                        
                        <label for="propertyDescription">Description:</label>
                        <textarea id="propertyDescription" name="propertyDescription" required></textarea>
                        
                        <label for="propertyStatus">Status:</label>
                        <select id="propertyStatus" name="propertyStatus" required>
                            <option value="rent">For Rent</option>
                            <option value="sale">For Sale</option>
                        </select>
                        
                        <button type="submit">Submit</button>
                    </form>
                </div>

                <div class="house-card">
                    <img src="../images/1.jpg" alt="House 1">
                    <h3>House 1</h3>
                    <p>Description of House 1...</p>
                    <p>Location: City, Country</p>
                    <p>Price: $XXXXX</p>
                    <button class="book-btn">Book</button>
                </div>

                <div class="house-card">
                    <img src="../images/2.jpg" alt="House 2">
                    <h3>House 2</h3>
                    <p>Description of House 2...</p>
                    <p>Location: City, Country</p>
                    <p>Price: $XXXXX</p>
                    <button class="book-btn">Book</button>
                </div>


            </div>
        </div>

        <script>
            function toggleForm() {
                var form = document.getElementById("propertyForm");
                form.style.display === "none" ? form.style.display = "block" : form.style.display = "none";
            }
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
