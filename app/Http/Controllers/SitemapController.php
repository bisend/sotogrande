<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sitemap;
use App\Models\Admin\Property;
use Carbon\Carbon;
use File;

class SitemapController extends Controller
{
    protected $default_language;

    public function __construct()
    {
        $this->default_language = default_language();
    }

    public function index()
    {
        $default_language = $this->default_language;

        $properties = Property::with([
            'property_status',
            'images',
            'contentLoad' => function ($query) use ($default_language) {
                $query->where('language_id', $default_language->id);
            },
        ])->get();

        header("Content-type: text/xml;charset=ISO-8859-1");
        $xml = "";
        $xml .= '<?xml version="1.0" encoding="ISO-8859-1"?><root>';
        foreach ($properties as $property) {
            $status = $property->status == 1 ? 'Available' : 'Not available';
            $cat2 = $property->category_id == 2 ? 1 : 0;
            $pool = ! empty($property->features) && in_array('8', $property->features) ? 1 : 0;
            $parking = ! empty($property->features) && in_array('2', $property->features) ? 1 : 0;
            $images_text = "";
            $t = strip_tags(trim($property->contentLoad->description));
            $t = htmlspecialchars($t, ENT_XML1 | ENT_COMPAT, 'UTF-8');
            $desc = $t ? strip_tags($t) : '';
            $price = $property->sales ? $property->prices['price'] : $property->prices['month'];
            if (empty($price)) {
                $price = 0;
            }
            if ( ! empty($property->images)) {
                foreach ($property->images as $image) {
                    if ($image) {
                        $images_text .= "<image id='{$image->id}'>
                            <url>". url('/images/data/' . $image->image) . "</url>
                        </image>";
                    }
                }
            }
            $xml .= "<property>
                <id>{$property->id}</id>
                <date></date>
                <ref>{$property->property_info['property_reference']}</ref>
                <price>$price</price>
                <service_charge>{$property->prices['service_charge']}</service_charge>
                <rates>{$property->prices['rates']}</rates>
                <type>
                    <en>{$property->category->contentDefault->name}</en>
                </type>
                <country>{$property->country->contentload->location}</country>
                <sale>{$property->sales}</sale>
                <rental>{$property->rentals}</rental>
                <status>$status</status>
                <category2>$cat2</category2>
                <beds>{$property->property_info['bedrooms']}</beds>
                <baths>{$property->property_info['bathrooms']}</baths>
                <pool>$pool</pool>
                <parking>$parking</parking>
                <internal_size>{$property->property_info['internal_area']}</internal_size>
                <external_size>{$property->property_info['external_area']}</external_size>
                <desc>
                    <en>$desc</en>
                </desc>
                <images>
                    $images_text
                </images>
	        </property>";
        }

        $xml .= '</root>';

        // foreach ($properties as $property) {
        //     $tag = Sitemap::addTag(route('property.show', $property->alias), Carbon::parse($property->updated_at));

            // foreach ($property->images as $image) {
            //     $tag->addImage(url('/images/data/'. $image->image));
            // }
        // }

        // $xml = Sitemap::xml();
        $filename = public_path('feed.xml');
        if (File::exists($filename)) {
            File::delete($filename);
        }
        File::put($filename, $xml);
        echo $xml;
        // return Sitemap::render();
    }
}
