const btnMore = document.querySelector('.btn-more');

btnMore.style.display = "none"

const typeSelect = document.querySelector('.type-select')
typeSelect.addEventListener('change', (e) => {
    if(typeSelect.value == 'multiplicity'){
        btnMore.style.display = "block"
    }
});
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
