<?php

use Illuminate\Database\Seeder;
use App\StockProductoItem;
class StockProductoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockProductoItem::create([
            'serie_producto'=>'STOCK-000001',
            'descripcion_producto'=>'Arroz Añejo',
            'precio'=>10.00,
            'kilos'=>49.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000002',
            'descripcion_producto'=>'Arroz Extra',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000003',
            'descripcion_producto'=>'Arroz Clasificado',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000004',
            'descripcion_producto'=>'Arroz Despuntado',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000005',
            'descripcion_producto'=>'Arroz Superior',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000006',
            'descripcion_producto'=>'Arroz Casserita',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000007',
            'descripcion_producto'=>'Descarte',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000008',
            'descripcion_producto'=>'Arrocillo 1/2',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000009',
            'descripcion_producto'=>'Arrocillo 3/4',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000010',
            'descripcion_producto'=>'Ñelen',
            'precio'=>10.00,
            'kilos'=>50.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);

        StockProductoItem::create([
            'serie_producto'=>'STOCK-000011',
            'descripcion_producto'=>'Polvillo',
            'precio'=>10.00,
            'kilos'=>40.00,
            'fecha_registro'=>\Carbon\Carbon::now(),
            'estado'=>'Habilitado'
        ]);
    }
}
