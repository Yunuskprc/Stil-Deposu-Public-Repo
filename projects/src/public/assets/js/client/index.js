function showOptions(filterId, bodyId) {
    var filterDiv = document.getElementById(filterId);
    var bodyDiv = document.getElementById(bodyId);

    if (filterDiv.style.height === '55px' || filterDiv.style.height === '') {
        filterDiv.style.height = 'auto';
        bodyDiv.style.display = 'block';
        bodyDiv.style.maxHeight = '155px';
    } else {
        filterDiv.style.height = '55px';
        bodyDiv.style.display = 'none';
        bodyDiv.style.maxHeight = '0';
    }
}





function showProductAttribute(data, product) {
    const productBodyRow = document.getElementById('productBodyRow');

    const categoryDiv = document.createElement('div');
    categoryDiv.classList.add('col-6', 'd-flex', 'mt-2');
    categoryDiv.innerHTML = `
        <h6>Kategori: <span style="opacity: 0.7">${product['category_name']}</span></h6>
    `;
    productBodyRow.appendChild(categoryDiv);

    const brandDiv = document.createElement('div');
    brandDiv.classList.add('col-6', 'd-flex', 'mt-2');
    brandDiv.innerHTML = `
        <h6>Marka: <span style="opacity: 0.7">${product['brand_name']}</span></h6>
    `;
    productBodyRow.appendChild(brandDiv);

    Object.entries(data).forEach(([key, value]) => {
        let dataKey = '';
        switch (key) {
            case 'size':
                dataKey = 'Beden';
                break;
            case 'male':
                dataKey = 'Cinsiyet';
                value = value === 1 ? 'Kadın' : 'Erkek';
                break;
            case 'person_count':
                dataKey = 'Kişi sayısı';
                break;
            case 'material':
                dataKey = 'Materyal';
                break;
            case 'style':
                dataKey = 'Tip';
                break;
            case 'formType':
                dataKey = 'Form Tipi';
                break;
            case 'skinType':
                dataKey = 'Cilt Tipi';
                break;
            case 'bindType':
                dataKey = 'Bağlama Şekli';
                break;
            case 'color':
                dataKey = 'Renk';
                break;
            default:
                dataKey = '';
                break;
        }

        if (dataKey !== '') {
            const attributeDiv = document.createElement('div');
            attributeDiv.classList.add('col-6', 'd-flex', 'mt-2');
            attributeDiv.innerHTML = `
                <h6>${dataKey}: <span style="opacity: 0.7">${value}</span></h6>
            `;
            productBodyRow.appendChild(attributeDiv);
        }
    });

    // Create and append a horizontal rule
    const hr = document.createElement('hr');
    hr.style.width = '100%';
    hr.classList.add('mt-3');
    productBodyRow.appendChild(hr);
}


function addDebitOrAdress() {
    var form = document.getElementById('modalForm');
    var formData = new FormData(form);
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var url = "";
    if (form.dataset.key == "debit") {
        url = 'http://stildeposu.test/add-debit';
    } else if (form.dataset.key == "adress") {
        url = 'http://stildeposu.test/add-adress';
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
            var modal = bootstrap.Modal.getInstance(document.getElementById('modal'));
            modal.hide();
            location.reload();
        } else {
            toastr.error(data.message);
        }
    })
    .catch(error => {
        toastr.error('Bir hata oluştu.');
        console.error('Error:', error);
    });
}

function deleteDebitOrAddress(event) {
    event.preventDefault();
    const target = event.currentTarget;
    const index = target.getAttribute('data-id');
    var formData = new FormData();
    formData.append('index', index);

    var url = "";
    if (target.getAttribute('data-key') == "debit") {
        url = 'http://stildeposu.test/delete-debit';
    } else if (target.getAttribute('data-key') == "adress") {
        url = 'http://stildeposu.test/delete-adress';
    } else if (target.getAttribute('data-key') == "comment") {
        url = 'http://stildeposu.test/user/delete-comment';
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
            location.reload();
        } else {
            toastr.error(data.message);
        }
    })
    .catch(error => {
        toastr.error('Bir hata oluştu.');
        console.error('Error:', error);
    });
}

