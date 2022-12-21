<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $index) {
            DB::table('posts')
                ->insert([
                    'author_id' => $index,
                    'slug' => "my-slug-$index",
                    'title' => "$index - My post title",
                    'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu arcu nec nulla vestibulum efficitur eget sit amet eros. Mauris eget efficitur libero. Mauris ac augue turpis.',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu arcu
                    nec nulla vestibulum efficitur eget sit amet eros. Mauris eget efficitur
                    libero. Mauris ac augue turpis. Donec ut gravida turpis, in vehicula ex.
                    Maecenas dui mi, eleifend vitae malesuada non, suscipit nec libero. Nam
                    fringilla feugiat nunc quis tincidunt. Integer semper aliquam erat, et
                    dignissim metus porttitor vitae. Ut eleifend tortor vel leo aliquet
                    porttitor. Duis sagittis ullamcorper feugiat. Proin vitae tincidunt magna,
                    sed sollicitudin dolor. Orci varius natoque penatibus et magnis dis
                    parturient montes, nascetur ridiculus mus. Morbi vitae venenatis libero. Sed
                    aliquet ante ut mauris finibus, id venenatis lacus accumsan. Praesent
                    imperdiet laoreet sapien. Cras laoreet id mauris vel finibus. Aliquam mattis
                    eget orci quis ornare. Aenean dictum diam in metus iaculis pharetra.
                    Phasellus interdum id nulla quis ornare. Duis in nulla auctor, sodales felis
                    vel, dapibus justo. Duis et neque vitae libero aliquam pulvinar. Sed finibus
                    erat id efficitur porttitor. Nullam velit felis, maximus nec hendrerit eu,
                    pretium quis ligula. Duis tempus tellus id ante suscipit finibus. Morbi et
                    varius nisi. Quisque elit lacus, fringilla ut nibh nec, lobortis mollis
                    purus. Vestibulum nec dui sem. Sed vitae nulla urna. Suspendisse ultricies
                    tellus ac ligula mollis, nec ornare lacus sodales.',
                    'created_at' => new CarbonImmutable(),
                    'updated_at' => new CarbonImmutable(),
                ]);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
