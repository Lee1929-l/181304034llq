<!-- 主侧边栏容器 -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- 品牌 Logo -->
    <a href='<?= base_url("admin/admin") ?>' class="brand-link">

        <img src='<?= base_url("static/admin/dist/img/AdminLTELogo.png") ?>' alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">后台管理系统</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- 侧边栏用户面板（可选） -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src='<?= base_url("static/dist/img/user2-160x160.jpg") ?>' class="img-circle elevation-2"
                    alt="用户头像">
            </div>
            <div class="info">
                <a>管理员：<?php echo $this->session->userdata('admin_info')['user_name'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="搜索" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- 侧边栏菜单 -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- 使用 .nav-icon 类添加图标，
               或使用 font-awesome 或其他任何图标字体库 -->
                <li class="nav-item">
                    <a href='<?= base_url("adminsystem/user") ?>'
                        class="nav-link <?php echo @$active == 'usermanageview' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            平台用户管理
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href='<?= base_url("adminsystem/college") ?>'
                        class="nav-link <?php echo @$active == 'collegemanageview' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            高校管理
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href='<?= base_url("adminsystem/company") ?>'
                        class="nav-link <?php echo @$active == 'companymanageview' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            企业管理
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href='<?= base_url("adminsystem/cooperation_case") ?>'
                        class="nav-link <?php echo @$active == 'casemanageview' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            合作案例管理
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item <?php echo @in_array($active, array('make_spaceview', 'collegeview', 'teamview', 'tutorview', 'activityview')) ? 'menu-open' : '' ?>">
                    <a href="#"
                        class="nav-link <?php echo @in_array($active, array('make_spaceview', 'collegeview', 'teamview', 'tutorview', 'activityview')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-hands"></i>
                        <p>
                            创业孵化数据管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/make_space/") ?>'
                                class="nav-link <?php echo @$active == 'make_spaceview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>孵化器众创空间</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/university/") ?>'
                                class="nav-link  <?php echo @$active == 'universityview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>创新创业学院</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/team/") ?>'
                                class="nav-link  <?php echo @$active == 'teamview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>创新创业团队</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/tutor/") ?>'
                                class="nav-link  <?php echo @$active == 'tutorview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>创新创业导师</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/activity/") ?>'
                                class="nav-link  <?php echo @$active == 'activityview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>创新创业活动</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item <?php echo @in_array($active, array('informationview', 'noticeview', 'regulationview')) ? 'menu-open' : '' ?>">
                    <a href="#"
                        class="nav-link <?php echo @in_array($active, array('informationview', 'noticeview', 'regulationview')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            科技资讯数据管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/information/") ?>'
                                class="nav-link <?php echo @$active == 'informationview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>新闻资讯</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/notice/") ?>'
                                class="nav-link  <?php echo @$active == 'noticeview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>通知公告</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/regulation/") ?>'
                                class="nav-link  <?php echo @$active == 'regulationview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>政策法规</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            招聘数据管理
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item <?php echo @$list_active != '' || @$train_active != '' || @$post_active != '' || @$salary_active != '' ? 'menu-open' : '' ?>">
                    <a href="#"
                        class="nav-link <?php echo @$list_active != '' || @$train_active != '' || @$post_active != '' || @$salary_active != '' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            企业人力资源管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: <?php echo @$list_active != '' || @$train_active != '' || @$post_active != '' || @$salary_active != '' ? 'block' : 'none' ?>;">
                        <li class="nav-item ">
                            <a href='<?= base_url("adminsystem/internlistmanage/index") ?>'
                                class="nav-link <?php if (isset($list_active) && $list_active != '') echo ('active') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    实习生名单管理
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/interntrainmanage/index") ?>'
                                class="nav-link  <?php if (isset($train_active) && $train_active == 'index_active') echo ('active') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>实习生培训管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/internpostmanage/post_msg") ?>'
                                class="nav-link  <?php echo @$post_active == 'post_msg_active' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    实习生岗位管理
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/internsalarymanage/index") ?>'
                                class="nav-link  <?php if (isset($salary_active) && $salary_active == 'index_active') echo ('active') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>实习生薪资管理</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item <?php echo @in_array($active, array('tagmanageview', 'contactmanageview', 'sitemanageview')) ? 'menu-open' : '' ?>">
                    <a href="#"
                        class="nav-link <?php echo @in_array($active, array('tagmanageview', 'contactmanageview', 'sitemanageview')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            平台配置管理
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/tag/") ?>'
                                class="nav-link <?php echo @$active == 'tagmanageview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>导航栏标签管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/contact/") ?>'
                                class="nav-link  <?php echo @$active == 'contactmanageview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>联系方式管理</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='<?= base_url("adminsystem/site/") ?>'
                                class="nav-link  <?php echo @$active == 'sitemanageview' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>页面标签管理</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            平台日志管理
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>