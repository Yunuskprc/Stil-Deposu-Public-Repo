<div class="row" id="category">
    <div id="filterCategory" class="col-5 BrandsPageFilterDiv">
        <a id="filter-link" class="filter-link pt-2 pb-2" onclick="showOptions('filterCategory', 'bodyDiv')">
            Kategori <div class="dropdown-toggle"></div>
        </a>

        <div id="bodyDiv" class="bodyDiv mb-2" style="display: none">
            @foreach ($categories as $category)
                <div class="ms-4 form-check d-flex align-items-center">
                    <input class="form-check-input me-2" type="checkbox" id="{{ $category->category_id }}"
                        data-value="{{ $category->category_id }}" data-key="category_id"
                        onchange="getOtherFilter({{ $category->category_id }})">
                    <label class="form-check-label" for="{{ $category->category_name }}">
                        {{ $category->category_name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
