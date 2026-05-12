const modal = document.getElementById("petModal");

const modalImage = document.getElementById("modalImage");
const modalName = document.getElementById("modalName");
const modalAge = document.getElementById("modalAge");
const modalWeight = document.getElementById("modalWeight");
const modalSpecies = document.getElementById("modalSpecies");
const modalSize = document.getElementById("modalSize");
const modalLocation = document.getElementById("modalLocation");
const modalDescription = document.getElementById("modalDescription");
const modalLink = document.getElementById("modalLink");

const closeBtn = document.querySelector(".close");


document.querySelectorAll(".pet-image").forEach(image => {

    image.addEventListener("click", () => {

        modal.style.display = "flex";

        modalImage.src = image.dataset.image;

        modalName.textContent = image.dataset.name;

        modalAge.textContent = image.dataset.age;

        modalWeight.textContent = image.dataset.weight;

        modalSpecies.textContent = image.dataset.species;

        modalSize.textContent = image.dataset.size;

        modalLocation.textContent = image.dataset.location;

        modalDescription.textContent = image.dataset.description;

        modalLink.href = image.dataset.link;

    });

});


closeBtn.addEventListener("click", () => {

    modal.style.display = "none";

});


window.addEventListener("click", (e) => {

    if(e.target === modal){

        modal.style.display = "none";

    }

});