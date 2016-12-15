@include('layout.header', ['title' => '登录', 'css' => 'reports/index'])

<!-- content start -->
<div class="report-content">
    <div class="report-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small></div>
        </div>

        <hr>

        <div class="am-g am-padding-vertical">
            <div class="am-u-sm-12 am-u-md-4">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-sm">
                        <a href="{{ url('report/create') }}" class="am-btn am-btn-sm am-btn-primary"><span class="am-icon-plus"></span> 新增</a>
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

        <div class="am-modal" tabindex="-1" id="select-modal">
            <div class="am-modal-dialog">
                <div class="am-modal-hd am-badge-secondary">
                    添加筛选条件
                    <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                </div>
                <div class="am-modal-bd">
                    <form id="report-filter-form" class="am-form am-form-inline">
                        <div class="am-g am-padding-vertical-sm">
                            <div class="am-form-group">
                                <div class="am-hide-sm-only am-u-md-6">
                                    <label for="report-start-time" class="am-hide-sm-only">请选择起始时间：</label>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6">
                                    <div class="am-input-group am-input-group-primary" style="margin: 0 auto">
                                        <input type="text" name="start_time" id="report-start-time" class="am-form-field" placeholder="起始时间" data-am-datepicker readonly required value="{{ $filter['start_time'] }}">
                                        <span id="report-start-clear" class="am-input-group-btn am-hide"><button class="am-btn am-btn-xs am-btn-default" type="button"><span class="am-icon-search"></span></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="am-g am-padding-vertical-sm">
                            <div class="am-form-group">
                                <div class="am-hide-sm-only am-u-md-6">
                                    <label for="report-end-time" class="am-hide-sm-only">请选择结束时间：</label>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6">
                                    <div class="am-input-group am-input-group-primary">
                                        <input type="text" name="end_time" id="report-end-time" class="am-form-field" placeholder="结束时间" data-am-datepicker readonly required value="{{ $filter['end_time'] }}">
                                        <span id="report-end-clear" class="am-input-group-btn am-hide"><button class="am-btn am-btn-xs am-btn-default" type="button"><span class="am-icon-search"></span></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="am-g am-padding-vertical-sm">
                            <div class="am-form-group">
                                <div class="am-hide-sm-only am-u-md-6">
                                    <label for="report-select-class" class="am-hide-sm-only">请选择查询的分类：</label>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6">
                                    <select name="classification_id[]" multiple id="report-select-class" data-am-selected="{searchBox: 1}" report-placeholder="所有分类">
                                        @foreach($classifications as $classification)
                                            <option value="{{ $classification->id }}"{{ in_array($classification->id, $filter['classifications_id']) ? ' selected' : ''}}>{{ $classification->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="am-g am-padding-vertical-sm">
                            <div class="am-form-group">
                                <div class="am-hide-sm-only am-u-md-6">
                                    <label for="report-select-user" class="am-hide-sm-only">请选择查询的人员：</label>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6">
                                    <select name="user_id[]" multiple id="report-select-user" data-am-selected="{searchBox: 1}" report-placeholder="所有人员">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"{{ in_array($user->id, $filter['users_id']) ? ' selected' : ''}}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="am-modal-footer">
                    <a class="am-modal-btn" data-am-modal-cancel>取消</a>
                    <a type="submit" class="am-modal-btn" id="report-filter-btn" data-am-modal-confirm>确定</a>
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
                    <table class="am-table am-table-hover table-main">
                        <thead>
                        <tr class="am-primary">
                            <th class="am-hide-sm-only">序号</th>
                            <th>分类</th>
                            <th>地点</th>
                            <th>当事人</th>
                            <th class="am-hide-sm-only">时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td class="am-hide-sm-only">{{ $report->id }}</td>
                                <td>{{ $report->Classification->name }}</td>
                                <td>{{ $report->address }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td class="am-hide-sm-only">{{ $report->created_at }}</td>
                                <td>
                                    <div class="am-dropdown am-dropdown-flip am-show-sm-only" data-am-dropdown="{justify: '#operation'}">
                                        <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" id="operation" data-am-dropdown-toggle=""><span class="am-icon-cog"></span> 操作 <span class="am-icon-caret-down"></span></button>
                                        <ul class="am-dropdown-content">
                                            <li class="am-warning"><a href="javascript:void(0);" class="report-delete" delete-uri="{{ url('report/' . $report->id) }}">删除</a></li>
                                            <li class="am-default"><a href="{{ url('report/'. $report->id .'/edit') }}">编辑</a></li>
                                            <li class="am-secondary"><a href="{{ url('report/'. $report->id) }}">详情</a></li>
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar am-hide-sm-only">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-xs am-btn-warning report-delete" href="javascript:void(0);" delete-uri="{{ url('report/' . $report->id) }}">删除</a>
                                            <a class="am-btn am-btn-xs am-btn-default" href="{{ url('report/'. $report->id .'/edit') }}">编辑</a>
                                            <a class="am-btn am-btn-xs am-btn-secondary" href="{{ url('report/'. $report->id) }}">详情</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="am-cf">
                        <div class="am-fr">

                            {!! $reports->render() !!}

                        </div>
                        <p>共5页/15条</p>
                    </div>
                    <hr />
                    <p>注：.....</p>
            </div>
        </div>
    </div>

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
<!-- content end -->

@include('layout.footer', ['js' => 'reports/index'])