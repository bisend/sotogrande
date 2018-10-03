<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Category;
use App\Models\Admin\Property;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\PropertyDate;
use App\Models\Admin\PropertyFile;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image as InterventionImage;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Super House',
            'Super Villa',
            'Super Hostel',
            'Super Restaurant',
            'Super Bar',
            'Super Night Club',
            'Super Commercial'
        ];
        $faker = Faker\Factory::create();
        Property::truncate();
        PropertyContent::truncate();
        PropertyDate::truncate();
        PropertyFile::truncate();
        Image::truncate();
        $userId = User::where('role_id', 1)->first()->id;
        \DB::beginTransaction();
        for ($i = 1; $i <= 210; $i++) {
            $categoryId = $faker->numberBetween($min = 1, $max = 7);
            $name = $names[$categoryId - 1] . ' ' . $i;
            $countryId = rand(1, 2);
            $property = new Property();
            $property->user_id = $userId;
            $property->category_id = $categoryId;
            $property->type_id = null;
            $property->country_id = $countryId;
            $property->location_id = $countryId == 1 ? $faker->numberBetween($min = 1, $max = 4) : $faker->numberBetween($min = 5, $max = 8);
            $property->status = 1;
            $property->featured = 0;
            $property->location = [
                'geo_lon' => '40.416775',
                'geo_lat' => '-3.7037900000000263',
                'geo_zoom' => '5'
            ];
            $featuresCount = $faker->numberBetween($min = 1, $max = 17);
            $featuresArray = [];
            for ($k = 1; $k <= $featuresCount; $k++) {
                $featuresArray[] = "$k";
            }
            $property->features = $featuresArray;
            if ($i >= 1 && $i <= 70) {
                $property->prices = [
                    "price" => "" . $faker->numberBetween($min = 1000, $max = 100000),
                    "service_charge" => "" . $faker->numberBetween($min = 100, $max = 200),
                    "rates" => "" . $faker->numberBetween($min = 200, $max = 300),
                    "week" => "",
                    "month" => ""
                ];
            } elseif ($i >= 71 && $i <= 140) {
                $property->prices = [
                    "price" => "",
                    "service_charge" => "",
                    "rates" => "",
                    "week" => "" . $faker->numberBetween($min = 1, $max = 50),
                    "month" => "" . $faker->numberBetween($min = 100, $max = 200)
                ];
            } elseif ($i >= 141 && $i <= 210) {
                $property->prices = [
                    "price" => "" . $faker->numberBetween($min = 1000, $max = 100000),
                    "service_charge" => "" . $faker->numberBetween($min = 100, $max = 200),
                    "rates" => "" . $faker->numberBetween($min = 200, $max = 300),
                    "week" => "" . $faker->numberBetween($min = 1, $max = 50),
                    "month" => "" . $faker->numberBetween($min = 100, $max = 200)
                ];
            }
            $property->fees = null;
            $property->price_per_night = 0;
            $property->guest_number = $faker->numberBetween($min = 1, $max = 20);
            $property->rooms = $faker->numberBetween($min = 1, $max = 20);
            $property->property_info = [
                "property_reference" => "ref1000$i",
                "internal_area" => "" . $faker->numberBetween($min = 10, $max = 100),
                "external_area" => "" . $faker->numberBetween($min = 100, $max = 200),
                "bedrooms" => "" . $faker->numberBetween($min = 1, $max = 20),
                "bathrooms" => "" . $faker->numberBetween($min = 1, $max = 20)
            ];
            $property->contact = [
                "tel1" => "",
                "tel2" => "",
                "fax" => "",
                "email" => "",
                "web" => ""
            ];
            $property->social = [
                "facebook" => "",
                "gplus" => "",
                "twitter" => "",
                "instagram" => "",
                "pinterest" => "",
                "linkedin" => ""
            ];
            $property->video = null;
            $property->meta_title = "";
            $property->meta_description = "";
            $property->meta_keywords = "";
            $property->alias = str_slug($name);
            if ($i >= 1 && $i <= 70) {
                $property->sales = 1;
                $property->rentals = 0;
            } elseif ($i >= 71 && $i <= 140) {
                $property->sales = 0;
                $property->rentals = 1;
            } elseif ($i >= 141 && $i <= 210) {
                $property->sales = 1;
                $property->rentals = 1;
            }
            $property->position = 0;
            $property->slider = $i == 10 || $i == 155 || $i == 200 ? 1 : 0;
            $property->featured_rent = $i >= 71 && $i <= 75 ? 1 : 0;
            $property->position_sale = 0;
            $property->position_rent = 0;
            $property->featured_sale = $i >= 1 && $i <= 5 ? 1 : 0;
            $property->save();

            $propertyContent = new PropertyContent();
            $propertyContent->property_id = $property->id;
            $propertyContent->language_id = 1;
            $propertyContent->name = $name;
            $propertyContent->description = $faker->realText(250);
            $propertyContent->save();

            $propertyDate = new PropertyDate();
            $propertyDate->property_id = $property->id;
            $propertyDate->dates = null;
            $propertyDate->save();

            $cat = Category::find($categoryId)->alias;
            $stat = rand(1, 2);
            
            $name = uniqid() . unique_string() .'.jpg';
            $date = date('M-Y');
            $path = public_path('/images/data/'. $date .'/'. $name);
            if( ! File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $file = public_path('/images/seed/'. $cat . '-1.jpg');
            $dest = public_path('/images/data/'. $date . '/' . $name);
            File::copy($file, $dest);

            $image = new Image();
            $image->image = $date . '/' . $name;
            $image->imageable_id = $property->id;
            $image->imageable_type = 'App\Models\Admin\Property';
            $image->status = $stat == 1 ? 1 : 0;
            $image->save();

            $name = uniqid() . unique_string() .'.jpg';
            $date = date('M-Y');
            $path = public_path('/images/data/'. $date .'/'. $name);
            if( ! File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $file = public_path('/images/seed/'. $cat . '-2.jpg');
            $dest = public_path('/images/data/'. $date . '/' . $name);
            File::copy($file, $dest);

            $image = new Image();
            $image->image = $date . '/' . $name;
            $image->imageable_id = $property->id;
            $image->imageable_type = 'App\Models\Admin\Property';
            $image->status = $stat == 2 ? 1 : 0;
            $image->save();

            $propertyFile = new PropertyFile();
            $propertyFile->property_id = $property->id;
            $propertyFile->name = 'findaproperty-agreement.doc';
            $propertyFile->file_name = 'findaproperty-agreement.doc';
            $propertyFile->path = '/files/findaproperty-agreement.doc';
            $propertyFile->save();
        }
        \DB::commit();
    }
}
