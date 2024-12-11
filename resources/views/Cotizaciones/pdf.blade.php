<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COTIZACIÓN</title>

</head>

<body>
    <!--HEADER-->
    <table class="div-1Header">
        <tr>
            <td class="logotd">
                <img id=""
                    src="https://scontent.ftru7-1.fna.fbcdn.net/v/t39.30808-1/277564756_4949011328515401_4981782462630580398_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=105&ccb=1-7&_nc_sid=f4b9fd&_nc_ohc=DY2GK5CW4V0Q7kNvgGQmi7y&_nc_zt=24&_nc_ht=scontent.ftru7-1.fna&_nc_gid=AIwlC5eGTCAjgiHFeQen8KV&oh=00_AYBdLAcLhCMSS-tDjutsGiARHtotaiFQdw5S7Le5oNMLew&oe=675FD93D"
                    alt="logo">
                {{-- <img id="" src="{{ base_path('public/img/logoex.jpg') }}" alt="logo"> --}}
            </td>
            <td class="datos-grales-td">
                <table class="table_h_factura">
                    <thead>
                        <th class="headerDatosh titulos">Cotización: <span class="titulos">
                                {{ $data['cCorrelativo'] }}</span>
                        </th>
                    </thead>
                    <tr>
                        <td class="titulos">
                            <p class="titulos">CCV SOLUCIONES INFORMATICAS E.I.R.L.</p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                RUC: <span>20601030498</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>TELEFONO: <span>+51 952 611 002</span> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>E-MAIL: <span>
                                    informes@ccvsi.com</span> </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--DATOS-->
    <table class="div-1Datos">
        <tr>
            <td class="receptor">
                <table class="table_receptor">
                    <tr>
                        <td class="titulos">
                            <p class="titulos tituloRec">CLIENTE</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                {{ $data['cNombreCliente'] }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Documento: <span> {{ $data['cNroDocumentoCliente'] }}</span> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Email: <span> {{ $data['cCorreo'] }}</span> </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="datosGral">
                <table class="table_datos">
                    <tr>
                        <td>
                            <p>
                                FECHA DE EMISIÓN:
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $data['dFechaEmision'] }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                FECHA DE VENCIMIENTO:
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $data['dFechaExpiracion'] }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>
                                VENDEDOR:
                            </p>
                        </td>
                        <td>
                            <p>
                                {{-- {{ $data['dFechaExpiracion'] }} --}}
                            </p>
                        </td>
                    </tr>
                    {{--  <tr>
                        <td>
                            <p>
                                SUCURSAL:
                            </p>
                        </td>
                        <td>
                            <p>
                                CDMX
                            </p>
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <td>
                            <p>
                                ALMACÉN:
                            </p>
                        </td>
                        <td>
                            <p>
                                8
                            </p>
                        </td>
                    </tr> --}}
                </table>
            </td>
        </tr>
    </table>
    <!--MATERIAL/PRODUCTO-->
    <table class="table_materiales">
        <thead>
            <tr>
                <td>Código</td>
                <td colspan="2">Producto</td>
                <td>Cantidad</td>
                <td>Precio Unitario</td>
                <td>Descuento</td>
                <td>Importe</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($data['productos'] as $producto)
                <tr>
                    <td>{{ $producto['cSku'] }}</td>
                    <td>
                        {{-- {{ $producto['cImagen'] }} --}}


                        <img style="width: 60px; height: 60px; object-fit: cover;" id=""
                            src="{{ base_path('public/storage/' . $producto['cImagen']) }}" alt="logo">

                    </td>

                    <td>{{ $producto['producto_nombre'] }}</td>
                    <td>{{ $producto['nCantidad'] }}</td>
                    <td>S/ {{ $producto['nPrecioUnitario'] }}</td>
                    <td>{{ $producto['nDescuento'] }}%</td>
                    <td>{{ $producto['nTotalConDescuento'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--DATOS FINALES-->
    <table class="div-1Datos">
        <tr>
            <td class="">
                <table class="table_datosFtxt">
                    <tr>
                        <td>
                            <p> {{ $data['cObservaciones'] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="datosFinales">
                <table class="table_datosfinales">
                    <tr>
                        <td>
                            <p>
                                Subtotal:
                            </p>
                        </td>
                        <td>
                            <p>
                                S/ {{ $data['nSubTotal'] }}
                            </p>
                        </td>
                    </tr>
                  {{--   <tr>
                        <td>
                            <p>
                                Descuento:
                            </p>
                        </td>
                        <td>
                            <p>
                                S/ {{ $data['nDescuento'] }}
                            </p>
                        </td>
                    </tr> --}}
                    <tr>
                        <td>
                            <p>
                                IGV:
                            </p>
                        </td>
                        <td>
                            <p>
                                S/ {{ $data['IGV'] }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Total:
                            </p>
                        </td>
                        <td>
                            <p>
                                S/ {{ $data['nTotal'] }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--FIRMA-->
    <div class="firma">
        Firma del cliente
    </div>
    <!--FOOTER-->
    <footer>
        <p>Obten tu factura en: https://tuempresa.com/facturacion | Empresa: 558525 | Referencia: 55a885dvs </p>
    </footer>
</body>

</html>
<style>
    /*ESTILOS GRALES*/
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    .titulos {
        font-size: 15px;
        text-transform: uppercase;
    }

    /*HEADER*/
    .div-1Header,
    .div-1Datos {
        width: 100%;
    }

    .logotd {
        width: 50%;
        height: auto;
    }

    .datos-grales-td,
    .receptor {
        width: 50%;
    }

    .table_h_factura {
        width: 50%;
        height: 150px;
        background-color: #FFF;
        width: 100%;
        margin: 0px;
        padding: 0px;
    }

    .headerDatosh {
        text-align: right;
        color: #FFF;
        padding: 5px;
        background-color: rgb(24, 140, 207);
    }

    .table_h_factura tr td p {
        margin: 0px;
        padding: 2px;
        text-align: right;
        padding-right: 5px;
    }

    /*DATOS*/
    .table_receptor,
    .table_datos {
        width: 42%;
        height: 100px;
        background-color: rgba(243, 243, 243, 0.521);
        width: 100%;
        margin: 0px;
        padding: 10px;
        border-radius: 5px;
    }

    .table_receptor tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    .tituloRec {
        color: rgb(24, 140, 207);
    }

    .table_datos tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    /*MATERIALES*/
    .table_materiales {
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .table_materiales thead tr {
        background-color: rgb(24, 140, 207);
        color: #FFF;
    }

    .table_materiales thead tr td {
        padding: 5px;
        text-align: center;
        font-size: 14px;
    }

    .table_materiales tr td {
        text-align: center;
        padding: 5px;
        border-bottom: 1px solid rgba(20, 20, 20, 0.096);
    }

    /*DATOS FINALES*/
    .table_datosFtxt {
        width: 70%;
        height: 100px;
        width: 100%;
        margin: 0px;
    }

    .datosFinales {
        width: 30%;
    }

    .datosFinales .table_datosfinales {
        width: 42%;
        height: 100px;
        width: 100%;
        margin: 0px;
        padding: 10px;
        border: 1px solid rgba(20, 20, 20, 0.096);
    }

    .datosFinales .table_datosfinales tr td p {
        margin: 0px;
        padding: 2px;
        text-align: left;
    }

    /*FIRMA*/
    .firma {
        border-top: 1px solid rgba(20, 20, 20, 0.5);
        text-align: center;
        width: 30%;
        margin-left: 70%;
        margin-top: 80px;
        padding-top: 5px;
    }

    /*FOOTER*/
    footer {
        width: 100%;
        text-align: center;
        position: absolute;
        bottom: 0px;
    }
</style>
