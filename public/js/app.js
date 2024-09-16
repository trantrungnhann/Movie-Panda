const user = document.querySelector("#user");
const logout = document.querySelector("#logout");
const cart = document.querySelector("#cart");
const products = document.querySelectorAll(".card-item");
cart.setAttribute("data-count", cart.dataset.count);

products.forEach((product) => {
  product.addEventListener("click", function () {
    localStorage.setItem("filmNameLocal", product.dataset.name);
  });
});

function checkMinMax(input) {
  const value = parseFloat(input.value);
  if (value < input.min) input.value = input.min;
  if (value > input.max) input.value = input.max;
}
