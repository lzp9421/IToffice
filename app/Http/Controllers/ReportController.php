<?php

namespace App\Http\Controllers;

use App\Model\Classification;
use App\Model\Report;
use App\Model\User;
use Faker\Provider\Uuid;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $classifications_id = (array)$request->classification_id;
        $users_id = (array)$request->user_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $errors = null;

        if (strtotime($start_time) > strtotime($end_time)) {
            $errors = '开始时间不能在结束时间之后！';
        }

        $reports = new Report();
        empty((array)$request->classification_id) || $reports = $reports->whereIn('classification_id', $classifications_id);
        empty((array)$request->user_id) || $reports = $reports->whereIn('user_id', $users_id);
        empty($start_time) || empty($end_time) || $reports = $reports->whereBetween('created_at', [$request->start_time, $request->end_time]);
        $reports = $reports->paginate(10);
        $classifications = Classification::all('id', 'name');
        $users = User::all('id', 'name');

        $filter = [
            'classifications_id' => $classifications_id,
            'users_id' => $users_id,
            'start_time' => $start_time,
            'end_time' => $end_time
        ];

        return view('reports.index', [
            'reports' => $reports,
            'classifications' => $classifications,
            'users' => $users,
            'filter' => $filter
        ])->withErrors($errors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classifications = Classification::all();

        return view('reports.create', ['classifications' => $classifications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $validator = Validator::make($data, [
            'classification_id' => 'required|numeric',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->all());
        }
        $report = Report::create($data);
        if ($report) {
            return success('保存成功！', 'report');
        }
        return error('保存失败！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $report = Report::find($id);
        if (empty($report)) {
            return error(trans('report.inexistence', ['id' => $id]));
        }
        return view('reports.show', ['report' => $report]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);

        return view('reports.edit', ['report' => $report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'classification_id' => 'required|numeric',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return error($validator->errors()->all());
        }

        $report = Report::find($id);
        if ($report) {
            return success('保存成功！', 'report');
        }
        return error('保存失败！');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $report = Report::find($id);

        if (empty($report)) {
            return error(trans('report.inexistence', ['id' => $id]));
        }
        $report->delete();
        return success('删除成功！');
    }

    public function upload(Request $request){

        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('editormd-image-file')){
            return response()->json(['success' => 0, 'message' => '上传文件为空！']);
        }
        $file = $request->file('editormd-image-file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            return response()->json(['success' => 0, 'message' => '文件上传出错！']);
        }
        $path = public_path('data/images/').date('Y/m/d');
        if(!file_exists($path))
            mkdir($path, 0755, true);
        $filename = Uuid::uuid() . '.' . $file->getClientOriginalExtension();
        if(!$file->move($path, $filename)){
            return response()->json(['success' => 0, 'message' => '保存文件失败！']);
        }
        return response()->json(['success' => 1, 'message' => '文件上传成功！', 'url' => asset('data/images/' . $filename)]);
    }
}
