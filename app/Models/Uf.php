<?php 
namespace App\Models;

use CodeIgniter\Model;

class Uf extends Model{
    protected $table      = 'uf';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','nombre','valor','fecha','delete_status'];
}