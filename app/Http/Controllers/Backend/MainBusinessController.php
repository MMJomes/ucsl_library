<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Interf\MainBusinesssRepository;
use App\Repositories\Backend\Interf\MemberRepository;
use Illuminate\Http\Request;
use App\Helpers\MainBusinessHelper;
use App\Http\Requests\MainBusinessRequest;
use App\Models\BizType;
use App\Models\MainBusiness;
use Carbon\Carbon;

class MainBusinessController extends Controller
{
    use MainBusinessHelper;
    private MainBusinesssRepository $mainbusinessrepository;
    private MemberRepository $memberRepository;


    public function __construct(MainBusinesssRepository   $mainbusinessrepository, MemberRepository $memberRepository)
    {
        $this->middleware('permission:mainbusiness.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mainbusiness.edit', ['only' => ['edit']]);
        $this->middleware('permission:mainbusiness.view', ['only' => ['index']]);
        $this->mainbusinessrepository = $mainbusinessrepository;
        $this->memberRepository = $memberRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->mainbusinessrepository->all();
            return $this->mainbusiness_datatable($data, $user);
        }

        $member_slug= null;
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.mainBusiness.index',compact('member_slug'));
    }

    public function mainbusinessById($slug)
    {
        // $data = $this->mainbusinessrepository->getById(1);
        // if (request()->ajax()) {
        //     $user = auth()->user();
        //     $data = MainBusiness::where('member_tbl_id', 1)->get();
        //     return $this->mainbusiness_datatable($data, $user);
        // }
        // view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        // return view('backend.mainBusiness.index','slug');

        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->mainbusinessrepository->all();
            return $this->mainbusiness_datatable($data, $user);
        }
        $member_slug= $slug;
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.mainBusiness.index',compact('member_slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $businessTypes = BizType::all();
        $contactListdata = $this->memberRepository->where('slug', $slug)->first();
        if ($contactListdata) {
            view()->share(['form' => true, 'select' => true]);
            return view('backend.mainBusiness.create', compact('contactListdata', 'businessTypes'));
        } else {
            return view('errorpage.404');
        }
    }
    public function created()
    {
        view()->share(['form' => true]);
        return view('backend.mainBusiness.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainBusinessRequest $request)
    {
        //dd($request->all());
        $member_id=$request->memberid;
        $member_slug=$this->memberRepository->getById($member_id)->slug;
        $image = $request->file('business_images');
        $upload_path = public_path() . '/upload/mainbusiness/';
        $file = $image->getClientOriginalExtension();
        $name = rand() . '.' . $file;
        $image->move($upload_path, $name);
        $mainbusiness_iamges = '/upload/mainbusiness/' . $name;

        $created_by = auth()->user()->name;
        $request->merge([
            'created_by' => $created_by,
            'updated_by' => $created_by,
            'member_tbl_id' => $member_id,
            'business_image' => $mainbusiness_iamges,
            'biz_type_tbl_id' => $request->business_type_id,
        ]);
        $this->mainbusinessrepository->create($request->all());
        return redirect()
            ->route('backend.mainbusiness.index',compact('member_slug'))
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

        $mainbusiness = $this->mainbusinessrepository->where('slug', $slug)->first();
        $member_slug=$mainbusiness->slug;
        if ($mainbusiness) {
            $businessTypes = BizType::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.mainBusiness.detail', compact('mainbusiness','businessTypes','member_slug'));
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

        $member_slug=$this->memberRepository->getById(1)->slug;
        $mainbusiness = $this->mainbusinessrepository->where('slug', $slug)->first();
        if ($mainbusiness) {
            $businessTypes = BizType::all();
            $member_slug=$mainbusiness->slug;
            view()->share(['form' => true, 'select' => true]);

            return view('backend.mainBusiness.edit', compact('mainbusiness','businessTypes','member_slug'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(MainBusinessRequest $request, $slug)
    {

        $member_id=$request->memberid;
        $member_slug=$this->memberRepository->getById($member_id)->slug;
        $mainbusiness = $this->mainbusinessrepository->where('slug', $slug)->first();
        if ($mainbusiness) {
            if ($request->file('business_images')) {
                $image = $request->file('business_images');
                $upload_path = public_path() . '/upload/mainbusiness/';
                $file = $image->getClientOriginalExtension();
                $name = rand() . '.' . $file;
                $image->move($upload_path, $name);
                $mainbusiness_iamges = '/upload/mainbusiness/' . $name;
            } else {
                $mainbusiness_iamges = $mainbusiness->business_image;
            }
            $updated_by = auth()->user()->name;
            $currentTime = Carbon::now();
            $request->merge([
                'updated_by' => $updated_by,
                'updatedat' => $currentTime,
                'business_image' => $mainbusiness_iamges,
                'biz_type_tbl_id' => $request->business_type_id,
            ]);
            $this->mainbusinessrepository->updateById($mainbusiness->id, $request->all());
            return redirect()->route('backend.mainbusiness.index',compact('member_slug'))->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {

        $mainbusiness = $this->mainbusinessrepository->where('slug', $request->slug)->first();
        if ($mainbusiness) {
            $this->mainbusinessrepository->deleteById($mainbusiness->id);
            return redirect()->route('backend.mainbusiness.index')->with('success', 'MainBusiness deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->mainbusinessrepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.mainbusiness.index')->with('success', 'MainBusiness deleted successfully');
    }
}
