<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Location;
use App\Models\Admin\LocationContent;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();
        LocationContent::truncate();
        \DB::beginTransaction();
        $locationsG = [
            'London',
            'Paris',
            'New York',
            'Zurich'
        ];
        $locationsS = [
            'Kuala Lumpur',
            'California',
            'Egypt',
            'Sydney'
        ];
        foreach ($locationsG as $locationG) {
            $newLocation = new Location();
            $newLocation->country_id = 1;
            $newLocation->featured = 0;
            $newLocation->order = 0;
            $newLocation->home_image = 'no_image.jpg';
            $newLocation->alias = str_slug($locationG);
            $newLocation->save();

            $newLocationContent = new LocationContent();
            $newLocationContent->location_id = $newLocation->id;
            $newLocationContent->language_id = 1;
            $newLocationContent->location = $locationG;
            $newLocationContent->save();
        }

        foreach ($locationsS as $locationS) {
            $newLocation = new Location();
            $newLocation->country_id = 2;
            $newLocation->featured = 0;
            $newLocation->order = 0;
            $newLocation->home_image = 'no_image.jpg';
            $newLocation->alias = str_slug($locationS);
            $newLocation->save();

            $newLocationContent = new LocationContent();
            $newLocationContent->location_id = $newLocation->id;
            $newLocationContent->language_id = 1;
            $newLocationContent->location = $locationS;
            $newLocationContent->save();
        }
        \DB::commit();
    }
}
