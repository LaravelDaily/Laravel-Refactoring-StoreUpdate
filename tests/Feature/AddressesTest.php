<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @internal
 * @covers \App\Http\Controllers\AddressController
 */
class AddressesTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateAddress()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/addresses', [
            'street'      => 'my street',
            'number'      => 'my house number',
            'city'        => 'my city',
            'state'       => 'my state',
            'postal_code' => '12345',
            'country'     => '67',
            'phone'       => '+1234567890',
        ]);

        $response->assertValid();
        $response->assertRedirect('/addresses');
    }

    public function testCreatedAddressHasValidationErrors()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/addresses', [
            'street'      => 'my street',
            'city'        => 'my city',
            'state'       => 'my state',
            'postal_code' => '12345',
            'country'     => '67',
            'phone'       => '+1234567890',
        ]);

        $response->assertInvalid();
    }

    public function testUserCanUpdateAddress()
    {
        $user = User::factory()->create();

        $address = Address::create([
            'user_id'      => $user->id,
            'country_id'   => Country::create(['name' => 'usa'])->id,
            'token'        => Str::random(32),
            'street_name'  => 'my street',
            'house_number' => 'my house number',
            'city'         => 'my city',
            'state'        => 'my state',
            'postal_code'  => '12345',
            'phone'        => '+1234567890',
        ]);

        $response = $this->actingAs($user)->put('/addresses/' . $address->id, [
            'street'      => 'my new street',
            'number'      => 'my house number',
            'city'        => 'my city',
            'state'       => 'my state',
            'postal_code' => '12345',
            'country'     => '1',
            'phone'       => '+1234567890',
            'is_billing'  => false
        ]);

        $response->assertValid();
        $response->assertRedirect('/addresses');
    }

    public function testUpdatedAddressHasValidationErrors()
    {
        $user = User::factory()->create();

        $address = Address::create([
            'user_id'      => $user->id,
            'country_id'   => Country::create(['name' => 'usa'])->id,
            'token'        => Str::random(32),
            'street_name'  => 'my street',
            'house_number' => 'my house number',
            'city'         => 'my city',
            'state'        => 'my state',
            'postal_code'  => '12345',
            'phone'        => '+1234567890',
        ]);

        $response = $this->actingAs($user)->put('/addresses/' . $address->id, [
            'street'      => 'my street',
            'city'        => 'my city',
            'state'       => 'my state',
            'postal_code' => '12345',
            'country'     => '67',
            'phone'       => '+1234567890',
        ]);

        $response->assertInvalid();
    }
}
