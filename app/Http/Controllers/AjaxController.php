<?php

namespace App\Http\Controllers;

use App\Models\Gidrant;
use App\Models\Polygon;
use App\User;
use Illuminate\Http\Request;
use App\Models\Operplan;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Обработка Ajax запроса для маркеров
     *
     * @param \Illuminate\Http\Request $request
     * @return false|string
     */
    public function markerAjax(Request $request)
    {
        $items = $request->all();
        if ($items['pokaz_op'] == "1") {
            $icon_map_op = '{ iconUrl: "'.$items["iconUrl"].'",
                                            iconRetinaUrl:"'.$items["iconRetinaUrl"].'",
                                            shadowUrl:"'.$items["shadowUrl"].'",
                                            iconSize:[25,41],
                                            iconAnchor:[12,41],
                                            popupAnchor:[1,-34],
                                            tooltipAnchor:[16,-28],
                                            shadowSize:[41,41]}';
            $stmt_op = Operplan::where('zavod', $items['zavod_objekt'] )->get();
            foreach ($stmt_op as $row) {
                $objekt = $row['objekt'];
                $pos_x = $row['pos_x'];
                $pos_y = $row['pos_y'];
                $file = $row['file'];
                $sub[] = "{x: \"$pos_x\", y:\"$pos_y\", note: '<center><b>$objekt</b><br/></center><a href=\"$file\" target=\"_blank\">Оперативный план</a>', iconog:$icon_map_op}";
            }
        }
        if ($items['pokaz_pg'] == "1") {
            $icon_map_pg = '{ iconUrl: "'.$items["iconUrl"].'",
                                            iconRetinaUrl:"'.$items["iconRetinaUrl"].'",
                                            shadowUrl:"'.$items["shadowUrl"].'",
                                            iconSize:[25,41],
                                            iconAnchor:[12,41],
                                            popupAnchor:[1,-34],
                                            tooltipAnchor:[16,-28],
                                            shadowSize:[41,41]}';
            $stmt_pg = Gidrant::where('zavod', $items['zavod_objekt'] )->get();
            foreach ($stmt_pg as $row) {
                $objekt = $row['objekt'];
                $pos_x = $row['pos_x'];
                $pos_y = $row['pos_y'];
                $file = $row['file'];
                $sub[] = "{x: \"$pos_x\", y:\"$pos_y\", note: '<center><b>$objekt</b><br/></center><a href=\"$file\" target=\"_blank\">Пожарный гидрант</a>', iconog:$icon_map_pg}";
            }
        }
        if ($items['pokaz_obj'] == "1") {
            $stmt_obj = Polygon::where('zavod', $items['zavod_objekt'] )->get();
            foreach ($stmt_obj as $row) {
                $opisanie = $row['opisanie'];
                $color = $row['color'];
                $pos_x_1 = $row['pos_x_1'];
                $pos_y_1 = $row['pos_y_1'];
                $pos_x_2 = $row['pos_x_2'];
                $pos_y_2 = $row['pos_y_2'];
                $pos_x_3 = $row['pos_x_3'];
                $pos_y_3 = $row['pos_y_3'];
                $pos_x_4 = $row['pos_x_4'];
                $pos_y_4 = $row['pos_y_4'];
                $pos_x_5 = $row['pos_x_5'];
                $pos_y_5 = $row['pos_y_5'];
                $pos_x_6 = $row['pos_x_6'];
                $pos_y_6 = $row['pos_y_6'];
                $pos_x_7 = $row['pos_x_7'];
                $pos_y_7 = $row['pos_y_7'];
                $pos_x_8 = $row['pos_x_8'];
                $pos_y_8 = $row['pos_y_8'];
                $sub[] = "{x1: \"$pos_x_1\", y1:\"$pos_y_1\", x2: \"$pos_x_2\", y2:\"$pos_y_2\", x3: \"$pos_x_3\", y3:\"$pos_y_3\",
               x4: \"$pos_x_4\", y4:\"$pos_y_4\", x5: \"$pos_x_5\", y5:\"$pos_y_5\",
               x6: \"$pos_x_6\", y6:\"$pos_y_6\", x7: \"$pos_x_7\", y7:\"$pos_y_7\", x8: \"$pos_x_8\", y8:\"$pos_y_8\", color: \"$color\", note: '<center><b>$opisanie</b><br/></center>'}";
            }
        }
        return  json_encode($sub);
    }

    /**
     * Обработка Ajax запроса для активации пользователя
     *
     * @param \Illuminate\Http\Request $request
     * @return false|string
     */
    public function userUpDownAjax(Request $request)
    {
        $item = $request->all('id_user', 'value');
        if (isset($item)){
            $user = User::find($item['id_user']);
            if (empty($user)){
                return  "Запись ID=[{$item['id_user']}]не найдена";
            }
            $data['admin'] = $item['value'];
            $result = $user->update($data);
            if ($result && $item['value'] == '0'){
                return "Пользователь [{$user->name}] активен!";
            }elseif ($result && $item['value'] == null){
                return "Пользователь [{$user->name}] отключен!";
            }
        }
        return "Ошибка сервера!";
    }

    /**
     * Обработка Ajax запроса для активации пользователя
     *
     * @param \Illuminate\Http\Request $request
     * @return false|string
     */
    public function userAdminUpDownAjax(Request $request)
    {
        $item = $request->all('id_admin', 'value');
        if (isset($item)){
            $user = User::find($item['id_admin']);
            if (empty($user)){
                return  "Запись ID=[{$item['id_admin']}]не найдена";
            }
            $data['admin'] = $item['value'];
            $result = $user->update($data);
            if ($result && $item['value'] == '0'){
                return "Права администратора для пользователя [{$user->name}] отключены!";
            }elseif ($result && $item['value'] == '1'){
                return "Права администратора для пользователя [{$user->name}] включены!";
            }
        }
        return "Ошибка сервера!";
    }

}
