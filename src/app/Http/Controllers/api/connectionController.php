<?php
namespace App\Http\Controllers\api;
use http\Env;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Schema;
class connectionController extends Controller
{
    public function conn(){
        $pdo = DB::connection();
        if($pdo->getPdo())
        {
            echo "kết nối thành công đến database : ".$pdo->getDatabaseName() ." - truy cập dưới tài khoản : ".env('DB_USERNAME');
        } else {
            echo "không thể kết nối đến database";
        }
    }
    public function getTableType(){
        $query = DB::select('SHOW TABLES');
        $arr_table = array_map('current',$query);
        foreach ($arr_table as $item){
            $arr[] =  DB::select('SHOW COLUMNS FROM '.$item);
        }
        return response()->json(['tables'=>$query,'columns'=>$arr],200);
    }
}
