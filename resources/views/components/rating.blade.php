<div class="filter">
    <form method="GET" action="{{ route('search.filter') }}">
        <div class="filter-box">
            Цена
            <div class="filter-line">
                <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}">
                <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}">
                <label for="in_stock">В наличии:</label>
                <input type="checkbox" id="in_stock" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                <button type="submit">Применить фильтр</button>
            </div>
        </div>
    </form>
</div>