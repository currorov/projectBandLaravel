
document.addEventListener('DOMContentLoaded', function () {
    const loansSection = document.getElementById('loansSection');
    const revisionsSection = document.getElementById('revisionsSection');
    const newLoanForm = document.getElementById('newLoanForm');
    const newRevisionForm = document.getElementById('newRevisionForm');
    const newLoanButton = document.getElementById('newLoanButton');
    const newRevisionButton = document.getElementById('newRevisionButton');
    const saveLoan = document.getElementById('saveLoan');

    newLoanButton.addEventListener('click', function () {
        loansSection.style.display = 'none';
        newLoanForm.style.display = 'block';
    });
    saveLoan.addEventListener('click', function () {
        loansSection.style.display = 'block';
        newLoanForm.style.display = 'none';
    });

    newRevisionButton.addEventListener('click', function () {
        revisionsSection.style.display = 'none';
        newRevisionForm.style.display = 'block';
    });
});


