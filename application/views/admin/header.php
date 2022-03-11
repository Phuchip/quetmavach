<?php 
    $admin = $this->session->userdata('admin');
    
?>
<header class="main-header">
    <a href="index2.html" class="logo">
        <span class="logo-mini"><b>A</b>D</span>
        <span class="logo-lg"><b>Admin</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <style type="text/css">
                    .nav>li>a>img {
                        float: left;
                        width: 25px;
                        height: 25px;
                        border-radius: 50%;
                        margin-right: 10px;
                        margin-top: -2px;
                        max-width: none;
                    }
                </style>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if ($admin["image"] != "" || $admin["image"] != null) {?>
                            <img src="/<?=$admin["image"]?>" alt="User Image" class="img-circle">
                        <?}else{?>
                            <img src="/assets/admin/dist/img/t_img_login.svg" class="img-circle" alt="User Image">
                        <?}?>
                        <span class="hidden-xs"><?php echo $admin['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <?php if ($admin["image"] != "" || $admin["image"] != null) {?>
                                <img src="/<?=$admin["image"]?>" alt="User Image" class="img-circle">
                            <?}else{?>
                                <img src="/assets/admin/dist/img/t_img_login.svg" class="img-circle" alt="User Image">
                            <?}?>
                            <p>
                                <?php echo $admin['username'] ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin/logout" class="btn btn-default btn-flat" onclick="return confirm('Bạn có chắc muốn đăng xuất không?')">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                </li>
            </ul>
        </div>
    </nav>
</header>