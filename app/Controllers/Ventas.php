<?php

namespace App\Controllers;

use App\Models\VentaModel;

class Ventas extends BaseController
{
    public function index()
    {
        $ventaModel = new VentaModel();
        $rol = session('rol');
        $usuarioId = session('id_usuario');

        $builder = $ventaModel
            ->select('ventas.*, clientes.nombre AS cliente_nombre, usuarios.nombre AS vendedor_nombre')
            ->join('clientes', 'clientes.id = ventas.cliente_id')
            ->join('usuarios', 'usuarios.id = ventas.usuario_id')
            ->orderBy('ventas.id', 'DESC');

        if ($rol === 'vendedor') {
            $builder->where('ventas.usuario_id', $usuarioId);
        }

        $ventas = $builder->findAll();

        return view('ventas/index', [
            'ventas' => $ventas,
        ]);
    }
}