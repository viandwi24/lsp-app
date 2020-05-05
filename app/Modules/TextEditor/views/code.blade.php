<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ (isset($title)) ? $title : 'Text Editor' }}</h4>
    </div>
    <form action="{{ $formAction }}" method="{{ $formMethod }}">
        @csrf
        <div class="card-body p-0">
            <div class="input-group">
                <input value="{{ $filename }}" type="text" readonly id="filename" class="form-control" placeholder="File Save" style="border-radius: 0;">
                <div class="input-group-append">
                    <select id="select" class="form-control form-control-sm">
                        <option>3024-day</option>
                        <option>3024-night</option>
                        <option>abcdef</option>
                        <option>ambiance</option>
                        <option>base16-dark</option>
                        <option>base16-light</option>
                        <option>bespin</option>
                        <option>blackboard</option>
                        <option>cobalt</option>
                        <option>colorforth</option>
                        <option>dracula</option>
                        <option>eclipse</option>
                        <option>elegant</option>
                        <option>erlang-dark</option>
                        <option>hopscotch</option>
                        <option>icecoder</option>
                        <option>isotope</option>
                        <option>lesser-dark</option>
                        <option>liquibyte</option>
                        <option>material</option>
                        <option>mbo</option>
                        <option>mdn-like</option>
                        <option>midnight</option>
                        <option>monokai</option>
                        <option>neat</option>
                        <option>neo</option>
                        <option>night</option>
                        <option>paraiso-dark</option>
                        <option>paraiso-light</option>
                        <option>pastel-on-dark</option>
                        <option>railscasts</option>
                        <option>rubyblue</option>
                        <option>seti</option>
                        <option>solarized dark</option>
                        <option>solarized light</option>
                        <option>the-matrix</option>
                        <option>tomorrow-night-bright</option>
                        <option>tomorrow-night-eighties</option>
                        <option>ttcn</option>
                        <option>twilight</option>
                        <option>vibrant-ink</option>
                        <option>xq-dark</option>
                        <option>xq-light</option>
                        <option>yeti</option>
                        <option>zenburn</option>
                    </select>
                    <button type="submit" class="btn btn-block btn-success" style="border-radius: 0;">Simpan</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="form-group p-0 m-0">
                <textarea id="codemirror-theme" name="code" rows="5">{{ (isset($code)) ? $code : '' }}</textarea>
            </div>
        </div>
    </form>
    <div class="card-footer"><b>Language Mode : </b> <span id="modeinfo"></span></div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/editors/codemirror.css') }}">
    <link rel="stylesheet" type="text/css" title="theme" href="{{ assets('vendors/css/editors/theme/3024-day.css') }}">
@endpush

@push('js')    
    <script src="{{ assets('vendors/js/editors/codemirror/lib/codemirror.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/xml/xml.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/css/css.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/meta.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/javascript/javascript.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/php/php.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/htmlmixed/htmlmixed.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/mode/markdown/markdown.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/search/searchcursor.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/search/search.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/dialog/dialog.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/display/rulers.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/edit/matchbrackets.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/edit/closebrackets.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/comment/comment.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/wrap/hardwrap.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/foldcode.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/foldgutter.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/brace-fold.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/xml-fold.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/markdown-fold.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/fold/comment-fold.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/mode/loadmode.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/mode/simple.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/scroll/annotatescrollbar.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/search/matchesonscrollbar.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/search/searchcursor.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/search/match-highlighter.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/selection/mark-selection.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/selection/active-line.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/addon/edit/matchbrackets.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/editors/codemirror/keymap/sublime.js') }}" type="text/javascript"></script>
@endpush

@push('js')
    <script>
	var input = document.getElementById("select");
	var theme = input.options[input.selectedIndex].textContent;
	code = document.getElementById("codemirror-theme");
	var editor1 = CodeMirror.fromTextArea(code, {
		lineNumbers: true,
		styleActiveLine: true,
		matchBrackets: true,
	});
	$('#select').change(function () {
		var selectedTheme = $(':selected').val();
		var stylesheet = $('[title="theme"]');
		stylesheet.attr('href',"{{ assets('vendors/css/editors/theme/') . '/' }}"+selectedTheme.toLowerCase()+ ".css");
		editor1.setOption("theme", selectedTheme);
        localStorage.setItem('texteditor_theme', selectedTheme.toLowerCase())
	});
	function selectTheme(theme = null) {
		var theme = (theme == null) ? input.options[input.selectedIndex].textContent : theme;
		var stylesheet = $('[title="theme"]');
		stylesheet.attr('href',"{{ assets('vendors/css/editors/theme/') . '/' }}"+theme+ ".css");
		editor1.setOption("theme", theme);
        $('#select').val(theme).trigger('change')
        return theme
	}
	var choice = (location.hash && location.hash.slice(1)) ||
				(document.location.search &&
					decodeURIComponent(document.location.search.slice(1)));
	if (choice) {
		input.value = choice;
		editor1.setOption("theme", choice);
	}
	CodeMirror.on(window, "hashchange", function() {
		var theme = location.hash.slice(1);
		if (theme) { input.value = theme; selectTheme(); }
	});

	$('#filename').on('change', detectLangMode);

    function detectLangMode(){
		var val = $('#filename').val(), m, mode, spec;
		if(m = /.+\.([^.]+)$/.exec(val)){
			var info = CodeMirror.findModeByExtension(m[1]);
			if (info) {
				mode = info.mode;
				spec = info.mime;
			}
		} else if (/\//.test(val)) {
			var info = CodeMirror.findModeByMIME(val);
			if (info) {
				mode = info.mode;
				spec = val;
			}
		} else {
			mode = spec = val;
		}
		if (mode) {
			editor1.setOption("mode", spec);
			CodeMirror.autoLoadMode(editor1, mode);
			$('#modeinfo').html(spec)
		} else {
			alert("Could not find a mode corresponding to " + val);
		}
	}

    selectTheme((localStorage.getItem('texteditor_theme') == null) ? '3024-day' : localStorage.getItem('texteditor_theme'))
    detectLangMode()

    </script>
@endpush