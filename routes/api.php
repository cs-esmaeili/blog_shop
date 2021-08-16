<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\helpers\G;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Category;
use App\Http\Controllers\FileManager;
use App\Http\Controllers\IndexPage;
use App\Http\Controllers\KeyValue;
use App\Http\Controllers\Person;
use App\Http\Controllers\Post;
use App\Http\Middleware\CheckHeaders;
use App\Http\Middleware\CheckToken;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('admin')->middleware([CheckHeaders::class])->group(function () {

    Route::post('/login', [Authentication::class, 'Login'])->name('Login');
    Route::post('/logout', [Authentication::class, 'Logout'])->name('Logout');

    Route::post('/contactUs', [Person::class, 'contactUs'])->name('contactUs');


    Route::middleware([CheckToken::class])->group(function () {

        Route::post('/personProfile', [Person::class, 'personProfile'])->name('personProfile');
        Route::post('/admins', [Person::class, 'admins'])->name('admins');
        Route::post('/adminRoles', [Person::class, 'adminRoles'])->name('adminRoles');
        Route::post('/createPerson', [Person::class, 'createPerson'])->name('createPerson');
        Route::post('/editPerson', [Person::class, 'editPerson'])->name('editPerson');
        Route::post('/roles', [Person::class, 'roles'])->name('roles');
        Route::post('/rolePermissions', [Person::class, 'rolePermissions'])->name('rolePermissions');
        Route::post('/missingPermissions', [Person::class, 'missingPermissions'])->name('missingPermissions');
        Route::post('/addPermission', [Person::class, 'addPermission'])->name('addPermission');
        Route::post('/deletePermission', [Person::class, 'deletePermission'])->name('deletePermission');

        Route::post('/addRole', [Person::class, 'addRole'])->name('addRole');
        Route::post('/deleteRole', [Person::class, 'deleteRole'])->name('deleteRole');
        Route::post('/editRole', [Person::class, 'editRole'])->name('editRole');


        Route::post('/saveFile', [FileManager::class, 'saveFile'])->name('saveFile');
        Route::post('/saveFiles', [FileManager::class, 'saveFiles'])->name('saveFiles');
        Route::post('/deleteFile', [FileManager::class, 'deleteFile'])->name('deleteFile');
        Route::post('/deleteFiles', [FileManager::class, 'deleteFiles'])->name('deleteFiles');
        Route::post('/deleteFolder', [FileManager::class, 'deleteFolder'])->name('deleteFolder');
        Route::post('/renameFolder', [FileManager::class, 'renameFolder'])->name('renameFolder');
        Route::post('/renameFile', [FileManager::class, 'renameFile'])->name('renameFile');
        Route::post('/moveFileAndFolder', [FileManager::class, 'moveFileAndFolder'])->name('moveFileAndFolder');
        Route::post('/renameFileAndFolder', [FileManager::class, 'renameFileAndFolder'])->name('renameFileAndFolder');
        Route::post('/folderFiles', [FileManager::class, 'folderFiles'])->name('folderFiles');
        Route::post('/folderFilesLinks', [FileManager::class, 'folderFilesLinks'])->name('folderFilesLinks');
        Route::post('/deleteFolderOrFile', [FileManager::class, 'deleteFolderOrFile'])->name('deleteFolderOrFile');
        Route::post('/createFolder', [FileManager::class, 'createFolder'])->name('createFolder');
        Route::post('/fileInformation', [FileManager::class, 'fileInformation'])->name('fileInformation');


        Route::any('/file/{hash}', function ($hash, Request $request) {
            $person = G::getPersonFromToken($request->bearerToken());
            $file = $person->files()->where('hash', '=', $hash)->get();
            if ($file->count() == 1) {
                return response()->file($file[0]->location . $file[0]->new_name);
            } else {
                return response(['statusText' => 'fail', 'message' => "درخواست شما مجاز نیست"], 200);
            }
        })->name('privateFile');

        Route::post('/categoryListPyramid', [Category::class, 'categoryListPyramid'])->name('categoryListPyramid');
        Route::post('/categoryListPure', [Category::class, 'categoryListPure'])->name('categoryListPure');
        Route::post('/addCategory', [Category::class, 'addCategory'])->name('addCategory');
        Route::post('/deleteCategory', [Category::class, 'deleteCategory'])->name('deleteCategory');


        Route::post('/createPost', [Post::class, 'createPost'])->name('createPost');
        Route::post('/postList', [Post::class, 'postList'])->name('postList');
        Route::post('/deletePost', [Post::class, 'deletePost'])->name('deletePost');
        Route::post('/changePostStatus', [Post::class, 'changePostStatus'])->name('changePostStatus');
        Route::post('/updatePost', [Post::class, 'updatePost'])->name('updatePost');

        Route::post('/addKey', [KeyValue::class, 'addKey'])->name('addKey');
        Route::post('/deleteKey', [KeyValue::class, 'deleteKey'])->name('deleteKey');

        Route::post('/sliderImages', [IndexPage::class, 'sliderImages'])->name('sliderImages');
        Route::post('/popularPosts', [IndexPage::class, 'popularPosts'])->name('popularPosts');
        Route::post('/lastVideo', [IndexPage::class, 'lastVideo'])->name('lastVideo');
        Route::post('/top3Recent', [IndexPage::class, 'top3Recent'])->name('top3Recent');
        Route::post('/latestScreenshots', [IndexPage::class, 'latestScreenshots'])->name('latestScreenshots');
        Route::post('/latestPictures', [IndexPage::class, 'latestPictures'])->name('latestPictures');
    });
});
