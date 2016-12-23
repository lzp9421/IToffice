@include('layout.header', ['title' => '编辑', 'share' => 'editor.md/editormd.min'])

<!-- content start -->
<div class="admin-content">
    <div class="admin-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑</strong> / <small>一些常用模块</small></div>
        </div>

        <hr>

        <form action="{{ url('report/' . $report->id) }}"  method="POST" class="am-form am-form-inline">
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
            <fieldset>
                <legend>表单标题</legend>
                <input type="hidden" name="_method" value="PUT">
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        分类
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <select name="classification_id">
                            @foreach($report->Classification->all() as $classification)
                                <option value="{{ $classification->id }}"{{ $classification->id == (old('classification_id') ?: $report->classification_id) ? ' selected' : ''}}>{{ $classification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        地点
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input name="address" type="text" class="am-form-field" value="{{ old('address') ?: $report->address }}">
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        描述
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <textarea name="description">{{ old('description') ?: $report->description }}</textarea>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        备注
                    </div>
                    <div id="editormd" path="{{ url('static/share/editor.md/lib') }}" upload="{{ url('report/upload') }}">
                        <textarea name="remark" style="display:none;">{{ old('remark') ?: $report->remark }}</textarea>
                    </div>
                </div>
                <div class="am-margin">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                </div>

            </fieldset>
        </form>
    </div>
    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
<!-- content end -->

@include('layout.footer', ['js' => 'reports/create', 'share' => 'editor.md/editormd'])