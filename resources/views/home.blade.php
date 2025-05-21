@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <h1>WorkHub</h1>
</div>

<div class="w-50 mx-auto">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('order.submit') }}" method="post">
        @csrf
        <h5>Укажите дату</h5>
        <div class="mb-3">
            <input class="border border-dark rounded form-control" name="data" type="date" id="data" required>
        </div>
        <h5>Выберите тип места</h5>
        <div class="w-25 mb-3 d-flex flex-row justify-content-between">
            <input type="radio" value="work" name="type" class="btn-check" id="btn-checkOne" autocomplete="off" required>
            <label class="btn btn-outline-primary" for="btn-checkOne">Рабочее</label>

            <input type="radio" value="tell" name="type" class="btn-check" id="btn-checkTwo" autocomplete="off">
            <label class="btn btn-outline-primary" for="btn-checkTwo">Переговорное</label>
        </div>

        <div class="input-group mb-3 d-none qwe">
            <label for="places-input" class="input-group-text">Количество человек (1–12)</label>
            <input min="1" max="12" type="number" class="form-control" id="places-input" name="places">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Цена:</span>
            <span class="form-control" id="price-display">0.00</span>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

<script>
    // Configuration
    const config = {
        prices: @json($prices ?? ['work' => 0.00, 'tell' => 0.00]),
        surchargePerPerson: 10,
        defaultPrice: 0.00,
        minPlaces: 1,
        maxPlaces: 12
    };

    // DOM elements
    const elements = {
        placesInput: document.querySelector("#places-input"),
        radioWork: document.querySelector("#btn-checkOne"),
        radioTell: document.querySelector("#btn-checkTwo"),
        placesContainer: document.querySelector(".qwe"),
        priceDisplay: document.querySelector("#price-display"),
        form: document.querySelector("form")
    };

    // Initialize form
    function initializeForm() {
        if (!config.prices.work || !config.prices.tell) {
            console.error("Price data for work or tell is missing");
            elements.priceDisplay.textContent = config.defaultPrice.toFixed(2);
        }
        updatePrice();
    }

    // Update price
    function updatePrice() {
        const selectedType = document.querySelector("input[name='type']:checked")?.value;
        let price = config.defaultPrice;

        if (selectedType === "work") {
            price = config.prices.work || config.defaultPrice;
        } else if (selectedType === "tell") {
            const people = parseInt(elements.placesInput.value) || 0;
            price = (config.prices.tell || config.defaultPrice) + (people * config.surchargePerPerson);
        }

        elements.priceDisplay.textContent = price.toFixed(2);
    }

    // Toggle places input
    function togglePlacesInput() {
        const selectedType = document.querySelector("input[name='type']:checked")?.value;
        elements.placesContainer.classList.toggle("d-none", selectedType !== "tell");
        if (selectedType === "tell" && !elements.placesInput.value) {
            elements.placesInput.value = config.minPlaces;
        }
        updatePrice();
    }

    // Validate form
    function validateForm(e) {
        const selectedType = document.querySelector("input[name='type']:checked")?.value;
        if (selectedType === "tell" && (!elements.placesInput.value || elements.placesInput.value < config.minPlaces || elements.placesInput.value > config.maxPlaces)) {
            e.preventDefault();
            alert("Пожалуйста, укажите количество человек от 1 до 12 для переговорного места.");
        }
    }

    // Event listeners
    function setupEventListeners() {
        elements.radioWork.addEventListener("change", togglePlacesInput);
        elements.radioTell.addEventListener("change", togglePlacesInput);
        elements.placesInput.addEventListener("input", updatePrice);
        elements.form.addEventListener("submit", validateForm);
    }

    // Initialize
    document.addEventListener("DOMContentLoaded", () => {
        setupEventListeners();
        initializeForm();
    });
</script>
@endsection