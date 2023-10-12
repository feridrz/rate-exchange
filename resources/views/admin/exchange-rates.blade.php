@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Search Form -->
                    <div class="mb-5 flex justify-end">
                        <form method="GET" action="{{ route('admin.exchange-rates') }}" class="flex items-center">
                            <input type="text" name="search" placeholder="Search currencies..."
                                   value="{{ request('search') }}"
                                   class="p-2 border rounded-l-md focus:outline-none focus:border-blue-300 w-72">
                            <button type="submit" class="bg-blue-500 text-white p-2 px-4 rounded-r-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
                        </form>
                    </div>


                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-700 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                N
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-700 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                From
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-700 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                To
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-700 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Rate
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-700 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Updated At
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exchangeRates as $rate)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                                    {{ $loop->iteration  }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                                    {{ $rate->fromCurrency->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                                    {{ $rate->toCurrency->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                                    {{ $rate->rate }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                                    {{ $rate->updated_at }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-700">
                        {{ $exchangeRates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
