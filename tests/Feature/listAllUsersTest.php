<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class listAllUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testLoadUserById()
    {
        // cria 4 usuários ficticios para simular a listagem
        $usuarios = User::factory()->count(4)->create();

        
        // seleciona um dos 4 usuários para agir como ator do login
        $user = $usuarios->get(1);
        $this->actingAs($user, 'api');

        // chama o endpoint de listagem
        $response = $this->get('/api/usuarios/listar');

        // verifica se o endpoint retornou que foi possivel listar os usuários
        $response->assertStatus(200);

        
        // verifica se os usuários retornados pelo endpoints são os mesmos que foram criados
        $response->assertJson([
            'content' => [
                'usuarios' => $usuarios->toArray()
            ]
        ]);
    }
}
