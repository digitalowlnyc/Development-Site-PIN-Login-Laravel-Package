<html>
<head>
    <title>Development Site PIN Login</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <style>
        .container {
            margin: 50px auto 0px auto;
            width: 600px;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Development Site PIN</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/development-site-login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('site-pin') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Site PIN</label>

                            <div class="col-md-6">
                                <input id="site-pin" type="number" class="form-control" name="site-pin" value="{{ old('site-pin') }}" required autofocus>

                                @if ($errors->has('site-pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site-pin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>