<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LibroModel;

class Libros extends Controller
{
    public function index()
    {
        $libro = new LibroModel();
        $datos['libros'] = $libro->orderBy('idLibro', 'ASC')->findAll();
        $datos['header'] = view('templates/header');
        $datos['footer'] = view('templates/footer');
        return view('libros/listar', $datos);
    }

    public function crear()
    {
        $datos['header'] = view('templates/header');
        $datos['footer'] = view('templates/footer');
        return view('libros/crear', $datos);
    }

    public function guardar()
    {
        $libro = new LibroModel();
        $validacion = $this->validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,2014]',
            ],
            'nombre' => 'required|min_length[3]' 
        ]);

        if (!$validacion) {
            return $this->response->redirect(site_url('/listar'));
        }


        if ($imagen = $this->request->getFile('imagen')) {
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move(WRITEPATH . '../public/uploads/', $nuevoNombre);
            $datos = [
                'aNombreLibro' => $this->request->getVar('nombre'),
                'mImagen' => $nuevoNombre
            ];
            $libro->insert($datos);
            return $this->response->redirect(site_url('/listar'));
        }
    }

    public function borrar($id = null)
    {
        $libro = new LibroModel();
        $datosLibro = $libro->where('idLibro', $id)->first();
        $ruta = ('../public/uploads/' . $datosLibro['mImagen']);
        unlink(WRITEPATH . $ruta);
        $libro->where('idLibro', $id)->delete($id);
        return $this->response->redirect(site_url('/listar'));
    }

    public function editar($id = null)
    {
        $libro = new LibroModel();
        $datos['libro'] = $libro->where('idLibro', $id)->first();
        $datos['header'] = view('templates/header');
        $datos['footer'] = view('templates/footer');

        return view('libros/editar', $datos);
    }

    public function actualizar()
    {
        $libro = new LibroModel();
        $datos = [
            'aNombreLibro' => $this->request->getVar('nombre'),
        ];
        $id = $this->request->getVar('idLibro');
        $libro->update($id, $datos);
        $validacion = $this->validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,2014]',
            ]
        ]);

        if ($validacion) {
            if ($imagen = $this->request->getFile('imagen')) {
                $datosLibro = $libro->where('idLibro', $id)->first();
                $ruta = ('../public/uploads/' . $datosLibro['mImagen']);
                unlink(WRITEPATH . $ruta);

                $nuevoNombre = $imagen->getRandomName();
                $imagen->move(WRITEPATH . '../public/uploads/', $nuevoNombre);
                $datos = ['mImagen' => $nuevoNombre];
                $libro->update($id, $datos);
            }
        }
        return $this->response->redirect(site_url('/listar'));
    }
}
