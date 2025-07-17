<div id="side-menu" class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu-nav">
            <li>
                <a href="index.php" class="<?php echo ($p == 'home') ? 'active' : ''; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#" class="<?php echo (in_array($p, ['user', 'member'])) ? 'active' : ''; ?>"><i class="fa fa-users fa-fw"></i> User Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="modules/user/index.php" class="<?php echo ($p == 'user' && $module == 'user') ? 'active' : ''; ?>">Employee Account</a>
                    </li>
                    <li>
                        <a href="modules/member/index.php" class="<?php echo ($p == 'member') ? 'active' : ''; ?>">Student Account</a>
                    </li>
                     <li>
                        <a href="#">Parent Account</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
             <li>
                <a href="#"><i class="fa fa-cog fa-fw"></i> System Settings</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
