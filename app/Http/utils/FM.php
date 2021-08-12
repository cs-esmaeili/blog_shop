<?php

namespace App\Http\utils;

use App\Http\helpers\G;
use App\Models\File;
use App\Models\File_Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FM
{
    public static function location($key)
    {
        $baseDir = env('FILE_MANAGER_BASE_DIRECTORY');
        $location  =   $baseDir . $key;
        return $location;
    }
    public static function saveFile($file, $location, $uploader)
    {
        if (!file_exists($location) && !is_dir($location)) {
            mkdir($location,  0755, true);
        }
        $result = DB::transaction(function () use ($file, $location, $uploader) {
            $newName =  Str::uuid() . "." .  $file->getClientOriginalExtension();
            $hash = G::getHash($newName);
            $result = File::create([
                "orginal_name" => $file->getClientOriginalName(),
                "new_name" => $newName,
                "location" => $location,
                "person_id" => $uploader,
            ]);
            $file->move($location, $newName);
            return $result['file_id'];
        });
        return $result;
    }
    public static function deleteFile(File $file)
    {
        $result = DB::transaction(function () use ($file) {
            $path = null;
            $path =  $file['location'] . $file['new_name'];
            if (file_exists($path)) {
                $result = $file->delete();
                if ($result) {
                    unlink($path);
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        });
        return $result;
    }
    public static function deleteFolder($location)
    {
        $result = DB::transaction(function () use ($location) {
            $files = self::files($location);
            foreach ($files as $key => $value) {
                if (is_dir($location . $value)) {
                    $result =  self::deleteFolder($location . $value);
                    if ($result == false) {
                        return false;
                    }
                } else {
                    $result = File::where('new_name', '=', $value)->get();
                    if ($result->count() == 1) {
                        $result = self::deleteFile($result[0]);
                        if ($result == false) {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            }
            rmdir($location);
            return true;
        });
        return $result;
    }
    public static function files($location)
    {
        if (file_exists($location)) {
            $files = scandir($location);
            unset($files[0]);
            unset($files[1]);
            return $files;
        }
        return false;
    }
    public static function folderFilesLinks($location, $token = null)
    {
        $files = self::files($location);
        if (count($files) == 0) {
            return 'location is empty';
        }
        $outfiles = [];
        foreach ($files as $key => $value) {
            $file = File::where('new_name', '=', $value)->get();
            if ($file->count() == 1) {
                $file = $file[0];
                $outfiles[] = ['name' => $file->new_name, 'link' => env('APP_URL') . substr($location, strpos($location, 'files/')) . $value];
            } else {
                $outfiles[] = ['name' => $value, 'link' => ""];
            }
        }
        return $outfiles;
    }
    public static function getFile($name, $items)
    {
        $file = File::where('new_name', '=', $name)->get($items);
        if ($file->count() == 1) {
            return $file[0];
        }
        return false;
    }
    public static function renameDirectory($old_name, $new_name, $old_path, $new_path)
    {
        $result = DB::transaction(function () use ($old_name, $new_name, $old_path, $new_path) {
            $temp = $old_path . $old_name;
            $files =  File::where('location', 'LIKE', "%$temp%")->get();
            if (count($files) > 0) {
                for ($i = 0; $i < count($files); $i++) {
                    $full_old_location = $files[$i]->location;
                    $full_new_location = str_replace(($old_path . $old_name), ($new_path . $new_name), $full_old_location);
                    File::where('file_id', '=', $files[$i]->file_id)->update([
                        'location' => $full_new_location,
                    ]);
                }
            }
            if (!file_exists($new_path) && !is_dir($new_path)) {
                mkdir($new_path,  0755, true);
            }
            rename($old_path . $old_name, $new_path . $new_name);
            return true;
        });
        return $result;
    }
    public static function renameFile($old_name, $new_name, $old_path, $new_path)
    {
        $result = DB::transaction(function () use ($old_name, $new_name, $old_path, $new_path) {
            $files =  File::where('new_name', '=', $old_name)->get();
            if (count($files) > 0) {
                for ($i = 0; $i < count($files); $i++) {
                    $full_old_location = $files[$i]->location;
                    $full_new_location = str_replace($old_path, $new_path, $full_old_location);
                    File::where('file_id', '=', $files[$i]->file_id)->update([
                        'location' => $full_new_location,
                        'new_name' => $new_name,
                    ]);
                }
            }
            if (!file_exists($new_path) && !is_dir($new_path)) {
                mkdir($new_path,  0755, true);
            }
            rename($old_path . $old_name, $new_path . $new_name);
            return true;
        });
        return $result;
    }
    public static function createFolder($location)
    {
        if (file_exists($location)) {
            return "file exist";
        }
        return mkdir($location,  0755, true);
    }
    public static function getFileLink($file)
    {
        $base = env('APP_URL');
        $public_folder = env('PUBLIC_FOLDER_NAME');
        $continue = substr($file->location, strpos($file->location, $public_folder) + strlen($public_folder)) . $file->new_name;
        return $base . $continue;
    }
}
