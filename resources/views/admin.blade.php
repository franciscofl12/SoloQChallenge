<x-guest-layout>
    <div class="w-full py-16 px-4">
        <div class="flex flex-col items-center justify-center">
            <div class="m-0 p-0 flex justify-center text-center align-middle py-5 mb-3 transition duration-100">
                <a href="{{route('welcome')}}"> <img data-aos="zoom-out" src="{{asset('img/SOLOQ.png')}}" class="object-center py-4 w-80"></a>
            </div>
            <div class="bg-white shadow rounded lg:w-1/3  md:w-1/2 w-full p-10 mt-16">
                <form method="POST" action="{{route('account.store')}}">
                    @csrf
                    <div>
                        <label id="name" class="text-sm font-medium leading-none text-gray-800">
                            Name
                        </label>
                        <input aria-labelledby="name" type="name" name="name"
                               class="bg-gray-200 border rounded  text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"/>
                    </div>
                    <div>
                        <label id="account" class="text-sm font-medium leading-none text-gray-800">
                            Account
                        </label>
                        <input aria-labelledby="account" type="account" name="account"
                               class="bg-gray-200 border rounded  text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"/>
                    </div>
                    <div class="mt-8">
                        <button role="button"
                                class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 text-sm font-semibold leading-none text-black focus:outline-none bg-yellow-300 border rounded py-4 w-full">
                            Añadir una cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
