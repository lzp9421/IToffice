@include('layout.header', ['title' => '登录', 'css' => 'reports/index'])

<!-- content start -->
<div class="report-content">
    <div class="report-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">物品清单</strong> / <small>一些常用模块</small></div>
        </div>

        <hr>

        <div class="am-g am-padding-vertical">
            <table class="am-table am-table-bordered">
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>数量</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                @foreach($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->quantity }}</td>
                        <td>{{ $asset->description }}</td>
                        <td>{{ $asset->status }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
<!-- content end -->

@include('layout.footer', ['js' => 'reports/index'])