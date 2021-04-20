<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MMO Manager <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                ETSY
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Best stores</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Best stores</h6>
                        <a class="collapse-item" href="http://etsy.com/shop/dachtx" target="_blank">Dachtx</a>
                        <a class="collapse-item" href="http://etsy.com/shop/hanateenshop" target="_blank">HanaTeenShop</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Etsy Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEtsy"
                    aria-expanded="true" aria-controls="collapseEtsy">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Etsy Manager</span>
                </a>
                <div id="collapseEtsy" class="collapse <?=isset($showMenu) && $showMenu == 'etsy' ? 'show' : ''?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Etsy Orders:</h6>
                        <a class="collapse-item" href="etsysummary">Etsy Summary</a>
                        <a class="collapse-item" href="etsyorder">Etsy Orders</a>

                        <div class="collapse-divider"></div>

                        <h6 class="collapse-header">Etsy Stores:</h6>
                        <a class="collapse-item" href="/etsy">Etsy Shops</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PAYMENT
            </div>

            <!-- Nav Item - Paypal Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaypal"
                    aria-expanded="true" aria-controls="collapsePaypal">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Paypal Manager</span>
                </a>
                <div id="collapsePaypal" class="collapse <?=isset($showMenu) && $showMenu == 'paypal' ? 'show' : ''?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Paypal Orders:</h6>
                        <a class="collapse-item" href="paypal">Paypal Accounts</a>
                        <a class="collapse-item" href="paypaltransaction">Paypal Transaction</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Payoneer Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/paypal">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Payoneer</span>
                </a>
            </li>

            <!-- Nav Item - Pingpong Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/paypal">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pingpong</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Emails Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/email">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Emails</span>
                </a>
            </li>

            <!-- Nav Item - Activities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/activity">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Activities</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>