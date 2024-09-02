/**
 *  This function dynamically generates the input tag for the product property
 *
 * @param {text} labelText - The text to be added in the label label.
 * @param {json} inputAttributes - This field waits for data containing input properties for input of the json - array type.
 * @returns {div} - Scope div returns.
 */
function createInputSection(labelText, inputAttributes) {
    // Kapsam Div Oluşturuluyor.
    let divCol5 = document.createElement('div');
    divCol5.classList.add('col-5', 'd-flex', 'align-items-center');
    divCol5.style.display = 'flex';
    divCol5.style.flexDirection = 'row';

    // Attr name içim h5 tagi oluşturuluyor
    let productName = document.createElement("h5");
    productName.classList.add('mt-5','col-2');
    productName.innerText = labelText;
    productName.style.flex = '0 0 auto';

    // Attr için input tagi oluşturuluyor
    let productNameInput = document.createElement('input');
    for (let key in inputAttributes) {
        productNameInput.setAttribute(key, inputAttributes[key]);
    }
    productNameInput.style.flex = '1 1 auto';
    productNameInput.style.marginLeft = '0.5rem';
    productNameInput.style.marginRight = '0.5rem';
    productNameInput.style.width = '85%';

    divCol5.appendChild(productName);
    divCol5.appendChild(productNameInput);

    return divCol5;
}


/**
 *  This function dynamically generates the input tag attributes
 *
 * @param {text} type - Input tag type Ex:text/password/file.
 * @param {text} id - Input tag id
 * @param {text} name - Input tag name
 * @param {text} placeholder - Input tag placehorder.
 * @returns {json} - Creates the required data set for the inputAttributes parameter of the createInputSection function
 */
function returnInputAttributes(type,id, name, placeholder) {
    return {
        type: type,
        id: id,
        name: name,
        placeholder: placeholder,
        class: 'form-control mt-5',
        required: 'true',
        multiple: 'true'
    };
}


/**
 *  This function dynamically generates the input tag for the product property
 *
 * @param {text} labelText - The text to be added in the label label.
 * @param {json} selectAttributes - This field waits for data containing select tag properties for input of the json - array type.
 * @param {json} options - This field waits for data select tag options
 * @returns {div} - Scope div returns.
 */
function createSelectSection(labelText, selectAttributes, options) {
    // Kapsam Div Oluşturuluyor.
    let divCol5 = document.createElement('div');
    divCol5.classList.add('col-5', 'd-flex', 'align-items-center');
    divCol5.style.display = 'flex';
    divCol5.style.flexDirection = 'row';

    // Attr name içim h5 tagi oluşturuluyor
    let productName = document.createElement("h5");
    productName.classList.add('mt-5','col-2');
    productName.innerText = labelText;
    productName.style.flex = '0 0 auto';

    // Attr için select tagi oluşturuluyor
    let productSelect = document.createElement('select');
    for (let key in selectAttributes) {
        productSelect.setAttribute(key, selectAttributes[key]);
    }
    productSelect.style.flex = '1 1 auto';
    productSelect.style.marginLeft = '0.5rem';
    productSelect.style.marginRight = '0.5rem';
    productSelect.style.width = '85%';

    // Select için optionlar foreach ile ekleniyor
    options.forEach(option => {
        let optionElement = document.createElement('option');
        optionElement.value = option.value;
        optionElement.innerText = option.text;
        productSelect.appendChild(optionElement);
    });

    divCol5.appendChild(productName);
    divCol5.appendChild(productSelect);

    return divCol5;
}

/**
 *  This function dynamically generates the select tag attributes
 *
 * @param {text} id - Select tag id
 * @param {text} name - Select tag name
 * @returns {json} - Creates the required data set for the select Attributes parameter of the createSelectSection function
 */
function returnSelectAttributes(id, name) {
    return {
        id: id,
        name: name,
        class: 'form-select mt-5',
        required: 'true'
    };
}


/**
 * This function creates a col-1 div to prevent code repetition
 *
 * @returns {div} col-1 div tag
 */
function createCol1Div() {
    let divCol2 = document.createElement('div');
    divCol2.classList.add('col-1', 'd-flex', 'align-items-center');

    return divCol2;
}

