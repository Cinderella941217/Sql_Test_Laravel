<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Query') }}
        </h2>
    </x-slot>
    <script>
        var queries = <?php echo json_encode($queries); ?>;
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700" onclick="openModal(-1)">
                        + ADD New
                    </a>
                    <table class="min-w-full divide-y divide-gray-200 text-center mt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Department
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Author
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Query
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(count($queries))
                                @foreach($queries as $query)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$loop->index + 1}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$query->title}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$query->department1->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$query->author}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{strlen($query->query) > 30 ?
                                                (substr($query->query, 0, 27) . "...") : $query->query }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="#" class="inline-flex items-center justify-center px-3 py-1 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700" onclick="openModal({{$loop->index}})">
                                                Edit
                                            </a>
                                            <a href="/query/delete/{{$query->id}}" class="inline-flex items-center justify-center px-3 py-1 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-sm text-center text-red-700 mt-1">No Query</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<form action="/query/add" method="post">
<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div
        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Department Query Info</p>
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
            
                <div class="my-5">
                    <!-- This is the input component -->
                    <div class="relative input-component mb-5">
                        <div class="mt-5">
                            <input type="text" name="title" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Query Title" id="titleText">
                        </div>
                        <div class="mt-5">
                            <select class="block w-full p-2 border rounded border-gray-300" name="department" id="sel_department">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-5">
                            <input type="text" name="author" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Author" id="authorText">
                        </div>
                        <div class="mt-5">
                            <textarea class="block w-full p-2 border rounded border-gray-300" name="query" id="queryText" cols="30" rows="10" placeholder="Please Insert Query."></textarea>
                        </div>
                        <input type="hidden" name="id" id="iden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button type="button" 
                        class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-white bg-red-400 hover:bg-red-300">Cancel</button>
                    <button type="submit"
                        class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white bg-indigo-400 hover:bg-indigo-300">Confirm</button>
                </div>
        </div>
    </div>
</div>
</form>

<style>
    .animated {
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
    }
</style>

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

    const openModal = (idx) => {
        modal.classList.remove('fadeOut');
        modal.classList.add('fadeIn');
        modal.style.display = 'flex';
        if(idx > -1){
            document.getElementById('iden').value = queries[idx].id;
            document.getElementById('titleText').value = queries[idx].title;
            document.getElementById('sel_department').value = queries[idx].department;
            document.getElementById('authorText').value = queries[idx].author;
            document.getElementById('queryText').value = queries[idx].query;
        } else {
            document.getElementById('iden').value = '';
            document.getElementById('titleText').value = '';
            document.getElementById('sel_department').value = '';
            document.getElementById('authorText').value = '';
            document.getElementById('queryText').value = '';
        }
        // document.getElementById('email').value = name;
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
</script>