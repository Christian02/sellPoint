<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title> Cochinita la Auténtica</title>
    <script language="JavaScript" type="text/javascript" src="../public/datePicker/jquery-3.0.0.min.js"></script>
		<link rel="stylesheet prefetch" href="../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet prefetch" href="../public/css-gentella/custom.css"> </link>
    <!-- Font Awesome -->
    <link href="../public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet prefetch" href="../public/css/mycss.css"> </link>
		
	</head>
	<body class="nav-md" >
	 <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="home"  class="site_title">{{ Html::image('img/logo.png') }}<span>La Auténtica</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="uploads/{{\Auth::user()->path_image_profile}}" alt="..." class="img-circle profile_img">
              
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2> {{ \Auth::user()->name }} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <li><a><i class="fa fa-edit"></i> Administrar ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                        {{ link_to_route('home','Vender') }}
                      </li>
                      <li>{{ link_to_route('list-sales','Listado de ventas') }} 
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Administrar productos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                        {{ link_to_route('create','Nuevo Producto') }}
                     </li>
                      <li>{{ link_to_route('list-products','Listado de productos') }}  </li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                        {{ link_to_route('reports','Ventas por día') }}
                      </li>
                      <li>
                        {{ link_to_route('reportsByMonthChart','Ventas por meses') }}
                      </li>
                    </ul>
                  </li>
                 
                </ul>
              </div>
              <div class="menu_section">
                <h3>Opciones</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Administración de  compras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="purchasesApp">Compras</a>
                      </li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>


        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="uploads/{{\Auth::user()->path_image_profile}}" alt="">{{ \Auth::user()->name }} 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li>
						{{ link_to_route('logout','Salir') }}
					</li>
                  </ul>
                </li>

            
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
		 <!-- page content -->

		<div class="right_col" role="main">
			@yield('content')
		</div>
             

	</body>

	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="../public/js/script.js"></script>
	<script src="../public/js-gentella/custom.js"></script>
	

</html>