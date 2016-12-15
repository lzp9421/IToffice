
<script src="{{ asset('static/share/jquery.min.js') }}"></script>
<script src="{{ asset('static/share/amazeui/js/amazeui.min.js') }}"></script>
@if(isset($share))
    @foreach((array)$share as $file)
        <script src="{{ asset('static/share/' . str_replace(['/', '\\'], '/js/', $file) . '.js') }}"></script>
    @endforeach
@endif
@if(isset($js))
    @foreach((array)$js as $file)
        <script src="{{ asset('static/js/' . str_replace('\\', '/', $file) . '.js') }}"></script>
    @endforeach
@endif
</body>
</html>