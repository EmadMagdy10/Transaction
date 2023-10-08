<x-app-layout>
    <form method="POST" action="{{ route('done') }}">
        @csrf
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- component -->
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-5 inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <div class=" mx-auto box-border max-w-full border bg-white p-4">
                                            <script>
                                                var msg = '{{ Session::get('alert') }}';
                                                var exist = '{{ Session::has('alert') }}';
                                                if (exist) {
                                                    alert(msg);
                                                }
                                            </script>
                                            <div class=" text-2xl flex items-center justify-center">
                                                <p class="text-gray-700 justify-center">Sending Money </p>
                                            </div>
                                            <div class="mt-6">
                                                <div class="font-semibold mt-5">How much would you like to send?</div>
                                                <div>
                                                    <x-input-label for="amountTransfer" />
                                                    <x-text-input id="amountTransfer" class="block mt-1 w-full"
                                                        type="text" name="amountTransfer" placeholder="amount" :value="old('amountTransfer')"
                                                        autofocus />
                                                    <x-input-error :messages="$errors->get('amountTransfer')" class="mt-2" />
                                                </div>
                                                <div class="font-semibold mt-5">Enter the username you want to transfer
                                                    money
                                                </div>

                                                <div>
                                                    <x-input-label for="sendTo" />
                                                    <x-text-input id="sendTo" class="block mt-1 w-full"
                                                        type="text" name="sendTo" placeholder="enter username" :value="old('sendTo')"
                                                        autofocus />
                                                    <x-input-error :messages="$errors->get('sendTo')" class="mt-2" />
                                                </div>
                                                <div class="flex justify-between">
                                                </div>
                                                <div class="mt-6">
                                                </div>
                                                <div class="mt-6">
                                                    <x-primary-button class="ml-3">
                                                        {{ __('Send') }}
                                                    </x-primary-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
<!-- component -->
