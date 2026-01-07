<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Apartment Location</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />

 
  <link rel="stylesheet" href="../css/location.css" />
</head>
<body>

  <section class="location-section">
    <h2 class="section-title">Apartment Location & How to Get There</h2>

    <div class="content-wrapper">
    
      <div class="text-area">
        <p>
          Our apartment is conveniently located in the heart of Dhaka,
          making commuting easy and hassle-free. The address is
          <strong>1234 Green Residency, Gulshan Avenue, Dhaka 1212</strong>.
        </p>

        <p class="sub-title">You can reach us via:</p>
        <ul>
          <li>Taxi or rideshare services (Uber, Pathao)</li>
          <li>Public bus routes stopping nearby</li>
          <li>Easy access from major highways</li>
          <li>Close to Gulshan metro station (5 minutes walk)</li>
        </ul>
      </div>

     
      <div class="map-area">
        <div id="map"></div>
      </div>
    </div>
  </section>

  
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  
  <script src="../js/location.js"></script>
</body>
</html>
