<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" href="">校企合作平台</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> 菜单
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="<?= base_url("home") ?>" class="nav-link">首页</a></li>
                <li class="nav-item"><a href="" class="nav-link">合作项目</a></li>
                <li class="nav-item"><a href="" class="nav-link">合作案例</a></li>
                <li class="nav-item"><a href="" class="nav-link">校企洽谈会</a></li>
                <li class="nav-item"><a href="" class="nav-link">校园招聘会</a></li>
                <li class="nav-item"><a href="" class="nav-link">企业库</a></li>

            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (!isset($this->session->userdata('user_info')['user_name'])) : ?>
                <li class="nav-item">
                    <a type="button" class="btn btn-primary btn-lg" href='<?= base_url("home/login_load") ?>'
                        class="nav-link">登录</a>
                </li>

                <li class="nav-item">
                    <a type="button" class="btn btn-success btn-lg" href='<?= base_url("home/register_load") ?>'
                        class="nav-link">注册</a>
                    <?php else : ?>

                <li class="nav-item">
                    <a type="button" class="btn btn-light btn-lg" href='<?= base_url("home/logout_fun") ?>'
                        onClick="return confirm('确定退出登录?');"
                        class="nav-link"><?php echo $this->session->userdata('user_info')['user_name'] ?>
                    </a>
                </li>
                <?php endif; ?>

                </li>
            </ul>
        </div>
    </div>
</nav>