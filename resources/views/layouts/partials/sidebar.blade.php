<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="#">
                <img class="img-fluid for-light" src="" alt="">
                <img class="img-fluid for-dark" src="" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid"
                    src="" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid"
                                src="" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="">Welcome!</h6>
                            <p class="">Greetings from</p>
                        </div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav active"
                            href="#"><i data-feather="home"> </i><span>Dashboard</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('project.show') }}"><i data-feather="file"> </i><span>Project</span></a>
                    </li>
                    <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('client.show') }}"><i data-feather="users"> </i><span>Client</span></a>
                    </li> -->
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="users"></i><span>Client</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('client.show') }}">Client List</a></li>
                            <li><a href="{{ route('client.show') }}">Assign Project</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="#"><i data-feather="dollar-sign"> </i><span>Cash</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="#"><i data-feather="chevrons-down"> </i><span>Withdraw</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                            href="#"><i data-feather="trending-up"> </i><span>Revenue</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="file-text"></i><span>Settings</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">User Type</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->