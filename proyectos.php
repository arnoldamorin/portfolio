<?php $pg = "proyectos";
include_once("menu.php"); ?>
<main>
    <div class="container">
        <div class="row mb-lg-5">
            <div class="col-12">
                <h1> Mis Proyectos</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-12">
                <p class="descr">Estos son algunos de los trabajos realizados durante el curso de desarrollador full stack.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12">
                <div class="card shadow-lg">
                    <img class="card-img-top img img-fluid" src="images/clientes.png" alt="ABM Clientes" title="ABM Clientes">
                    <div class="card-body position-relative">
                        <h2 class="card-title color-gradiente">ABM CLIENTES</h2>
                        <p class="card-text">Alta, Baja, modificiacion de un registro de clientes
                            Realizado en HTML, CSS, PHP, Bootstrap y Json.</p>
                        <div class="card-block">
                            <div class="row p-0  btn-proyectos w-100">
                                <div class="col-sm-6 col-6 btn-col-p">
                                    <a href="Proyectos/AbmClientes/abmclientes.php" target="_blank" class="btn-p1 rounded-pill">VER ONLINE</a>
                                </div>
                                <div class="col-sm-6 col-6 btn-col-d">
                                    <a href="https://github.com/arnoldamorin/abmclientes.git" class="btn-p2">CÓDIGO FUENTE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="card shadow-lg">
                    <img class="card-img-top img img-fluid" src="images/svg.png" alt="Sistema de Gestión de Ventas" title="Sistema de Gestión de Ventas">
                    <div class="card-body position-relative">
                        <h2 class="card-title color-gradiente">SISTEMA DE GESTIÓN DE VENTAS</h2>
                        <p class="card-text">Sistema de gestión de clientes, productos y ventas, Realizado en
                            HTML, CSS, PHP, MVC, Bootstrap, Js, Ajax, jQuery y MySQL de base de datos.</p>
                        <div class="card-block">
                            <div class="row p-0 btn-proyectos w-100">
                                <div class="col-sm-6 col-6 btn-col-p">
                                    <a href="Proyectos/SGV/login.php" target="_blank" class="btn-p1 rounded-pill">VER PROYECTO</a>
                                </div>
                                <div class="col-sm-6 col-6 btn-col-d">
                                    <a href="https://github.com/arnoldamorin/Sistema-de-ventas.git" target="_blank" class="btn-p2">CÓDIGO FUENTE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="card shadow-lg">
                    <img class="card-img-top img img-fluid" src="images/proyectoIntegrador.png" alt="Proyecto" title="Proyecto Integrador">
                    <div class="card-body position-relative">
                        <h2 class="card-title color-gradiente">PROYECTO INTEGRADOR</h2>
                        <p class="card-text">Proyecto Full Stack desarrollado en PHP, Laravel, Javascript, jQuery, AJAX, HTML, CSS, con panel administrador, gestor de usuarios, módulo de permisos y funcionalidades a fines.</p>
                        <div class="card-block">
                            <div class="row p-0  btn-proyectos w-100">
                                <div class="col-sm-6 col-6 btn-col-p">
                                    <a href="wwww.emilcecharras.com.ar/admin" target="_blank" class="btn-p1 rounded-pill">VER ONLINE</a>
                                </div>
                                <div class="col-sm-6 col-6 btn-col-d">
                                    <a href="#" class="btn-p2">CÓDIGO FUENTE</a>
                                </div>
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