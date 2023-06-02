<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <hr>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.category.index') }}">All Category</a>
                        <a class="nav-link" href="{{ route('admin.category.create') }}">Create Category</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subcats" aria-expanded="false" aria-controls="subcats">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Sub Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="subcats" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.subcat.index') }}">All Sub-Category</a>
                        <a class="nav-link" href="{{ route('admin.subcat.create') }}">Create Sub-Category</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#caste" aria-expanded="false" aria-controls="caste">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Caste
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="caste" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.caste.index') }}">All Caste</a>
                        <a class="nav-link" href="{{ route('admin.caste.create') }}">Create Caste</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#garden" aria-expanded="false" aria-controls="garden">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Garden
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="garden" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.garden.index') }}">All Garden</a>
                        <a class="nav-link" href="{{ route('admin.garden.create') }}">Create Garden</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#WebsiteSetting" aria-expanded="false" aria-controls="WebsiteSetting">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Website Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="WebsiteSetting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.website-setting.edit') }}">Edit Website Setting</a>
                    </nav>
                </div>

            </div>
        </div>
    </nav>
</div>