<?php

namespace App\Http\Controllers;

use App\Model\Asset;
use App\Model\Detail;
use EasyWeChat\Core\Exception;
use Illuminate\Http\Request;

use Validator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $nav = null;
        $asset_id = $request->asset_id;
        $direction = $request->direction;
        $institutions = $request->institutions;

        $details = Detail::orderBy('created_at', 'desc')->with('Asset');
        if($asset_id) {
            $nav .= '<a href="' . action('DetailController@index', ['asset_id' => $asset_id]) . '">' .
                ($nav ? '/' : '') . Asset::find($asset_id)->name .
                '</a>';
            $details->where('asset_id', $asset_id);
        }
        if($direction) {
            $nav .= '<a href="' . action('DetailController@index', ['direction' => $direction]) . '">' .
                ($nav ? '/' : '') . Detail::getDirectionAttribute($direction) .
                '</a>';
            $details->where('direction', $direction);
        }
        if($institutions) {
            $nav .= '<a href="' . action('DetailController@index', ['institutions' => $institutions]) . '">' .
                ($nav ? '/' : '') . $institutions .
                '</a>';
            $details->where('institutions', $institutions);
        }

        $details = $details->get();
        return view('details.index', ['details' => $details, 'nav' => $nav, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $assets = Asset::all();
        return view('details.create', ['assets' => $assets]);
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
        /*验证开始*/
        //$data['user_id'] = Auth::user()->id;
        $rules = [
            "direction" => "required|numeric|in:1,2,3,4,5,6",
            //"name" => "物品名称",
            //"asset_id" => "numeric",
            "site" => "required",
            "quantity" => "required|numeric",
            "institutions" => "required",
            //"contact" => "联系方式",
            //"remark" => "备注",
        ];
        if(isset($data['direction'])){
            if ($data['direction'] == 1) {  //添置新设备
                $rules['name'] = "required";
            } else { //已有设备变动
                $rules['asset_id'] = "required|numeric|exists:assets,id";
            }
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return error($validator->errors()->all());
        }
        /*验证结束*/
        /*事务开始*/
        if ($data['direction'] == 1) {  //添置新设备
            DB::beginTransaction();
            try {
                $asset = Asset::create($data);//创建新设备记录，白名单设置仅会保存“name”，“quantity”字段。
                $data['asset_id'] = $asset->id;
                Detail::create($data);//添加物品变动记录
                DB::commit();
            } catch (\Exception $e) {
                BD::rollBack();
                return error($e->getMessage(), 'detail');
            }
        } else { //已有设备变动
            DB::beginTransaction();
            try {
                $detail = Detail::create($data);//创建物品表
                if ($detail->isIncrease()) { //增加总数量
                    DB::table('assets')->where('id', $detail->asset_id)->increment('quantity', $detail->quantity);
                } else {//减少总数量
                    $quantity = DB::table('assets')->where('id', $data['asset_id'])->first()->quantity;
                    if ($quantity - $detail->quantity < 0) {
                        throw new Exception('没有这么多的数量！');
                    }
                    DB::table('assets')->where('id', $detail->asset_id)->decrement('quantity', $detail->quantity);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return error($e->getMessage(), 'detail');
            }
        }
        /*事务结束*/
        return success('保存成功！', 'detail');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $detail = Asset::with('Asset')->find($id);
        return view('details.edit', ['detail' => $detail]);
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
        $detail = Detail::find($id);

        if (empty($detail)) {
            return error(trans('detail.inexistence', ['id' => $id]));
        }
        $detail->delete();
        return success('删除成功！');
    }
}
