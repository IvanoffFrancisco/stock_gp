<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Sistema Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Ventas</h1>
            <p class="text-muted mb-0">
                <?php if (session('rol') === 'admin'): ?>
                    Visualización de todas las ventas del sistema
                <?php else: ?>
                    Visualización de tus ventas generadas
                <?php endif; ?>
            </p>
        </div>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
            Volver
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="py-3">Cliente</th>
                            <th class="py-3">Vendedor</th>
                            <th class="py-3">Fecha venta</th>
                            <th class="py-3">Fecha entrega</th>
                            <th class="py-3">Forma de pago</th>
                            <th class="py-3">Estado entrega</th>
                            <th class="py-3">Subtotal</th>
                            <th class="py-3">Descuento</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ventas)): ?>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td class="px-4"><?= esc($venta['id']) ?></td>
                                    <td><?= esc($venta['cliente_nombre']) ?></td>
                                    <td><?= esc($venta['vendedor_nombre']) ?></td>
                                    <td><?= esc($venta['fecha_venta'] ?: '-') ?></td>
                                    <td><?= esc($venta['fecha_entrega'] ?: '-') ?></td>
                                    <td><?= esc($venta['forma_pago'] ?: '-') ?></td>
                                    <td>
                                        <?php
                                            $estado = $venta['estado_entrega'];
                                            $badgeClass = match ($estado) {
                                                'entregado' => 'bg-success',
                                                default => 'bg-secondary',
                                            };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= esc(ucfirst($estado)) ?>
                                        </span>
                                    </td>
                                    <td>$ <?= number_format((float) $venta['subtotal'], 2, ',', '.') ?></td>
                                    <td>$ <?= number_format((float) $venta['descuento'], 2, ',', '.') ?></td>
                                    <td>$ <?= number_format((float) $venta['total'], 2, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('ventas/show/' . $venta['id']) ?>" class="btn btn-sm btn-outline-dark">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="11" class="text-center py-4">
                                    No hay ventas registradas.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>