<?php

namespace App\Http\Controllers;

use App\Http\helpers\G;
use App\Http\Requests\assignFileToUser;
use App\Http\Requests\deleteFile;
use App\Http\Requests\deleteFiles;
use App\Http\Requests\deleteFolder;
use App\Http\Requests\renameFolder;
use App\Http\Requests\saveFile;
use App\Http\Requests\saveFiles;
use App\Http\Requests\unAssignFileFromUser;
use App\Http\utils\FM;
use App\Models\File;
use Illuminate\Http\Request;

class FileManager extends Controller
{
    public function saveFile(saveFile $request)
    {
        $location = FM::location($request->path, 'public');
        $person = G::getPersonFromToken($request->bearerToken());
        $result = FM::saveFile($request->file('file'), $location, $person->person_id);
        if ($result != false) {
            return response(['statusText' => 'ok', 'message' => "فایل ذخیره شد"], 200);
        } else {
            return response(['statusText' => 'fail', 'message' => "فایل ذخیره نشد"], 200);
        }
    }

    public function saveFiles(saveFiles $request)
    {
        $location = FM::location($request->path,  'public');
        $person = G::getPersonFromToken($request->bearerToken());
        $files = $request->file('file');

        $output = [];
        for ($i = 0; $i < count($files); $i++) {
            $result = FM::saveFile($files[$i], $location, $person->person_id);
            $output[] = $result;
        }
        return response(['statusText' => 'ok', 'list' => $output, 'message' => "فایل(ها) ذخیره شد"], 200);
    }

    public function deleteFile(deleteFile $request)
    {
        $content =  json_decode($request->getContent());
        $result = File::where('new_name', '=', $content->file_name)->get();
        if ($result->count() == 1) {
            $result = FM::deleteFile($result[0]);
            if ($result) {
                return response(['statusText' => 'ok', 'message' => "فایل حذف شد!"], 200);
            } else {
                return response(['statusText' => 'fail', 'message' => "فایل حذف نشد"], 200);
            }
        } else {
            return response(['statusText' => 'fail', 'message' => "فایل پیدا نشد"], 200);
        }
    }

    public function deleteFiles(deleteFiles $request)
    {
        $content =  json_decode($request->getContent());
        $content = $content->files;
        for ($i = 0; $i < count($content); $i++) {
            $result = File::where('new_name', '=', $content[$i])->get();
            if ($result->count() == 1) {
                $result = FM::deleteFile($result[0]);
                if ($result == false) {
                    return response(['statusText' => 'fail', 'message' => "فایل(ها) حذف نشد"], 200);
                }
            } else {
                return response(['statusText' => 'fail', 'message' => "فایل(ها) پیدا نشد"], 200);
            }
        }
        return response(['statusText' => 'ok', 'message' => "فایل(ها) حذف شد!"], 200);
    }

    public function deleteFolder(deleteFolder $request)
    {
        $content =  json_decode($request->getContent());
        $location = FM::location($content->path);
        $result = FM::deleteFolder($location);
        if ($result) {
            return response(['statusText' => 'ok', 'message' => "پوشه حذف شد"], 200);
        } else {
            return response(['statusText' => 'fail', 'message' => "پوشه حذف نشد"], 200);
        }
    }

    public function deleteFolderOrFile(Request $request)
    {
        $content =  json_decode($request->getContent());
        $list = $content->list;
        $folders = [];
        $files = [];
        for ($i = 0; $i < count($list); $i++) {
            if (str_contains($list[$i], '.')) {
                $files[] = $list[$i];
            } else {
                $folders[] =  $content->path . $list[$i];
            }
        }
        for ($i = 0; $i < count($files); $i++) {
            $result = File::where('new_name', '=', $files[$i])->get();
            if ($result->count() == 1) {
                $result = FM::deleteFile($result[0]);
                if ($result == false) {
                    return response(['statusText' => 'fail', 'message' => "فایل(ها) حذف نشد"], 200);
                }
            } else {
                return response(['statusText' => 'fail', 'message' => "فایل(ها) پیدا نشد"], 200);
            }
        }
        for ($i = 0; $i < count($folders); $i++) {
            $location = FM::location($folders[$i] . '/');
            $result = FM::deleteFolder($location);
            if ($result === false) {
                return response(['statusText' => 'fail', 'message' => "پوشه حذف نشد"], 200);
            }
        }
        return response(['statusText' => 'ok', 'message' => "فایل/پوشه (ها) حذف شد"], 200);
    }

