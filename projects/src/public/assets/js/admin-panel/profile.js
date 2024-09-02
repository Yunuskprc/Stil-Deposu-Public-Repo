/**
 * this function is called when the userinfo blade is rendered. Its purpose is to execute the codes that need to be executed in the DOMContentLoaded state.
 * @param {json} userInfo a userInfo object containing user information and returned from the server
 */
function initializeUserInfoPageLoaded(userInfo) {
    const selectElementDay = document.getElementById('daySelect');
    for (let i = 1; i <= 31; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        selectElementDay.appendChild(option);
    }

    const selectElementYear = document.getElementById('yearSelect');
    for (let i = 1940; i <= 2010; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        selectElementYear.appendChild(option);
    }

    const selectElementMonth = document.getElementById('monthSelect');
    const birthDate = new Date(userInfo.birth_date);

    if (birthDate) {
        document.getElementById('daySelect').value = birthDate.getDate();
        document.getElementById('monthSelect').value = birthDate.getMonth() + 1;
        document.getElementById('yearSelect').value = birthDate.getFullYear();
    }
}


/**
 *  this function is called when the Adres page blade is rendered. Its purpose is to execute the codes that need to be executed in the DOMContentLoaded state.
 * @param {*} route this parameter is the url variable to be used in fetch.
 * @param {*} userInfo  a userInfo object containing user information and returned from the server
 */
function initializeAdressPageLoaded(route, userInfo) {
    const addAddressLink = document.getElementById('addAddressLink');
    const addressModal = new bootstrap.Modal(document.getElementById('addressModal'));

    addAddressLink.addEventListener('click', function(event) {
        event.preventDefault();
        addressModal.show();
    });

    document.getElementById('addressForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        fetch(route, {
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
                location.reload();
            } else {
                toastr.error(data.message);
            }
        })
        .catch(error => {
            toastr.error('Bir hata oluştu.');
            console.error('Error:', error);
        });
    });
}


/**
 *  this function is called when the debit card page blade is rendered. Its purpose is to execute the codes that need to be executed in the DOMContentLoaded state.
 * @param {*} route this parameter is the url variable to be used in fetch.
 * @param {*} userInfo  a userInfo object containing user information and returned from the server
 */
function initializeDebitCardPageLoaded(route, userInfo) {
    const addAddressLink = document.getElementById('addAddressLink');
    const addressModal = new bootstrap.Modal(document.getElementById('addressModal'));

    addAddressLink.addEventListener('click', function(event) {
        event.preventDefault();
        addressModal.show();
    });

    document.getElementById('addressForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        fetch(route, {
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
                location.reload();
            } else {
                toastr.error(data.message);
            }
        })
        .catch(error => {
            toastr.error('Bir hata oluştu.');
            console.error('Error:', error);
        });
    });
}


/**
 *  this function is called when the image page blade is rendered. Its purpose is to execute the codes that need to be executed in the DOMContentLoaded state.
 * @param {*} route this parameter is the url variable to be used in fetch.
 * @param {*} userInfo  a userInfo object containing user information and returned from the server
 */
function initializeImagePageLoaded(routes, userInfo) {
    const buttons = document.querySelectorAll('.btn[data-action]');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const type = this.getAttribute('data-type');

            let fileInput;
            if (type === 'cardImage') {
                fileInput = document.getElementById('fileInputCardImage');
            } else if (type === 'logo') {
                fileInput = document.getElementById('fileInputLogo');
            }

            if (action === 'add') {
                fileInput.click();

                fileInput.onchange = function() {
                    const file = fileInput.files[0];
                    if (file) {
                        const formData = new FormData();
                        formData.append(type, file);

                        const url = type === 'cardImage' ? routes.addCardImage : routes.addLogo;

                        toastr.info('İşleminiz gerçekleştiriliyor. Lütfen Bekleyin!');
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
                            console.error('Hata:', error);
                            toastr.error('Bir hata oluştu!');
                        });
                    }
                };
            } else if (action === 'delete') {
                const url = type === 'cardImage' ? routes.deleteCardImage : routes.deleteLogo;

                toastr.info('İşleminiz gerçekleştiriliyor. Lütfen Bekleyin!');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ type: type })
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
                    console.error('Hata:', error);
                    toastr.error('Bir hata oluştu!');
                });
            }
        });
    });
}

// User info page functions

/**
 * this function assigns a request to the server with fetch to updates the user's user password
 */
function sellerPasswordUpdate() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const form = document.getElementById('sellerPaswordUpdate');
    const btnUpdatePassword = document.getElementById('passwordUpdateBtn');
    const url = btnUpdatePassword.getAttribute('data-url');
    const formData = new FormData(form);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
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


/**
 * this function assigns a request to the server with fetch to updates the user's user information
 */
function sellerProfileInfoUpdate() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const form = document.getElementById('sellerInfoUpdateForm');
    const btnUpdateInfo = document.getElementById('userInfoUpdateBtn');
    const url = btnUpdateInfo.getAttribute('data-url');
    const formData = new FormData(form);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
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

// Mail verify page functions

/**
 * this function assigns a request to the server with fetch to check the verification code
 */
function checkVerificationCode() {
    const verificationCode = document.getElementById("verificationCode").value;
    const formData = new FormData();
    formData.append('verificationCode', verificationCode);
    const btnCheck = document.getElementById('btnmailVerifyCehck');
    const url = btnCheck.getAttribute('data-url');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.json();
    })
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

function showToast() {
    toastr.success('Mail adresi daha önceden doğrulanmış!');
}

/**
 * this function assigns a request to the server with fetch to send the verification code mail
 */
function sendVerificationCode() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const btnGenerateCode = document.getElementById('btngenerateMailCode');
    const url = btnGenerateCode.getAttribute('data-url');

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
        } else {
            toastr.error(data.message);
        }
    })
    .catch(error => {
        toastr.error('Bir hata oluştu.');
        console.error('Error:', error);
    });

    document.getElementById("verificationCodeSection").style.display = "block";
}

// Debit card page functions
/**
 * this function assigns a request to the server with fetch to delete the user debit card
 */
function deleteCards(event) {
    event.preventDefault();
    const selectedCards = [];
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('input[name="select-card"]:checked').forEach(function(card) {
        selectedCards.push(card.value);
    });

    if (selectedCards.length > 0) {
        const btnDeleteSelected = document.getElementById('deleteSelectedCards');
        const url = btnDeleteSelected.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cardIds: selectedCards })
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
            console.error('Error:', error);
            toastr.error('Bir hata oluştu.');
        });
    } else {
        toastr.warning('Lütfen silmek istediğiniz kartları seçin.');
    }
}


//Adress Page functions
/**
 * this function assigns a request to the server with fetch to delete the user adress
 */
function deleteAddress(event) {
    event.preventDefault();
    const target = event.currentTarget;
    const index = target.getAttribute('data-id');
    const url = target.getAttribute('data-url');
    var formData = new FormData();
    formData.append('index', index);
    for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
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
