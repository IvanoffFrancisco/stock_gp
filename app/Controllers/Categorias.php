<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categorias extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaModel();

        $data = [
            'categorias' => $categoriaModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('categorias/index', $data);
    }

    public function create()
    {
        return view('categorias/create');
    }

    public function store()
    {
        $rules = [
            'nombre' => 'required|min_length[3]|max_length[120]|is_unique[categorias.nombre]',
            'descripcion' => 'permit_empty|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $categoriaModel = new CategoriaModel();

        $categoriaModel->save([
            'nombre'      => trim($this->request->getPost('nombre')),
            'descripcion' => trim((string) $this->request->getPost('descripcion')),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/categorias')->with('success', 'Categoría creada correctamente.');
    }
}