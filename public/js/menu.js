


function showTreeParent(el) {
    // let children = $(el).find(".drop-down");
    // $(".drop-down").fadeOut();
    // $(children).fadeIn();
    // let dpopend = $('.dropend');
    //     let dropDown = $('.drop-down');
    //    let elChild = el.querySelector('ul');
    //    let elParent = el.closest('.drop-down');
    //    let hasBlock = elChild.style.display;
    //    if (!hasBlock.includes('block')){
    //     dropDown.fadeOut();
    //    }
    //     if (el.classList.contains('pp')){
    //        // dropDown.fadeOut();
    //     }
    //     console.log(elParent);
    //     console.log(hasBlock);
    //     $(elChild).fadeIn();

    // $(el).click(function(){
    //     let elChild = el.querySelector('ul');
    //     let elParent = el.closest('.drop-down');
    //     console.log(el);
    //     $(elChild).fadeIn();
    // })
}

document.addEventListener('livewire:navigated', () => {
document.querySelector('.catalog').onclick  = function(event){
    console.log(event);
    if(event.target.nodeName !== 'LI') return;
    closeAllSubMenu(event.target.lastElementChild);
    //event.target.classList.add('menu-bg');
    event.target.lastElementChild.classList.toggle('d-block');
;}

function closeAllSubMenu(current = null){
    let parents = [];
    if (current){
       // console.dir(current);
       let currentParent = current.parentNode;
       while(currentParent){
        if (currentParent.classList.contains('catalog')) break;
        if (currentParent.nodeName === 'UL') parents.push(currentParent);
        currentParent = currentParent.parentNode;
       }
    }
    const subMenu = document.querySelectorAll('.catalog ul');
    Array.from(subMenu).forEach(item => {
        if(item != current && !parents.includes(item)) {
            item.classList.remove('d-block');
            // if(item.firstElementChild.nodeName === 'LI'){
            //     item.firstElementChild.classList.remove('menu-bg');
            // }
        }
    });
}})