<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Sistema Stock</a>
        <div class="ms-auto d-flex align-items-center gap-3 text-white">
            <span><?= esc(session('nombre')) ?> (<?= esc(session('rol')) ?>)</span>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Salir</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4">
            <h1 class="h3 mb-3">Bienvenido, <?= esc(session('nombre')) ?></h1>
            <p class="text-muted mb-0">Has iniciado sesión correctamente.</p>
            <p class="mt-2">
                Tu rol actual es: <strong><?= esc(session('rol')) ?></strong>
            </p>

            <div class="row g-3 mt-3">
                <?php if (session('rol') === 'admin'): ?>
                    <div class="col-md-4">
                        <div class="card border-danger h-100">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios</h5>
                                <p class="card-text text-muted">
                                    Gestiona usuarios, permisos y accesos del sistema.
                                </p>
                                <a href="<?= base_url('usuarios') ?>" class="btn btn-danger">
                                    Ir a usuarios
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-primary h-100">
                            <div class="card-body">
                                <h5 class="card-title">Categorías</h5>
                                <p class="card-text text-muted">
                                    Administra categorías de productos para perro y gato.
                                </p>
                                <a href="<?= base_url('categorias') ?>" class="btn btn-primary">
                                    Ir a categorías
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos</h5>
                                <p class="card-text text-muted">
                                    Administra productos, pesos, stock inicial y pallets.
                                </p>
                                <a href="<?= base_url('productos') ?>" class="btn btn-success">
                                    Ir a productos
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title">Precios</h5>
                                <p class="card-text text-muted">
                                    Administra precios por cantidad de bolsas para cada producto.
                                </p>
                                <a href="<?= base_url('precio-productos') ?>" class="btn btn-warning">
                                    Ir a precios
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-info h-100">
                            <div class="card-body">
                                <h5 class="card-title">Movimientos de stock</h5>
                                <p class="card-text text-muted">
                                    Registra ingresos, egresos y ajustes de stock con historial.
                                </p>
                                <a href="<?= base_url('movimientos-stock') ?>" class="btn btn-info text-white">
                                    Ir a movimientos
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-dark h-100">
                            <div class="card-body">
                                <h5 class="card-title">Clientes</h5>
                                <p class="card-text text-muted">
                                    Administra y consulta los clientes del sistema.
                                </p>
                                <a href="<?= base_url('clientes') ?>" class="btn btn-dark">
                                    Ir a clientes
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (session('rol') === 'vendedor'): ?>
                    <div class="col-md-4">
                        <div class="card border-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">Clientes</h5>
                                <p class="card-text text-muted">
                                    Consulta y registra clientes para generar pedidos.
                                </p>
                                <a href="<?= base_url('clientes') ?>" class="btn btn-success">
                                    Ir a clientes
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (session('rol') === 'consultor'): ?>
                    <div class="col-md-4">
                        <div class="card border-secondary h-100">
                            <div class="card-body">
                                <h5 class="card-title">Panel de consultor</h5>
                                <p class="card-text text-muted">
                                    Aquí podrás consultar productos, stock y reportes.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>