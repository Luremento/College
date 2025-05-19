@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <h1>WorkHub</h1>
</div>

<div class="w-50 mx-auto">
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <input form-control type="date" id="date-input">
        </div>
        <h4>Выберите тип места </h4>
        <div class="w-25 mb-3 d-flex flex-row justify-content-between ">

            <input type="radio" value="one" class="btn-check" id="btn-checkOne" autocomplete="off">
            <label class="btn btn-outline-primary" for="btn-checkOne">Рабочее</label><br>

            <input type="radio" value="two" class="btn-check" id="btn-checkTwo" autocomplete="off">
            <label class="btn btn-outline-primary" for="btn-checkTwo">Переговорное</label><br>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection