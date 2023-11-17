<?php

namespace App\Helpers;

class Helper
{
    public static function menu($menus)
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            $html .= '
            <tr>
            <td>' . $menu->id . '</td>
            <td>' . $menu->name . '</td>
            <td>' . $menu->updated_at . '</td>
            <td>
            
                <a class ="btn btn-primary btn-sm" href="/admin/categorie/edit/' . $menu->id . '">\
                    <i class="fas fa-edit"></i>
                </a>
            
                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow(' . $menu->id . ',\' /admin/categorie/destroy \')">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            </tr>
           ';
        }

        return $html;
    }
}
