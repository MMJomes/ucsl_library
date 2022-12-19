<?php

namespace App\Http\Controllers\Backend;

use App\Models\Books;
use App\Models\Stduent\PreRequest;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\Teacher;
use App\Models\Teacher\Teacherrent;
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

        //dd($totalbooks);
        $statics = $this->repository->getStatics();
        //$totalbook=Books::all()->count();
        $totalbookskind=Books::sum('totalbook');
        $totalbook=(int)$totalbookskind;

        $staff=Teacher::all();
        $staffTotal =$staff->count();
        $staffActiveTotal=$staff->where('status',ON)->count();
        $staffInActiveTotal=$staff->where('status',OFF)->count();

         $staffRent= Teacherrent::where('rentstatus',ON)->get();
         $TotalstaffRent= count($staffRent);

         $TotalstdRents= PreRequest::where('status',ON)->get();
         $TotalstdRent= count($TotalstdRents);


        $std=Stduent::all();
        $stdTotal = $std->count();
        $stdActiveTotal=$std->where('status',ON)->count();
        $stdInActiveTotal=$std->where('status',OFF)->count();

        return view('backend.dashboard.index',compact('TotalstdRent','TotalstaffRent','totalbook','staffTotal','staffActiveTotal','staffInActiveTotal','stdTotal','stdActiveTotal','stdInActiveTotal'));
    }

    public function changeLanguage(Request $request)
    {
        $data= Session::put('locale', $request->lang);
        return redirect()->back();
    }
}