/**
 * creates a row to insert the input or select tags into it
 * @returns col d-flex align-items-center div tag
 */
function newRowColumn() {

    let rowDiv = document.createElement('div');
    rowDiv.className = 'row';

    let mainDiv = document.createElement('div');
    mainDiv.classList.add('col', 'd-flex', 'align-items-center');
    rowDiv.appendChild(mainDiv);

    document.getElementById('mainContent').appendChild(rowDiv);
    return mainDiv;
}


/**
 * This function creates custom input or select tags for the selected categories
 */
function categoryOnChanged() {
    const category_id = document.getElementById('category_id').value;
    let buttonsDiv = document.getElementById('buttonsDiv');

    const divMainAddProc = document.getElementById('addProcMainDiv');


    buttonsDiv.style.display = 'none';

    if (category_id === '0') {
        return;
    }

    const mainContent = document.getElementById('mainContent');
    mainContent.innerHTML = '';

    // Her koşul için yeni bir col1Div
    function createNewCol1Div() {
        return createCol1Div();
    }

    let mainDivProcNameDesc = newRowColumn();
    addProcName(mainDivProcNameDesc);
    mainDivProcNameDesc.append(createNewCol1Div());
    addLongDesc(mainDivProcNameDesc);

    let mainDiv;

    if ((category_id >= 1 && category_id <= 8) || (category_id >= 14 && category_id <= 15) || (category_id >= 65 && category_id <= 69)) {
        mainDiv = newRowColumn();
        addSize(mainDiv);
        mainDiv.append(createNewCol1Div());
        addMale(mainDiv);

    } else if (category_id >= 9 && category_id <= 13) {
        mainDiv = newRowColumn();
        addPersonCount(mainDiv);
        mainDiv.append(createNewCol1Div());
        addMaterial(mainDiv);

    } else if (category_id >= 25 && category_id <= 29) {
        if (category_id == 25) {
            mainDiv = newRowColumn();
            addSizeInput(mainDiv);
            mainDiv.append(createNewCol1Div());
            addStyleForCurtain(mainDiv);
        }

    } else if (category_id >= 30 && category_id <= 41) {
        mainDiv = newRowColumn();
        addFormTypeMakeUp(mainDiv);

    } else if (category_id >= 42 && category_id <= 51) {
        mainDiv = newRowColumn();
        addSkinType(mainDiv);
        mainDiv.append(createNewCol1Div());
        addFormTypeForCleanning(mainDiv);

    } else if (category_id >= 59 && category_id <= 64) {
        mainDiv = newRowColumn();
        addSizeInput(mainDiv);
        mainDiv.append(createNewCol1Div());
        addMale(mainDiv);

        let anotherDiv = newRowColumn();
        addMaterialForShoes(anotherDiv);
        anotherDiv.append(createNewCol1Div());
        addBindType(anotherDiv);

    }

    let mainDivColor = newRowColumn();
    addColor(mainDivColor);

    let mainDivStockPrice = newRowColumn();
    addStock(mainDivStockPrice);
    mainDivStockPrice.append(createNewCol1Div());
    addPrice(mainDivStockPrice);

    let mainDivPictureProduct = newRowColumn();
    addPictureProduct(mainDivPictureProduct);

    buttonsDiv.style.display = 'block';
}


/**
 * resets the input and select tags created when the page is refreshed
 */
function clearTagsText(){
    location.reload();
}




/**
 * Create input tag for product name
 * @param {div} mainDiv
 */
function addProcName(mainDiv) {
    let divCol5Name = createInputSection("Ürün Adı:", returnInputAttributes('text','proc_name', 'proc_name', 'Ürün Adı:'));
    mainDiv.append(divCol5Name);
}

/**
 * Create input tag for product description
 * @param {div} mainDiv
 */
function addLongDesc(mainDiv) {
    let divCol5LongDesc = createInputSection("Açıklama:", returnInputAttributes('text','proc_desc', 'proc_desc', 'Açıklama'));
    mainDiv.append(divCol5LongDesc);
}

/**
 * Create select tag for product size
 * @param {div} mainDiv
 */
