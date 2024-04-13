<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
                "cDescripcion" => "Laptop HP 156 FHD Core i5 8GB 512GB 15-DY5000LA",
                "categoria_id" => 3,
                "proveedor_id" => 1,
                "cSlug" => "laptop-hp-156-fhd-core-i5-8gb-512gb-15-dy5000la",
                "cSku" => "116629282",
                "nPrecioPEN" => 2199.00,
                "nPrecioUSD" => 593.40,
                "cResumen" => "Laptop HP 15,6 FHD Core i5 8GB 512GB 15-DY5000LA Diseñada para tu productividad.",
                "cDescripcionDetallada" => "",
                "cImagen" => "productos/GXxCDCIRhBDR6NZfO3yofCo9sM74Pz6gyEOwGKXq.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ],
            [
                "cDescripcion" => "Razer DeathAdder",
                "categoria_id" => 2,
                "proveedor_id" => 1,
                "cSlug" => "razer-deathadder",
                "cSku" => "423343",
                "nPrecioPEN" => 50.99,
                "nPrecioUSD" => 15.99,
                "cResumen" => "Razer DeathAdder Elite, el mejor ratón gamer para FPS, RTS y MOBA",
                "cDescripcionDetallada" => "",
                "cImagen" => "productos/0dHGWztfDEypDNXsH1q6dxDjPp1GVHnioWQDc90z.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ],
            [
                "cDescripcion" => "Ratón con cable SteelSeries Sensei",
                "categoria_id" => 2,
                "proveedor_id" => 1,
                "cSlug" => "raton-con-cable-steelseries-sensei",
                "cSku" => "33434313413",
                "nPrecioPEN" => 50.99,
                "nPrecioUSD" => 15.99,
                "cResumen" => "Ratón con cable SteelSeries Sensei Ten 10 Master E-game Lol",
                "cDescripcionDetallada" => "",
                "cImagen" => "productos/2z0b2aX0sSZjQ9Uju4403zNJPrpWVsoi78qhGY2Y.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ],
            [
                "cDescripcion" => "Laptop Gamer Predator Helios",
                "categoria_id" => 3,
                "proveedor_id" => 1,
                "cSlug" => "laptop-gamer-predator-helios",
                "cSku" => "CMK16GX4M2B3200C16",
                "nPrecioPEN" => 50.99,
                "nPrecioUSD" => 15.99,
                "cResumen" => "Laptop Gamer Predator Helios 300 PH315-51-78NP 15.6'' Core i7 16GB 256GB SSD Nvidia GeForce GTX 1060",
                "cDescripcionDetallada" => "",

                "cImagen" => "productos/FfVrpEWPjDsTDjW1xzldNmkBUVRlmFIGTEGeRWQ7.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ],
            [
                "cDescripcion" => "Memoria G.skill Trident Z5",
                "categoria_id" => 1,
                "proveedor_id" => 1,
                "cSlug" => "memoria-gskill-trident-z5",
                "cSku" => "41341341",
                "nPrecioPEN" => 50.99,
                "nPrecioUSD" => 15.99,
                "cResumen" => "Módulo de memoria RAM DDR4 de alto rendimiento.",
                "cDescripcionDetallada" => "",

                "cImagen" => "productos/a59WZ4LEeV0uZVB4NQb6R8lUD7RlRhhv7GCjT0n8.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ],
            [
                "cDescripcion" => "Teclado Mecánico",
                "categoria_id" => 4,
                "proveedor_id" => 1,
                "cSlug" => "teclado-mecanico",
                "cSku" => "CMK16GX4M2B3200C16",
                "nPrecioPEN" => 50.99,
                "nPrecioUSD" => 15.99,
                "cResumen" => "Teclados para Juegos de PC de ANNE PRO",
                "cDescripcionDetallada" => "",
                "cImagen" => "productos/I0IGKaKMJNSqPAbbdDYaWT6b4IfL2XXXmcG0vFdb.jpg",
                "nStock" => 100,
                "nPrecioCompra" => 40.99,
                "dFechaCompra" => "2023-01-15",
                "nEstado" => 1,

            ]



        ];

        foreach ($productos as $producto) {
            $producto['cUsuarioCreacion'] = '74757790';
            $producto['cUsuarioModificacion'] = '74757790';
            $producto['created_at'] = now();
            $producto['updated_at'] = now();

            DB::table('productos')->insert($producto);
        }
    }
}
