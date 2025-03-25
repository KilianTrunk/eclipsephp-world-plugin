<?php

use Eclipse\World\Filament\Clusters\World\Resources\CountryResource;
use Eclipse\World\Filament\Clusters\World\Resources\CountryResource\Pages\ListCountries;
use Eclipse\World\Models\Country;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->setUpSuperAdmin();
});

test('unauthorized access can be prevented', function () {
    // Create regular user with no permissions
    $this->setUpCommonUser();

    // Create test country
    $country = Country::factory()->create();

    // View table
    $this->get(CountryResource::getUrl())
        ->assertForbidden();

    // Add direct permission to view the table, since otherwise any other action below is not available even for testing
    $this->user->givePermissionTo('view_any_country');

    // Create country
    livewire(ListCountries::class)
        ->assertActionDisabled('create');

    // Edit country
    livewire(ListCountries::class)
        ->assertCanSeeTableRecords([$country])
        ->assertTableActionDisabled('edit', $country);

    // Delete country
    livewire(ListCountries::class)
        ->assertTableActionDisabled('delete', $country)
        ->assertTableBulkActionDisabled('delete');

    // Restore and force delete
    $country->delete();
    $this->assertSoftDeleted($country);

    livewire(ListCountries::class)
        ->assertTableActionDisabled('restore', $country)
        ->assertTableBulkActionDisabled('restore')
        ->assertTableActionDisabled('forceDelete', $country)
        ->assertTableBulkActionDisabled('forceDelete');
});

test('countries table can be displayed', function () {
    $this->get(CountryResource::getUrl())
        ->assertSuccessful();
});

test('form validation works', function () {
    $component = livewire(ListCountries::class);

    // Test required fields
    $component->callAction('create')
        ->assertHasActionErrors([
            'id' => 'required',
            'a3_id' => 'required',
            'name' => 'required',
        ]);

    // Test with valid data
    $component->callAction('create', Country::factory()->definition())
        ->assertHasNoActionErrors();
});

test('new country can be created', function () {
    $data = Country::factory()->definition();

    livewire(ListCountries::class)
        ->callAction('create', $data)
        ->assertHasNoActionErrors();

    $country = Country::where('id', $data['id'])->first();
    expect($country)->toBeObject();

    foreach ($data as $key => $val) {
        expect($country->$key)->toEqual($val);
    }
});

test('existing country can be updated', function () {
    $country = Country::factory()->create([
        'id' => 'SI',
        'a3_id' => 'SVN',
        'num_code' => 705,
        'name' => 'Slovenia',
        'flag' => '🇸🇮',
    ]);

    $data = \Illuminate\Support\Arr::except(Country::factory()->definition(), ['id']);

    livewire(ListCountries::class)
        ->callTableAction('edit', $country, $data)
        ->assertHasNoTableActionErrors();

    $country->refresh();

    foreach ($data as $key => $val) {
        expect($country->$key)->toEqual($val);
    }
});

test('country can be deleted', function () {
    $country = Country::factory()->create();

    livewire(ListCountries::class)
        ->callTableAction('delete', $country)
        ->assertHasNoTableActionErrors();

    $this->assertSoftDeleted($country);
});

test('country can be restored', function () {
    $country = Country::factory()->create();
    $country->delete();

    $this->assertSoftDeleted($country);

    livewire(ListCountries::class)
        ->filterTable('trashed')
        ->assertTableActionExists('restore')
        ->assertTableActionEnabled('restore', $country)
        ->assertTableActionVisible('restore', $country)
        ->callTableAction('restore', $country)
        ->assertHasNoTableActionErrors();

    $this->assertNotSoftDeleted($country);
});

test('country can be force deleted', function () {
    $country = Country::factory()->create();

    $country->delete();
    $this->assertSoftDeleted($country);

    livewire(ListCountries::class)
        ->filterTable('trashed')
        ->assertTableActionExists('forceDelete')
        ->assertTableActionEnabled('forceDelete', $country)
        ->assertTableActionVisible('forceDelete', $country)
        ->callTableAction('forceDelete', $country)
        ->assertHasNoTableActionErrors();

    $this->assertModelMissing($country);
});
