<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\VentaDetalleModel;

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

    public function show($id = null)
    {
        $ventaModel = new VentaModel();
        $ventaDetalleModel = new VentaDetalleModel();

        $venta = $ventaModel
            ->select('ventas.*, 
                      clientes.nombre AS cliente_nombre,
                      clientes.telefono,
                      clientes.direccion,
                      clientes.localidad,
                      usuarios.nombre AS vendedor_nombre')
            ->join('clientes', 'clientes.id = ventas.cliente_id')
            ->join('usuarios', 'usuarios.id = ventas.usuario_id')
            ->where('ventas.id', $id)
            ->first();

        if (!$venta) {
            return redirect()->to('/ventas')->with('error', 'La venta no existe.');
        }

        if (session('rol') === 'vendedor' && (int) $venta['usuario_id'] !== (int) session('id_usuario')) {
            return redirect()->to('/ventas')->with('error', 'No tienes permisos para ver esta venta.');
        }

        $detalles = $ventaDetalleModel
            ->select('venta_detalles.*, productos.nombre AS producto_nombre, productos.kilogramos, categorias.nombre AS categoria_nombre')
            ->join('productos', 'productos.id = venta_detalles.producto_id')
            ->join('categorias', 'categorias.id = productos.categoria_id')
            ->where('venta_detalles.venta_id', $id)
            ->findAll();

        return view('ventas/show', [
            'venta'    => $venta,
            'detalles' => $detalles,
        ]);
    }
}