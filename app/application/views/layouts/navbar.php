<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-2">

        <!-- Logo Left -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Cart-Mart" style="height:42px;">
            <span class="fw-bold">Cart-Mart</span>
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">

            <!-- Nav Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="<?= base_url() ?>">Home</a>
                </li>

                <!-- MEN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        Men
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('products/category/men') ?>">All Men</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/men') ?>">Shirts</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/men') ?>">Shoes</a></li>
                    </ul>
                </li>

                <!-- WOMEN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        Women
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('products/category/women') ?>">All Women</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/women') ?>">Dresses</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/women') ?>">Handbags</a></li>
                    </ul>
                </li>

                <!-- KIDS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        Kids
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('products/category/kids') ?>">All Kids</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/kids') ?>">T-Shirts</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products/category/kids') ?>">Footwear</a></li>
                    </ul>
                </li>

            </ul>

            <!-- Right Side: Cart + Login -->
            <div class="d-flex align-items-center gap-3">

                <a href="<?= base_url('cart') ?>" class="btn btn-light position-relative rounded-pill px-3">
                    <i class="bi bi-cart3"></i>
                    <span class="ms-1">Cart</span>

                    <!-- Cart Count (static for now) -->
                    <?php
                    $cart = $this->session->userdata('cart');
                    $cart_count = 0;

                    if($cart && is_array($cart)){
                        foreach($cart as $qty){
                            $cart_count += (int)$qty;
                        }
                    }
                    ?>

                    <span id="cartCountBadge"
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                         <?= $cart_count ?>
                    </span>


                </a>

                <?php if($this->session->userdata('user_id')): ?>

                    <?php $image = $this->session->userdata('image'); ?>

                    <div class="dropdown">
                        <button class="btn btn-pastel dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">

                            <!-- PROFILE IMAGE -->
                            <?php
                            $image = $this->session->userdata('image');

                            if(!empty($image)){

                                // 🔥 Check if Google URL
                                if(filter_var($image, FILTER_VALIDATE_URL)){
                                    $imgPath = $image;
                                }
                                // 🔥 Local upload
                                elseif(file_exists(FCPATH.'uploads/users/'.$image)){
                                    $imgPath = base_url('uploads/users/'.$image);
                                }
                                else {
                                    $imgPath = base_url('assets/img/default-user.png');
                                }

                            } else {
                                $imgPath = base_url('assets/img/default-user.png');
                            }
                            ?>

                            <img src="<?= $imgPath ?>"
                                 style="width:32px;height:32px;border-radius:50%;object-fit:cover;">

                            <!-- NAME -->
                            Hi, <?= $this->session->userdata('name') ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('orders') ?>">My Orders</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-pastel">
                        Login
                    </a>
                <?php endif; ?>


            </div>

        </div>
    </div>
</nav>
