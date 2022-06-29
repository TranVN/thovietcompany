<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BannersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'image_name' => 'Banner 1',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => Str::random(10),
        ]);
        DB::table('banners')->insert([
            'image_name' => 'Banner 2',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => Str::random(10),
        ]);
        DB::table('banners')->insert([
            'image_name' => 'Banner 3',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => Str::random(10),
        ]);
        DB::table('banners')->insert([
            'image_name' => 'Banner 4',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => Str::random(10),
        ]);
        DB::table('banners')->insert([
            'image_name' => 'Banner 5',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => Str::random(10),
        ]);
        DB::table('banners')->insert([
            'image_name' => 'Video Banner',
            'image_alt' => Str::random(10),
            'image_size' => Str::random(10),
            'image_height' => Str::random(10),
            'image_width' => Str::random(10),
            'image_path' => 'q8YqAWuGF9U',
        ]);

    }
}
