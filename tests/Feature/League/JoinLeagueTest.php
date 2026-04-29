<?php

use App\Models\User;
use App\Models\League;
use App\Models\FantasyTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can see join league page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
                     ->get(route('leagues.join'));

    $response->assertStatus(200);
    $response->assertSee('Join League'); // Mainīt pēc savas lapas teksta
});

test('user can join a league with valid code', function () {
    $user = User::factory()->create();
    $team = FantasyTeam::factory()->create(['user_id' => $user->id]);

    $league = League::factory()->create([
        'code' => 'ABC123',
        'is_public' => true,
    ]);

    $response = $this->actingAs($user)
                     ->post(route('leagues.join'), [
                         'code' => 'ABC123',
                     ]);

    $response->assertRedirect(route('leagues.index')); // vai kur citur novirza

    $this->assertDatabaseHas('league_fantasy_team', [  // vai kāds ir pivot tabulas nosaukums
        'league_id'      => $league->id,
        'fantasy_team_id' => $team->id,
    ]);
});

test('user cannot join league with invalid code', function () {
    $user = User::factory()->create();
    FantasyTeam::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)
                     ->post(route('leagues.join'), [
                         'code' => 'WRONG123',
                     ]);

    $response->assertSessionHasErrors('code');
});

test('user must have a fantasy team to join a league', function () {
    $user = User::factory()->create(); // lietotājam nav komandas

    $league = League::factory()->create(['code' => 'TEST123']);

    $response = $this->actingAs($user)
                     ->post(route('leagues.join'), [
                         'code' => 'TEST123',
                     ]);

    $response->assertSessionHasErrors(); // vai redirect ar ziņu
    // Pārbaudi arī ziņu, ja vajag
});

test('user cannot join the same league twice', function () {
    $user = User::factory()->create();
    $team = FantasyTeam::factory()->create(['user_id' => $user->id]);

    $league = League::factory()->create(['code' => 'DUPLICATE']);

    // Pievienojam pirmo reizi
    $this->actingAs($user)->post(route('leagues.join'), ['code' => 'DUPLICATE']);

    // Mēģinām vēlreiz
    $response = $this->actingAs($user)
                     ->post(route('leagues.join'), ['code' => 'DUPLICATE']);

    $response->assertSessionHasErrors('code'); // vai līdzīgu kļūdu
});

test('unauthenticated user cannot join league', function () {
    $response = $this->post(route('leagues.join'), [
        'code' => 'ABC123',
    ]);

    $response->assertRedirect(route('login'));
});

test('only public leagues or leagues with correct code can be joined', function () {
    $user = User::factory()->create();
    FantasyTeam::factory()->create(['user_id' => $user->id]);

    $privateLeague = League::factory()->create([
        'code' => 'PRIVATE1',
        'is_public' => false,
    ]);

    $response = $this->actingAs($user)
                     ->post(route('leagues.join'), [
                         'code' => 'PRIVATE1',
                     ]);

    // Atkarībā no loģikas — vai atļauj vai nē
    $response->assertSessionHasErrors('code');
});