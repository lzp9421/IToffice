@include('layout.header', ['title' => '出入库记录', 'css' => 'reports/index'])

<!-- content start -->
<div class="details-content">
    <div class="details-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><a href="{{ url('detail') }}">出入库记录</a></strong> / {!! $nav or '<small>全部</small>' !!}</div>
        </div>

        <hr>

        <div class="am-g am-padding-vertical">
            <div class="am-u-sm-12 am-u-md-4">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-sm">
                        <a href="{{ url('detail/create') }}" class="am-btn am-btn-sm am-btn-primary"><span class="am-icon-plus"></span> 新增</a>
                        <a href="javascript:void(0);" class="am-btn am-btn-sm am-btn-default" data-am-modal="{target: '#select-modal', closeViaDimmer: 0}"><span class="am-icon-plus"></span> 筛选</a>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" class="am-form-field">
                    <span class="am-input-group-btn"><button class="am-btn am-btn-default" type="button">搜索</button></span>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="am-g am-padding">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div class="am-alert am-alert-danger" data-am-alert>
                            <button type="button" class="am-close">&times;</button>
                            <p>{{ $error }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-g am-padding-vertical">
                    <table class="am-table am-table-hover table-main">
                        <tr class="am-primary">
                            <th class="am-hide-sm-only">序号</th>
                            <th>名称</th>
                            <th>动向</th>
                            <th class="am-hide-sm-only">来源或去向</th>
                            <th>数量</th>
                            <th>当事人</th>
                            <th class="am-hide-sm-only">联系方式</th>
                            <th class="am-hide-sm-only">备注</th>
                            <th class="am-hide-sm-only">时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($details as $detail)
                            <tr>
                                <td class="am-hide-sm-only">{{ $detail->id }}</td>
                                <td><a href="{{ url_append($request, $params = ['asset_id' => $detail->Asset->id]) }}">{{ $detail->Asset->name }}</a></td>
                                <td><a href="{{ url_append($request, $params = ['direction' => $detail->getOriginal('direction')]) }}">{{ $detail->direction }}</a></td>
                                <td class="am-hide-sm-only">{{ $detail->isIncrease() ? $detail->site . '-->办公室' : '办公室-->' . $detail->site }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td><a href="{{ url_append($request, $params = ['institutions' => $detail->getOriginal('institutions')]) }}">{{ $detail->institutions }}</a></td>
                                <td class="am-hide-sm-only">{{ $detail->contact }}</td>
                                <td class="am-hide-sm-only">{{ $detail->remark }}</td>
                                <td class="am-hide-sm-only">{{ $detail->created_at }}</td>
                                <td>
                                    <div class="am-dropdown am-dropdown-flip am-show-sm-only" data-am-dropdown="{justify: '#operation'}">
                                        <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" id="operation" data-am-dropdown-toggle=""><span class="am-icon-cog"></span> 操作 <span class="am-icon-caret-down"></span></button>
                                        <ul class="am-dropdown-content">
                                            <li class="am-warning"><a href="javascript:void(0);" class="detail-delete" delete-uri="{{ url('detail/' . $detail->id) }}">删除</a></li>
                                            <li class="am-default"><a href="{{ url('detail/'. $detail->id .'/edit') }}">编辑</a></li>
                                            <li class="am-secondary"><a href="{{ url('detail/'. $detail->id) }}">详情</a></li>
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar am-hide-sm-only">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-xs am-btn-warning detail-delete" href="javascript:void(0);" delete-uri="{{ url('detail/' . $detail->id) }}">删除</a>
                                            <a class="am-btn am-btn-xs am-btn-default" href="{{ url('detail/'. $detail->id .'/edit') }}">编辑</a>
                                            <a class="am-btn am-btn-xs am-btn-secondary" href="{{ url('detail/'. $detail->id) }}">详情</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
<!-- content end -->

@include('layout.footer', ['js' => 'details/index'])