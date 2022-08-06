<header id="header">
    <!-- header two area start -->
    <div class="header-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-6 d-block d-lg-none">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-9 offset-lg-1 d-none d-lg-block">
                    <div class="main-menu menu-style2">
                        <nav>
                            <ul id="m_menu_active">
                                <li class="activeInicio"><a href="?menu=index">Inicio</a>
                                </li>
                                <li class="activeAbout"><a href="?menu=acerca">About</a></li>
                                <li><a href="javascript:void(0);">Courses</a>
                                    <ul class="submenu">
                                        <li><a href="courses.html">courses</a></li>
                                        <li><a href="course-details.html">course details</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);">teacher</a>
                                    <ul class="submenu">
                                        <li><a href="teachers.html">teachers</a></li>
                                        <li><a href="teacher-details.html">teacher details</a></li>
                                    </ul>
                                </li>
                                <li class="middle-logo">
                                    <a href="index.html">
                                        <img src="assets/images/icon/logo-middle.png" alt="logo">
                                        <img class="hb-bottom-shape" src="assets/images/icon/hb-bottom-shape.png" alt="logo">
                                    </a>
                                </li>
                                <li><a href="#">Events</a></li>
                                <li><a href="javascript:void(0);">blog</a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-5">
                    <div class="header-bottom-right-style-2">
                        <ul>
                            <li><a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-round" href="#">Iniciar Sesion</a></li>
                            <!-- <li><a data-toggle="modal" data-target="#exampleModal2" class="btn btn-light btn-round" class="active" href="#">Sign Up</a></li> -->
                        </ul>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="signin.php" method="POST">
                                        <input type="email" name="email" placeholder="Ingresa tu correo electronico..." required="">
                                        <input type="password" name="password" placeholder="Ingresa tu contraseña...">
                                        <input class="btn btn-primary btn-sm" type="submit" value="Login">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Please Sign Up Here</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="signup-form text-center">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="First Name">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <input type="email" placeholder="Ingresa tu correo.." required="">
                                        <input type="password" placeholder="Ingresa tu contraseña..." required="">
                                        <label class="checkbox-inline"><input type="checkbox" value="">I Agree</label>
                                        <input class="btn btn-primary btn-sm" type="submit" value="Register Now">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- col-lg-2 -->
                <div class="col-12 d-block d-lg-none">
                    <div id="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- header two area end -->
</header>