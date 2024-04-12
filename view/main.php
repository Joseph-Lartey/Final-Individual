<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webpage Design</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
        <div>
            <div class="main" id="home">
                <div class="navbar">
                    <div class="icon">
                        <h2 class="logo">PropertyHub</h2>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="#home">HOME</a></li>
                            <li><a href="#about">ABOUT</a></li>
                            <li><a href="#service">SERVICE</a></li>
                            <li><a href="#contact">CONTACT</a></li>
                        </ul>
                    </div>
                </div> 

                <div class="content" id="home">
                    <h1>House Listing & Rental</h1>
                    <p class="par">
                        Explore our platform for house listings and rental services.<br> 
                        Find your ideal home or rent out your property effortlessly.<br> 
                    </p>
                    <button class="cn"><a href="../login/login.php">EXPLORE NOW</a></button>
                </div>
            </div>
        </div>

        <div class="service" id="service">
            <div class="products">
                <h1>Explore Our Services</h1>
                <div class="manage">
                    <div class="card">
                        <ion-icon name="business-outline"></ion-icon>
                        <h3>Explore and manage all your listed properties effortlessly with our comprehensive property management system.</h3>
                    </div>

                    <div class="card">
                        <ion-icon name="card-outline"></ion-icon>
                        <h3>Discover your dream home and begin the journey to make it yours with our streamlined property acquisition process.</h3>
                    </div>

                    <div class="card">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <h3>Reserve your ideal home for an exclusive tour and explore your potential new living space firsthand.</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="about" id="about">
            <h1>About PropertyHub</h1>
            <div class="about-info">
                <div class="about-item">
                    <ion-icon name="globe-outline"></ion-icon>
                    <h3>Our Mission</h3>
                    <p>To provide a seamless platform for property owners and seekers to connect, list properties, and find their dream homes.</p>
                </div>
                <div class="about-item">
                    <ion-icon name="people-outline"></ion-icon>
                    <h3>Our Team</h3>
                    <p>Meet our dedicated team of professionals committed to delivering exceptional service and support to our users.</p>
                </div>
                <div class="about-item">
                    <ion-icon name="analytics-outline"></ion-icon>
                    <h3>Our Vision</h3>
                    <p>To revolutionize the real estate industry by leveraging technology to simplify property transactions and enhance customer experience.</p>
                </div>
            </div>
        </div>


        <div class="steps">
            <h1>How PropertyHub Works</h1>
            <div class="step-item">
                <ion-icon name="create-outline"></ion-icon>
                <h3>Create an Account</h3>
                <p>Sign up for an account to access all our features and services.</p>
            </div>
            <div class="step-item">
                <ion-icon name="log-in-outline"></ion-icon>
                <h3>Login</h3>
                <p>Login to your account to manage your properties and preferences.</p>
            </div>
            <div class="step-item">
                <ion-icon name="list-outline"></ion-icon>
                <h3>List Your House</h3>
                <p>List your property for sale or rent to reach potential buyers or tenants.</p>
            </div>
            <div class="step-item">
                <ion-icon name="search-outline"></ion-icon>
                <h3>Find Your Ideal Home</h3>
                <p>Explore our listings and find the perfect home for your needs and preferences.</p>
            </div>
            <div class="step-item">
                <ion-icon name="calendar-outline"></ion-icon>
                <h3>Book a House Viewing</h3>
                <p>Reserve a time to visit the properties you're interested in and see them firsthand.</p>
            </div>
            <div class="step-item">
                <ion-icon name="settings-outline"></ion-icon>
                <h3>Manage Your Properties</h3>
                <p>Effortlessly manage your listed properties, update details, and track their performance.</p>
            </div>
        </div>

        <div class="recent-listings">
            <h1>Recently Listed Properties</h1>
            <div class="carousel">
                <?php include "../action/getRecentlsiting.php";?>
                <!-- <div class="property-card">
                    <img src="../images/12.jpg" alt="Property 1">
                    <div class="property-details">
                        <h3>Property Title 1</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X </p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/13.jpg" alt="Property 2">
                    <div class="property-details">
                        <h3>Property Title 2</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X </p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/2.jpg" alt="Property 3">
                    <div class="property-details">
                        <h3>Property Title 3</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X </p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/5.jpg" alt="Property 4">
                    <div class="property-details">
                        <h3>Property Title 4</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X</p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/5.jpg" alt="Property 4">
                    <div class="property-details">
                        <h3>Property Title 4</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X</p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/5.jpg" alt="Property 4">
                    <div class="property-details">
                        <h3>Property Title 4</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X</p>
                        <p>Location: City, State</p>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../images/5.jpg" alt="Property 4">
                    <div class="property-details">
                        <h3>Property Title 4</h3>
                        <p>Price: $XXX,XXX</p>
                        <p>Bedrooms: X</p>
                        <p>Location: City, State</p>
                    </div> 
                </div> -->
            </div>
        </div>



        <div class="final" id="contact">
            <div class="final-outer">
                <div class="final-div">
                    <div >
                        <h1>Main Office</h1>
                        <p>1234 Elm Street, Suite 567</p>
                        <p>Cityville, State 12345</p>
                        <p>Phone: 0599755320</p>
                        <p>Email: josephlartey414.com</p>
                    </div>
                    <div>
                        <h1>Customer Service</h1>
                        <p>5678 Oak Street, Apt 910</p>
                        <p>Townsville, State 67890</p>
                        <p>Phone: +9876543210</p>
                        <p>Email: juconzylartey@gmail.com</p>
                    </div>
                    <div>
                        <h1>Contact Us</h1>
                        <p>7890 Pine Street, Unit 123</p>
                        <p>Villageton, State 45678</p>
                        <p>Phone: 0553408626</p>
                        <p>Email: josephlartey414@gmail.com</p>
                    </div>
                    <div>
                        <h1>Explore More</h1>
                        <p>9012 Maple Street, Floor 345</p>
                        <p>Hamletville, State 23456</p>
                        <p>Phone: +1357924680</p>
                        <p>Email: explore@nestquest.com</p>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>






