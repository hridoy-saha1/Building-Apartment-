<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Discover Room</title>
  <link rel="stylesheet" href="../css/rooms.css">
</head>
<body>

<div class="room-wrapper">
  <h1>Discover Room</h1>

  <!-- Tabs -->
  <div class="tabs">
    <button class="tab active" onclick="showRoom(0)">Living Room</button>
    <button class="tab" onclick="showRoom(1)">Dining Room</button>
    <button class="tab" onclick="showRoom(2)">Kitchen</button>
    <button class="tab" onclick="showRoom(3)">Master Bedroom</button>
    <button class="tab" onclick="showRoom(4)">Bathroom</button>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Left -->
    <div class="text-box">
      <h2 id="room-name">Living Room</h2>
      <p id="room-desc">
        A cozy, social hub with plush seating and entertainment. Ideal for relaxing, gatherings, and family time.
      </p>
    </div>

    <!-- Right -->
    <div class="image-box">
      <img id="room-img" src="../Image/living.jpg" alt="Living Room">
      <span id="room-size">20 m²</span>
    </div>
  </div>
</div>

<script src="../JS/rooms.js"></script>

</body>
</html>
