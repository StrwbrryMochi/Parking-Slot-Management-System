<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="landing.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="stylesheet" href="lib/icons/css/all.css"/>
    <link rel="stylesheet" href="lib/css/aos.css">
    <link rel="stylesheet" href="lib/css/sweetalert.css">
    <script src="lib/js/sweetalert.js"></script>
    <script src="lib/js/aos.js"></script>
  </head>
  <body>

    <!-- Navigation Bar -->
     <div class="navbar-wrapper">
      <div class="navbar">
        <a href="#Home">
          <img src="img/Landing/logoo.png" alt="" class="logo">
        </a>
        <ul>
          <li><a href="#service">Services</a></li>
          <li><a href="#About">About</a></li>
          <li><a href="#Book">Book</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="cta-wrapper">
          <a href="login.php" class="nav-cta">Sign in</a>
        </div>
      </div>
     </div>


    <!-- Hero Section -->

    <div class="main__container" id="Home">
      <div class="main__content">
        <div class="main__header">
        <h1 data-aos="fade-up" data-aos-duration="2000">Efficient Slot Allocation at Your Fingertips</h1>
        <p data-aos="fade-up" data-aos-duration="1800">Safe parking station for you</p>
        </div>
        <a href="booking.php" class="main-btn" data-aos="fade-up" data-aos-duration="2000">Book Now <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span></a>
      </div>
    </div>

    <!-- Services Section -->
    <div class="services" id="service">
      <h1>Our Services</h1>
      <div class="service-container">
       <div class="progress progressBar"></div>
       <div class="card card1" data-aos="fade-right" data-aos-duration="1000">
        <div class="card-icon"><i class="fas fa-car"></i></div>
        <div class="card-header">Streamlined Experience</div>
        <div class="card-desc">Enjoy a fast and efficient parking process from start to finish, saving you time and reducing stress.
        </div>
       </div>
       <div class="card card2" data-aos="fade-left" data-aos-duration="1000">
        <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
        <div class="card-header">Easy & Reliable Process</div>
        <div class="card-desc">Navigate the parking system with confidence, knowing everything is designed for your convenience and trust.</div>
       </div>
       <div class="card card3" data-aos="fade-right" data-aos-duration="1000">
        <div class="card-icon"><i class="fas fa-phone-alt"></i></div>
        <div class="card-header">Constant Assistance</div>
        <div class="card-desc">Get help at any time, ensuring a smooth parking experience whenever you need it.</div>
       </div>
      </div>
    </div>

    <!-- About Us Section -->
    <div class="about-us" id="About">
      <h1 data-aos="fade-up" data-aos-duration="1000">About Us</h1>
      <div class="about-us__container">
        <div class="about-us__text">
          <h2 data-aos="fade-left" data-aos-duration="1000">Our System</h2>
          <p data-aos="fade-up" data-aos-duration="1000">
            The BSIT 21002 Parking System simplifies parking management, making it safer, faster, and more efficient. Designed to reduce stress and improve security, it offers convenient features like easy booking, real-time monitoring, and secure login for both staff and visitors. Developed by BSIT students, this project reflects a commitment to innovative, user-centered design and provides a foundation for future enhancements in parking solutions.
          </p>
        </div>
        <div class="about-us__image" data-aos="zoom-out">
          <?php include 'components/Booking/AboutImage.php'; ?>
        </div>
      </div>
    </div>

    <div class="book-now" id="Book">
    <img class="divider" src="img/layered-arch.svg" alt="" srcset="">
      <div class="container" data-aos="fade-up" data-aos-duration="1000">
        
        <div class="book-now-content">
          <div class="left-column">
            <h2>Book a Slot Now!</h2>
            <p>
              Experience convenient, efficient, and affordable parking solutions
              tailored to meet your needs.
            </p>
            <a href="booking.php" class="main-btn" data-aos="fade-up" data-aos-duration="2000">Book Now <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span></a>
          </div>
          <div class="right-column">
            <div class="booking-card bookCard1" data-aos="fade-up" data-aos-duration="1000">
              <div class="book-icon">
                <i class="fas fa-clock"></i>
              </div>
              <h3>Quick Booking</h3>
              <p>Book your parking in less than a minute.</p>
            </div>
            <div class="booking-card bookCard2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              <div class="book-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <h3>Find Locations</h3>
              <p>Locate the nearest parking stations in your area.</p>
            </div>
            <div class="booking-card bookCard3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"> 
              <div class="book-icon">
                <i class="fas fa-wallet"></i>
              </div>
              <h3>Affordable Rates</h3>
              <p>Get the best rates for short and long-term parking.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Contact section-->
    <div class="contact" id="contact">
      <img src="img/wavaes.svg" alt="" srcset="">
      <div class="contact-content">
        <h1>Contact Us</h1>
        <div class="contact-info">
          <div class="contact-details">

            <div class="contact-card" data-aos="fade-up" data-aos-duration="1000">
              <div class="card-bg">
                <div class="contact-icon">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
              </div>
              <div class="contact-header">
                Our Location
              </div>
              <div class="contact-data">
              • 1071 Brgy. Kaligayahan, Quirino Highway
              Novaliches Quezon City, Philippines 1123
              </div>
            </div>

            <div class="contact-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              <div class="card-bg">
                <div class="contact-icon">
                  <i class="fa-solid fa-envelope"></i>
                </div>
              </div>
              <div class="contact-header">
                Email us
              </div>
              <div class="contact-data">
              • bcp-inquiry@bcp.edu.ph
              </div>
            </div>

            <div class="contact-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
              <div class="card-bg">
                <div class="contact-icon">
                  <i class="fa-solid fa-phone-volume"></i>
                </div>
              </div>
              <div class="contact-header">
                Call us
              </div>
              <div class="contact-data">
              • 417-4355
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <div class="footer__container">
      <div class="footer"  data-aos="zoom-in" data-aos-offset="0" data-aos-duration="1000">
        <p>@ BSIT 2102 . All rights reserved</p>
      </div>
    </div>

    <?php include 'php/Booking/alerts.php';?>

  <script>
    AOS.init();
  </script>

    <script src="js/Landing/navBar.js"></script>
  </body>
</html>
