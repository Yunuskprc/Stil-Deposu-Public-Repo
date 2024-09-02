  <!-- Eğer selected değilde direkt tüm categoryler'ler seçilirse controllerda düzenleme yapılması gerekir (Gönderilen veri tek tiptir.) -->

  <div class="row" id="selectedCategory">
      <div id="filterCategory" class="col-5 BrandsPageFilterDiv">
          <a id="filter-link" class="filter-link pt-2 pb-2" onclick="showOptions('filterCategory', 'bodyDiv')">
              Kategori<div class="dropdown-toggle"></div>
          </a>

          <div id="bodyDiv" class="bodyDiv mb-2" style="display: none">
              <div class="ms-4 form-check d-flex align-items-center">
                  <input class="form-check-input me-2" type="checkbox" id="{{ $categories->category_id }}"
                      data-value="{{ $categories->category_id }}" data-key="category_id" checked readonly>
                  <label class="form-check-label" for="{{ $categories->category_name }}">
                      {{ $categories->category_name }}
                  </label>
              </div>
          </div>
      </div>
  </div>
