<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\BizTypeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BizTypeRequest;
use Illuminate\Http\Request;
use App\Repositories\Backend\Interf\BizTypeRepository;
use Carbon\Carbon;

class BizTypeController extends Controller
{
    use BizTypeHelper;
    private BizTypeRepository $bizCategoryRepository;

    public function __construct(BizTypeRepository   $bizCategoryRepository)
    {
        $this->middleware('permission:bizcategory.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bizcategory.edit', ['only' => ['edit']]);
        $this->middleware('permission:bizcategory.view', ['only' => ['index']]);
        $this->bizCategoryRepository = $bizCategoryRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->bizCategoryRepository->all();
            return $this->biztype_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.biztype.index');
    }
    public function create()
    {

        view()->share(['form' => true]);
        return view('backend.biztype.create');
    }
    public function store(BizTypeRequest $request)
    {

        $this->bizCategoryRepository->create($request->validated());
        return redirect()
            ->route('backend.biztype.index')
            ->with(['success' => 'Successfully Added']);
    }
    public function show($biztype_slug)
    {
        $bizCategory = $this->bizCategoryRepository->where('slug', $biztype_slug)->first();
        if ($bizCategory) {

            view()->share(['form' => true]);
            return view('backend.biztype.detail', compact('bizCategory'));
        } else {
            return view('errorpage.404');
        }
    }
    public function edit($biztype_slug)
    {
        $bizCategory = $this->bizCategoryRepository->where('slug', $biztype_slug)->first();
        if ($bizCategory) {

            view()->share(['form' => true]);
            return view('backend.biztype.edit', compact('bizCategory'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(BizTypeRequest $request, $biztype_slug)
    {
        $currentTime = Carbon::now();

        $request->merge([
            'updatedat' => $currentTime,
        ]);

        $bizCategory = $this->bizCategoryRepository->where('slug', $biztype_slug)->first();
        if ($bizCategory) {

            $this->bizCategoryRepository->updateById($bizCategory->id,$request->validated());
             return redirect()->route('backend.biztype.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $bizCategory = $this->bizCategoryRepository->where('slug', $request->slug)->first();
        if ($bizCategory) {
            $this->bizCategoryRepository->deleteById($bizCategory->id);
            return redirect()->route('backend.biztype.index')->with('success', 'BizType deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->bizCategoryRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.biztype.index')->with('success', 'BizType deleted successfully');
    }

}
