<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{route('socket-serve')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>Server Configuration</h5>
                        </div>
                        <div class="card-body">
                            <div class="p-2">
                                <label for="host" class="pb-2">Enter Host
{{--                                    <span class="text-info">Default is your base url</span>--}}
                                </label>
                                <input type="text" name="host" class="form-control pb-3" id="host" placeholder="{{url('/')}}">
                            </div>

                            <div class="p-2">
                                <label for="port" class="pb-2">Enter Port <span class="text-info">Default: 6001</span></label>
                                <input type="text" name="port" class="form-control pb-3" id="port" placeholder="6001">
                            </div>

                            <div class="p-2">
                                <button type="submit" id="submit" class="btn btn-primary">Run</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
