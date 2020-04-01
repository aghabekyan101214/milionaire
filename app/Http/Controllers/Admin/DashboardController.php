<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    const FOLDER = "admin.dashboard"; //    Path To the View Folder

    const TITLE = "Dashboard"; //    Resource Title

    const ROUTE = "/admin/"; //    Resource Route

    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER . ".index", compact("title", "route"));
    }
}
