<?php 

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper{
    public static function menu($menus, $psrent_id = 0, $char = ""){
        $html = "";
        foreach($menus as $key=>$menu){
            if($menu->parent_id == $psrent_id){
                $html .=
                 '
                <tr>
                    <td>'.$menu->id.'</td>
                    <td>'.$char.$menu->name.'</td>
                    <td><a href="'.$menu->file.'" target="_blank"><img src="'.$menu->file.'" height="50px"></a></td>
                    <td>'.self::active($menu->active).'</td>
                    <td>'.$menu->updated_at.'</td>
                    <td>
                     <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$menu->id.'"><i class="fas fa-edit"></i></a>
                     <a class="btn btn-danger btn-sm" href="#"
                      onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')">
                      <i class="fas fa-trash"></i></a>
                    </td>             
                     </tr>

                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char.'--');
            }
        }

        return $html;

    }

    public static function active($active = 0){
        return $active == 0 ? '<span class="btn btn-danger btn-xs text-center ">Không</span>' :'<span class="btn btn-success btn-xs text-center ">Có</span>';
    }

    public static function menus($menus, $parent_id = 0 ){
        $html = '';
        foreach($menus as $key=>$menu){
            if($menu->parent_id == $parent_id){
                $html .='
                    <li>
                        <a href="/danh-muc/'.$menu->id.'-'.Str::slug($menu->name,'-').'">
                            '.$menu->name.'
                        </a>';
                unset($menus[$key]);
                if(self::isChild($menus, $menu->id)){
                    $html.='<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .='</ul>';
                }
                $html.='</li>
                ';
            }

        }
        return $html;
    }

    public static function isChild($menus, $id){
        foreach($menus as $menu){
            if($menu->parent_id == $id){
                return true;
            }
        }
        return false;

    }

    public static function price($price = 0, $price_sale = 0){
        if($price!= 0) return $price; 
        if($price_sale!= 0) return $price_sale;
        return '<a href="/lien-he.html">Liên hệ</a>';
    }

}