<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == 'index') {
        include_once('inicio.php');
    }
    if ($_GET['menu'] == 'acerca') {
        include_once('about.php');
    }
} else {
    include_once('inicio.php');
}
