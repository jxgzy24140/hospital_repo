const outForm = document.querySelector(".out-patient-form");
const inForm = document.querySelector(".in-patient-form");
function selectFormInput(a) {
  if (a == 1) {
    outForm.classList.remove("show");
    outForm.classList.add("hide");
    inForm.classList.remove("hide");
    inForm.classList.add("show");
  }
  if (a == 0) {
    outForm.classList.remove("hide");
    outForm.classList.add("show");
    inForm.classList.remove("show");
    inForm.classList.add("hide");
  }
}
const medArr = [];
const deleteMed = (index) => {
    const medElement = document.querySelector(".medications");
    medElement.innerHTML = ''
    medArr.splice(index, 1)
    medArr.forEach(item => {
        const index = medArr.length-1
        const liElement = document.createElement('li')
        liElement.innerHTML = `<span>${item}</span><span><i onclick="deleteMed(${index})" class="fa-solid fa-xmark"></i></span>`
        liElement.style.padding = '0 4px'
        liElement.style.listStyle = 'none'
        medElement.appendChild(liElement)
    })
}
const addMed = (name) => {
    const medElement = document.querySelector(".medications");
    if(!medArr.includes(name)) {
        medArr.push(name)
        const index = medArr.length-1
        const liElement = document.createElement('li')
        liElement.innerHTML = `<span>${name}</span><span><i onclick="deleteMed(${index})" class="fa-solid fa-xmark"></i></span>`
        liElement.style.padding = '0 4px'
        liElement.style.listStyle = 'none'
        medElement.appendChild(liElement)
    }
};
