<?php

namespace App\Http\Controllers;

use App\Models\Callgroups;
use Illuminate\Http\Request;

class CallgroupsController extends Controller
{
    
    /**
     * show the list of the Callgroups
     *
     * @return void
     */
    public function show()
    {
        $callGroups = Callgroups::all();
        return view('callgroups.show', ['callGroups'=>$callGroups]);
    }
}
