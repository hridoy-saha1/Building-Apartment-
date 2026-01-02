document.addEventListener("DOMContentLoaded", function () {

  // Dhaka location
  const position = [23.8103, 90.4125];

  // Create map
  const map = L.map("map").setView(position, 14);

  // Tile layer
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors"
  }).addTo(map);

  // Marker
  L.marker(position)
    .addTo(map)
    .bindPopup(
      "<strong>OneBuilding Apartment</strong><br>1234 Green Residency, Gulshan Avenue"
    )
    .openPopup();

});
