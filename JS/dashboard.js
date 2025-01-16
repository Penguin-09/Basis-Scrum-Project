const accountOptions= document.querySelector('header .account-options');
const accountOptionsBtn = accountOptions.querySelector('button');

accountOptionsBtn.addEventListener('click', (event) => { 
    const accountOptionsList = accountOptions.querySelector('.dropdown');
    accountOptionsList.classList.toggle('show');
});

accountOptions.addEventListener('mouseover', (event) => { 
    const accountOptionsList = accountOptions.querySelector('.dropdown');
    accountOptionsList.classList.add('show');
});

accountOptions.addEventListener('mouseout', (event) => { 
    const accountOptionsList = accountOptions.querySelector('.dropdown');
    accountOptionsList.classList.remove('show');
});

