document.querySelectorAll('.containerResponse').forEach(item => {
    item.addEventListener('click', function()  {
        let container = document.getElementById('inputContainer');

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

document.getElementById('btnCancel').addEventListener('click', function() {
    let container = document.getElementById('inputContainer')
    container.classList.remove('flex', 'fixed');
    container.classList.add('hidden');
})
