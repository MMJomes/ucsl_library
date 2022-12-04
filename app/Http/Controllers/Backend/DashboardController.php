<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Interf\DashboardRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    private DashboardRepository $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $statics = $this->repository->getStatics();

        return view('backend.dashboard.index');
    }

    public function changeLanguage(Request $request)
    {
        $data= Session::put('locale', $request->lang);
        dd($data);
        return redirect()->back();
    }
}
