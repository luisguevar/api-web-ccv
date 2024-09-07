<?php

use Illuminate\Database\Seeder;
use App\Models\Venta\Venta;
use App\Models\Venta\DetalleVenta;

class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Venta::create([
            'id' => 1,
            'cCorrelativo' => '2409000001',
            'nTipoOrigen' => 1,
            'cliente_id' => 5,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:22:04',
            'nTipoComprobante' => 1,
            'nTipoPago' => 1,
            'nEfectivoRecibido' => 600,
            'bEfectivoExacto' => 0,
            'nVuelto' => 90.1,
            'cCodigoOperacion' => NULL,
            'nSubTotal' => 418.12,
            'IGV' => 0.18,
            'nValorIGV' => 91.78,
            'nDescuento' => 0,
            'nTotal' => 509.9,
            'cObservaciones' => NULL,
            'nEstado' => 2,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:22:04',
            'updated_at' => '2024-09-07 19:34:26',
        ]);

        Venta::create([
            'id' => 2,
            'cCorrelativo' => '2409000002',
            'nTipoOrigen' => 1,
            'cliente_id' => 4,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:33:53',
            'nTipoComprobante' => 1,
            'nTipoPago' => 1,
            'nEfectivoRecibido' => 200,
            'bEfectivoExacto' => 0,
            'nVuelto' => 98.02,
            'cCodigoOperacion' => NULL,
            'nSubTotal' => 83.62,
            'IGV' => 0.18,
            'nValorIGV' => 18.36,
            'nDescuento' => 0,
            'nTotal' => 101.98,
            'cObservaciones' => NULL,
            'nEstado' => 1,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:33:53',
            'updated_at' => '2024-09-07 19:33:56',
        ]);

        Venta::create([
            'id' => 3,
            'cCorrelativo' => '2409000003',
            'nTipoOrigen' => 1,
            'cliente_id' => 2,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:34:16',
            'nTipoComprobante' => 1,
            'nTipoPago' => 1,
            'nEfectivoRecibido' => 199,
            'bEfectivoExacto' => 0,
            'nVuelto' => 148.01,
            'cCodigoOperacion' => NULL,
            'nSubTotal' => 41.81,
            'IGV' => 0.18,
            'nValorIGV' => 9.18,
            'nDescuento' => 0,
            'nTotal' => 50.99,
            'cObservaciones' => NULL,
            'nEstado' => 3,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:34:16',
            'updated_at' => '2024-09-07 19:34:31',
        ]);

        Venta::create([
            'id' => 4,
            'cCorrelativo' => '2409000004',
            'nTipoOrigen' => 1,
            'cliente_id' => 4,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:35:07',
            'nTipoComprobante' => 1,
            'nTipoPago' => 1,
            'nEfectivoRecibido' => 120,
            'bEfectivoExacto' => 0,
            'nVuelto' => 18.02,
            'cCodigoOperacion' => NULL,
            'nSubTotal' => 83.62,
            'IGV' => 0.18,
            'nValorIGV' => 18.36,
            'nDescuento' => 0,
            'nTotal' => 101.98,
            'cObservaciones' => NULL,
            'nEstado' => 1,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:35:07',
            'updated_at' => '2024-09-07 19:35:10',
        ]);

        Venta::create([
            'id' => 5,
            'cCorrelativo' => '2409000005',
            'nTipoOrigen' => 1,
            'cliente_id' => 5,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:35:28',
            'nTipoComprobante' => 1,
            'nTipoPago' => 1,
            'nEfectivoRecibido' => 180,
            'bEfectivoExacto' => 0,
            'nVuelto' => 78.02,
            'cCodigoOperacion' => NULL,
            'nSubTotal' => 83.62,
            'IGV' => 0.18,
            'nValorIGV' => 18.36,
            'nDescuento' => 0,
            'nTotal' => 101.98,
            'cObservaciones' => NULL,
            'nEstado' => 1,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:35:28',
            'updated_at' => '2024-09-07 19:35:28',
        ]);

        Venta::create([
            'id' => 6,
            'cCorrelativo' => '2409000006',
            'nTipoOrigen' => 1,
            'cliente_id' => 5,
            'vendedor_id' => 1,
            'dFechaVenta' => '2024-09-07 14:36:02',
            'nTipoComprobante' => 1,
            'nTipoPago' => 2,
            'nEfectivoRecibido' => 100,
            'bEfectivoExacto' => 0,
            'nVuelto' => 54.11,
            'cCodigoOperacion' => '123322',
            'nSubTotal' => 41.81,
            'IGV' => 0.18,
            'nValorIGV' => 9.18,
            'nDescuento' => 5.1,
            'nTotal' => 45.89,
            'cObservaciones' => NULL,
            'nEstado' => 1,
            'bCompletado' => 0,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:36:02',
            'updated_at' => '2024-09-07 19:36:02',
        ]);

        DetalleVenta::create([
            'id' => 1,
            'venta_id' => 1,
            'producto_id' => 2,
            'nCantidad' => 10,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 0.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:22:04',
            'updated_at' => '2024-09-07 19:22:04',
        ]);

        DetalleVenta::create([
            'id' => 2,
            'venta_id' => 2,
            'producto_id' => 4,
            'nCantidad' => 2,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 0.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:33:53',
            'updated_at' => '2024-09-07 19:33:53',
        ]);

        DetalleVenta::create([
            'id' => 3,
            'venta_id' => 3,
            'producto_id' => 2,
            'nCantidad' => 1,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 0.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:34:16',
            'updated_at' => '2024-09-07 19:34:16',
        ]);

        DetalleVenta::create([
            'id' => 4,
            'venta_id' => 4,
            'producto_id' => 6,
            'nCantidad' => 2,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 0.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:35:07',
            'updated_at' => '2024-09-07 19:35:07',
        ]);

        DetalleVenta::create([
            'id' => 5,
            'venta_id' => 5,
            'producto_id' => 2,
            'nCantidad' => 2,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 0.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:35:28',
            'updated_at' => '2024-09-07 19:35:28',
        ]);

        DetalleVenta::create([
            'id' => 6,
            'venta_id' => 6,
            'producto_id' => 2,
            'nCantidad' => 1,
            'nPrecioUnitario' => 50.99,
            'nDescuento' => 10.00,
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => '2024-09-07 19:36:02',
            'updated_at' => '2024-09-07 19:36:02',
        ]);
    }
}
