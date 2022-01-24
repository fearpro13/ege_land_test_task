<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PaintController extends Controller
{
    public function paint(){
        return view('paint',[
            'files' => $this->getPaints()
        ]);
    }
    public function savePaint(Request $request)
    {
        $file = $_POST['canvas_image'];

        var_dump($file);
        $file = str_replace('data:image/octet-stream;base64,', '', $file);
        $img = str_replace(' ', '+', $file);
        $fileData = base64_decode($img);

        $fileName = $_POST["info"] . bin2hex(random_bytes(6));

        file_put_contents(base_path("public/paints/$fileName.png"), $fileData);
    }

    private function getPaints():array{
        $path    = '/paints';
        $files = array_diff(scandir(base_path("public/$path")), array('.', '..'));

        $files = array_map(function ($item){
            return '/paints/' . $item;
        },$files);

        return $files;
    }
}
