let receiver = document.querySelector(".receiver");
let hospital = document.querySelector(".hospital");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");

receiver.addEventListener("click", () => {
  slider.classList.add("moveslider");
  formSection.classList.add("form-section-move");
});

hospital.addEventListener("click", () => {
  slider.classList.remove("moveslider");
  formSection.classList.remove("form-section-move");
});
