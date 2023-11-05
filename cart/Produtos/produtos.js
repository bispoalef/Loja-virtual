document.addEventListener("DOMContentLoaded", function () {
    fetch("mock.json")
        .then(response => response.json())
        .then(data => {
            const carousel = document.getElementById("carousel");
            data.forEach(product => {
                const carouselItem = document.createElement("div");
                carouselItem.classList.add("carousel-item", "carousel-animation");

                const productImage = new Image();
                productImage.src = product.image;
                productImage.alt = product.name;
                productImage.classList.add("product-image");
                productImage.style.maxWidth = "200px";

                carouselItem.appendChild(productImage);
                carouselItem.innerHTML += `
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <p>Preço: R$ ${product.price.toFixed(2)}</p>
                    <a href="../PaginaProduto/index.html">Detalhes</a>
                `;
                carousel.appendChild(carouselItem);
            });


            const productList = document.getElementById("product-list");
            data.forEach(product => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `
                    <h2>${product.name}</h2>
                    <p>${product.description}</p>
                    <p>Preço: R$ ${product.price.toFixed(2)}</p>
                    <a href="../PaginaProduto/index.html">Detalhes</a>
                `;
                productList.appendChild(listItem);
            });
        })
        .catch(error => console.error("Erro ao carregar os produtos:", error));
});
