<?php
require_once "db_conn.php";
        
     session_start();
  
     if (isset($_SESSION['user_name']) && isset($_GET['id'])) {
         $id = intval($_GET['id']);
         $sql = "SELECT result , scan_type , url FROM history WHERE id = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("i", $id);
         $stmt->execute();
         $stmt->store_result();
     
         if ($stmt->num_rows > 0) {
             $stmt->bind_result($result, $scan_type, $url);
             $stmt->fetch();
     
             $alerts = json_decode($result, true);
            //  echo $url;
             
     // Traitement des données pour le graphique
     $severityCounts = [
         'High' => 0,
         'Medium' => 0,
         'Low' => 0,
         'Informational' => 0
     ];
     foreach ($alerts as $alert) {
         $severity = $alert['risk'];
         if (isset($severityCounts[$severity])) {
             $severityCounts[$severity]++;
         } else {
             $severityCounts[$severity] = 1;
         }
     }

      // Calcul du total des alertes
      $totalAlerts = count($alerts);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../assets/img/logoVulneraScan1.png">
  <title>
    VulneraScan - Telechargement PDF
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
<!-- Include jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- Include jsPDF AutoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>
<!-- jsPDF needed packages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.1.5/purify.min.js" integrity="sha512-JatFEe90fJU2nrgf27fUz2hWRvdYrSlTEV8esFuqCtfiqWN8phkS1fUl/xCfYyrLDQcNf3YyS0V9hG7U4RHNmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style>
     #iframe-container,
     #iframe_div {
         width: 100%;
      }
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

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" ">
        <img src="../assets/img/logos/vulneraScan_logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">VulneraScan</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
  
      <ul class="navbar-nav">
        <!-- dashboard section list -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard1.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Accueil</span>
          </a>
        </li>
        <!-- historique section list -->
        <li class="nav-item">
          <a class="nav-link active" href="historique.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Historique</span>
          </a>
        </li>
        <!-- Scan section list -->
        <li class="nav-item">
          <a class="nav-link " href="scan.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Scan</span>
          </a>
        </li>
        <!-- Logout -->
        <li class="nav-item">
          <a class="nav-link " href="logout.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Besoin d'aide?</h6>
            <p class="text-xs font-weight-bold mb-0">Veuillez consulter nos documents</p>
          </div>
        </div>
      </div>
      <a href="https://docs.google.com/document/d/1YRaSMCKLkyHlnmDbPiKoT5p6zXLwIqD5/edit?usp=sharing&ouid=115636460967030362882&rtpof=true&sd=true" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="contact_us.php" type="button">Contactez nous</a>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Historique</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Telechargement</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
             <div id="weatherContainer">
                 <div id="weatherInfo" class="weather-info d-flex align-items-center"></div>
             </div>
         </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="nav-link text-white font-weight-bold px-0" href="logout.php">
                 <i class="fa fa-user me-sm-1"></i>
                 <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
    <div class="row mt-4">
         <div class="col align-self-center">
             <div class="card z-index-2 h-100">
                 <div class="d-flex justify-content-center align-items-center" id="iframe_div">
                     <img src="../assets/img/pdf_upload.png" alt="telechargement_icon" style="max-width: 40%; height: auto; opacity: 0.5; padding: 20px;">
                     <h3>
                      Merci pour votre confiance!<br>
                     <small class="text-muted">Check la boite de téléchargement</small>
                     </h3> 
                 </div>
             </div>
          </div>
      </div>
    </div>
  </main>


<!-- SETTING MOBILE THEME - DROPOUT MENU LISTE   -->
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">VulneraScan</h5>
          <p>Consultez nos options de tableau de bord.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Couleurs de Sidebar</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Type de Sidenav</h6>
          <p class="text-sm">Choisissez entre 2 types de Sidenav différents.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">Clair</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Sombre</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">Vous pouvez modifier le type de navigation latérale uniquement sur la vue du bureau.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar fixée</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Clair / Sombre</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn btn-outline-dark w-100" href="https://github.com/ranaitsan123/VulneraScan">voir la documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/ranaitsan123/VulneraScan" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Etoile</a>
          <h6 class="mt-3">Merci pour le partage!</h6>
          <a href="https://twitter.com/intent/tweet?text=I%20want%20to%20thank%20vulneraScan%20for%20making%20it%20easy%20for%20non-developers%20to%20scan%20their%20web%20apps!%20It's%20incredible%20how%20they%20use%20OWASP%20ZAP%20API%20technology.%20This%20tool%20is%20a%20game-changer%20for%20web%20security%20and%20will%20definitely%20stand%20out%20on%20the%20job%20market.%20%23vulneraScan%20%23websecurity%20%23jobmarket" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Partager
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <!-- GRAPH SECTION -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <!-- PDF GENERATION -->
  <script>
    // Get data from PHP or mock data for testing
    const totalAlerts = <?php echo $totalAlerts; ?>;
    const highAlerts = <?php echo $severityCounts['High']; ?>;
    const mediumAlerts = <?php echo $severityCounts['Medium']; ?>;
    const lowAlerts = <?php echo $severityCounts['Low']; ?>;
    const infoAlerts = <?php echo $severityCounts['Informational']; ?>;

window.jsPDF = window.jspdf.jsPDF;

// Create a new jsPDF instance
const pdf = new jsPDF();

// Add title
let y = 10;
pdf.setFontSize(18);
pdf.text("Summary of Alerts", 10, y);
y += 10;

// Add table for summary
pdf.setFontSize(12);
const tableData = [
    [totalAlerts, highAlerts, mediumAlerts, lowAlerts, infoAlerts]
];
pdf.autoTable({
    startY: y,
    head: [['Total Alerts', 'High', 'Medium', 'Low', 'Informational']],
    body: tableData
});
y = pdf.autoTable.previous.finalY + 10;

// Add chart
const chartData = [highAlerts, mediumAlerts, lowAlerts, infoAlerts];
const chartLabels = ['High', 'Medium', 'Low', 'Informational'];
const chartWidth = 100;
const chartHeight = 80;
const startX = 10;

// Draw axes
pdf.setLineWidth(0.5);
pdf.line(startX, y, startX, y + chartHeight); // Y axis
pdf.line(startX, y + chartHeight, startX + chartWidth, y + chartHeight); // X axis

const maxCount = Math.max(...chartData);
const barWidth = chartWidth / chartData.length;
const scale = chartHeight / maxCount;

for (let i = 0; i < chartData.length; i++) {
    const x = startX + i * barWidth + barWidth / 4;
    const height = chartData[i] * scale;
    pdf.setFillColor(51, 122, 183); // Bar color
    pdf.rect(x, y + chartHeight - height, barWidth / 2, height, 'F');
    pdf.setTextColor(0);
    pdf.text(chartLabels[i], x + barWidth / 8, y + chartHeight + 5);
}

// Add title for details of alerts tables
pdf.setFontSize(16);
pdf.text("Details of Alerts", 10, y + chartHeight + 20);
y += chartHeight + 30;

// Data for the tables (you can replace this with your PHP fetched data)
var alerts = <?php echo json_encode($alerts); ?>;

// Define the initial startYPosition
const startYPosition = y;

// Define an array to hold the unique risk levels
const riskLevels = ['High', 'Medium', 'Low', 'Informational'];

// Loop through each risk level to render alerts
riskLevels.forEach(riskLevel => {
// Filter alerts for the current risk level
const alertsForRiskLevel = alerts.filter(alert => alert.risk === riskLevel);

// Check if there are alerts for this risk level
if (alertsForRiskLevel.length > 0) {
    // Render subtitle for the section
    pdf.setFontSize(16);
    pdf.text(`Details of ${riskLevel} Alerts`, 10, y);
    y += 10;

    // Render each alert for this risk level
    alertsForRiskLevel.forEach(alert => {
        // Add a spacer if this is not the first alert in the section
        if (y !== startYPosition) {
            y += 10; // Add spacing between alerts
        }

        // Render the header row for the alert
        pdf.autoTable({
            startY: y,
            head: [[alert.risk, alert.alert]],
            body: []
        });

        // Increment y to move to the next row
        y += 10;

        // Render the details rows for the alert
        const detailsData = [
            ['Description', alert.description || 'N/A'],
            ['URL', alert.url || 'N/A'],
            ['Method', alert.method || 'N/A'],
            ['Attack', alert.attack || 'N/A'],
            ['Evidence', alert.evidence || 'N/A'],
            ['Solution', alert.solution || 'N/A'],
            ['Reference', alert.reference || 'N/A'],
            ['Plugin Id', alert.pluginId || 'N/A']
        ];

        pdf.autoTable({
            startY: y,
            head: [],
            body: detailsData
        });

        // Update y for the next alert
        y = pdf.autoTable.previous.finalY;
    });

    // Add some extra space after the section
    y += 10;
} else {
    // Render a message if no alerts are found for this risk level
    pdf.setFontSize(14);
    pdf.setTextColor(255, 0, 0); // Red color for emphasis
    pdf.text(`No ${riskLevel} Alerts Found`, 10, y);
    y += 20; // Add extra space for the message
}
});

// Update y for the next content
y += 10; // Add some extra space after the details of alerts table

// Save PDF
pdf.save('alerts_summary.pdf');

</script>

<!-- WEATHER SCRIPT API -->
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
<?php
    } else {
        echo "No record found.";
    }
    $stmt->close();
} else {
    echo "Unauthorized access.";
}
$conn->close();
?>