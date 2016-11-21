<div id="header">
    <div class="color-line"></div>

    <div id="logo">
        <h3 class="logo">Yala<span>Research</span></h3>
    </div>

    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        
        <div class="small-logo">
            <span class="text-primary logo-dark">Yala<span>Research</span></span>
        </div>
        

        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="<?=admin_url('settings/account')?>">Settings</a>
                    </li>
                    <li>
                        <a class="" href="<?=admin_url('settings/profile')?>">Profile</a>
                    </li>
                    <li>
                        <a class="" href="<?=admin_url('logout')?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                
                <!-- Notification -->
                <li class="dropdown">
                    <a class="dropdown-toggle label-menu-corner" href="#" data-toggle="dropdown">
                        <i class="pe-7s-speaker"></i>
                        <span class="label label-danger">3</span>
                    </a>
                    <ul class="dropdown-menu hdropdown notification animated flipInX">
                        <li>
                            <a>
                                <span class="label label-success">NEW</span> It is a long established.
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="label label-warning">WAR</span> There are many variations.
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="label label-danger">ERR</span> Contrary to popular belief.
                            </a>
                        </li>
                        <li class="summary"><a href="#">See all notifications</a></li>
                    </ul>
                </li>
                <!-- /Notification -->

                <!-- Messages -->
                <li class="dropdown">
                    <a class="dropdown-toggle label-menu-corner" href="#" data-toggle="dropdown">
                        <i class="pe-7s-mail"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu hdropdown animated flipInX">
                        <div class="title">
                            You have 4 new messages
                        </div>
                        <li>
                            <a>
                                It is a long established.
                            </a>
                        </li>
                        <li>
                            <a>
                                There are many variations.
                            </a>
                        </li>
                        <li>
                            <a>
                                Lorem Ipsum is simply dummy.
                            </a>
                        </li>
                        <li>
                            <a>
                                Contrary to popular belief.
                            </a>
                        </li>
                        <li class="summary"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Messages -->

                <!-- QuickLinks -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="pe-7s-keypad"></i>
                    </a>

                    <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="pe pe-7s-portfolio text-info"></i>
                                            <h5>Publications</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="pe pe-7s-mail text-warning"></i>
                                            <h5>Messages</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="pe pe-7s-users text-success"></i>
                                            <h5>Contacts</h5>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="pe pe-7s-comment text-info"></i>
                                            <h5>Forum</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="pe pe-7s-graph1 text-danger"></i>
                                            <h5>Analytics</h5>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=admin_url('logout')?>">
                                            <i class="pe-7s-upload pe-rotate-90 text-danger"></i>
                                            <h5>Logout</h5>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <!-- QuickLinks -->

            </ul>
        </div>
        
    </nav>
</div>