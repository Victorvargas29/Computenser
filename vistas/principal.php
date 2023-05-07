
<?php

        require_once("../modelos/Usuarios.php");

        $usuario = new Usuarios();



?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="20x20" href="../public/assets/images/m.png">
    <title>MERILARA</title>
    <!-- Custom CSS -->
    <link href="../public/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../public/dist/css/style.min.css" rel="stylesheet">
        <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../public/assets/extra-libs/multicheck/multicheck.css">



       <!-- Nuevas datatables -->
    <link href="../public/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link href="../public/datatables/datatables.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../public/plugins/toastr/toastr.min.css">




<!-- SWEET ALERT -->
    <link rel="stylesheet" type="text/css" href="../public/sweetalert2/sweetalert2.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- otras lib del otro proyecto// -->
<!--  <link rel="stylesheet" href="../public/css/font-awesome.min.css">    -->
   <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../public/css/animate.css">
  <link href="../public/css/prettyPhoto.css" rel="stylesheet">


<!-- Morris chart -->
  <link rel="stylesheet" href="../public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <link rel="stylesheet" type="text/css" href="../public/Responsive-2.2.3/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="../public/css/estilos.css">

    <link rel="stylesheet" type="text/css" href="../public/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">

    <!-- toogle button -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark ">
                <div class="navbar-header " data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a id="logo-home" class="navbar-brand" >
                        <!-- Logo icon  -->
                        <b class="logo-icon p-l-8">  
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon
                            <img src="../public/assets/images/logo-min.png" alt="homepage" class="light-logo" /> 
                           -->
                       </b> 
                     <!--    End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="../public/assets/images/logo-text.png" alt="homepage" class="light-logo" />
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>

                        <li class="nav-item">
                        
                           <!--     <input class="nav-link dropdown-toggle waves-effect waves-dark" type="checkbox" checked data-toggle="toggle" data-on="<i class='fa fa-moon'></i> Dark" data-off="<i class='fa fa-sun'></i> Light">
                            -->
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5> 
                                                        <span class="mail-desc">Just a reminder that event</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5> 
                                                        <span class="mail-desc">Just see the my admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5> 
                                                        <span class="mail-desc">Just see the my new admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../public/images/<?php echo $_SESSION["avatar"]?> " alt="user" class="rounded-circle" width="45" height="45">   <span class="hidden-xs"><?php echo $_SESSION["nombre"]
                            ?> </span></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a style="color: #fff;" class="dropdown-item sidebar-link waves-effect waves-dark sidebar-link btn btn-primary" id="myprofile" onClick="mostrar_perfil('<?php echo $_SESSION["idUsuario"]?>')" data-toggle="modal" data-target="#perfilModal"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a id="home" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Inicio</span></a></li>
                        <li class="sidebar-item"> <a id="servi_prestado2" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Facturacion</span></a></li>
                        <li class="sidebar-item"> <a id="compra" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Compras</span></a></li>
                        <!-- <li class="sidebar-item"> <a id="servi_prestado" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Servicio Prestado</span></a></li> -->
                                               
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Gestion de Servicios </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"> <a id="depa" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-sitemap"></i><span class="hide-menu">Departamentos</span></a></li>
                                <li class="sidebar-item"><a id="servi" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Servicios </span></a></li>
                            </ul>
                        </li>
                        
                        <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="empleadas_p" aria-expanded="false"><i class="fas fa-address-card"></i><span class="hide-menu">Empleadas</span></a></li>-->
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="clientess" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Clientes</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="proveedor" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Proveedores</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Gestion de Inventario </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"> <a disabled id="producto" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-sitemap"></i><span class="hide-menu">Producto</span></a></li>
                              <!--  <li class="sidebar-item"><a id="presentacionP" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Presentacion del producto </span></a></li>
                                <li class="sidebar-item"><a id="Iinventario" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Inventario </span></a></li>-->
                            </ul>      
                        </li>


                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="usuarios_p" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Usuarios</span></a></li>
                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="reportes_p" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reportes Facturas</span></a></li>
                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="reportes_presupuestos" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reportes Presupuestos</span></a></li>
                     <li class="sidebar-item"> <a id="presupuesto_p" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Presupuesto</span></a></li>
                     <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Gestion de Vehiculos </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a id="vehiculo" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Vehiculos </span></a></li>
                                <li class="sidebar-item"> <a id="marca" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Marcas</span></a></li>
                                <li class="sidebar-item"> <a id="modelo" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Modelos</span></a></li>
                                <li class="sidebar-item"><a id="color" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Colores </span></a></li>
                            </ul>      
                        </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" id="fallas" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">fallas</span></a></li>
                     
                   <!--   <li class="sidebar-item"> <a id="marca" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Marcas</span></a></li>
                     <li class="sidebar-item"> <a id="modelo" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Modelos</span></a></li>
                    <li class="sidebar-item"> <a id="icon-font" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="fas fa-smile"></i><span class="hide-menu">Font Awesome Icons</span></a></li>
                          <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a id="icon-font" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="fas fa-smile"></i><span class="hide-menu">Font Awesome Icons</span></a></li>
                                <li class="sidebar-item"><a id="icon-material" class="sidebar-link waves-effect waves-dark sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                                <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                                <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                                <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                                <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                                <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                                <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                                <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                            </ul>
                        </li>-->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->


        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            
            <section class="col-lg-12" id="seccion1"></section>



          <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Todo los derechos reservados. Diseñado y desarrollado por <a href="https://www.facebook.com/vic7orvargas29">Computenser</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../public/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../public/assets/extra-libs/sparkline/sparkline.js"></script>
    

 <!--Sweetalert -->
