document.getElementById('questionBar').addEventListener('click', function()  {
    let container = document.getElementById('inputContainer');
    container.classList.remove('hidden'); // Remove the 'hidden' class
    container.classList.add('flex', 'fixed'); // Add 'flex' and 'fixed' classes
})

document.getElementById('btnCancel').addEventListener('click', function(event)  {
    event.preventDefault(); // prevent form submission
    let container = document.getElementById('inputContainer');
    container.classList.add('hidden'); // Add the 'hidden' class
    container.classList.remove('flex', 'fixed'); // Remove 'flex' and 'fixed' classes
})
