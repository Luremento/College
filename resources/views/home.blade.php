@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <h1>WorkHub</h1>
</div>

<div class="w-50 mx-auto">
    <form>
        <div class="mb-3">
            <input form-control type="date" id="date-input">
        </div>
        <h4>Выберите тип места </h4>
        <div class="w-25 mb-3 d-flex flex-row justify-content-between ">
            <input type="radio" value="one" name="type" class="btn-check" id="btn-checkOne" autocomplete="off">
            <label class="btn btn-outline-primary button1" for="btn-checkOne">Рабочее</label><br>

            <input type="radio" value="two" onclick="addFn()" name="type" class="btn-check" id="btn-checkTwo" autocomplete="off">
            <label class="btn btn-outline-primary" for="btn-checkTwo">Переговорное</label><br>

            <div class="qwe" style="display: none;">
                <h1>элемент</h1>
            </div>

            <br>

            <script>


            </script>

        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    const qwe = document.querySelector(".qwe")
    const button1 = document.querySelector(".button1")
    button1.addEventListener("click", () => {
        qwe.style.display = "block"
    })
</script>
@endsection