function addSize(mainDiv) {
     let divCol5Size = createSelectSection('Beden:', returnSelectAttributes('size', 'size'), [
            { value: '', text: 'Seçiniz' },
            { value: 'xsmall', text: 'xsmall' },
            { value: 'small', text: 'small' },
            { value: 'medium', text: 'medium' },
            { value: 'large', text: 'large' },
            { value: 'xlarge', text: 'xlarge' },
            { value: 'xxlarge', text: 'xxlarge' }
     ]);

    mainDiv.append(divCol5Size);
}

/**
 * Create select tag for male
 * @param {div} mainDiv
 */
function addMale(mainDiv) {
     let divCol5Male = createSelectSection('Cinsiyet:', returnSelectAttributes('male', 'male'), [
            { value: '', text: 'Seçiniz' },
            { value: 0, text: 'Erkek' },
            { value: 1, text: 'Kadın' },
        ]);
    mainDiv.append(divCol5Male);
}

/**
 * Create input tag for product person count Ex:for 2,3,4,5 people
 * @param {div} mainDiv
 */
function addPersonCount(mainDiv) {
    let divCol5PersonCount = createInputSection('Kişi Sayısı:',returnInputAttributes('text','person_count','person_count','Kişi Sayısı:'));
    mainDiv.append(divCol5PersonCount);
}

/**
 * Create input tag for product material
 * @param {div} mainDiv
 */
function addMaterial(mainDiv) {
    let divCol5Material = createInputSection('Ürün Meteryal:',returnInputAttributes('text','material','material','Materyal Tipi:'));
    mainDiv.append(divCol5Material);
}

/**
 * Create input tag for product size Ex: 45*45 cm...
 * @param {div} mainDiv
 */
function addSizeInput(mainDiv) {
    let divCol5Size = createInputSection('Boyut/Ebat:',returnInputAttributes('text','size','size','Ürünün Boyutu:'));
    mainDiv.append(divCol5Size)
}

/**
 * Create select tag for curtain style
 * @param {div} mainDiv
 */
function addStyleForCurtain(mainDiv) {
    let divCol5Type = createSelectSection('Tip:', returnSelectAttributes('style', 'style'), [
                { value: '', text: 'Seçiniz' },
                { value: 'Tül Perde', text: 'Tül Perde' },
                { value: 'Fon Perde', text: 'Fon Perde' },
                { value: 'Stor Perde', text: 'Stor Perde' },
            ]);
    mainDiv.append(divCol5Type);
}

/**
 * Create select tag for make up products form
 * @param {div} mainDiv
 */
function addFormTypeMakeUp(mainDiv) {
    let divCol5FormType = createSelectSection('Form Tipi:',returnSelectAttributes('formType','formType'),[
            {value:'', text:'Belirtilmemiş'},
            {value:'Far', text:'Far'},
            {value:'Jel', text:'Jel'},
            {value:'Kalem', text:'Kalem'},
            {value:'Kompakt', text:'Kompakt'},
            {value:'Krem', text:'Krem'},
            {value:'Sıvı', text:'Sıvı'},
            {value:'Toz', text:'Toz'},
        ]);
    mainDiv.append(divCol5FormType);
}

/**
 * Create select tag for product skin type
 * @param {div} mainDiv
 */
function addSkinType(mainDiv) {
    let divCol5SkinType = createSelectSection('Cilt Tipi:',returnSelectAttributes('skinType','skinType'),[
            {value:'', text:'Belirtilmemiş'},
            {value:'Hassas', text:'Hassas'},
            {value:'Karma', text:'Karma'},
            {value:'Kuru', text:'Kuru'},
            {value:'Yağlı', text:'Yağlı'},
            {value:'Tüm Cilt Tipleri', text:'Tüm Cilt Tipleri'},
        ]);
    mainDiv.append(divCol5SkinType);
}

/**
 * Create select tag for cleaning product form type
 * @param {div} mainDiv
 */
