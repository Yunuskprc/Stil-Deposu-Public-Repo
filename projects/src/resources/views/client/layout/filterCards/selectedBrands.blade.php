 <div class="row" id="selectedBrands">
     <div id="filterCategory2" class="col-5 BrandsPageFilterDiv">
         <a id="filter-link2" class="filter-link pt-2 pb-2" onclick="showOptions('filterCategory2', 'bodyDiv2')">
             Marka<div class="dropdown-toggle"></div>
         </a>

         <div id="bodyDiv2" class="bodyDiv mb-2" style="display: none">
             <div class="ms-4 form-check d-flex align-items-center">
                 <input class="form-check-input me-2" type="checkbox" id="{{ $brand->brands_name }}"
                     data-value="{{ $brand->brand_id }}" data-key="brand_id" checked readonly>
                 <label class="form-check-label" for="{{ $brand->brands_name }}">
                     {{ $brand->brands_name }}
                 </label>
             </div>
         </div>
     </div>
 </div>
