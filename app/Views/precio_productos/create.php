<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo precio - Sistema Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-secondary">

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">Sistema Stock</a>
        <div class="ms-auto d-flex align-items-center gap-3 text-white">
            <span><?= esc(session('nombre')) ?> (<?= esc(session('rol')) ?>)</span>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Salir</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold mb-1">Nuevo precio</h2>
                            <p class="text-muted mb-0">Crear precio por rango de cantidad</p>
                        </div>
                        <a href="<?= base_url('precio-productos') ?>" class="btn btn-outline-secondary">Volver</a>
                    </div>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php $errors = session()->getFlashdata('errors'); ?>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('precio-productos/store') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select class="form-select" id="producto_id" name="producto_id" required>
                                <option value="">Seleccionar producto</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?= esc($producto['id']) ?>" <?= old('producto_id') == $producto['id'] ? 'selected' : '' ?>>
                                        <?= esc($producto['nombre']) ?> - <?= esc($producto['kilogramos']) ?> kg (<?= esc($producto['categoria_nombre']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cantidad_desde" class="form-label">Cantidad desde</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="cantidad_desde"
                                    name="cantidad_desde"
                                    value="<?= old('cantidad_desde') ?>"
                                    placeholder="Ej: 1"
                                    required
                                >
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cantidad_hasta" class="form-label">Cantidad hasta</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="cantidad_hasta"
                                    name="cantidad_hasta"
                                    value="<?= old('cantidad_hasta') ?>"
                                    placeholder="Ej: 10"
                                >
                                <div class="form-text">Dejalo vacío si es sin límite.</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="precio_unitario" class="form-label">Precio unitario</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                    id="precio_unitario"
                                    name="precio_unitario"
                                    value="<?= old('precio_unitario') ?>"
                                    placeholder="Ej: 13000"
                                    required
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                            Guardar precio
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>