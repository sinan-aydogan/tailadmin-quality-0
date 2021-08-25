<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getDepartments(){
        $content = Department::with('manager:id,name')->get(['name','manager_id']);
        return response()->json($content);
    }
}
