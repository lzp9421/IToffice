@include('layout.header', ['title' => '添加'])

<!-- content start -->
<div class="admin-content">
    <div class="admin-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加记录</strong> / <small>一些常用模块</small></div>
        </div>

        <hr>

        <form action="{{ url('detail') }}"  method="POST" class="am-form am-form-horizontal">
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
                <div class="am-g">
                    <div class="am-u-md-6 am-u-sm-centered">
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="direction">请选择动向</label>
                            <div class="am-u-md-9" id="direction">
                                <h3 class="am-show-sm-only">请选择动向</h3>
                                <div class="am-btn-group am-btn-group-xs" data-am-button>
                                    <!-- 1新增|2增加|3归还||4借出|5使用|6报废 -->
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="1" title="新增" data-am-ucheck{{ old('direction') == 1 ? ' checked' : '' }}><em class="am-icon-plus"></em>
                                    </label>
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="2" title="增加" data-am-ucheck{{ old('direction') == 2 ? ' checked' : '' }}><em class="am-icon-plus-square"></em>
                                    </label>
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="5" title="领用" data-am-ucheck{{ old('direction') == 5 ? ' checked' : '' }}><em class="am-icon-puzzle-piece"></em>
                                    </label>
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="2" title="借出" data-am-ucheck{{ old('direction') == 4 ? ' checked' : '' }}><em class="am-icon-sign-out"></em>
                                    </label>
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="4" title="归还" data-am-ucheck{{ old('direction') == 3 ? ' checked' : '' }}><em class="am-icon-sign-in"></em>
                                    </label>
                                    <label class="am-btn am-btn-secondary">
                                        <input type="radio" name="direction" value="6" title="报废" data-am-ucheck{{ old('direction') == 6 ? ' checked' : '' }}><em class="am-icon-recycle"></em>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group am-hide" id="details-name">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="name">物品名称</label>
                            <div class="am-u-md-9">
                                <input name="name" id="name" type="text" class="am-form-field am-u-sm-10" value="{{ old('name') }}" placeholder="添加物品名称">
                            </div>
                        </div>
                        <div class="am-form-group am-hide" id="details-asset-id">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="asset_id">物品名称</label>
                            <div class="am-u-md-9">
                                <select name="asset_id" id="asset_id" class="am-form-field am-u-sm-10" placeholder="选择物品名称" data-am-selected="{btnWidth: '100%', searchBox: 1}">
                                    <option value="" selected></option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->id }}"{{ old('asset_id') == $asset->id ? 'selected' : '' }}>{{ $asset->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="site">来源或去向</label>
                            <div class="am-u-md-9">
                                <input name="site" id="site" type="text" class="am-form-field am-u-sm-10" value="{{ old('site') }}" placeholder="来源或去向">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="quantity">数量</label>
                            <div class="am-u-md-9">
                                <input name="quantity" id="quantity" type="text" class="am-form-field am-u-sm-10" value="{{ old('quantity') }}" placeholder="数量">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="institutions">当事人</label>
                            <div class="am-u-md-9">
                                <input name="institutions" id="institutions" type="text" class="am-form-field am-u-sm-10" value="{{ old('institutions') }}" placeholder="相关单位或人员">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="contact">联系方式</label>
                            <div class="am-u-md-9">
                                <input name="contact" id="contact" type="text" class="am-form-field am-u-sm-10" value="{{ old('contact') }}" placeholder="联系方式">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-md-3 am-form-label am-hide-sm-only" for="remark">备注</label>
                            <div class="am-u-md-9">
                                <input name="remark" id="remark" type="text" class="am-form-field am-u-sm-10" value="{{ old('remark') }}" placeholder="备注">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-md-9 am-align-right">
                                <button class="am-btn am-btn-block">提交</button>
                            </div>
                        </div>
                    </div>
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

@include('layout.footer', ['js' => 'details/create'])