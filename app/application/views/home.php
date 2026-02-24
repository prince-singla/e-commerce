<div class="container mt-4">

    <!-- HERO SLIDER -->
    <div id="heroSliderContent" class="mb-5"></div>

    <!-- FEATURED PRODUCTS -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="section-title mb-0">Featured Products</h4>
                <small class="text-muted">Hand-picked for you</small>
            </div>
        </div>
        <div id="featuredProducts"></div>
    </div>

    <!-- RECENT ARRIVALS -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="section-title mb-0">Recent Arrivals</h4>
                <small class="text-muted">Just dropped</small>
            </div>
        </div>
        <div id="recentProducts"></div>
    </div>

    <!-- BESTSELLER -->
    <div class="mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="section-title mb-0">Best Seller</h4>
                <small class="text-muted">Top rated products</small>
            </div>
        </div>
        <div id="bestsellerProducts"></div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        fetch(BASE_URL + 'api/home')
            .then(res => res.json())
            .then(res => {

                const data = res.data;

                renderHero(data.hero);
                renderProducts('featuredProducts', data.featured);
                renderProducts('recentProducts', data.recent);
                renderProducts('bestsellerProducts', data.bestseller);

                AOS.refreshHard();

            })
            .catch(err => console.error(err));

    });


    // ================= HERO SLIDER =================
    function renderHero(products){

        let html = `
    <div id="heroSlider" class="carousel slide"
         data-bs-ride="carousel" data-bs-interval="2500">

        <div class="carousel-indicators">
    `;

        products.forEach((p, i)=>{
            html += `
        <button type="button"
            data-bs-target="#heroSlider"
            data-bs-slide-to="${i}"
            class="${i==0?'active':''}">
        </button>`;
        });

        html += `</div><div class="carousel-inner rounded-4 overflow-hidden">`;

        products.forEach((p, i)=>{

            let img = p.image
                ? BASE_URL + 'uploads/products/' + p.image
                : `https://picsum.photos/1200/420?random=${p.id}`;

            html += `
        <div class="carousel-item ${i==0 ? 'active':''}"
             onclick="window.location.href='${BASE_URL}products/view/${p.id}'"
             style="cursor:pointer;">

            <img src="${img}" class="d-block w-100"
                 style="height:420px;object-fit:contain;background:#f8f9ff;">

            <div class="carousel-caption text-dark">
                <div class="p-3 rounded-4"
                     style="background: rgba(255,255,255,0.75); display:inline-block;">
                    <h3 class="fw-bold">${p.name}</h3>
                    <p>${p.description ? p.description.substring(0,80) : ''}</p>
                </div>
            </div>

        </div>`;
        });

        html += `
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>`;

        document.getElementById('heroSliderContent').innerHTML = html;

        setTimeout(()=>{
            new bootstrap.Carousel(document.querySelector('#heroSlider'), {
                interval: 2500,
                ride: 'carousel'
            });
        }, 200);
    }



    // ================= PRODUCTS =================
    function renderProducts(containerId, products){

        let html = '<div class="row">';

        products.forEach(p=>{

            let img = p.image
                ? BASE_URL + 'uploads/products/' + p.image
                : `https://picsum.photos/400/300?random=${p.id}`;

            html += `
        <div class="col-md-3 mb-3" data-aos="zoom-in">

            <div class="card product-card h-100">

                <a href="${BASE_URL}products/view/${p.id}" style="text-decoration:none;color:inherit;">
                    <img src="${img}"
                         style="height:220px;object-fit:contain;background:#f8f9ff;padding:12px;">
                </a>

                <div class="card-body">

                    <a href="${BASE_URL}products/view/${p.id}" style="text-decoration:none;color:inherit;">
                        <h6 class="fw-semibold">${p.name}</h6>
                    </a>

                    <p class="text-muted small">
                        ${p.description ? p.description.substring(0,40)+'...' : ''}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            ${
                p.offer_price < p.original_price
                    ? `<div class="price-old">₹${p.original_price}</div>
                                 <div class="price-new">₹${p.offer_price}</div>`
                    : `<div class="price-new">₹${p.original_price}</div>`
            }
                        </div>

                        <button onclick="event.stopPropagation(); addToCart(${p.id})"
                                class="btn btn-sm btn-pastel">
                            Add
                        </button>

                    </div>

                </div>

            </div>

        </div>`;
        });

        html += '</div>';

        document.getElementById(containerId).innerHTML = html;
    }



    // ================= ADD TO CART =================
    function addToCart(id){

        fetch(BASE_URL + 'api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + id
        })
            .then(res => res.json())
            .then(data => {

                if(data.status){
                    updateCartCount();
                    alert('Product added to cart!');
                } else {
                    alert('Error adding product');
                }

            })
            .catch(err => console.error(err));
    }



    // ================= UPDATE CART COUNT =================
    function updateCartCount(){

        fetch(BASE_URL + 'api/cart/count')
            .then(res => res.json())
            .then(res => {
                document.getElementById('cartCountBadge').innerText = res.count;
            });
    }
</script>