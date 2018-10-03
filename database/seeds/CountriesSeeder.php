<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Country;
use App\Models\Admin\CountryContent;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        CountryContent::truncate();
        \DB::beginTransaction();
        $countries = [
            'Gibraltar',
            'Spain'
        ];
        foreach ($countries as $country) {
            $newCountry = new Country();
            $newCountry->featured = 0;
            $newCountry->order = 0;
            $newCountry->alias = str_slug($country);
            $newCountry->save();
            $newCountryContent = new CountryContent();
            $newCountryContent->location_id = $newCountry->id;
            $newCountryContent->language_id = 1;
            $newCountryContent->location = $country;
            $newCountryContent->save();
        }
        \DB::commit();
    }
}
