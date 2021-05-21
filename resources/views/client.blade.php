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
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            select[name="DataTables_Table_0_length"]{
                padding: 0 0 0.5rem 0.75rem;
            }
            tr{
                background-color: transparent !important;
            }
            .loading-icon{
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: #1c273a;
                display: none;
            }
            .loading-icon img{
                margin: 100px auto;
            }
        </style>
    </head>
    <body>
        
        <div class="fixed top-0 right-0 px-6 py-4 sm:block">
            <a href="{{ route('login') }}" class="text-lg text-gray-700 underline">Admin</a>
        </div>
        <div class="container m-auto p-8 text-grey-darkest">

            <h1 class="mb-4">Department Sql Runner</h1>

            <div class="mb-8 p-2 w-full flex flex-wrap bg-grey-600 hover:bg-grey-700">
                <div class="border-8 w-full md:w-4/4 bg-grey">
                    <div class="w-full block mb-1 button-wrapper">
                        <a href="/" class="focus:outline-none px-10 py-3 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-full inline-flex items-center"><i class="fa fa-hand-o-left text-lg"></i>&nbsp;Back</a>
                    </div>
                    <div class="w-full block mb-1 query-wrapper">
                        <div class=" px-8 py-8 bg-gray-900 text-white overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <h3 class="py-2 text-4xl font-bold font-mono">Title: {{$query->title}}</h3>
                            <?php
                                $today = date('Y-d-m');
                                $rlt = preg_match_all('/@\w+/', $query->query, $matches);
                                $promptNames = array_unique($matches[0]);
                                $rlt1 = preg_match_all('/set([^;]+);/i', $query->query, $matches1);
                                $values = [];
                                if($rlt1) {
                                    foreach($matches1[1] as $set_command) {
                                        
                                        $segs = explode(",",  $set_command);
                                        foreach($segs as $seg) {
                                            $rlt2 = preg_match('/(@\w+)[ ]*=[ ]*[\'\"](.*)[\'\"]/', $seg, $matches2);
                                            if($rlt2) {
                                                $varname = $matches2[1];
                                                $value = $matches2[2];
                                                $values[$varname] = $value;
                                            }
                                        }
                                    }
                                }
                                $promptNames = array_keys($values);
                            ?>
                            <div class="container">
                                @foreach($promptNames as $prom)
                                    <div class="col-md-4">
                                        <label for="{{$prom}}">{{$prom}}: </label>
                                        <input id="{{$prom}}" value="{{$values[$prom]}}" class="promInput form-control" type="text" name="{{$prom}}">
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="query_id" value="{{$query->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <form action="/exportExcel" method="post" id="exportForm">
                                <input id="exportExcelValue" type="hidden" name="exportValue">
                            </form>
                            <label>Author:</label>
                            <span class="text-md">{{$query->author}}</span><br>
                            <a href="#" id="runQuery{{$query->id}}" class="runQuery focus:outline-none px-5 py-3 bg-green-700 hover:bg-green-800 text-white font-bold py-1 px-1 rounded-full inline-flex items-center">Run</a>
                            <button type="button" class="exportExcel focus:outline-none px-5 py-3 bg-green-700 hover:bg-green-800 text-white font-bold py-1 px-1 rounded-full inline-flex items-center float-right">Export to Excel</button>
                            <div class="table-wrap mt-1">
                                <table class="border-separate border border-green-800 min-w-full divide-y divide-gray-200 text-center mt-3">
                                    <tr>
                                        <td class="text-center text-white">No Result</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
            style="background: rgba(0,0,0,.7);">
            <div
                class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Report</p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <!--Body-->
                    <!-- <form action="/department/add" method="post"> -->
                        <div class="my-5">
                            <!-- This is the input component -->
                            <div class="relative h-10 input-component mb-5">
                                <input
                                    id="email"
                                    type="email"
                                    name="name"
                                    class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm"
                                />
                                <input type="hidden" name="id" id="iden">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="email" class="absolute left-2 transition-all bg-white px-1">
                                    Email Address
                                </label>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button type="button"
                                class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-white bg-red-400 hover:bg-red-300">Cancel</button>
                            <button type="submit"
                                class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white bg-indigo-400 hover:bg-indigo-300">Confirm</button>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        </div>
        <div class="loading-icon">
            <img src="../loading.gif">
        </div>
    </body>
    <style>
        /* .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animated.faster {
            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }
        label {
            top: 0%;
            transform: translateY(-50%);
            font-size: 11px;
            color: rgba(37, 99, 235, 1);
        }
        .empty input:not(:focus) + label {
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
        }
        input:not(:focus) + label {
            color: rgba(70, 70, 70, 1);
        }
        input {
            border-width: 1px;
        }
        input:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 1);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        } */
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openModal = (id, name) => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }
        for (let i = 0; i < closeButton.length; i++) {

        const elements = closeButton[i];

        elements.onclick = (e) => modalClose();

        modal.style.display = 'none';

        window.onclick = function (event) {
            if (event.target == modal) modalClose();
        }
        }
        const allInputs = document.querySelectorAll('input');
        for(const input of allInputs) {
        input.addEventListener('input', () => {
            const val = input.value
            if(!val) {
                input.parentElement.classList.add('empty')
            } else {
                input.parentElement.classList.remove('empty')
            }
        })
        }
        $(document).ready(function() {
            var eptExcelVal = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.runQuery').on('click', function(){
                event.preventDefault();
                // console.log($('.promInput'));
                var self = this;
                var promptEle = $(this).parents('.query-wrapper').find('.promInput');
                var promsKey = [];
                var promsValue = [];
                var flag = true;
                promptEle.each((idx, ele) => {
                    if(ele.value == ''){
                        flag = false;
                    }
                    promsKey.push(ele.id);
                    promsValue.push(ele.value);
                });
                if(flag){
                    var queryId = $(this).siblings('input[name="query_id"]').val();
                    $('.loading-icon').css('display', 'block');
                    $.ajax({
                        url: '/run',
                        type: 'post',
                        data: {
                            'id': queryId,
                            'key': promsKey,
                            'value': promsValue
                        },
                        success: function(res){
                            eptExcelVal = res;
                            if(res.length){
                                var headhtml = '<tr>';
                                Object.keys(res[0]).forEach(element => {
                                headhtml += '<td>' + element + '</td>';
                                });
                                headhtml += '</tr>';
                                var html = '<table class="example table table-striped table-bordered" style="width:100%">';
                                html += '<thead>' + headhtml + '</thead><tbody>';
                                res.forEach(element => {
                                    html += '<tr>';
                                    Object.keys(res[0]).forEach(subEle => {
                                        html += '<td>' + element[subEle] + '</td>';
                                    });
                                    html += '</tr>';
                                });
                                html += '</tbody><tfoot>' + headhtml + '</tfoot>';
                                $(self).next().next().html(html);
                                $('.example').DataTable();
                            } else {
                                var html = '<table class="border-separate border border-green-800 min-w-full divide-y divide-gray-200 text-center mt-3"><tr><td class="text-center text-white">No Result</td></tr></table>';
                                $(self).next().next().html(html);
                            }
                        },
                        error: function(err){
                            alert('Sql Error!');
                        },
                        complete: function(){
                            $('.loading-icon').css('display', 'none');
                        }
                    });
                } else {
                    alert('Input Error!');
                }
                return false;
            });
            $('.exportExcel').click(function(){
                if(eptExcelVal.length){
                    $('#exportExcelValue').val(JSON.stringify(eptExcelVal));
                    $('#exportForm').submit();
                } else {
                    alert('Report Data is not exist!');
                }
            });
        } );
    </script>
</html>
