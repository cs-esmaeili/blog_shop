<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class KeyValue extends Controller
{
    public function addKey(Request $request)
    {
        $content =  json_decode($request->getContent());
        $result =  Item::create([
            'key' => $content->key,
            'value' => json_encode($content->value),
        ]);
        if ($result->count() > 0) {
            return response(['statusText' => 'ok', "message" => "مقدار اضافه شد"], 200);
        } else {
            return response(['statusText' => 'fail', "message" => "مقدار اضافه نشد"], 200);
        }
    }
    public function deleteKey(Request $request)
    {
        $result =  Item::where('item_id', '=', $request->key_value_id)->delete();
        if ($result) {
            return response(['statusText' => 'ok', "message" => "مقدار حذف شد"], 200);
        } else {
            return response(['statusText' => 'fail', "message" => "مقدار حذف نشد"], 200);
        }
    }
}
