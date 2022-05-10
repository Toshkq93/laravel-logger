<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .menu {
            visibility: hidden;
            opacity: 0;
        }

        .menu.open {
            transition: .2s visibility linear, .2s opacity linear;
            visibility: visible;
            opacity: 1;
        }
    </style>
    <title>{{ config('app.name', 'Logger') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body style="font-family: 'Nunito', sans-serif;font-size: 0.9rem;line-height: 1.6">
<div class="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('logs') }}">
                {{ config('app.name', 'Logger') }}
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Фильтр
            </button>
            <!-- Модальное окно -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Фильтры:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Закрыть"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Метод:</h5>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio1" value="GET">
                                        <label class="form-check-label" for="method">GET</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio2" value="POST">
                                        <label class="form-check-label" for="method">POST</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio3" value="PUT">
                                        <label class="form-check-label" for="method">PUT</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio3" value="PATCH">
                                        <label class="form-check-label" for="method">PATCH</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio3" value="DELETE">
                                        <label class="form-check-label" for="method">DELETE</label>
                                    </div>
                                </div>
                                <div class="controllers">
                                    <div class="modal-header" style="border-top: 1px solid #dee2e6;">
                                        <h5 class="modal-title" id="exampleModalLabel">Контроллеры:</h5>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <select class="form-select" name="controller" id="controllers" aria-label="Default select example">
                                            <option value="" selected>Выберите контроллер</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="users">
                                    <div class="modal-header" style="border-top: 1px solid #dee2e6;">
                                        <h5 class="modal-title" id="exampleModalLabel">Id пользователей:</h5>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <select class="form-select" name="user_id" id="users" aria-label="Default select example">
                                            <option value="" selected>Выберите пользователя</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="directories">
                                    <div class="modal-header" style="border-top: 1px solid #dee2e6;">
                                        <h5 class="modal-title" id="exampleModalLabel">Директории:</h5>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <select class="form-select" name="dir_name" id="directories" aria-label="Default select example">
                                            <option value="" selected>Выберите директорию</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="responses">
                                    <div class="modal-header" style="border-top: 1px solid #dee2e6;">
                                        <h5 class="modal-title" id="exampleModalLabel">Статусы ответов:</h5>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-2">
                                        <select class="form-select" name="method_status" id="responses" aria-label="Default select example">
                                            <option value="" selected>Выберите директорию</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Показать">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            <div class="w-100 d-flex justify-content-between">
                <h3 class="text-center">Logger</h3>
                <form method="POST" action="{{ route('delete') }}">
                    @csrf
                    @method('delete')
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger delete-logs" value="Delete Logs">
                    </div>
                </form>
            </div>
            <div class="list-group">
                @if(count($logs->getItems()))
                    @foreach($logs->getItems() as $log)
                        <?php /** @var Toshkq93\Logger\DTO\Logger\ShowDataDTO $log */?>
                        <div class="list-group-item list-group-item-action"
                             style="margin:5px;margin-bottom: 30px;border-top-width:1px">
                            <div class="row w-100">
                            <span class="col-md-3">
                                @if ($log->getStatus() > \Illuminate\Http\Response::HTTP_BAD_REQUEST)
                                    <button class="btn btn-danger font-weight-bold">{{$log->getMethod()}}</button>
                                @elseif($log->getStatus() > \Illuminate\Http\Response::HTTP_MULTIPLE_CHOICES)
                                    <button class="btn btn-info font-weight-bold">{{$log->getMethod()}}</button>
                                @else
                                    <button
                                        class="btn btn-{{$log->getMethod()=="GET"? "primary" : "success"}} font-weight-bold">{{$log->method}}</button>
                                @endif
                                <small class="col-md-2">
                                    <b>{{$log->getStatus()}}</b>
                                </small>
                            </span>
                                <large class="col-md-2"><b>Duration : </b>{{$log->getDuration()}}ms</large>
                                <large class="col-md-3"><b>Date : </b>{{$log->getDate()}}</large>
                                <p class="col-md-2 mb-1"><b>IP :</b> {{$log->getIp()}}</p>
                                <p class="col-md-2 mb-1"><b>User id: </b>{{ $log->getUserId() }}</p>
                            </div>
                            <hr>
                            <div class="row w-100">
                                <p class="col-md-5 mb-1"
                                   style="padding-right: 10px; padding-left: 10px; flex: 0 0 35.666667%;max-width: 35.666667%;">
                                    <b>URL : </b>{{$log->getUrl()}}</br>
                                </p>
                                <p class="col-md-2 mb-1"
                                   style="padding-right: 10px; padding-left: 10px; flex: 0 0 12.666667%;max-width: 12.666667%;">
                                    <b>Action : </b>{{$log->getMethodController()}}</br>
                                </p>
                                <p class="col-md-6 mb-1"
                                   style="padding-right: 10px; padding-left: 10px; flex: 0 0 45.666667%;max-width: 45.666667%;">
                                    <b>Controller : </b>{{$log->getController()}}</br>
                                </p>
                            </div>
                            <div class="row w-100" style="display: flex;flex-wrap: nowrap;justify-content: flex-start;">
                                <p class="col-md-2" style="margin-bottom: 0;width: 10.666667%;">
                                    <b>Models(retrieved):</b>
                                </p>
                                <div style="width: 25%;max-width: 25%;">
                                    @if($log->getModels())
                                        @foreach($log->getModels()->getItems() as $model)
                                            <?php /** @var Toshkq93\Logger\DTO\Logger\ModelDTO $model */ ?>
                                            <p class="col-md-12 mb-0"><b>Model : </b>{{$model->getModelName()}}
                                                ({{$model->getCount()}})</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if($log->getQueries())
                                <div id="accordeon" style="display: flex;flex-direction: column;">
                                    @if($log->getQueries())
                                        <a class="query_toggle btn btn-info mt-2 mb-2" href="##" style="width: 15%;color: white">Requests</a>

                                        <div class="queries row w-100"
                                             style="background: #0dcaf0; color: white;display: none">
                                            <p class="col-md-12 mb-0">{!! $log->getQueries() !!}</p>
                                        </div>
                                    @endif
                                    @if($log->getMessageError())
                                        <a class="error_toggle btn btn-danger mt-2 mb-2" href="##" style="width: 15%">Errors</a>
                                        <div class="errors row w-100"
                                             style="background: red; color: white;display: none">
                                            <p class="col-md-12 mb-0">{!! $log->getMessageError() !!}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                    {{ $logs->getPaginator()->getLink() }}
                @endif
            </div>
        </div>
    </main>
</div>
</body>
<script>
    $(document).ready(function () {
        $('#accordeon .query_toggle').on('click', query);
        $('#accordeon .error_toggle').on('click', error);
    });

    function query() {
        $('#accordeon .queries').not($(this).next()).slideUp();
        $(this).next().slideToggle();
    }

    function error() {
        $('#accordeon .errors').not($(this).next()).slideUp();
        $(this).next().slideDown();
    }

    $.ajax({
        url: '/logs/get-filters',
        type: 'GET',
        success: function (res) {
            for(var key in res){
                if(res[key]){
                    let filter = res[key],
                        filter_name = key;

                    var option = '';

                    for (var i = 0; i < filter.length; i++) {
                        option += "<option value='" + filter[i] + "'>" + filter[i] + "</option>";
                    }

                    $('#' + filter_name).append(option);
                }
            }
        },
        error: function () {
            alert('Ошибка!');
        }
    });
</script>
</html>
