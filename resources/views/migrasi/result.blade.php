<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Migrasi User</title>
    </head>
    <body>
        <div id="app" class="container pt-4 pb-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-12">
                    <h1>MIGRATION RESULT</h1>
                    <form action="{{ url('migrasi/user/rollback') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Skema</label>
                            <input type="text" class="form-control" value="{{ $skema->id }} - {{ $skema->judul }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Asesor</label>
                            <input type="text" class="form-control" value="{{ $asesor->id }} - {{ $asesor->nama }}" readonly>
                        </div>
                        <hr>
                        @foreach ($result as $item)
                            <h5>{{ $item->user->nama }} :</h5>
                            <input type="text" class="form-control" value="{{ $item->user->id }} - {{ $item->user->nama }}" readonly>
                            @foreach ($item->berkas as $berkas)
                                <input type="text" class="form-control" value="{{ $berkas->id }} - {{ $berkas->nama }}" readonly>
                                <input type="hidden" name="berkas[]" value="{{ $berkas->id }}">
                            @endforeach
                            
                            <input type="hidden" name="permohonan[]" value="{{ $item->permohonan->id }}">
                            <input type="hidden" name="user[]" value="{{ $item->user->id }}">
                            <hr>
                        @endforeach
                        <p class="text-danger">*Rollback can delete all user data!</p>
                        <a href="{{ url('migrasi/user') }}" class="btn btn-success">Back</a>
                        <button class="btn btn-danger">Rollback</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>