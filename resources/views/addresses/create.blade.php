<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Addresses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 overflow-hidden overflow-x-auto bg-white">

                    <div class="min-w-full align-middle sm:rounded-md">
                        <x-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('addresses.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="mt-4">
                                <x-label for="country" :value="__('Country')"></x-label>
                                <select name="country" id="country" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ (int) old('country') === $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <x-label for="street" :value="__('Street name')"></x-label>
                                <x-input id="street" class="block mt-1 w-full"
                                    type="text"
                                    name="street"
                                    :value="old('street')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <x-label for="number" :value="__('House number')"></x-label>
                                <x-input id="number" class="block mt-1 w-full"
                                    type="text"
                                    name="number"
                                    :value="old('number')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <x-label for="city" :value="__('City')"></x-label>
                                <x-input id="city" class="block mt-1 w-full"
                                    type="text"
                                    name="city"
                                    :value="old('city')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <x-label for="state" :value="__('State')"></x-label>
                                <x-input id="state" class="block mt-1 w-full"
                                    type="text"
                                    name="state"
                                    :value="old('state')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <x-label for="postal_code" :value="__('Postal code')"></x-label>
                                <x-input id="postal_code" class="block mt-1 w-full"
                                    type="text"
                                    name="postal_code"
                                    :value="old('postal_code')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone')"></x-label>
                                <x-input id="phone" class="block mt-1 w-full"
                                    type="text"
                                    name="phone"
                                    :value="old('phone')"
                                    required />
                            </div>

                            <div class="mt-4">
                                <input type="hidden" name="is_billing" value="0">
                                <input id="is_billing"
                                    name="is_billing"
                                    type="checkbox"
                                    class="inline-block"
                                    value="1"
                                    {{ old('is_billing') ? 'checked' : '' }}/>
                                <x-label for="is_billing" :value="__('Is billing address')" class="inline-block pl-1"></x-label>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="px-3 py-2 bg-blue-500 text-white font-bold rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
