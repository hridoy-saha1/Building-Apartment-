const rooms = [
  {
    name: "Living Room",
    desc: "A cozy, social hub with plush seating and entertainment. Ideal for relaxing, gatherings, and family time.",
    size: "20 m²",
    img: "../Image/living.jpg"
  },
  {
    name: "Dining Room",
    desc: "An elegant space designed for meals and conversations, perfect for family dinners or hosting guests.",
    size: "15 m²",
    img: "../Image/dining.jpg"
  },
  {
    name: "Kitchen",
    desc: "A modern cooking area equipped with appliances and ample storage for efficient meal preparation.",
    size: "12 m²",
    img: "../Image/kitchen.jpg"
  },
  {
    name: "Master Bedroom",
    desc: "A spacious retreat with comfort and privacy, offering relaxation and restful nights.",
    size: "25 m²",
    img: "../Image/master.jpg"
  },
  {
    name: "Bathroom",
    desc: "A clean and refreshing space with modern fixtures, designed for relaxation and hygiene.",
    size: "8 m²",
    img: "../Image/bathroom.jpg"
  }
];

function showRoom(index) {
  document.getElementById("room-name").innerText = rooms[index].name;
  document.getElementById("room-desc").innerText = rooms[index].desc;
  document.getElementById("room-img").src = rooms[index].img;
  document.getElementById("room-size").innerText = rooms[index].size;

  document.querySelectorAll(".tab").forEach(tab =>
    tab.classList.remove("active")
  );

  document.querySelectorAll(".tab")[index].classList.add("active");
}
