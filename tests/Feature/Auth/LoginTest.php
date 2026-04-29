<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('login page is accessible', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
    $response->assertSee('Login');        // Mainīt, ja lapā ir cits teksts
});

test('user can login with correct credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('Password123!'),
    ]);

    $response = $this->post(route('login'), [
        'email'    => 'test@example.com',
        'password' => 'Password123!',
    ]);

    $response->assertRedirect(route('dashboard')); // Mainīt, ja tev cits redirect
    $this->assertAuthenticatedAs($user);
});

test('user cannot login with wrong password', function () {
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('Password123!'),
    ]);

    $response = $this->post(route('login'), [
        'email'    => 'test@example.com',
        'password' => 'WrongPassword123!',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('user cannot login with non-existing email', function () {
    $response = $this->post(route('login'), [
        'email'    => 'neeksiste@example.com',
        'password' => 'Password123!',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('email is required', function () {
    $response = $this->post(route('login'), [
        'email'    => '',
        'password' => 'Password123!',
    ]);

    $response->assertSessionHasErrors('email');
});

test('password is required', function () {
    $response = $this->post(route('login'), [
        'email'    => 'test@example.com',
        'password' => '',
    ]);

    $response->assertSessionHasErrors('password');
});

test('login remembers user when remember me is checked', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('Password123!'),
    ]);

    $response = $this->post(route('login'), [
        'email'      => 'test@example.com',
        'password'   => 'Password123!',
        'remember'   => 'on',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
});