<?php

session_start();
if (!isset($_SESSION['tipo_user']) || $_SESSION['tipo_user'] != 'profesor') {
    header('Location: ../login.php');
}

// require_once('/persistencia/util/Conexion.php');

// $obj = new Conexion();
// $conexion = $obj->conectarBD();

?>

<style type="text/css">
    .main-menu nav ul li.activeInicio a {
        color: #fc9928;
    }
</style>
<!-- offset search area start -->
<div class="offset-search">
    <form action="#">
        <input type="text" name="search" placeholder="Sarch here...">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- offset search area end -->
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->
<!-- crumbs area start -->
<div class="crumbs-area">
    <div class="container">
        <div class="crumb-content">
            <h4 class="crumb-title"><span>Bienvenido </span><?php echo $_SESSION['nom_user'];  ?></h4>
        </div>
    </div>
</div>
<!-- crumbs area end -->
<!-- teacher area start -->
<div class="all-teachers  pt--120 pb--70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member1.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Patrick Garner Dony</a></h4>
                        <span class="primary-color d-block mb-4">Economist</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div><!-- teacher single end -->

            <!-- teacher single start -->
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member2.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Cameron Brown</a></h4>
                        <span class="primary-color d-block mb-4">Financier</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div><!-- teacher single end -->

            <!-- teacher single start -->
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member3.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Joseph Mack Monika</a></h4>
                        <span class="primary-color d-block mb-4">Languages</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div><!-- teacher single end -->

            <!-- teacher single start -->
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member4.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Patrick Garner Dony</a></h4>
                        <span class="primary-color d-block mb-4">Economist</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div>
            <!-- teacher single end -->

            <!-- teacher single start -->
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member5.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Patrick Garner Dony</a></h4>
                        <span class="primary-color d-block mb-3">Economist</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div><!-- teacher single end -->

            <!-- teacher single start -->
            <div class="col-lg-4 col-md-6">
                <div class="card mb-5">
                    <img src="assets/images/teacher/teacher-member6.jpg" alt="image">
                    <div class="card-body teacher-content p-25">
                        <h4 class="card-title mb-1"><a href="teacher-details.html">Patrick Garner Dony</a></h4>
                        <span class="primary-color d-block mb-4">Economist</span>
                        <p class="card-text">We’re a philosophical bunch here at School site and we have thought long and hard about.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div><!-- card -->
            </div><!-- teacher single end -->
        </div>
    </div>
</div>
<!-- teacher area end -->