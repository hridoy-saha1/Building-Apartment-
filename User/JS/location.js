document.addEventListener("DOMContentLoaded", function () {

  const position = [23.8103, 90.4125];

  const map = L.map("map").setView(position, 14);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors"
  }).addTo(map);

  L.marker(position)
    .addTo(map)
    .bindPopup(
      "<strong>OneBuilding Apartment</strong><br>1234 Green Residency, Gulshan Avenue"
    )
    .openPopup();

});
