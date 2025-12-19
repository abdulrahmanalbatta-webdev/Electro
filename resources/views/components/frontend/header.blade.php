<!-- Topbar Start -->
<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <!-- الشعار على اليسار -->
        <div class="col d-flex justify-content-start align-items-center">
            <a href="" class="navbar-brand p-0">
                <h1 class="display-5 text-orange m-0">Electro</h1>
            </a>
        </div>

        <!-- الـ Icons على اليمين -->
        <div class="col d-flex justify-content-end align-items-center">
            <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3">
                <span class="rounded-circle btn-md-square border">
                    <i class="fas fa-heart"></i>
                </span>
            </a>
            <a href="#" class="text-muted d-flex align-items-center justify-content-center">
                <span class="rounded-circle btn-md-square border">
                    <i class="fas fa-shopping-cart"></i>
                </span>
                <span class="text-dark ms-2">$0.00</span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">
        <div class="col-lg-3 d-none d-lg-block">
            <nav class="navbar navbar-light position-relative" style="width: 250px;">
                <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button"
                    data-bs-toggle="collapse" data-bs-target="#allCat">
                    <h4 class="m-0"><i class="fa fa-bars me-2"></i>All Categories</h4>
                </button>
                <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                    <div class="navbar-nav ms-auto py-0">
                        <ul class="list-unstyled categories-bars">
                            @foreach ($categories as $category)
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">{{ $category->trans_name_en }}</a>
                                        <span>({{ $category->products->count() }})</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <a href="" class="navbar-brand d-block d-lg-none">
                    <h1 class="display-5 text-secondary m-0">Electro</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{route('store.index')}}" class="nav-item nav-link {{request()->routeIs('store.index') ? 'active' : ''}}">Home</a>
                        <a href="{{route('store.shop')}}" class="nav-item nav-link {{request()->routeIs('store.shop') ? 'active' : ''}}">Shop</a>
                        <a href="{{route('store.contact')}}" class="nav-item nav-link me-2 {{request()->routeIs('store.contact') ? 'active' : ''}}">Contact</a>
                        <div class="nav-item dropdown d-block d-lg-none mb-3">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">All
                                Category</a>
                            <div class="dropdown-menu m-0">
                                <ul class="list-unstyled categories-bars">
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Accessories</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Electronics & Computer</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Laptops & Desktops</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Mobiles & Tablets</a>
                                            <span>(8)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">SmartPhone & Smart TV</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->
