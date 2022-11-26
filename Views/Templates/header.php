<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url ?>Assets/js/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>Assets/js/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>Assets/js/datatables/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Hoja de Estilos css-->
    <link rel="stylesheet" href="<?php echo base_url ?>Assets/css/style/style.min.css">
    <!--Font Awsome-->
    <script src="<?php echo base_url ?>Assets/js/fontawesome/all.min.js" crossorigin="anonymous"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini text-sm layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-grey-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">

                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <strong><a href="index3.html" class="nav-link text-dark">Home</a></strong>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <strong><a href="#" class="nav-link text-dark">Contact</a></strong>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt text-dark"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large text-dark"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Logout" data-slide="true" href="<?php echo base_url; ?>Usuarios/salir" role="button">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary" style="background-color: #030215;">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url ?>/Assets/img/5G.jpg" class="brand-image img-circle elevation-3" style="opacity: .8;">
                <img src="<?php echo base_url ?>/Assets/img/logo_telcel2.png" class="brand-text font-weight-light" style="opacity: .8">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-1 d-flex">
                    <div class="info">
                        <h6 class="text-light">HOLA!</h6>
                        <p class="text-light">Alberto Sanchez Ortiz</p>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-screwdriver-wrench nav-icon"></i>
                                <p>
                                    Configuracion
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url; ?>Usuarios" class="nav-link">
                                        <i class="fa-solid fa-angle-right nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url; ?>Clientes" class="nav-link">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-folder-open nav-icon"></i>
                                <p>
                                    Catalogos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url; ?>Catalogos" class="nav-link">
                                        <i class="fa-solid fa-angle-right nav-icon"></i>
                                        <p>Catalogos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url; ?>Productos" class="nav-link">
                                <i class="fa-brands fa-product-hunt nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->