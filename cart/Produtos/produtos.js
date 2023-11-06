document.addEventListener("DOMContentLoaded", function () {
    fetch("mock.json")
        .then(response => response.json())
        .then(data => {
            const carousel = document.querySelector(".carousel-inner");

            data.forEach((product, index) => {
                const carouselItem = document.createElement("div");
                carouselItem.classList.add("carousel-item");
                if (index === 0) {
                    carouselItem.classList.add("active");
                }
            
                const productImage = new Image();
                productImage.src = product.image;
                productImage.alt = product.name;
                productImage.style.borderRadius= "50%"
                productImage.classList.add("d-block", "max-width-100", "max-height-100");
            
                const itemContent = document.createElement("div");
                itemContent.classList.add("carousel-caption");
                itemContent.style.color = "#333"; 
                itemContent.style.padding = "10px";
                itemContent.innerHTML = `
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <p>Preço: R$ ${product.price.toFixed(2)}</p>
                    <a href="../PaginaProduto/?id=${product.id}">Detalhes</a>
                `;
            
                const carouselInner = document.createElement("div");
                carouselInner.classList.add("d-flex", "justify-content-between");
                carouselInner.appendChild(productImage);
                carouselInner.appendChild(itemContent);
            
                carouselItem.appendChild(carouselInner);
                carousel.appendChild(carouselItem);
            });
            

            const productList = document.getElementById("product-list");
            data.forEach(product => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `
                    <h2>${product.name}</h2>
                    <p>${product.description}</p>
                    <p>Preço: R$ ${product.price.toFixed(2)}</p>
                    <a href="../PaginaProduto/?id=${product.id}">Detalhes</a>
                `;
                productList.appendChild(listItem);
            });
        })
        .catch(error => console.error("Erro ao carregar os produtos:", error));
});
