<?php

namespace Database\Seeders;

use App\Http\helpers\G;
use App\Models\File;
use App\Models\Person;
use App\Models\PersonInfo;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = G::newToken(env('ADMIN_USERNAME'), 1)['token_id'];
        $obj = Person::create([
            'username' => env('ADMIN_USERNAME'),
            'password' => G::getHash(G::changeWords(env('ADMIN_PASSWORD'))),
            'token_id' => $token,
            'role_id' => 1,
            'status' => 1,
        ]);
        $file = File::create([
            'orginal_name' => 'firstFile',
            'new_name' => '50167980.jpg',
            'location' => env('FILE_MANAGER_BASE_DIRECTORY') . "/Admins/Javad/",
            'person_id' => $obj->person_id,
        ]);
        PersonInfo::create([
            'person_id' => $obj->person_id,
            'file_id' => $file->file_id,
            'name' => env('ADMIN_NAME'),
            'family' => env('ADMIN_FAMILY'),
            'description' => "javad esmaeili is developer",
        ]);
    }
}
