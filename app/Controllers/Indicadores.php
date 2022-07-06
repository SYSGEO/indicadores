<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Uf;

class Indicadores extends Controller{

    public function index()
    {
        $uf = new Uf();

        $datos['uf'] = $uf->orderBy('id','ASC')->findAll();
        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');
        
        return view('indicadores/index',$datos);
    }

    
    public function create()
    {
        $uf = new Uf();

        $datos['uf'] = $uf->orderBy('id','ASC')->findAll();
        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');
        
        return view('indicadores/create',$datos);
    }

    public function createAjax()
    {
      
        $datos['fechas']= json_decode($this->request->getVar('fechas'));
        $datos['valores']= json_decode($this->request->getVar('valores'));
        //$datos['valores'] = $this->request->getVar('valores');
        
        
        for($i=0; $i<count($datos['fechas']);$i++){
            $uf = new Uf();
            $dat['nombre'] = 'uf';
            $dat['valor'] = $datos['valores'][$i] ;
            $dat['delete_status']= '1';
            $dat['fecha']= $datos['fechas'][$i] ;
            $uf->insert($dat);
        }
    
       
        return  print_r($datos['valores']);
        
        

    }

        
    public function store()
    {
        
        $uf = new Uf();
        $datos['nombre'] = $this->request->getVar('nombre');
        $datos['valor'] = $this->request->getVar('valor');
        $datos['delete_status']= $this->request->getVar('estado');
        $datos['fecha']= $this->request->getVar('fecha');

        $uf->insert($datos);

        return $this->response->redirect(site_url('/'));
    }

    public function edith($id=null)
    {
        $uf = new Uf();
        $datos['uf'] = $uf->where('id',$id)->first();
        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');

        return view('indicadores/edith', $datos);
    }

    public function update($id)
    {
        $uf = new Uf();
        $datos['nombre'] = $this->request->getVar('nombre');
        $datos['valor'] = $this->request->getVar('valor');
        $datos['delete_status']= $this->request->getVar('estado');
        $datos['fecha']= $this->request->getVar('fecha');
        $id = $this->request->getVar('id');
        $uf->update($id,$datos);
        
        return $this->response->redirect(site_url('/'));
    }


    public function delete($id=null)
    {

        $uf = new Uf();
        $uf->where('id',$id)->delete($id);
        
        return $this->response->redirect(site_url('/'));
    }



}