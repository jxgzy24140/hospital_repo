
const outForm = document.querySelector('.out-patient-form')
const inForm = document.querySelector('.in-patient-form')
function selectFormInput(a) {
    if(a==0) {
        outForm.classList.remove('hide')
        outForm.classList.add('show')
        inForm.classList.remove('show') 
    } else {
        inForm.classList.add('show') 
        outForm.classList.remove('show')
        outForm.classList.add('hide')
    }
}
