<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;
//require_once('/var/www/html/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php');

class ProjetosCancelados extends Model
{
    // View projetoscancelados
    /**
    *
    * retorna os projetos cancelados 
    * @param date - anomês -yyyymm - aaaamm
    * sample SELECT responsavel, projeto, status  FROM `projetoscancelados` WHERE data ='201801'
    **/
    protected $table = "projetoscancelados";
     /**
     * Create a new ProjetosCancelados.
     *
     * @return void
     */
    public function __construct()
    {

    }
}
