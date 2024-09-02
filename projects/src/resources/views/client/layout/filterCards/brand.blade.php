 <!-- Eğer selected değilde direkt tüm brands'ler seçilirse controllerda düzenleme yapılması gerekir (Gönderilen veri tek tiptir.) -->

 <div class="row" id="brand">
     <div id="filterCategory2" class="col-5 BrandsPageFilterDiv">
         <a id="filter-link2" class="filter-link pt-2 pb-2" onclick="showOptions('filterCategory2', 'bodyDiv2')">
             Marka <div class="dropdown-toggle"></div>
         </a>

         <div id="bodyDiv2" class="bodyDiv mb-2" style="display: none">
             @foreach ($brand as $key)
                 <div class="ms-4 form-check d-flex align-items-center">
                     <input class="form-check-input me-2" type="checkbox" id="{{ $key->brand_name }}"
                         data-value="{{ $key->brand_id }}" data-key="brand_id"
                         onchange="getOtherFilter({{ $key->brand_id }},{{ $categories->category_id }})">
                     <label class="form-check-label" for="{{ $key->brand_name }}">
                         {{ $key->brand_name }}
                     </label>
                 </div>
             @endforeach
         </div>
     </div>
 </div>
