<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ExportMemberList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MemberHelper;
use App\Http\Requests\MemberRequest;
use App\Imports\ContactListImport;
use App\Repositories\Backend\Interf\ContactListRepository;
use App\Repositories\Backend\Interf\MemberRepository;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    use MemberHelper;
    private ContactListRepository $contactListRepository;
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository, ContactListRepository $contactListRepository)
    {
        $this->middleware('permission:bizcategory.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bizcategory.edit', ['only' => ['edit']]);
        $this->middleware('permission:bizcategory.view', ['only' => ['index']]);
        $this->memberRepository = $memberRepository;
        $this->contactListRepository = $contactListRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->memberRepository->all();
            return $this->member_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.memberLists.index');
    }

    public function create()
    {

        view()->share(['form' => true]);
        return view('backend.memberLists.create');
    }
    public function store(MemberRequest $request)
    {
        $this->contactListRepository->create($request);
        return redirect()
            ->route('backend.memberLists.index')
            ->with(['success' => 'Successfully Added']);
    }
    public function show($member_slug)
    {

        $contactListdata = $this->memberRepository->where('slug', $member_slug)->first();
        if ($contactListdata) {

            view()->share(['form' => true]);
            return view('backend.memberLists.detail', compact('contactListdata'));
        } else {
            return view('errorpage.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($member_slug)
    {
        $contactListdata = $this->memberRepository->where('slug', $member_slug)->first();
        if ($contactListdata) {

            view()->share(['form' => true]);
            return view('backend.memberLists.edit', compact('contactListdata'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(MemberRequest $request, $member_slug)
    {
        $contactListdata = $this->memberRepository->where('slug', $member_slug)->first();
        if ($contactListdata) {

            if ($request->password) {

                $password = $request->password;
            } else {
                $password = $contactListdata->password;
            }
            $request->merge([
                'password' => $password,
            ]);
            $data = $contactListdata->update($request->all());
            return redirect()->route('backend.memberLists.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $contactListdata = $this->memberRepository->where('slug', $request->slug)->first();
        if ($contactListdata) {
            $this->memberRepository->deleteById($contactListdata->id);
            return redirect()->route('backend.memberLists.index')->with('success', 'Member deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('backend.memberLists.mulitiple_create');
    }
    public function template()
    {
        $file = public_path() . "/yue_emba_contact_list_template.xlsx";

        if (file_exists($file)) {
            return Response
                ::download($file, 'yue_emba_contact_list_template.xlsx');
        } else {
            return 'file not found';
        }
    }

    public function importData(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        try {
            Excel::import(new ContactListImport, $request->import_file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->withErrors($failures);
        }
        return redirect()->route('backend.memberLists.index')->with(['success' => 'Successfully Upload!']);
    }

    public function mass_destroy(Request $request)
    {
        $this->memberRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.memberLists.index')->with('success', 'Member deleted successfully');
    }

    public function approve(Request $request)
    {
        $contactListdata = $this->memberRepository->where('slug', $request->slug)->first();
        if ($contactListdata) {
            if ($contactListdata->status == ON) {
                $contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->update(['status' => ON]);
            }
            return redirect()->route('backend.memberLists.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }

    public function mass_approve(Request $request)
    {
        $this->memberRepository->massUpdate($request->ids, ['status' => ON]);
        return redirect()->route('backend.memberLists.index')->with('success', 'Members Approved successfully');
    }

    public function excelexport()
    {
        return Excel::download(new ExportMemberList(), 'member_List.xlsx');
    }
}