    public function renameFolder(renameFolder $request)
    {
        $content =  json_decode($request->getContent());
        $location_old = FM::location($content->old_path);
        $location_new = FM::location($content->new_path);
        $result = FM::renameDirectory($content->old_name, $content->new_name, $location_old, $location_new);
        if ($result) {
            return response(['statusText' => 'ok', 'message' => "نام پوشه تغییر کرد"], 200);
        } else {
            return response(['statusText' => 'fail', 'message' => "نام پوشه تغییر نکرد"], 200);
        }
    }
    public function renameFile(renameFolder $request)
    {
        $content =  json_decode($request->getContent());
        $location_old = FM::location($content->old_path);
        $location_new = FM::location($content->new_path);
        $result = FM::renameFile($content->old_name, $content->new_name, $location_old, $location_new);
        if ($result) {
            return response(['statusText' => 'ok', 'message' => "نام فایل تغییر کرد"], 200);
        } else {
            return response(['statusText' => 'fail', 'message' => "نام فایل تغییر نکرد"], 200);
        }
    }

    public function folderFilesLinks(Request $request)
    {
        $content =  json_decode($request->getContent());
        $location = FM::location($content->path);
        $files = FM::folderFilesLinks($location);
        if ($files == false) {
            return response(['statusText' => 'fail'], 200);
        } else {
            return response(['statusText' => 'ok', "list" => $files], 200);
        }
    }
    public function folderFiles(Request $request)
    {
        $content =  json_decode($request->getContent());
        $location = FM::location($content->path);
        $files = FM::files($location);
        if ($files === false) {
            return response(['statusText' => 'fail', 'message' => "مسیر وجود ندارد"], 200);
        } else {
            return response(['statusText' => 'ok', "list" => array_values($files)], 200);
        }
    }
    public function createFolder(Request $request)
    {
        $content =  json_decode($request->getContent());
        $location = FM::location($content->path);
        $result = FM::createFolder($location);
        if ($result === false) {
            return response(['statusText' => 'fail', 'message' => "پوشه ساخته نشد"], 200);
        } else if ($result === true) {
            return response(['statusText' => 'ok', 'message' => "پوشه ساخته شد"], 200);
        } else {
            return response(['statusText' => 'fail', 'message' => "پوشه ای با این نام وجود دارد"], 200);
        }
    }
    public function fileInformation(Request $request)
    {
        $content =  json_decode($request->getContent());
        $result = FM::getFile($content->name, ['orginal_name', 'new_name', 'person_id', 'created_at', 'file.file_id', 'location']);
        $file =  $result->toArray();
        $file['link'] = FM::getFileLink($result);
        unset($file['location']);
        $file['uploader'] = $result->uploader->informations();
        if ($result === false) {
            return response(['statusText' => 'fail', 'message' => "اطلاعات فایل پیدا نشد"], 200);
        } else {
            return response(['statusText' => 'ok', "file" => $file], 200);
        }
    }
    public function moveFileAndFolder(Request $request)
    {
        $content =  json_decode($request->getContent());
        $location_old = FM::location($content->old_path);
        $location_new = FM::location($content->new_path);
        $items = $content->items;
        $folders = [];
        $files = [];
        foreach ($items as $key => $value) {
            if (str_contains($value, '.')) {
                $files[] = $value;
            } else {
                $folders[] = $value;
            }
        }
        foreach ($files as $key => $value) {
            $result = FM::renameFile($value, $value, $location_old, $location_new);
            if ($result == false) {
                return response(['statusText' => 'fail', 'message' => "فایل(ها)  منتقل نشد"], 200);
            }
        }
        foreach ($folders as $key => $value) {
            $result = FM::renameDirectory($value, $value, $location_old, $location_new);
            if ($result == false) {
                return response(['statusText' => 'fail', 'message' => "فایل(ها)  منتقل نشد"], 200);
            }
        }
        return response(['statusText' => 'ok', 'message' => "فایل(ها)  منتقل شد"], 200);
    }
    public function renameFileAndFolder(Request $request)
    {
        $content =  json_decode($request->getContent());
        $location = FM::location($content->path);
        $old_name = $content->old_name;
        $new_name = $content->new_name;

        if (str_contains($old_name, '.')) {
            $result = FM::renameFile($old_name, $new_name, $location, $location);
            if ($result == false) {
                return response(['statusText' => 'fail', 'message' => "فایل تغییر نام پیدا نکرد"], 200);
            }
        } else {
            $result = FM::renameDirectory($old_name, $new_name, $location, $location);
            if ($result == false) {
                return response(['statusText' => 'fail', 'message' => "فایل تغییر نام پیدا نکرد"], 200);
            }
        }
        return response(['statusText' => 'ok', 'message' => "فایل تغییر نام پیدا کرد"], 200);
    }
}
