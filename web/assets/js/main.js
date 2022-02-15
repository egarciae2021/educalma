/*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) => {
    const toggleBtn = document.getElementById(headerToggle),
        nav = document.getElementById(navbarId)

    // Validate that variables exist
    if (headerToggle && navbarId) {
        toggleBtn.addEventListener('click', () => {
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu-dashboard')
                // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle', 'navbar')





/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link-dashboard')

function colorLink() {
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))





/*==================== COURSE ====================*/
const showModal = (openButton, modalContent) => {
    const openBtn = document.getElementById(openButton),
        modalContainer = document.getElementById(modalContent)

    if (openBtn && modalContainer) {
        openBtn.addEventListener('click', () => {
            modalContainer.classList.add('show-modal')
        })
    }
}
showModal('open-modal', 'modal-container')

/*=============== CLOSE MODAL ===============*/
const closeBtn = document.querySelectorAll('.close-modal')

function closeModal() {
    const modalContainer = document.getElementById('modal-container')
    modalContainer.classList.remove('show-modal')
}
closeBtn.forEach(c => c.addEventListener('click', closeModal))








/*=============== MODAL 2===============*/
const showModal1 = (openButton1, modalContent1) => {
    const openBtn1 = document.getElementById(openButton1),
        modalContainer1 = document.getElementById(modalContent1)

    if (openBtn1 && modalContainer1) {
        openBtn1.addEventListener('click', () => {
            modalContainer1.classList.add('show-modal1')
        })
    }
}
showModal1('open-modal1', 'modal-container1')

/*=============== CLOSE MODAL ===============*/
const closeBtn1 = document.querySelectorAll('.close-modal1')

function closeModal1() {
    const modalContainer1 = document.getElementById('modal-container1')
    modalContainer1.classList.remove('show-modal1')
}
closeBtn1.forEach(c => c.addEventListener('click', closeModal1))







/*=============== MODAL 3===============*/
const showModal2 = (openButton2, modalContent2) => {
    const openBtn2 = document.getElementById(openButton2),
        modalContainer2 = document.getElementById(modalContent2)

    if (openBtn2 && modalContainer2) {
        openBtn2.addEventListener('click', () => {
            modalContainer2.classList.add('show-modal2')
        })
    }
}
showModal2('open-modal2', 'modal-container2')

/*=============== CLOSE MODAL ===============*/
const closeBtn2 = document.querySelectorAll('.close-modal2')

function closeModal2() {
    const modalContainer2 = document.getElementById('modal-container2')
    modalContainer2.classList.remove('show-modal2')
}
closeBtn2.forEach(c => c.addEventListener('click', closeModal2))









/*=============== MODAL 4===============*/
const showModal3 = (openButton3, modalContent3) => {
    const openBtn3 = document.getElementById(openButton3),
        modalContainer3 = document.getElementById(modalContent3)

    if (openBtn3 && modalContainer3) {
        openBtn3.addEventListener('click', () => {
            modalContainer3.classList.add('show-modal3')
        })
    }
}
showModal3('open-modal3', 'modal-container3')

/*=============== CLOSE MODAL ===============*/
const closeBtn3 = document.querySelectorAll('.close-modal3')

function closeModal3() {
    const modalContainer3 = document.getElementById('modal-container3')
    modalContainer3.classList.remove('show-modal3')
}
closeBtn3.forEach(c => c.addEventListener('click', closeModal3))