@include('layout.header', ['title' => '详情', 'share' => 'editor.md/editormd.preview.min'])

<!-- content start -->
<div class="admin-content">
    <div class="admin-content-body">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑</strong> / <small>一些常用模块</small></div>
        </div>

        <hr>

        <style>
            section.main {
                width: 800px;
                margin: 0 auto;
            }
        </style>
        <section class="main">
            <header>表单标题</header>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    分类
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <p>{{ $report->classification->name }}</p>
                </div>
            </div>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    地点
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <p>{{ $report->address }}</p>
                </div>
            </div>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    描述
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <p>{{ $report->description }}</p>
                </div>
            </div>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    备注
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end"></div>
            </div>
            <div id="editormd-view" path="{{ url('static/share/editor.md/lib') }}" upload="{{ url('report/upload') }}">
                <textarea name="remark" style="display:none;">{{ $report->remark }}</textarea>
            </div>
        </section>
    </div>
    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
<!-- content end -->


<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('static/share/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('static/share/amazeui/js/amazeui.min.js') }}"></script>

<!-- <script src="js/zepto.min.js"></script>
    <script>
        var jQuery = Zepto;  // 为了避免修改flowChart.js和sequence-diagram.js的源码，所以使用Zepto.js时想支持flowChart/sequenceDiagram就得加上这一句
    </script> -->
<script src="{{ asset('static/share/jquery.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/marked.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/prettify.min.js') }}"></script>

<script src="{{ asset('static/share/editor.md/lib/raphael.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/underscore.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/sequence-diagram.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/flowchart.min.js') }}"></script>
<script src="{{ asset('static/share/editor.md/lib/jquery.flowchart.min.js') }}"></script>

<script src="{{ asset('static/share/editor.md/editormd.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var editormdView;


        editormdView = editormd.markdownToHTML("editormd-view", {
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    });
</script>
</body>
</html>