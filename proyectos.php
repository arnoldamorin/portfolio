<?php $pg = "proyectos";
include_once("menu.php"); ?>
<main>
    <div class="container">
        <div class="row mb-sm-5">
            <div class="col-12">
                <h1> Mis Proyectos</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-12">
                <p>Estos son algunos de mis trabajos realizados durante el curso de Desarrollador web Full Stack</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-content-stretch flex-wrap">
                <div class="col-sm-4 col-12">
                    <div class="card shadow-lg m-1">
                        <img src="images/clientes.png" alt="ABM Clientes" title="ABM Clientes" class="img-fluid">
                        <div class="col-12 color-gradiente py-3">
                            <h2 class="card-title">ABM CLIENTES</h2>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="card-text p-3 mb-3">Alta, Baja, modificiacion de un registro de clientes
                                Realizado en HTML, CSS, PHP, Bootstrap y Json.</p>
                        </div>
                        <div class="row p-3 mt-5">
                            <div class="col-sm-6 col-6">
                                <a href="Proyectos/AbmClientes/abmclientes.php" target="_blank" class="btn-p1 rounded-pill">VER ONLINE</a>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <a href="#" class="btn-p2 px-3">CÓDIGO FUENTE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card shadow-lg m-1" >
                        <img src="images/svg.png" alt="Sistema de Gestión de Ventas" title="Sistema de Gestión de Ventas" class="img-fluid">
                        <div class="col-12 color-gradiente py-3">
                            <h2 class="card-title">SISTEMA DE GESTIÓN DE VENTAS</h2>
                        </div>
                        <div class="col-12">
                            <p class="card-text p-3">Sistema de gestión de clientes, productos y ventas, Realizado en
                                HTML, CSS, PHP, MVC, Bootstrap, Js, Ajax, jQuery y MySQL de base de datos. <br> <br></p>
                        </div>
                        <div class="row p-3">
                            <div class="col-sm-6 col-6">
                                <a href="Proyectos/SGV/index.php" target="_blank" class="btn-p1 rounded-pill">VER PROYECTO</a>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <a href="#" class="btn-p2 px-3">CÓDIGO FUENTE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="card shadow-lg m-1">
                        <img src="images/proyectoIntegrador.png" alt="Proyecto" title="Proyecto Integrador" class="img-fluid">
                        <div class="col-12 color-gradiente py-3">
                            <h2 class="card-title">PROYECTO INTEGRADOR</h2>
                        </div>
                        <div class="col-12">
                            <p class="card-text p-3">Proyecto Full Stack desarrollado en PHP, Laravel, Javascript, jQuery, AJAX, HTML, CSS, con panel administrador, gestor de usuarios, módulo de permisos y funcionalidades a fines.</p>
                        </div>
                        <div class="row p-3">
                            <div class="col-sm-6 col-6">
                                <a href="wwww.emilcecharras.com.ar/admin" target="_blank" class="btn-p1 rounded-pill">VER ONLINE</a>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <a href="#" class="btn-p2 px-3">CÓDIGO FUENTE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
include_once("footer.php"); ?>