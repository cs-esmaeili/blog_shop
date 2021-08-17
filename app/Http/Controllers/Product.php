<?php

namespace App\Http\Controllers;

use App\Http\helpers\G;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;

class Product extends Controller
{
    public function addProduct(Request $request)
    {
        try {
            $result = ModelsProduct::create(
                G::getArrayItems(
                    collect($request->request)->toArray(),
                    (new ModelsProduct())->getFillable()
                )
            );
            if ($result) {
                return response(
                    ["statusText" => "ok", "message" => "محصول ساخته شد"],
                    201
                );
            } else {
                return response(
                    ["statusText" => "fail", "message" => "محصول ساخته نشد"],
                    406
                );
            }
        } catch (\Throwable $error) {
            if ($error->errorInfo[1] == 1062) {
                return response(
                    [
                        "statusText" => "fail",
                        "message" => "نام محصول باید منحصر به فرد باشد",
                    ],
                    406
                );
            } else {
                dd($error);
                return response(["statusText" => "fail"], 500);
            }
        }
    }
    public function deleteProduct(Request $request)
    {
        $content = json_decode($request->getContent());
        $result = ModelsProduct::where(
            "product_id",
            "=",
            $content->product_id
        )->delete();
        if ($result) {
            return response(
                ["statusText" => "ok", "message" => "محصول حذف شد"],
                406
            );
        } else {
            return response(
                ["statusText" => "fail", "message" => "محصول حذف نشد"],
                406
            );
        }
    }
    public function editProduct(Request $request)
    {
        $content = json_decode($request->getContent());
        $result = ModelsProduct::where(
            "product_id",
            "=",
            $content->product_id
        )->update(
            G::getArrayItems(
                collect($request->request)->toArray(),
                (new ModelsProduct())->getFillable()
            )
        );
        if ($result) {
            return response(
                ["statusText" => "ok", "message" => "محصول بروز شد"],
                406
            );
        } else {
            return response(
                ["statusText" => "fail", "message" => "محصول بروز نشد"],
                406
            );
        }
    }

    public function productList(Request $request)
    {
        $content = json_decode($request->getContent());
        $item_number = $content->item_number;
        $page = $content->page;

        $result = ModelsProduct::offset(($page - 1) * $item_number)
            ->limit($item_number)
            ->get();

        if ($page == 1) {
            $count = ModelsProduct::all()->count();
            $pages = ceil($count / $item_number);
            return response(["pages_number" => $pages, $result]);
        }
        return response($result);
    }
}
