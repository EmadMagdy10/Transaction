<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="text-center p-2 bg-gray-200">
        <p class="text-3xl">YOUR BALANCE</p>
        <p class="text-5xl mb-3">{{ session('user_data')['balance'] }}$</p>
        <x-primary-button class="ml-3">
            <a href="{{ route('received') }}">{{ __('received') }}</a>
        </x-primary-button>
        <x-primary-button class="ml-3 ">
            <a href="{{ route('dashboard') }}">{{ __('transferred') }}</a>
        </x-primary-button>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- component -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-white border-b ">
                                            <tr class="px-5">
                                                <th scope="col"
                                                    class="text-xl font-medium text-gray-900 px-6 py-4 text-left">
                                                    name
                                                </th>
                                                <th scope="col"
                                                    class="text-xl font-medium text-gray-900 px-6 py-4 text-left">
                                                    amount of transfer
                                                </th>
                                                <th scope="col"
                                                    class="text-xl font-medium text-gray-900 px-6 py-4 text-left">
                                                    date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($userTransaction->isEmpty())
                                                <tr class="bg-gray-100 border-b text-center">
                                                    <td colspan="3"
                                                        class="px-6 py-4 text-sm whitespace-nowrap font-medium text-gray-900">
                                                        No data found yet.
                                                    </td>
                                                </tr>
                                            @endif
                                            @foreach ($userTransaction as $user)
                                                <tr class="bg-gray-100 border-b">

                                                    @if ($user->from_username != session('user_data')['username'])
                                                        <td
                                                            class="px-6 py-4 text-sm whitespace-nowrap  font-medium text-gray-900">
                                                            {{ $user->from_username }}</td>
                                                    @else
                                                        <td
                                                            class="px-6 py-4 text-sm whitespace-nowrap  font-medium text-gray-900">
                                                            {{ $user->to_username }}</td>
                                                    @endif
                                                    <td
                                                        class="px-6 py-4 text-sm whitespace-nowrap  font-medium text-gray-900">
                                                        {{ $user->transaction_amount }} $</td>
                                                    <td
                                                        class="px-6 py-4 text-sm whitespace-nowrap  font-medium text-gray-900">
                                                        {{ $user->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-4 flex justify-center text-2xl">
                                        {{ $userTransaction->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
