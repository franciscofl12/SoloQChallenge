<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

</head>
<body class="bg-black">
<div class="m-0 p-0 flex justify-center text-center align-middle py-5 mb-3 transition duration-100">
    <img data-aos="zoom-out" src="{{asset('img/SOLOQ.png')}}" class="object-center py-4 w-80">
</div>
<div>
    <div class="mx-auto w-2/3 bg-gray-200 rounded-lg">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="p-2 shadow">
                    <!-- <table> -->
                    <table id="dataTable" class="py-8">
                        <thead>
                        <tr>
                            <th class="p-8 text-xs text-gray-500">
                                Name
                            </th>
                            <th class="p-8 text-xs text-gray-500">
                                Account
                            </th>
                            <th class="p-8 text-xs text-gray-500">
                                Games
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Elo
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Win Rate
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr class="whitespace-nowrap hover:bg-gray-50 transition duration-300">
                                <td class="px-6 py-10 text-center">
                                    <div class="text-sm text-gray-900">
                                        {{$account->name}}
                                    </div>
                                </td>
                                <td class="px-6 py-10 text-center">
                                    <div class="text-sm text-gray-500 hover:text-yellow-300">
                                        @if(\App\Http\Controllers\AccountController::getOnline($account->lolID) == false)
                                            <a href="{{"https://euw.op.gg/summoners/euw/" . $account->account}}" target="_blank" >
                                                {{$account->account}} <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Offline</span>
                                            </a>
                                        @else
                                            <a href="{{"https://euw.op.gg/summoners/euw/" . $account->account . "/ingame"}}" target="_blank">
                                                {{$account->account}} <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Ingame</span>
                                            </a>
                                        @endif

                                    </div>
                                </td>
                                @if(empty(\App\Http\Controllers\AccountController::getInfo($account->lolID)))
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                    </td>
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                        Unranked
                                    </td>
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                    </td>
                                @else
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                        {{\App\Http\Controllers\AccountController::getMatches($account->lolID)}} (<span class="text-green-500">{{\App\Http\Controllers\AccountController::getWins($account->lolID)}}</span> - <span class="text-red-500">{{\App\Http\Controllers\AccountController::getLosses($account->lolID)}}</span>)
                                    </td>
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                        <strong>{{\App\Http\Controllers\AccountController::getInfo($account->lolID)[0]->tier}} {{\App\Http\Controllers\AccountController::getInfo($account->lolID)[0]->rank}}</strong>&nbsp;{{\App\Http\Controllers\AccountController::getInfo($account->lolID)[0]->leaguePoints}} lps
                                    </td>
                                    <td class="px-6 py-10 text-sm text-center text-gray-500">
                                        {{round((\App\Http\Controllers\AccountController::getWins($account->lolID) / \App\Http\Controllers\AccountController::getMatches($account->lolID))*100) }} %
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },

        })
    });
</script>
</body>
</html>
