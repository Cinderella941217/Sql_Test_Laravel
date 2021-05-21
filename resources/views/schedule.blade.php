<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SQL Test</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <h3 class="text-center">Scheduled Report For {{ $email }}</h3>
            <div class='row'>
                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+ ADD NEW</button>
                <a href="/" class="btn btn-primary">Back</a>
            </div>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Email Address</td>
                        <td>Email Subject</td>
                        <td>Query</td>
                        <td>Time to report</td>
                        <td>Reoccurring</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($schedules))
                        @foreach($schedules as $key => $schedule)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $schedule->email }}</td>
                                <td>{{ $schedule->subject }}</td>
                                <td>{{strlen($schedule->query) > 30 ? (substr($schedule->query, 0, 27) . "...") : $schedule->query }}</td>
                                <td>{{ $schedule->time }}</td>
                                <td>
                                    @switch($schedule->reoccurring)
                                        @case(1)
                                            Once
                                            @break
                                        @case(2)
                                            Every Day
                                            @break
                                        @case(2)
                                            Every Week
                                            @break
                                        @case(2)
                                            Every Month
                                            @break
                                        @default
                                    @endswitch
                                </td>
                                <td><a href="/deleteSchedule/{{$schedule->id}}" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-danger">Table is Empty.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/addNewSche" method="post">
                    <input type="hidden" name="email" value="{{$email}}">
                    <input type="hidden" name="queryId">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="email-subject" class="col-form-label">Email Subject:</label>
                            <input type="text" class="form-control" name="subject" id="email-subject">
                        </div>
                        <div class="form-group">
                            <label for="department" class="col-form-label">Department:</label>
                            <select class="form-control" name="department" id="department">
                                <option value="-1">------Select Department------</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="query" class="col-form-label">Query:</label>
                            <select class="form-control" name="query" id="query">
                            </select>
                        </div>
                        <div id="promptWrap">

                        </div>
                        <div class="form-group">
                            <label for="time" class="col-form-label">Time:</label>
                            <input id="time" type="text" name="time" class="form-control" placeholder="2020-01-01 15:30:00">
                        </div>
                        <div class="form-group">
                            <label for="reoccurring" class="col-form-label">Reoccurring:</label>
                            <select class="form-control" name="reoccurring" id="reoccurring">
                                <option value="1">Once</option>
                                <option value="2">Every Day</option>
                                <option value="3">Every Week</option>
                                <option value="4">Every Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src={{asset("/js/bootstrap-typehead.js")}}></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script>
        var days = [31,28,31,30,31,30,31,31,30,31,30,31];
        $('document').ready(function(){
            var queries = [];
            var promArray;
            var dateHead = ['Yesterday', 'Last Week', 'Last Month'];
            $('#department').on('change', function(){
                if($(this).val() != '-1'){
                    $.ajax({
                        url:"/getQuery",
                        type: 'post',
                        data:{
                            id: $(this).val()
                        },
                        success: function(res){
                            queries = res;
                            var html = '<option value="-1">------Select Query------</option>';
                            res.forEach((ele, idx) => {
                                var exQuery = ele.query.length > 60 ? ele.query.substr(0, 30) + '.....' : ele.query;
                                html += '<option value="' + idx + '">' + exQuery + '</option>';
                            });
                            $('#query').html(html);
                        }
                    });
                } else {
                    $('#query').html('');
                    $('#promptWrap').html('');
                }
            });
            $('#query').on('change', function(){
                $('input[name="queryId"]').val(queries[$(this).val() * 1].id);
                var query = queries[$(this).val() * 1].query;
                var promptNames = query.match(/(@\w+)/g).filter(onlyUnique);
                var html = '';
                promptNames.forEach(ele => {
                    html += '<div="form-group">';
                    html += '<label for="' + ele + '">' + ele + '</label>';
                    html += '<input type="text" name="values[]" id="' + ele + '" class="form-control promptInput">';
                    html += '<input type="hidden" name="keys[]" value="' + ele + '">';
                    html += '</div>';
                });
                $('#promptWrap').html(html);
                $('.promptInput').typeahead({
                    source: dateHead
                });
                $('.promptInput').change(function(){
                    switch($(this).val()){
                        case 'Yesterday':
                            $(this).val(getYesterday());
                            break;
                        case 'Last Week':
                            $(this).val(getLastWeek());
                            break;
                        case 'Last Month':
                            $(this).val(getLastMonth());
                            break;
                    }
                });
            });
        });
        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }
        function checkDateFormat(dateVal){
            return dateVal < 10 ? '0' + dateVal : '' + dateVal;
        }
        function getYesterday(){
            var nowDate = new Date();
            console.log(nowDate.getDate());
            if (nowDate.getDate() == 1) {
                return nowDate.getFullYear() + '-' + checkDateFormat(nowDate.getMonth()) + '-' + days[nowDate.getMonth()] + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());
            } else {
                return nowDate.getFullYear() + '-' + checkDateFormat(nowDate.getMonth() + 1) + '-' + checkDateFormat(nowDate.getDate() - 1) + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());
            }
        }
        function getLastWeek(){
            var nowDate = new Date();
            if (nowDate.getDate() - 7 < 0){
                return nowDate.getFullYear() + '-' + checkDateFormat(nowDate.getMonth()) + '-' + days[nowDate.getMonth()] + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());

            } else {
                return nowDate.getFullYear() + '-' + checkDateFormat(nowDate.getMonth() + 1) + '-' + checkDateFormat(nowDate.getDate() - 7) + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());
            }
        }
        function getLastMonth(){
            var nowDate = new Date();
            if(nowDate.getMonth == 1){
                return (nowDate.getFullYear() - 1) + '-12-' + checkDateFormat(nowDate.getDate() - 7) + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());
            } else {
                return nowDate.getFullYear() + '-' + checkDateFormat(nowDate.getMonth()) + '-' + checkDateFormat(nowDate.getDate() - 7) + ' ' + checkDateFormat(nowDate.getHours()) + ':' + checkDateFormat(nowDate.getMinutes()) + ':' + checkDateFormat(nowDate.getSeconds());
            }
        }
        </script>
</html>
