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
                    <h1>LSP MIGRATION TO 2.0</h1>
                    <form action="{{ url('migrasi/user/prepare') }}" method="POST">
                        @csrf
                        <hr>
                        <h5>User :</h5>
                        <div class="form-group" v-for="(item,i) in inputs" :key="i">
                            <label>
                                nama @{{ item }}
                                <a href="#" @click.prevent="delInput(i)">delete</a>
                            </label>
                            <input type="text" name="user[]" class="form-control">
                        </div>
                        <div class="form-group">
                            <button @click.prevent="addInput" class="btn btn-primary">Tambah Input</button>
                        </div>
                        <hr>
                        <h5>Arahkan ke :</h5>
                        <div class="form-group">
                            <label>Id Skema :</label>
                            <input type="number" value="1" name="skema" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Id Asesor :</label>
                            <input type="number" value="1" name="asesor" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Id Jadwal :</label>
                            <input type="number" value="1" name="jadwal" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script>
            const app = new Vue({
                el: '#app',
                data: {
                    inputs: ['user 1']
                },
                methods: {
                    addInput() {
                        this.inputs.push("user " + (parseInt(this.inputs.length) + 1));
                    },
                    delInput(i) {
                        this.inputs.splice(i, 1);
                    }
                }
            })
        </script>
    </body>
</html>