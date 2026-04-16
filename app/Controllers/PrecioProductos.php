<?php

namespace App\Controllers;

use App\Models\PrecioProductoModel;
use App\Models\ProductoModel;

class PrecioProductos extends BaseController
{
    public function index()
    {
        $precioProductoModel = new PrecioProductoModel();

        $precios = $precioProductoModel
            ->select('precio_productos.*, productos.nombre AS producto_nombre, productos.kilogramos, categorias.nombre AS categoria_nombre')
            ->join('productos', 'productos.id = precio_productos.producto_id')
            ->join('categorias', 'categorias.id = productos.categoria_id')
            ->orderBy('productos.nombre', 'ASC')
            ->orderBy('precio_productos.cantidad_desde', 'ASC')
            ->findAll();

        return view('precio_productos/index', [
            'precios' => $precios,
        ]);
    }

    public function create()
    {
        $productoModel = new ProductoModel();

        $productos = $productoModel
            ->select('productos.*, categorias.nombre AS categoria_nombre')
            ->join('categorias', 'categorias.id = productos.categoria_id')
            ->orderBy('productos.nombre', 'ASC')
            ->findAll();

        return view('precio_productos/create', [
            'productos' => $productos,
        ]);
    }

    public function store()
    {
        $rules = [
            'producto_id'      => 'required|is_not_unique[productos.id]',
            'cantidad_desde'   => 'required|integer|greater_than[0]',
            'cantidad_hasta'   => 'permit_empty|integer|greater_than[0]',
            'precio_unitario'  => 'required|decimal|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $cantidadDesde = (int) $this->request->getPost('cantidad_desde');
        $cantidadHastaPost = $this->request->getPost('cantidad_hasta');
        $cantidadHasta = ($cantidadHastaPost === '' || $cantidadHastaPost === null) ? null : (int) $cantidadHastaPost;

        if ($cantidadHasta !== null && $cantidadHasta < $cantidadDesde) {
            return redirect()->back()->withInput()->with('error', 'La cantidad hasta no puede ser menor que la cantidad desde.');
        }

        $precioProductoModel = new PrecioProductoModel();

        $precioProductoModel->save([
            'producto_id'      => $this->request->getPost('producto_id'),
            'cantidad_desde'   => $cantidadDesde,
            'cantidad_hasta'   => $cantidadHasta,
            'precio_unitario'  => $this->request->getPost('precio_unitario'),
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/precio-productos')->with('success', 'Precio cargado correctamente.');
    }
}