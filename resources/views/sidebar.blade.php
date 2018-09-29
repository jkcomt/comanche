<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        {{--Admin--}}
        @if(auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">OPCIONES</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="/"><i class="fa fa-home"></i> <span>Principal</span></a></li>
            @if(auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
                <li class="treeview">
                    <a href="#"><i class="fa fa fa-th"></i> <span>Recepción</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="@if(Request::is('agricultor')) active @elseif(Request::is('agricultor/*')) active @endif "><a href="{{route('agricultor.index')}}"><i class="fa fa-user-circle-o"></i> <span>Agricultores</span></a></li>
                        {{--<li class="@if(Request::is('cliente')) active @elseif(Request::is('cliente/*')) active @endif "><a href="{{route('cliente.index')}}"><i class="fa fa-user-circle-o"></i> <span>Clientes</span></a></li>--}}
                        <li class="@if(Request::is('empresa')) active @elseif(Request::is('empresa/*')) active @endif "><a href="{{route('empresa.index')}}"><i class="fa fa fa-building"></i> <span>Empresas</span></a></li>
                        <li class="@if(Request::is('variedad')) active @elseif(Request::is('variedad/*')) active @endif"><a href="{{route('variedad.index')}}"><i class="fa fa-list"></i> <span>Variedades de Cáscara</span></a></li>
                        <li class="@if(Request::is('procedencia')) active @elseif(Request::is('procedencia/*')) active @endif "><a href="{{route('procedencia.index')}}"><i class="fa fa-map-marker"></i> <span>Procedencia</span></a></li>
                        <li class="@if(Request::is('chofer')) active @elseif(Request::is('chofer/*')) active @endif "><a href="{{route('chofer.index')}}"><i class="fa fa-id-card-o"></i> <span>Choferes</span></a></li>
                        <li class="@if(Request::is('vehiculo')) active @elseif(Request::is('vehiculo/*')) active @endif"><a href="{{route('vehiculo.index')}}"><i class="fa fa-truck"></i> <span>Vehículos</span></a></li>
                        <li class="@if(Request::is('lote')) active @elseif(Request::is('lote/*')) active @endif"><a href="{{route('lote.index')}}"><i class="fa fa-th"></i> <span>Recepción</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa fa-sun-o"></i> <span>Secado</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(auth()->user()->area->descripcion == 'secado' || auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
                            <li class="@if(Request::is('secado')) active @elseif(Request::is('tendido/*')) active @elseif(Request::is('recojo/*')) active @endif"><a href="{{route('secado.index')}}"><i class="fa fa-sun-o"></i> <span>Secado</span></a></li>
                            <li class="@if(Request::is('responsable')) active @elseif(Request::is('responsable/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('responsable.index')}}"><i class="fa fa-address-card"></i> <span> Resp. de Cuadrilla</span></a></li>
                            {{--<li class="@if(Request::is('almacen')) active @elseif(Request::is('almacen/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('almacen.index')}}"><i class="fa fa fa-archive"></i> <span>Almacen</span></a></li>--}}
                        @endif
                    </ul>
                </li>

                @if(auth()->user()->area->descripcion == 'produccion' || auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
                    <li class="@if(Request::is('produccion_ingreso')) active @elseif(Request::is('produccion_ingreso/*')) active @endif"><a href="{{route('produccion.index')}}"><i class="fa fa-bullseye"></i> <span>Producción</span></a></li>
                @endif
                <li class="treeview">
                    <a href="#"><i class="fa fa fa-usd"></i> <span>Ventas</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(auth()->user()->area->descripcion == 'ventas' || auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
                            {{--<li class="@if(Request::is('ventas')) active @elseif(Request::is('ventas/*')) active @elseif(Request::is('recojo/*')) active @endif"><a href="#"><i class="fa fa-sun-o"></i> <span>Principal</span></a></li>--}}
                            <li class="@if(Request::is('stock_producto')) active @elseif(Request::is('stock_producto/*')) active @endif"><a href="{{route('stock_producto.index')}}"><i class="fa fa-archive"></i> <span> Stock de Productos</span></a></li>
                            <li class="@if(Request::is('comprador_persona')) active @elseif(Request::is('comprador_persona/*')) active @endif"><a href="{{route('comprador_persona.index')}}"><i class="fa fa-user-circle-o"></i> <span> Comprador Persona</span></a></li>
                            <li class="@if(Request::is('comprador_empresa')) active @elseif(Request::is('comprador_empresa/*')) active @endif"><a href="{{route('comprador_empresa.index')}}"><i class="fa fa-building"></i> <span> Comprador Empresa</span></a></li>
                            <li class="@if(Request::is('ventas')) active @elseif(Request::is('ventas/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('ventas.index')}}"><i class="fa fa fa-usd"></i> <span> Registro de Venta</span></a></li>
                            <li class="@if(Request::is('liquidacion')) active @elseif(Request::is('liquidacion/*')) active @endif"><a href="{{route('liquidacion.index')}}"><i class="fa fa-download"></i> <span> Liquidaciones</span></a></li>
                            {{--<li class="@if(Request::is('almacen')) active @elseif(Request::is('almacen/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('almacen.index')}}"><i class="fa fa fa-archive"></i> <span>Almacen</span></a></li>--}}
                        @endif
                    </ul>
                </li>
                @if(auth()->user()->area->descripcion == 'administrador' || auth()->user()->area->descripcion == 'gerencia')
                    <li class="@if(Request::is('configuracion')) active @elseif(Request::is('configuracion/*')) active @elseif(Request::is('usuario')) active @elseif(Request::is('usuario/*')) active @elseif(Request::is('personal/*')) active @elseif(Request::is('personal')) active @elseif(Request::is('area')) active @elseif(Request::is('area/*')) active  @endif "><a href="{{route('configuracion')}}"><i class="fa fa-cog"></i> <span>Configuración</span></a></li>
                @endif
            @endif


        </ul>
        @else
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">OPCIONES</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="/"><i class="fa fa-home"></i> <span>Principal</span></a></li>
            @if(auth()->user()->area->descripcion == 'recepcion' )
                <li class="@if(Request::is('agricultor')) active @elseif(Request::is('agricultor/*')) active @endif "><a href="{{route('agricultor.index')}}"><i class="fa fa-user-circle-o"></i> <span>Agricultores</span></a></li>
                <li class="@if(Request::is('empresa')) active @elseif(Request::is('empresa/*')) active @endif "><a href="{{route('empresa.index')}}"><i class="fa fa-user-circle-o"></i> <span>Empresas</span></a></li>
                <li class="@if(Request::is('variedad')) active @elseif(Request::is('variedad/*')) active @endif"><a href="{{route('variedad.index')}}"><i class="fa fa-list"></i> <span>Variedades de Cáscara</span></a></li>
                <li class="@if(Request::is('procedencia')) active @elseif(Request::is('procedencia/*')) active @endif "><a href="{{route('procedencia.index')}}"><i class="fa fa-map-marker"></i> <span>Procedencia</span></a></li>
                <li class="@if(Request::is('chofer')) active @elseif(Request::is('chofer/*')) active @endif "><a href="{{route('chofer.index')}}"><i class="fa fa-id-card-o"></i> <span>Choferes</span></a></li>
                <li class="@if(Request::is('vehiculo')) active @elseif(Request::is('vehiculo/*')) active @endif"><a href="{{route('vehiculo.index')}}"><i class="fa fa-truck"></i> <span>Vehículos</span></a></li>
                <li class="@if(Request::is('lote')) active @elseif(Request::is('lote/*')) active @endif"><a href="{{route('lote.index')}}"><i class="fa fa-th"></i> <span>Recepción</span></a></li>
            @endif
            @if(auth()->user()->area->descripcion == 'secado' )
                <li class="@if(Request::is('secado')) active @elseif(Request::is('tendido/*')) active @elseif(Request::is('recojo/*')) active @endif"><a href="{{route('secado.index')}}"><i class="fa fa-sun-o"></i> <span>Secado</span></a></li>
                <li class="@if(Request::is('responsable')) active @elseif(Request::is('responsable/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('responsable.index')}}"><i class="fa fa-address-card"></i> <span> Resp. de Cuadrilla</span></a></li>
                {{--<li class="@if(Request::is('almacen')) active @elseif(Request::is('almacen/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('almacen.index')}}"><i class="fa fa fa-archive"></i> <span>Almacen</span></a></li>--}}
            @endif
            @if(auth()->user()->area->descripcion == 'produccion')
                <li class="@if(Request::is('produccion_ingreso')) active @elseif(Request::is('produccion_ingreso/*')) active @endif"><a href="{{route('produccion.index')}}"><i class="fa fa-bullseye"></i> <span>Producción</span></a></li>
            @endif

            
                @if(auth()->user()->area->descripcion == 'ventas')
                    {{--<li class="@if(Request::is('ventas')) active @elseif(Request::is('ventas/*')) active @elseif(Request::is('recojo/*')) active @endif"><a href="#"><i class="fa fa-sun-o"></i> <span>Principal</span></a></li>--}}
                    <li class="@if(Request::is('stock_producto')) active @elseif(Request::is('stock_producto/*')) active @endif"><a href="{{route('stock_producto.index')}}"><i class="fa fa-archive"></i> <span> Stock de Productos</span></a></li>
                    <li class="@if(Request::is('comprador_persona')) active @elseif(Request::is('comprador_persona/*')) active @endif"><a href="{{route('comprador_persona.index')}}"><i class="fa fa-user-circle-o"></i> <span> Comprador Persona</span></a></li>
                    <li class="@if(Request::is('comprador_empresa')) active @elseif(Request::is('comprador_empresa/*')) active @endif"><a href="{{route('comprador_empresa.index')}}"><i class="fa fa-building"></i> <span> Comprador Empresa</span></a></li>
                    <li class="@if(Request::is('ventas')) active @elseif(Request::is('ventas/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('ventas.index')}}"><i class="fa fa fa-usd"></i> <span> Registro de Venta</span></a></li>
                    <li class="@if(Request::is('liquidacion')) active @elseif(Request::is('liquidacion/*')) active @endif"><a href="{{route('liquidacion.index')}}"><i class="fa fa-download"></i> <span> Liquidaciones</span></a></li>
                    {{--<li class="@if(Request::is('almacen')) active @elseif(Request::is('almacen/*')) active @elseif(Request::is('responsable/*')) active @endif"><a href="{{route('almacen.index')}}"><i class="fa fa fa-archive"></i> <span>Almacen</span></a></li>--}}
                @endif

        </ul>
        @endif
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
