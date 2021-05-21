<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700" onclick="openModal(0, '')">
                        + ADD New
                    </a>
                    <table class="min-w-full divide-y divide-gray-200 text-center mt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Department Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(count($departments))
                                @foreach($departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$loop->index + 1}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$department->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="#" class="inline-flex items-center justify-center px-3 py-1 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700" onclick="openModal({{$department->id}}, '{{$department->name}}')">
                                                Edit
                                            </a>
                                            <a href="/department/delete/{{$department->id}}" class="inline-flex items-center justify-center px-3 py-1 border border-transparent text-base font-medium rounded-md text-white bg-red-500 hover:bg-red-600">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-sm text-center text-red-700 mt-1">No Department</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div
        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Department Info</p>
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
            <form action="/department/add" method="post">
                <div class="my-5">
                    <!-- This is the input component -->
                    <div class="relative h-10 input-component mb-5">
                        <input
                            id="email"
                            type="text"
                            name="name"
                            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm"
                        />
                        <input type="hidden" name="id" id="iden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <label for="email" class="absolute left-2 transition-all bg-white px-1">
                            Department Name
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
            </form>
        </div>
    </div>
</div>
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

    const openModal = (id, name) => {
        modal.classList.remove('fadeOut');
        modal.classList.add('fadeIn');
        modal.style.display = 'flex';
        document.getElementById('iden').value = id;
        document.getElementById('email').value = name;
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