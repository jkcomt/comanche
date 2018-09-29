<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Agricultor;
class AgricultorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test*/
    function crear_nuevo_agricultor()
    {
        $this->withoutExceptionHandling();

        $this->post('agricultor/crear',[
            'apellidos'=>'Diaz',
            'nombres'=>'Ricardo',
            'dni'=>'70488170',
            'celular'=>'956505497',
            'direccion'=>'cajamarca',
            'email'=>'jkcomt@gmail.com',
            'estado'=>'Habilitado'
        ])->assertRedirect(route('agricultor.index'));

        $this->assertDatabaseHas('agricultores',[
            'apellidos'=>'Diaz',
            'nombres'=>'Ricardo',
            'dni'=>'70488170'
        ]);
    }

    /** @test*/
    function nombre_requerido()
    {
        $this->from('agricultor/nuevo')->post('agricultor/crear',
            [
            'apellidos'=>'',
            'nombres'=>'Jose',
            'dni'=>'70488170',
            'celular'=>'956505497',
            'direccion'=>'cajamarca 123',
            'email'=>'jkcomt@gmail.com',
            'estado'=>'Habilitado'
        ])
        ->assertRedirect(route('agricultor.nuevo'))
         ->assertSessionHasErrors(['apellidos' => 'El campo es obligatorio']);

        $this->assertDatabaseMissing('agricultores',[
            'email'=>'jkcomt@gmail.com'
        ]);

    }
}
