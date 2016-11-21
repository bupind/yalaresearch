<aside id="menu">
    <div id="navigation">

        <!-- Profile -->
        <div class="profile-picture">
            <a href="<?=admin_url('settings/profile')?>">
                <img src="<?=userProfilePics(getUser())?>" class="img-circle m-b" alt="<?=getUser()->username?>">
            </a>

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase"><?=getFullName(getUser())?></span>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small class="text-muted"><?=getUser()->designation?> <b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                        <li><a href="<?=admin_url('settings/accounts')?>">Accounts</a></li>
                        <li><a href="<?=admin_url('settings/profile')?>">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=admin_url('logout')?>">Logout</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <!-- Profile -->

        <ul class="nav" id="side-menu">
            
            <li class="active">
                <a href="<?=admin_url('dashboard')?>"> <span class="nav-label">Dashboard</span> <span class="label label-success pull-right"></span> </a>
            </li>

            <li>
                <a href="<?=admin_url('message')?>"> <span class="nav-label">Messages</span><span class="label label-success pull-right">5</span> </a>
            </li>

            <li>
                <a href="#"><span class="nav-label">Settings</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?=admin_url('settings/accounts')?>">Accounts</a></li>
                    <li><a href="<?=admin_url('settings/profile')?>">Profile</a></li>
                </ul>
            </li>

        </ul>

    </div>
</aside>