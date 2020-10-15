<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            'admin' =>      Role::create(['name' => 'Admin', 'slug' => 'super-admin', 'special' => 'all-access']),

            'administracion_jornal' =>       Role::create(['name' => 'Administrativo Jornal', 'slug' => 'administracion_jornal']),
            'supervisor' =>       Role::create(['name' => 'Supervisor', 'slug' => 'supervisor']),
            'seh' =>       Role::create(['name' => 'Técnico Seguridad e Higiene', 'slug' => 'seh']),
            'rrhh' =>       Role::create(['name' => 'Lic. RRHH', 'slug' => 'rrhh']),
            'enfermeria' =>       Role::create(['name' => 'Lic. Enfermería', 'slug' => 'enfermeria']),
            'perito_caligrafico' =>       Role::create(['name' => 'Perito caligráfico', 'slug' => 'perito_caligrafico']),
            'medicina' =>       Role::create(['name' => 'Fac. médico', 'slug' => 'medicina']),
            'coordinacion' =>       Role::create(['name' => 'Coordinador médico', 'slug' => 'coordinacion']),

            'noaccess' =>   Role::create(['name' => 'No access', 'slug' => 'no-access', 'special' => 'no-access']),

        ];

        $permission = [
            'menu_acces_jornal' =>  Permission::create(['name' => 'Menú: eJornal', 'slug' => 'menu_acces_jornal']),
            'menu_geren_jornal' =>  Permission::create(['name' => 'Menú: Gerencia Jornal', 'slug' => 'menu_geren_jornal']),
            'menu_equip_jornal' =>  Permission::create(['name' => 'Menú: Equipo Jornal', 'slug' => 'menu_equip_jornal']),
            'menu_calen_empresa' =>  Permission::create(['name' => 'Menú: Calendario Empresa', 'slug' => 'menu_calen_empresa']),
            'menu_gesti_empresa' =>  Permission::create(['name' => 'Menú: Gestión Empresa', 'slug' => 'menu_gesti_empresa']),
            'menu_corre_empresa' =>  Permission::create(['name' => 'Menú: Correo Empresa', 'slug' => 'menu_corre_empresa']),
            'menu_ticke_empresa' =>  Permission::create(['name' => 'Menú: Ticket Empresa', 'slug' => 'menu_ticke_empresa']),
            'menu_traba_empresa' =>  Permission::create(['name' => 'Menú: Trabajadores Empresa', 'slug' => 'menu_traba_empresa']),
            'menu_seh_empresa' =>  Permission::create(['name' => 'Menú: Seguridad e Higiene Empresa', 'slug' => 'menu_seh_empresa']),
            'menu_ausen_empresa' =>  Permission::create(['name' => 'Menú: Ausentismo Empresa', 'slug' => 'menu_ausen_empresa']),
            'menu_medla_empresa' =>  Permission::create(['name' => 'Menú: Medicina Laboral Empresa', 'slug' => 'menu_medla_empresa']),
            'menu_prest_empresa' =>  Permission::create(['name' => 'Menú: Prestaciones Empresa', 'slug' => 'menu_prest_empresa']),
            'menu_docum_empresa' =>  Permission::create(['name' => 'Menú: Documentación Empresa', 'slug' => 'menu_docum_empresa']),
            'menu_repor_empresa' =>  Permission::create(['name' => 'Menú: Reportes Empresa', 'slug' => 'menu_repor_empresa']),
            'menu_estad_empresa' =>  Permission::create(['name' => 'Menú: Estadísticas Empresa', 'slug' => 'menu_estad_empresa']),
            
            'ticket_empre_crear' =>  Permission::create(['name' => 'Ticket Empresa: crear', 'slug' => 'ticket_empre_crear']),
            'ticket_empre_editar' =>  Permission::create(['name' => 'Ticket Empresa: editar', 'slug' => 'ticket_empre_editar']),
            'ticket_empre_eliminar' =>  Permission::create(['name' => 'Ticket Empresa: eliminar', 'slug' => 'ticket_empre_eliminar']),
            'trabajador_empre_crear' =>  Permission::create(['name' => 'Trabajador Empresa: crear', 'slug' => 'trabajador_empre_crear']),
            'trabajador_empre_editar' =>  Permission::create(['name' => 'Trabajador Empresa: editar', 'slug' => 'trabajador_empre_editar']),
            'trabajador_empre_eliminar' =>  Permission::create(['name' => 'Trabajador Empresa: eliminar', 'slug' => 'trabajador_empre_eliminar']),
            'seh_empre_ar' =>  Permission::create(['name' => 'Email Users', 'slug' => 'seh_empre_ar']),
            'seh_empre_incid_crear' =>  Permission::create(['name' => 'Seguridad e Higiene: crear incidencia', 'slug' => 'seh_empre_incid_crear']),
            'seh_empre_incid_editar' =>  Permission::create(['name' => 'Seguridad e Higiene: editar incidencia', 'slug' => 'seh_empre_incid_editar']),
            'seh_empre_incid_eliminar' =>  Permission::create(['name' => 'Seguridad e Higiene: eliminar incidencia', 'slug' => 'seh_empre_incid_eliminar']),
            'ausentismo_traba_crear' =>  Permission::create(['name' => 'Ausentismo Trabajador: crear', 'slug' => 'ausentismo_traba_crear']),
            'ausentismo_traba_editar' =>  Permission::create(['name' => 'Ausentismo Trabajador: editar', 'slug' => 'ausentismo_traba_editar']),
            'ausentismo_traba_eliminar' =>  Permission::create(['name' => 'Ausentismo Trabajador: eliminar', 'slug' => 'ausentismo_traba_eliminar']),
            'ausentismo_traba_dossier' =>  Permission::create(['name' => 'Ausentismo Trabajador: ver dossier', 'slug' => 'ausentismo_traba_dossier']),
            'ausentismo_empre_estad' =>  Permission::create(['name' => 'Ausentismo Empresa: ver estadisticas', 'slug' => 'ausentismo_empre_estad']),
            'ausentismo_empre_lista' =>  Permission::create(['name' => 'Ausentismo Empresa: ver listado', 'slug' => 'ausentismo_empre_lista']),
            'documentacion_traba_crear' =>  Permission::create(['name' => 'Documentacion Trabajador: crear', 'slug' => 'documentacion_traba_crear']),
            'documentacion_traba_editar' =>  Permission::create(['name' => 'Documentacion Trabajador: editar', 'slug' => 'documentacion_traba_editar']),
            'documentacion_traba_eliminar' =>  Permission::create(['name' => 'Documentacion Trabajador: eliminar', 'slug' => 'documentacion_traba_eliminar']),
            'documentacion_empre_lista' =>  Permission::create(['name' => 'Documentacion Empresa: ver listado', 'slug' => 'documentacion_empre_lista']),
            'consulta_traba_crear' =>  Permission::create(['name' => 'Consulta Trabajador: crear', 'slug' => 'consulta_traba_crear']),
            'consulta_traba_editar' =>  Permission::create(['name' => 'Consulta Trabajador: editar', 'slug' => 'consulta_traba_editar']),
            'consulta_traba_eliminar' =>  Permission::create(['name' => 'Consulta Trabajador: eliminar', 'slug' => 'consulta_traba_eliminar']),
            'consulta_empre_lista' =>  Permission::create(['name' => 'Consulta Empresa: ver listado', 'slug' => 'consulta_empre_lista']),
            'comunicacion_traba_crear' =>  Permission::create(['name' => 'Comunicación Trabajador: crear', 'slug' => 'comunicacion_traba_crear']),
            'comunicacion_traba_editar' =>  Permission::create(['name' => 'Comunicación Trabajador: editar', 'slug' => 'comunicacion_traba_editar']),
            'comunicacion_traba_eliminar' =>  Permission::create(['name' => 'Comunicación Trabajador: eliminar', 'slug' => 'comunicacion_traba_eliminar']),
            'comunicacion_empre_lista' =>  Permission::create(['name' => 'Comunicación Empresa: ver listado', 'slug' => 'comunicacion_empre_lista']),

            'prestaciones_empre_crear' =>  Permission::create(['name' => 'Prestaciones Empresa: crear', 'slug' => 'prestaciones_empre_crear']),
            'prestaciones_empre_editar' =>  Permission::create(['name' => 'Prestaciones Empresa: editar', 'slug' => 'prestaciones_empre_editar']),
            'prestaciones_empre_eliminar' =>  Permission::create(['name' => 'Prestaciones Empresa: eliminar', 'slug' => 'prestaciones_empre_eliminar']),
            'prestaciones_empre_ver' =>  Permission::create(['name' => 'Prestaciones Empresa: ver prestación', 'slug' => 'prestaciones_empre_ver']),
            'prestaciones_empre_lista' =>  Permission::create(['name' => 'Prestaciones Empresa: ver listado', 'slug' => 'prestaciones_empre_lista']),

            'prestaciones_traba_crear' =>  Permission::create(['name' => 'Prestaciones Trabajador: crear', 'slug' => 'prestaciones_traba_crear']),
            'prestaciones_traba_editar' =>  Permission::create(['name' => 'Prestaciones Trabajador: editar', 'slug' => 'prestaciones_traba_editar']),
            'prestaciones_traba_eliminar' =>  Permission::create(['name' => 'Prestaciones Trabajador: eliminar', 'slug' => 'prestaciones_traba_eliminar']),
            'prestaciones_traba_ver' =>  Permission::create(['name' => 'Prestaciones Trabajador: ver prestación', 'slug' => 'prestaciones_traba_ver']),
            'prestaciones_traba_lista' =>  Permission::create(['name' => 'Prestaciones Trabajador: ver listado', 'slug' => 'prestaciones_traba_lista']),



        ];
 

            $roles['enfermeria']->permissions()->attach($permission['menu_acces_jornal']);
            $roles['enfermeria']->permissions()->attach($permission['menu_equip_jornal']);
            $roles['enfermeria']->permissions()->attach($permission['menu_corre_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_ticke_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_traba_empresa']);

            $roles['enfermeria']->permissions()->attach($permission['menu_seh_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_ausen_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_medla_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_prest_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_estad_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_repor_empresa']);
            $roles['enfermeria']->permissions()->attach($permission['menu_docum_empresa']);

            $roles['medicina']->permissions()->attach($permission['menu_acces_jornal']);
            $roles['medicina']->permissions()->attach($permission['menu_equip_jornal']);
            $roles['medicina']->permissions()->attach($permission['menu_corre_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_ticke_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_traba_empresa']);

            $roles['medicina']->permissions()->attach($permission['menu_seh_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_ausen_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_medla_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_prest_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_estad_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_repor_empresa']);
            $roles['medicina']->permissions()->attach($permission['menu_docum_empresa']);



    }
}
