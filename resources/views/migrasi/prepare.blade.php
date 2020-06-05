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
                    <h1>PREPARE FOR MIGRATE</h1>
                    <form action="{{ url('migrasi/user/submit') }}" method="POST">
                        @csrf
                        <hr>
                        <h5>User :</h5>
                        @foreach ($users as $user)
                            <input type="text" class="form-control" value="{{ $user->data->id }} - {{ $user->data->nama }}" readonly>
                            <input type="hidden" name="user[]" value="{{ $user->data->id }}">
                        @endforeach
                        <hr>
                        <h5>Arahkan ke :</h5>
                        <div class="form-group">
                            <label>Skema :</label>
                            <input type="text" class="form-control" value="{{ $skema->judul }}" readonly>
                            <input type="hidden" name="skema" value="{{ $skema->id }}">
                        </div>
                        <div class="form-group">
                            <label>Asesor :</label>
                            <input type="text" class="form-control" value="{{ $asesor->id }} - {{ $asesor->nama }}" readonly>
                            <input type="hidden" name="asesor" value="{{ $asesor->id }}">
                        </div>
                        <div class="form-group">
                            <label>Jadwal :</label>
                            <input type="text" class="form-control" value="{{ $jadwal->nama }}" readonly>
                            <input type="hidden" name="jadwal" value="{{ $jadwal->id }}">
                        </div>
                        <div class="form-group">
                            <p class="text-danger">* This process cannt be undo!</p>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>