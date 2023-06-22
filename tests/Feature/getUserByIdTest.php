<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class getUserByIdTest extends TestCase
{
    use RefreshDatabase;

    public function testLoadUserById()
    {
        // cria um usuário ficticio
        $user = User::factory()->create();

        // simula um login para que possa chamar o endpoint
        $this->actingAs($user, 'api');

        // chama o endpoint de carregar usuário por id
        $response = $this->get('api/usuarios/carregar/' . $user->id);

        // verifica se o endpoint retornou que foi possivel carregar os dados
        $response->assertStatus(200);

        // verifica se os dados carregados estão corretos
        $response->assertJson([
            'content' => [
                'usuario' => [
                    'id' => $user->id,
                    'name' => $user->name
                    // aqui podem ser adicionados mais campos para serem verificados
                ]
            ]
        ]);
    }
}