<script src="../public/sweetalert2/sweetalert2.all.min.js"></script>



    <!--Wave Effects -->
    <script src="../public/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../public/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../public/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../public/assets/libs/flot/excanvas.js"></script>
    <script src="../public/assets/libs/flot/jquery.flot.js"></script>
    <script src="../public/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../public/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../public/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../public/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../public/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../public/dist/js/pages/chart/chart-page-init.js"></script>


        <!-- this page js -->
    <script src="../public/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../public/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../public/assets/extra-libs/DataTables/datatables.min.js"></script>
  <!--  
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
   
    </script>
Mas Del otro proyecto -->
    <script src="../public/js/jquery-migrate.min.js"></script>
        <script src="../public/js/jquery.prettyPhoto.js"></script>
        <script src="../public/js/jquery.isotope.min.js"></script>
        <script src="../public/js/wow.min.js"></script>
        <script src="../public/js/functions.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="../public/bower_components/jquery-ui/jquery-ui.min.js"></script>


        <script src="../public/datatables/datatables.min.js"></script>




        <script type="text/javascript" src="../public/plugins/toastr/toastr.min.js"></script>

<!--   

        <script src="../public/datatables/jquery.dataTables.min.js"></script>
        <script src="../public/datatables/dataTables.buttons.min.js"></script>
        <script src="../public/datatables/buttons.html5.min.js"></script>
        <script src="../public/datatables/buttons.colVis.min.js"></script>      
        <script src="../public/datatables/jszip.min.js"></script>
        <script src="../public/datatables/pdfmake.min.js"></script>
        <script src="../public/datatables/vfs_fonts.js"></script>
        
 Estilo bootstrap datatable 
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
-->
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>

                <!-- Morris.js charts -->
        <script src="../public/bower_components/raphael/raphael.min.js"></script>
        <script src="../public/bower_components/morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="../public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="../public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../public/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../public/bower_components/moment/min/moment.min.js"></script>
        <script src="../public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="../public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 
        <script src="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
        <!-- Slimscroll -->
        <script src="../public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../public/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../public/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) 
        <script src="../public/dist/js/pages/dashboard.js"></script>    -->
        <!-- AdminLTE for demo purposes -->
        <script src="../public/dist/js/demo.js"></script>

        <!--LIBRERIA DE MENSAJE MODAL -->
        <script src="js/bootbox.all.min.js"></script>

      

        <script src="js/pantallas.js"></script>
        
     <script src="../public/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>

        <script>
          //PRODUCTO
          $(":file").filestyle({input: false, buttonText: "Agregar Imagen",buttonName: "btn-primary"});
        </script>
        <script src="js/perfil.js"></script>

        <script src="../public/Responsive-2.2.3/js/dataTables.responsive.min.js" type="text/javascript"></script>

        <script src="../public/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

        <!-- toogle button -->
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?php  
   require_once("modal/perfil-user.php");
?>        

</body>

</html>