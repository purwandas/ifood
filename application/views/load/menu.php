<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item start active">
        <?php echo anchor('index', '
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            ', 'class="nav-link"'); ?>
        </li>
        <li class="heading">
            <h3 class="uppercase">Tim Promina AKP </h3>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">Data User</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <?php echo anchor('users', '<span class="title">Data User</span>', 'class="nav-link "'); ?>
                </li>
                <li class="nav-item  ">
                    <?php echo anchor('aktifitas-user', '<span class="title">Aktifitas User</span>', 'class="nav-link "'); ?>
                </li>
                <li class="nav-item  ">
                    <?php echo anchor('reportsku', '<span class="title">Report SKU</span>', 'class="nav-link "'); ?>
                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('url', '<span class="title">Tambah User</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('url', '<span class="title">Absensi BA</span>', 'class="nav-link "'); ?>
                                </li> -->
            </ul>
                <!-- </li> -->

                        <!-- <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Data Absensi</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('absensi', '<span class="title">Data Absensi</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('absensi/izin', '<span class="title">Data Izin</span>', 'class="nav-link "'); ?>
                                </li>
                            </ul> -->
                        <!-- </li> -->


                        <!-- MENU 2 -->

                        <li class="heading">
                            <h3 class="uppercase">List Product </h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <span class="title">Data SKU</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('sku', '<span class="title">Data SKU</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('sku/add', '<span class="title">Tambah SKU</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>




                        <!-- MENUS -->

                        <li class="heading">
                            <h3 class="uppercase">Store Area </h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <span class="title">Data Toko</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('toko', '<span class="title">Data Toko</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('toko/add', '<span class="title">Tambah Toko</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>

                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-chain"></i>
                                <span class="title">Data Cabang</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('cabang', '<span class="title">Data Cabang</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('cabang/add', '<span class="title">Tambah Cabang</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-chain"></i>
                                <span class="title">Data Account</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('account', '<span class="title">Data Account</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('cabang/add', '<span class="title">Tambah Cabang</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-chain"></i>
                                <span class="title">Data Kota</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('kota', '<span class="title">Data Kota</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('kota/add', '<span class="title">Tambah Kota</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>

                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-chain"></i>
                                <span class="title">Data Keterangan</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('keterangan_oos', '<span class="title">Keterangan OOS</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('kategori_segmen', '<span class="title">Kategori Segmen</span>', 'class="nav-link "'); ?>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <?php echo anchor('kota/add', '<span class="title">Tambah Kota</span>', 'class="nav-link "'); ?>
                                </li> -->
                            </ul>
                        </li>

                        <!-- MENU 3 -->

                        <li class="heading">
                            <h3 class="uppercase">Achievement Report</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cart-plus"></i>
                                <span class="title">Sales Out</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('report', '<span class="title">Report</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('topSku', '<span class="title">Top SKU</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('topBA', '<span class="title">Top BA</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('topCabang', '<span class="title">Top Cabang</span>', 'class="nav-link "'); ?>
                                </li>
                            </ul>
                        </li>
                        <!-- MENU A -->
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-envelope-o"></i>
                                <span class="title">Contact</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('totalcontact', '<span class="title">Report Total Contact</span>', 'class="nav-link "'); ?>
                                </li>
                                <li class="nav-item  ">
                                    <?php echo anchor('detailcontact', '<span class="title">Report Detail Contact</span>', 'class="nav-link "'); ?>
                                </li>
                            </ul>
                        </li>


                        <!-- MENU B -->
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-bullhorn"></i>
                                <span class="title">Promo</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('reportpromo', '<span class="title">Report Consumer Promo</span>', 'class="nav-link "'); ?>
                                </li>
                            </ul>
                        </li>


                        <!-- MENU C -->
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-exclamation"></i>
                                <span class="title">Out Of Stock</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <?php echo anchor('oos', '<span class="title">Report</span>', 'class="nav-link "'); ?>
                                </li>
                            </ul>
                        </li>


                        <!-- MENU C -->






                    </ul>