function addFormTypeForCleanning(mainDiv) {
    let divCol5FormType = createSelectSection('Form Tipi', returnSelectAttributes('formType','formType'),[
            {value:'', text:'Belirtilmemiş'},
            {value:'Balm', text:'Balm'},
            {value:'Jel', text:'Jel'},
            {value:'Köpük', text:'Köpük'},
            {value:'Krem', text:'Krem'},
            {value:'Losyon', text:'Losyon'},
            {value:'Peeling', text:'Peeling'},
            {value:'Sıvı', text:'Sıvı'},
            {value:'Soyulabilen', text:'Soyulabilen'},
            {value:'Toz', text:'Toz'},
            {value:'Vazelin', text:'Vazelin'},
            {value:'Yağ', text:'Yağ'},
        ]);
        mainDiv.append(divCol5FormType)
}

/**
 * Create select tag for shoes product material
 * @param {div} mainDiv
 */
function addMaterialForShoes(mainDiv) {
    let col5Material = createSelectSection('Materyal:',returnSelectAttributes('material','material'),[
            {value:'',text:'Belirtilmemiş'},
            {value:'Deri',text:'Deri'},
            {value:'Keten',text:'Keten'},
            {value:'Hasır',text:'Hasır'},
            {value:'Kumaş',text:'Kumaş'},
            {value:'Mikrofiber',text:'Mikrofiber'},
            {value:'Pamuklu',text:'Pamuklu'},
            {value:'Polietilen',text:'Polietilen'},
            {value:'Polyester',text:'Polyester'},
            {value:'Rugan',text:'Rugan'},
            {value:'Saten',text:'Saten'},
        ]);
        mainDiv.append(col5Material);
}

/**
 * Create select tag for shoes product bind type
 * @param {div} mainDiv
 */
function addBindType(mainDiv) {
    let col5BindType = createSelectSection('Bağlama Şekli:',returnSelectAttributes('bindType','bindType'),[
            {value:'',text:'Belirtilmemiş'},
            {value:'Bağcıklı',text:'Bağcıklı'},
            {value:'Bağcıksız',text:'Bağcıksız'},
            {value:'Fermuarlı',text:'Fermuarlı'},
            {value:'Slip-on',text:'Slip-on'},
        ]);
    mainDiv.append(col5BindType);
}

/**
 * Create select tag for product color
 * @param {div} mainDiv
 */
function addColor(mainDiv) {
    let divCol5Color = createSelectSection('Renk:',returnSelectAttributes('color','color'),[
        { "value": "", "text": "Seçiniz" },
        { "value": "bej", "text": "Bej" },
        { "value": "beyaz", "text": "Beyaz" },
        { "value": "bordo", "text": "Bordo" },
        { "value": "ekru", "text": "Ekru" },
        { "value": "gri", "text": "Gri" },
        { "value": "haki", "text": "Haki" },
        { "value": "kahverengi", "text": "Kahverengi" },
        { "value": "kirmizi", "text": "Kırmızı" },
        { "value": "lacivert", "text": "Lacivert" },
        { "value": "mavi", "text": "Mavi" },
        { "value": "metalik", "text": "Metalik" },
        { "value": "mor", "text": "Mor" },
        { "value": "pembe", "text": "Pembe" },
        { "value": "sari", "text": "Sarı" },
        { "value": "siyah", "text": "Siyah" },
        { "value": "turkuaz", "text": "Turkuaz" },
        { "value": "turuncu", "text": "Turuncu" },
        { "value": "yesil", "text": "Yeşil" },
        { "value": "cok-renkli", "text": "Çok Renkli" }
    ]);
    mainDiv.append(divCol5Color);
}

/**
 * Create input tag for product stock
 * @param {div} mainDiv
 */
function addStock(mainDiv) {
    let divCol5Stock = createInputSection('Stok:',returnInputAttributes('text','stock','stock','Ürün stok miktarınızı girin.'));
    mainDiv.append(divCol5Stock);
}

/**
 * Create input tag for product price
 * @param {div} mainDiv
 */
function addPrice(mainDiv) {
    let divCol5Price = createInputSection('Fiyat:',returnInputAttributes('text','price','price','Ürünün fiyat bilgisini girin.'));
    mainDiv.append(divCol5Price);
}

/**
 * Create input tag for product picture
 * @param {div} mainDiv
 */
function addPictureProduct(mainDiv) {
    let divCol5Images = createInputSection('Ürün Resimleri:',returnInputAttributes('file','images','images[]','Ürünlerin resimlerini girin.'));
    mainDiv.append(divCol5Images);
}


