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
    VulneraScan - Se connecter
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
        color: grey;
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
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="index.php">
              <img src="../logo.png" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 40px;">
              VulneraScan
          </a>          
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="d-flex justify-content-end" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link me-2" href="https://docs.google.com/document/d/1YRaSMCKLkyHlnmDbPiKoT5p6zXLwIqD5/edit?usp=sharing&ouid=115636460967030362882&rtpof=true&sd=true">
                    <i class="fas fa-file opacity-6 text-dark me-1"></i>
                    Documentation
                </a>                
                </li>           
              </ul>
              <div class="ms-md-auto pe-md-3 d-flex align-items-center">
             <div id="weatherContainer">
                 <div id="weatherInfo" class="weather-info d-flex align-items-center"></div>
             </div>
         </div>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto mt-5">
             <div class="card-header pb-0 text-start">
                 <h4 class="font-weight-bolder">Se connecter</h4>
                 <p class="mb-0">Entrez votre email et votre mot de passe pour vous connecter</p>
             </div>
             <div class="card-body">
                 <form action="login.php" method="post"> <!-- Added action attribute pointing to the PHP processing script -->
                     <div class="mb-3">
                         <input type="text" class="form-control form-control-lg" name="uname" placeholder="Email" aria-label="Email">
                     </div>
                     <div class="mb-3">
                         <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" aria-label="Password">
                     </div>
                     <div class="form-check form-switch">
                         <input class="form-check-input" type="checkbox" id="rememberMe">
                         <label class="form-check-label" for="rememberMe">Souvient-moi</label>
                     </div>
                     <div class="text-center">
                         <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Se connecter</button>
                     </div>         
                     <?php if (isset($_GET['error'])) { ?>
                         <p class="text-danger"><?php echo $_GET['error']; ?></p> <!-- PHP error message -->
                     <?php } ?>
                 </form>
             </div>
             <div class="card-footer text-center pt-0 px-lg-2 px-1">
                 <p class="mb-4 text-sm mx-auto">
                     Vous n'avez pas de compte ?
                     <a href="signup.php" class="text-primary text-gradient font-weight-bold">S'inscrire</a>
                 </p>
             </div>
         </div>
         <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                  background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Vigilance: Le Nouveau Précieux"</h4>
                <p class="text-white position-relative">La sécurité requiert une vigilance constante. Bienvenue sur notre outil de détection de vulnérabilités. Restez protégé sans effort.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
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