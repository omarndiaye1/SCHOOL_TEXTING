<!doctype html>
<html>
    <head>

        <title>contact</title>
        {{-- <link rel="stylesheet"  type="text/css" href="/css/app.css"> --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
        <style>
            .is-complete{
                text-decoration: line-through;
            }
        </style>
    </head>
    <body>
        <h1 class="title">Create a new User</h1>

    <form >
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="field">

            <label class="label" for="title">login</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="login" placeholder="Login" style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Password</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="password"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Nom</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="nom"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Prenom</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="prenom"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Telephone</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="tel"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Email</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="email"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Sexe</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="sexe"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Date Naissance</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="datenaissance"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Adresse</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="libelle"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Ville</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="ville"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Pays</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="pays"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Civilité</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="civilite"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">


            <label class="label" for="title">Role</label>
            <div>
                <input class="input {{ $errors-> has('title') ? 'is-danger' : '' }}" type="text" name="role"  style="margin-bottom: 1em" value="{{ old('title') }}">
            </div>

        </div>

        <div class="field">

            <div class="control" style="margin-bottom: 1em">
                <button type="submit" class="button is-primary">Create user</button>
            </div>

        </div>

    </form>

    </body>
</html>
