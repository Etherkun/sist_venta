<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles y Permisos
        // Admin -> all
        // Vendedor -> Vender, Registrar clientes y Productos

        $admin = role::create(['name'=>'administrador']);
        $vendedor = role::create(['name'=>'vendedor']);

        // Permisos



    }
}
