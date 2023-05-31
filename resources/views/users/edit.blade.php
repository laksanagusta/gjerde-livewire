<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Transaction &raquo; Edit') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif
                
                <form class="w-full" action="{{ route('user-profile-information.update', $id) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Name</label>
                            <input value="{{ $name }}" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Email</label>
                            <input value="{{ $email }}" name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Email">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="phoneNumber" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Phone Number</label>
                            <input value="{{ $phoneNumber }}" name="phoneNumber" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Password</label>
                            <input value="{{ old('password') }}" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Password">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-gray-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save Transaction
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>