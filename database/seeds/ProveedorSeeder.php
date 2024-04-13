<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveedores = [
            [
                "nTipoPersona" => 2,
                "nTipoDocumento" => 2,
                "cNroDocumento" => "1002903038",
                "cRazonSocial" => "Tech Solutions Inc.",
                "cCelular" => "9876543210",
                "cCorreo" => "techsolutions@example.com",
                "cPaginaWeb" => "www.techsolutions.com",
                "cDireccion" => "123 Main Street",
                "cActividadPrincipal" => "Venta de computadoras al por mayor",
                "cObservaciones" => "Contacto preferido por teléfono",
            ],
            [
                "nTipoPersona" => 1,
                "nTipoDocumento" => 1,
                "cNroDocumento" => "12345678",
                "cRazonSocial" => "Juan Pérez",
                "cCelular" => "987654321",
                "cCorreo" => "juanperez@example.com",
                "cDireccion" => "Av. Libertad 456",
                "cActividadPrincipal" => "Servicios de consultoría informática",
                "cObservaciones" => "Cliente habitual",
            ],
            [
                "nTipoPersona" => 1,
                "nTipoDocumento" => 1,
                "cNroDocumento" => "87654321",
                "cRazonSocial" => "María Rodríguez",
                "cCelular" => "955987654",
                "cCorreo" => "mariarodriguez@example.com",
                "cDireccion" => "Calle Lima 123",
                "cActividadPrincipal" => "Venta de accesorios de computadora",
                "cObservaciones" => "Preferencia por envío a domicilio",
            ],
            [
                "nTipoPersona" => 2,
                "nTipoDocumento" => 2,
                "cNroDocumento" => "2009876543",
                "cRazonSocial" => "ElectroMax SRL",
                "cCelular" => "955678901",
                "cCorreo" => "electromax@example.com",
                "cPaginaWeb" => "www.electromax.com",
                "cDireccion" => "Av. Tecnológica 567",
                "cActividadPrincipal" => "Venta de teléfonos celulares al por mayor",
                "cObservaciones" => "Especializados en últimas tecnologías",
            ],
            [
                "nTipoPersona" => 2,
                "nTipoDocumento" => 2,
                "cNroDocumento" => "2008765432",
                "cRazonSocial" => "ElectroMundo SAC",
                "cCelular" => "955456789",
                "cCorreo" => "electromundo@example.com",
                "cPaginaWeb" => "www.electromundo.com",
                "cDireccion" => "Calle Pizarro 345",
                "cActividadPrincipal" => "Venta de laptops al por mayor",
                "cObservaciones" => "Descuentos especiales por compras al por mayor",
            ],
            [
                "nTipoPersona" => 2,
                "nTipoDocumento" => 2,
                "cNroDocumento" => "2012345678",
                "cRazonSocial" => "ElectroTech EIRL",
                "cCelular" => "955234567",
                "cCorreo" => "electrotech@example.com",
                "cPaginaWeb" => "www.electrotech.com",
                "cDireccion" => "Av. Innovación 678",
                "cActividadPrincipal" => "Venta de cámaras de seguridad al por mayor",
                "cObservaciones" => "Ofrecen instalación gratuita en compras grandes",
            ],
        ];

        foreach ($proveedores as $proveedor) {
            $proveedor['nEstado'] = 1;
            $proveedor['cUsuarioCreacion'] = '74757790';
            $proveedor['cUsuarioModificacion'] = '74757790';
            $proveedor['created_at'] = now();
            $proveedor['updated_at'] = now();

            DB::table('proveedores')->insert($proveedor);
        }
    }
}
