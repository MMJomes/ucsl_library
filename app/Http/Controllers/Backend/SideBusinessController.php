<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Interf\SideBusinesssRepository;
use App\Repositories\Backend\Interf\MemberRepository;
use Illuminate\Http\Request;
use App\Helpers\SideBusinessHelper;
use App\Http\Requests\SideBusinessRequest;
use App\Models\BizType;
use Carbon\Carbon;

class SideBusinessController extends Controller
{
    use SideBusinessHelper;
    private SideBusinesssRepository $sidebusinessrepository;
    private MemberRepository $memberRepository;


    public function __construct(MemberRepository $memberRepository, SideBusinesssRepository $sidebusinessrepository)
    {
        $this->middleware('permission:sidebusiness.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sidebusiness.edit', ['only' => ['edit']]);
        $this->middleware('permission:sidebusiness.view', ['only' => ['index']]);
        $this->memberRepository = $memberRepository;
        $this->sidebusinessrepository = $sidebusinessrepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->sidebusinessrepository->all();
            return $this->sidebusiness_datatable($data, $user);
        }
        $member_slug= null;
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.sidebusiness.index',compact('member_slug'));
    }
    public function mainbusinessById($slug)
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->sidebusinessrepository->all();
            return $this->sidebusiness_datatable($data, $user);
        }

        $member_slug= $slug;
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.sidebusiness.index',compact('member_slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $contactListdata = $this->memberRepository->where('slug', $slug)->first();
        if ($contactListdata) {
            $businessTypes = BizType::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.sidebusiness.create', compact('contactListdata','businessTypes'));
        } else {
            return view('errorpage.404');
        }
    }
    public function created()
    {
        view()->share(['form' => true]);
        return view('backend.sidebusiness.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(sidebusinessRequest $request)
    {


        $member_id=$request->memberid;
        $member_slug=$this->memberRepository->getById($member_id)->slug;
        $image = $request->file('business_images');
        $upload_path = public_path() . '/upload/sidebusiness/';
        $file = $image->getClientOriginalExtension();
        $name = rand() . '.' . $file;
        $image->move($upload_path, $name);
        $sidebusiness_iamges = '/upload/sidebusiness/' . $name;

        $created_by = auth()->user()->name;
        $request->merge([
            'created_by' => $created_by,
            'updated_by' => $created_by,
            'member_tbl_id' => $member_id,
            'business_image' => $sidebusiness_iamges,
            'biz_type_tbl_id' => $request->business_type_id,
        ]);
        $this->sidebusinessrepository->create($request->all());
        return redirect()
            ->route('backend.sidebusiness.index',compact('member_slug'))
            ->with(['success' => 'Successfully Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $sidebusiness = $this->sidebusinessrepository->where('slug', $slug)->first();
        if ($sidebusiness) {

            $member_slug=$sidebusiness->slug;
            view()->share(['form' => true]);
            return view('backend.sidebusiness.detail', compact('sidebusiness','member_slug'));
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
    public function edit($slug)
    {
        $sidebusiness = $this->sidebusinessrepository->where('slug', $slug)->first();
        if ($sidebusiness) {

            $businessTypes = BizType::all();
            $member_slug=$sidebusiness->slug;
            view()->share(['form' => true,'select'=> true]);
            return view('backend.sidebusiness.edit', compact('sidebusiness','member_slug','businessTypes'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(sidebusinessRequest $request, $slug)
    {
        $sidebusiness = $this->sidebusinessrepository->where('slug', $slug)->first();
        if ($sidebusiness) {
            if ($request->file('business_images')) {
                $image = $request->file('business_images');
                $upload_path = public_path() . '/upload/mainbusiness/';
                $file = $image->getClientOriginalExtension();
                $name = rand() . '.' . $file;
                $image->move($upload_path, $name);
                $mainbusiness_iamges = '/upload/mainbusiness/' . $name;
            } else {
                $mainbusiness_iamges = $sidebusiness->business_image;
            }
            $created_by = auth()->user()->name;
            $currentTime = Carbon::now();
            $request->merge([

                'updated_by' => $created_by,
                'updatedat' => $currentTime,
                'business_image' => $mainbusiness_iamges,
            ]);
            $this->sidebusinessrepository->updateById($sidebusiness->id, $request->all());
            return redirect()->route('backend.sidebusiness.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $sidebusiness = $this->sidebusinessrepository->where('slug', $request->slug)->first();
        if ($sidebusiness) {
            $this->sidebusinessrepository->deleteById($sidebusiness->id);
            return redirect()->route('backend.sidebusiness.index')->with('success', 'sidebusiness deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->sidebusinessrepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.sidebusiness.index')->with('success', 'sidebusiness deleted successfully');
    }
}
