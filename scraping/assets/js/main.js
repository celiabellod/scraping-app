const btnMore = document.querySelector('.btn-more');
const extractionSection = document.querySelectorAll('.extraction-section');
btnMore.addEventListener('click', (e) => {
    const datas = document.querySelector('.datas');
    const dataClone = datas.cloneNode(true);
    const seeMoreDiv = document.querySelector('.see-more');
    extractionSection[1].insertBefore(dataClone,seeMoreDiv)
});
