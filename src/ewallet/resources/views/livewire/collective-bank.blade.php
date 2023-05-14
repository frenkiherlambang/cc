<div class="flex flex-col w-full space-y-2 md:space-y-0 md:space-x-2 md:flex-row">
    <div class="w-full overflow-hidden bg-white shadow md:w-2/3 sm:rounded-2xl">
        @if (session()->has('message'))
        <div role="alert" class="p-4 mx-2 mt-2 border-green-500 rounded-xl bg-green-50">
            <strong class="block font-medium text-green-800"> {{ session('message') }}</strong>
        </div>
        @endif
        <div class="p-6 text-gray-900">
            <div class="flex flex-col ">
                {{-- header title --}}
                <div class="flex items-center justify-center w-full text-2xl font-bold ">
                    My Account
                </div>
                <div class="flex flex-col items-center justify-center w-full text-2xl font-bold ">
                    {{ number_format($userBalance, 2) }}
                </div>
            </div>
        </div>
        <div class="text-sm font-normal ">
            @livewire('history-component')
        </div>

    </div>
    <div class="w-full overflow-hidden bg-white shadow md:w-1/3 sm:rounded-2xl max-h-56">

        <div class="p-6 text-gray-900">
            <div class="flex flex-col items-center justify-center m-2 ">
                <div class="flex flex-col m-2">
                    {{-- Insert label "Enter amount of withdrawal or Deposit" --}}
                    <label for="amount" class="text-gray-600">Enter the amount of Deposit or Withdrawal</label>
                    <input type="number" placeholder="Amount" id="amount"
                        class="w-full px-4 py-2 border border-gray-400 rounded-lg" wire:model="amount">
                </div>
                <div class="flex space-x-1">
                    <div>
                        <button type="button" wire:click="deposit"
                            class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Deposit</button>

                    </div>
                    <div>
                        <button type="button" wire:click="withdrawal"
                            class="px-4 py-2 mt-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Withdrawal</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
