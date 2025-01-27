<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    echo "<script>alert('Impossible d\'accéder à cette page sans se déconnecter.'); window.location.href='dashboard1.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../assets/img/logoVulneraScan1.png">
  <title>
    VulneraScan - S'inscrire
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <style>
      #weatherContainer {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        color: white;
      }

      .weather-info {
        display: flex;
        gap: 15px;  /* Adjust the space between items as needed */
        align-items: center;
      }

      .weather-info h4,
      .weather-info p {
        margin: 0;
        font-size: 0.9em;
      }
      
  </style>
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
    <img src="../assets/img/logos/signup_logo.png" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 40px;">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="index.php">
        VulneraScan
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="https://docs.google.com/document/d/1YRaSMCKLkyHlnmDbPiKoT5p6zXLwIqD5/edit?usp=sharing&ouid=115636460967030362882&rtpof=true&sd=true">
            <i class="fa fa-book opacity-6  me-1"></i>
              <span class="d-sm-inline d-none">Documentation</span>
              </a>
         </div> 
        <!-- weather -->
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
             <div id="weatherContainer">
                 <div id="weatherInfo" class="weather-info d-flex align-items-center"></div>
             </div>
         </div> 
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/background_signup.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Bienvenue!</h1>
            <p class="text-lead text-white">Utilisez ces superbes formulaires pour vous connecter ou créer gratuitement un nouveau compte dans votre projet.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Inscrivez-vous avec</h5>
            </div>
            <div class="card-body">
               <form action="signup-check.php" method="post">          
                 <?php if (isset($_GET['error'])) { ?>
     		  <p class="error"><?php echo $_GET['error']; ?></p>
     	       <?php } ?>

                 <?php if (isset($_GET['success'])) { ?>
                 <p class="success"><?php echo $_GET['success']; ?></p>
                 <?php } ?>
                <div class="mb-3">
                     <?php if (isset($_GET['name'])) { ?>
                     <input type="text" 
                      name="name" 
                      placeholder="Nom"
                      value="<?php echo $_GET['name']; ?>" class="form-control"><br>
                     <?php }else{ ?>
                     <input type="text" 
                      name="name" 
                      placeholder="Nom" class="form-control"><br>
                     <?php }?>     
                </div>
                <div class="mb-3">
                     <?php if (isset($_GET['uname'])) { ?>
                     <input type="text" 
                      name="uname" 
                      placeholder="email"
                      value="<?php echo $_GET['uname']; ?>" class="form-control"><br>
                     <?php }else{ ?>
                     <input type="text" 
                      name="uname" 
                      placeholder="email" class="form-control"><br>
                     <?php }?>
                </div>
                <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Mot de Passe" aria-label="Password">
                </div>
                <div class="mb-3">
                  <input type="password" name="re_password" class="form-control" placeholder="confirmer votre mot de passe" aria-label="Password">
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                  Je suis d'accord les <a href="javascript:;" class="text-dark font-weight-bolder">Termes et conditions</a>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">S'inscrire</button>
                </div>
                <p class="text-sm mt-3 mb-0">Vous avez déjà un compte? <a href="index.php" class="text-dark font-weight-bolder">Se connecter</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
    <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by FSAC.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>

  <!-- WEATHER -->
  <script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const weatherInfo = document.getElementById('weatherInfo');
    
    // Function to get weather data
    async function getWeather(lat, lon) {
      const apiKey = '8c524806e7b98e2a8f893b4b0055a2c8';  // Replace with your OpenWeatherMap API key
      const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`;
      
      try {
        const response = await fetch(url);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        displayWeather(data);
      } catch (error) {
        weatherInfo.innerHTML = 'Unable to retrieve weather data';
        console.error('There has been a problem with your fetch operation:', error);
      }
    }
    
    // Function to display weather data
    function displayWeather(data) {
      const { name, main, weather } = data;
      const weatherIcon = getWeatherIcon(weather[0].icon);
      weatherInfo.innerHTML = `
        <i class="fas fa-map-marker-alt"></i>
        <h4>${name}</h4>
        ${weatherIcon}
        <p>${weather[0].description}</p>
        <i class="fas fa-thermometer-half"></i>
        <p>${main.temp} °C</p>
        <i class="fas fa-tint"></i>
        <p>${main.humidity}%</p>
      `;
    }

    // Function to get weather icon based on weather condition code
    function getWeatherIcon(iconCode) {
      // Map weather condition codes to corresponding Font Awesome icons
      const iconMap = {
        '01d': '<i class="fas fa-sun"></i>',  // clear sky day
        '01n': '<i class="fas fa-moon"></i>',  // clear sky night
        '02d': '<i class="fas fa-cloud-sun"></i>',  // few clouds day
        '02n': '<i class="fas fa-cloud-moon"></i>',  // few clouds night
        '03d': '<i class="fas fa-cloud"></i>',  // scattered clouds day
        '03n': '<i class="fas fa-cloud"></i>',  // scattered clouds night
        '04d': '<i class="fas fa-cloud"></i>',  // broken clouds day
        '04n': '<i class="fas fa-cloud"></i>',  // broken clouds night
        '09d': '<i class="fas fa-cloud-showers-heavy"></i>',  // shower rain day
        '09n': '<i class="fas fa-cloud-showers-heavy"></i>',  // shower rain night
        '10d': '<i class="fas fa-cloud-sun-rain"></i>',  // rain day
        '10n': '<i class="fas fa-cloud-moon-rain"></i>',  // rain night
        '11d': '<i class="fas fa-bolt"></i>',  // thunderstorm day
        '11n': '<i class="fas fa-bolt"></i>',  // thunderstorm night
        '13d': '<i class="fas fa-snowflake"></i>',  // snow day
        '13n': '<i class="fas fa-snowflake"></i>',  // snow night
        '50d': '<i class="fas fa-smog"></i>',  // mist day
        '50n': '<i class="fas fa-smog"></i>'   // mist night
      };
      return iconMap[iconCode];
    }

    // Get user's current location
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const { latitude, longitude } = position.coords;
            getWeather(latitude, longitude);
          },
          (error) => {
            weatherInfo.innerHTML = 'Unable to retrieve your location';
            console.error('Geolocation error:', error);
          }
        );
      } else {
        weatherInfo.innerHTML = 'Geolocation is not supported by this browser';
      }
    }

    // Fetch weather on page load
    getLocation();
  });
</script>

</body>

</html>