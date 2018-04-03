<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\DL\Manager;

class SimplyUpdateMessageController extends Controller
{

    public function __construct()
    {
        
    }

    public function handle(Request $request, $type)
    {
        $type = str_replace('-', '_', $type);
        if(!method_exists($this, $type)) return '';
        return $this->$type($request);
    }

    protected function manager_addManager(Request $request)
    {

        $id = $request->input('id');
        $manager = Manager::find($id);
        $fills = [
            'USERNAME' => $request->input('userName'),
            'PASSWORD' => $request->input('password'),
            'PRIVILEGES' => $request->input('pri'),
            'TELEPHONE' => $request->input('tel'),
        ];
        if(empty($manager)) {
            $manager = Manager::create($fills);
        } else {
            $manager->fill($fills);
            $manager->save();
        }
        
        return 'null';
    }
}
