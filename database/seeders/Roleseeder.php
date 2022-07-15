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
        // Vendedor -> Vender, Registrar clientes 

        $admin = role::create(['name'=>'administrador']);
        $vendedor = role::create(['name'=>'vendedor']);

        // Permisos

        Permission::create(['name'=>'home'])->syncRoles($admin,$vendedor);
        Permission::create(['name'=>'sistema.usuario.update'])->assignRole($admin);
        Permission::create(['name'=>'sistema.usuario.show'])->assignRole($admin);;
        Permission::create(['name'=>'sistema.cliente.update'])->syncRoles($admin,$vendedor);
        Permission::create(['name'=>'sistema.proveedor.update'])->assignRole($admin);
        Permission::create(['name'=>'sistema.sucursal.update'])->assignRole($admin);
        Permission::create(['name'=>'sistema.producto.update'])->assignRole($admin);
        Permission::create(['name'=>'sistema.venta.update'])->syncRoles($admin,$vendedor);
        Permission::create(['name'=>'sistema.venta.show'])->syncRoles($admin,$vendedor);

    }
}
