const btnMore = document.querySelector('.btn-more');
if(btnMore){
    btnMore.style.display = "none"

    const typeSelect = document.querySelector('.type-select')
    typeSelect.addEventListener('change', (e) => {
        if(typeSelect.value == 'multiplicity'){
            btnMore.style.display = "block"
            const extractionSection = document.querySelectorAll('.extraction-section')

            btnMore.addEventListener('click', (e) => {

                const datas = document.querySelectorAll('.datas')

                const dataClone = datas[datas.length - 1].cloneNode(true);

                const id = datas.length +1;

                dataClone.querySelector('#dataName').name = "dataName["+id+"]"
                dataClone.querySelector('#dataType').name = "dataType["+id+"]"
                dataClone.querySelector('#dataPath').name = "dataPath["+id+"]"

                const seeMoreDiv = document.querySelector('.see-more')
                extractionSection[1].insertBefore(dataClone,seeMoreDiv)
            });

        } else {
            btnMore.style.display = "none"
            const datas = document.querySelectorAll('.datas')
            for(var i = 1; i < datas.length; i++){
                datas[1].style.display = "none"

            }
        }
    });
}


const passwordConfirm = document.querySelector('#passwordConfirm');
const password = document.querySelector('#password');

if(passwordConfirm){
    var btn = document.querySelector('.form-btn');
    btn.setAttribute("disabled", "");
    passwordConfirm.addEventListener('input', (e)=> {
        if(password.value == passwordConfirm.value){
            btn.removeAttribute("disabled");
        }
    });
}



function valideConnect() {
    const email = document.querySelector('#email');
    if (passwordConfirm) {
        const firstname = document.querySelector('#firstname')
        const lastname = document.querySelector('#lastname')
        return signUpVerif(firstname, lastname, email, password, passwordConfirm)
    } else {
        return loginVerif(email, password)
    }
}


function loginVerif(email, password) {
    if (password.value != "" && email.value != "") {
        return true
    } else {
        return error(email, password)
    }
}

function signUpVerif(firstname, lastname, email, password, passwordConfirm) {
    if (firstname.value != "" && lastname.value != "" && password.value != "" && email.value != "" && passwordConfirm.value != "") {
        return true
    } else {
        return error()
    }
}

function error() {
    let response = document.querySelector('.form-title + p')
    response.innerHTML = 'Tous les champs doivent être remplis !'
    return false
}



var aside = document.querySelector('.js-menu');
var menu = aside.querySelector('.menu');

var drowpdown = aside.querySelector('.dropdownMenu');

menu.addEventListener('click', (e) => {


    if(drowpdown.style.display == "block"){
        drowpdown.style.animationName = "close-menu";
        drowpdown.style.animationDuration = "0.5s";
        setTimeout(function(){ drowpdown.style.display = "none"; }, 505);
    } else {
        drowpdown.style.animationName = "open-menu";
        drowpdown.style.animationDuration = "0.5s";
        drowpdown.style.display = "block";
    }
})


function confirmDelete() {
    confirm("Are you sure ? This action is irreversible.");
}