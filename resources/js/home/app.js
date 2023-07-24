document.querySelectorAll('.containerResponse').forEach(item => {
    item.addEventListener('click', function()  {
        let container = document.getElementById('inputContainerResponse');

        let username = item.dataset.username;
        let questionTitle = item.dataset.questiontitle;
        let questionId = item.dataset.questionid;
        console.log('questionId', questionId);


        container.querySelector('.userNameQuestion').textContent = username;
        container.querySelector('.titleQuestion .font-semibold').textContent = questionTitle;
        container.querySelector('.question_id').value = questionId;

        container.classList.remove('hidden'); // Remove the 'hidden' class
        container.classList.add('flex', 'fixed'); // Add 'flex' and 'fixed' classes
    })
})

document.getElementById('btnCancelResponse').addEventListener('click', function() {
    let container = document.getElementById('inputContainerResponse')
    container.classList.remove('flex', 'fixed');
    container.classList.add('hidden');
})

document.getElementById('btnCloseResponse').addEventListener('click', function() {
    let container = document.getElementById('inputContainerResponse')
    container.classList.remove('flex', 'fixed');
    container.classList.add('hidden');
})



document.querySelectorAll('.containerQuestion').forEach(item => {
    item.addEventListener('click', function() {
        let container = document.getElementById('inputContainerQuestion');
        container.classList.remove('hidden'); // Remove the 'hidden' class
        container.classList.add('flex', 'fixed'); // Add 'flex' and 'fixed' classes
    })
})

document.getElementById('btnCancelQuestion').addEventListener('click', function() {
    let container = document.getElementById('inputContainerQuestion')
    container.classList.remove('flex', 'fixed');
    container.classList.add('hidden');
})

document.getElementById('btnCloseQuestion').addEventListener('click', function() {
    let container = document.getElementById('inputContainerQuestion')
    container.classList.remove('flex', 'fixed');
    container.classList.add('hidden');
})


let buttonsPlus = document.querySelectorAll('.contentPlusClick')

buttonsPlus.forEach(button => {

    button.addEventListener('click', function() {
        let container = this.parentElement.querySelector('.contentOverflow')
        container.classList.remove('overflow-hidden', 'max-h-[70px]');
        this.classList.add('hidden');
    })

})

let contentElements = document.querySelectorAll('.contentOverflow');

contentElements.forEach(contentElement => {
    console.log(contentElement);
    let lineHeight = parseInt(window.getComputedStyle(contentElement)['line-height']);
    console.log(lineHeight);
    let contentHeight = contentElement.scrollHeight;
    console.log(contentHeight);
    let numLines = contentHeight / lineHeight;
    console.log(numLines);
    let containerPlus = contentElement.parentElement.querySelector('.contentPlusClick')
    if (numLines > 3) {
        containerPlus.classList.add('block'); // show the Plus button
        containerPlus.classList.remove('hidden'); // show the Plus button
    }
});


let penLogo = document.querySelector('.penLogo')
let homeLogo = document.querySelector('.homeLogo')
let urlParams = window.location.href.slice(window.location.href.lastIndexOf('/')+1);
console.log(urlParams);
if (urlParams == 'home') {
    homeLogo.classList.add('border-b-4', 'border-black')
    penLogo.classList.remove('border-b-4', 'border-black')
}
else if (urlParams == 'response') {
    penLogo.classList.add('border-b-4', 'border-black')
    homeLogo.classList.remove('border-b-4', 'border-black')
}

document.getElementById('btnOpenImage').addEventListener('click', function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du navigateur.
    document.getElementById('image_path').click(); // Active l'input file.
});


// let petitPoint = document.querySelector('.petitPoints')
// let petitPointsContainer = document.querySelector('.petitPointsContainer')
// petitPoint.addEventListener('click', function() {
//     petitPointsContainer.classList.toggle('absolute')
//     petitPointsContainer.classList.toggle('hidden')
// })

// let searchBar = document.querySelector('.searchBar')

// searchBar.addEventListener('click', function() {
    
// })

function addMultipleListeners(element, events, handler) {
    // "events" est une chaîne de caractères contenant les noms des événements séparés par des espaces
    events.split(' ').forEach(function(event) {
        element.addEventListener(event, handler);
    });
}

let searchInput = document.getElementById('search-input');
let containerSearch = document.getElementById('searchBar');
let rechercher = document.getElementById('search-text');

// Ajoutez les écouteurs d'événements 'keyup' et 'click' à searchInput
addMultipleListeners(searchInput, 'keyup click', function(event) {
    if (event.type === 'keyup') {
        rechercher.textContent = "Rechercher : " + searchInput.value;
    } else if (event.type === 'click') {
        console.log('E');
        containerSearch.classList.remove('hidden');
    }
});