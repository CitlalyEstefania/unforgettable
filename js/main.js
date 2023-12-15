// import { Cropper } from '../node_modules/cropperjs/dist/cropper.js';

const navItems = document.querySelector('.nav__items');
const openNavBtn = document.querySelector('#open__nav-btn');
const closeNavBtn = document.querySelector('#close__nav-btn');

// opens nav dropdown
const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block';
}

// close nav dropdown
const closeNav = () => {
    navItems.style.display = 'none';
    openNavBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';
}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);

// PROFILE SECTIONS

 //========== FUNCTION TO FILTER THE EMAIL ==========
function filterEmail(email){
    splits = email.split('@');
    username = splits[0];
    domain = splits[1];
    username_filtered = username.substring(0, 2) + '*'.repeat(username.length - 2);
    return username_filtered + '@' + domain;
}

const email = document.getElementById('filtered-email');
document.getElementById('filtered-email').innerHTML = filterEmail(email.getAttribute('data-email'));
email.removeAttribute('data-email');

 //========== INITIALIZE THE INFO PROFILE AND HIDE THE POSTS ==========
const sections_info = document.querySelector('#list-info-section');
const sections_post = document.querySelector('#list-post-section');

const div_info = document.querySelectorAll('#info-section');
const div_post = document.querySelectorAll('#post-section');
const div_post_warning = document.querySelectorAll('#post-section-warning');

let flaged = document.getElementById('post-section-flag').getAttribute('data-flag');
parseInt(flaged);
    //========== FUNCTION TO HIDE (use querySelector) ==========
function hideFamily(element){
    children = element.querySelectorAll('*');
    displayList = [];

    children.forEach(child => {
        displayList.push(child.classList.contains('hidden') ? 'hidden' : 'visible');
        child.classList.add('hidden');
    })

    displayList.push(element.classList.contains('hidden') ? 'hidden' : 'visible');
    element.classList.add('hidden');

    return displayList;
}
function showFamily(element, list){
    element.classList.remove('hidden');
    children = element.querySelectorAll('*');

    children.forEach((child, index) => {
        if (list[index] === 'visible') {
            child.classList.remove('hidden');
        } else {
            child.classList.add('hidden');
        }
    });
}

    //========== FUNCTION TO HIDE (use querySelectorAll) ==========
function hide_eParent(id){
    id.forEach(element => {
        element.style.display = 'none';
    });
}
function show_eParent(id, display = ''){
    id.forEach(element => {
        element.style.display = display;
    });
}

hide_eParent(div_post);
hide_eParent(div_post_warning);

 //========== EVENTS TO SHOW AND HIDE THE RESPECTIVE SECTION ==========
sections_info.addEventListener('click', (e) => {
    show_eParent(div_info);
    hide_eParent(div_post);
    hide_eParent(div_post_warning);
})

sections_post.addEventListener('click', (e) => {
    if(flaged == 1){
        hide_eParent(div_info);
        show_eParent(div_post);
        hide_eParent(div_post_warning);
    }else{
        hide_eParent(div_info);
        hide_eParent(div_post);
        show_eParent(div_post_warning);
    }
})

 //========== INITIALIZE THE CROP IMAGE POPUP ==========
function cropperInit(image){
    cropper = new Cropper(image, {
        dragMode: 'move',
        aspectRatio: 1,
        autoCropArea: 1,
        restore: false,
        guides: false,
        center: false,
        highlight: false,
        cropBoxMovable: false,
        // cropBoxResizable: false,
        toggleDragModeOnDblclick: false,
        background: 0,
        viewMode: 1,
    });
}

const image = document.querySelector('.crop-image.img');
let tempImg, divError, pMessage;

const div_popUp = document.querySelector('#edit-image-popUp');
const overlay = document.querySelectorAll('#overlay');
const messages_container = document.getElementById('profile-messages-containers');


const divConImgCrop = document.getElementById('crop-image-container');

const list_popUp = hideFamily(div_popUp);
hide_eParent(overlay);

const edit_img = document.getElementById('img-profile-img');
const btn_close = document.getElementById('close-popUp');

 
edit_img.addEventListener('click', () => {
    showFamily(div_popUp, list_popUp);
    show_eParent(overlay);
    cropperInit(image);
})

 //========== HIDE/CLOSE THE CROP IMAGE POPUP ==========
overlay.forEach(element => {
    element.addEventListener('click', () => {
        btn_close.click();
    })
});

btn_close.addEventListener('click', () => {
    cropper.destroy();
    tempImg?.parentNode?.removeChild(tempImg);
    hideFamily(div_popUp);
    hide_eParent(overlay);
});

  //==========RESTORE THE CROP BOX==========
const inputImg = document.getElementById('input-profile-image');
const inputFile = document.getElementById('input-profile-file');
const inputFileBlob = document.getElementById('canvasBlob');

const btn_submit = document.getElementById('btn-submit-showed');
const btn_restore = document.getElementById('restore-profile');

const form = document.forms['form-crop-image'];

btn_restore.addEventListener('click', () => {
    cropper.destroy();
    divConImgCrop.querySelectorAll('*').forEach(element => {
        if (element.tagName === 'IMG' && element.classList.contains('hidden') === false) {
            cropperInit(element);
        }
    });
});

  //========== MESSAGES ERROR ==========
function messageError(message){
    divError = document.createElement('div');
    divError.classList.add('alert__message', 'error', 'container', 'alert__message-profile');
    pMessage = document.createElement('p');
    pMessage.textContent = message;
    divError.appendChild(pMessage);

    return divError;
};
if (messages_container.firstChild) {
    document.addEventListener('click', () => {
        messages_container.firstChild?.remove();
    });
}

  //========== UPLOAD A NEW IMAGE ==========
inputImg.addEventListener('click', (e) => {
    inputFile.click();
    // e.preventDefault();
});
inputFile.addEventListener('change', (e) => {
    const file = e.target.files;

    if (file.length > 0) {
        const reader = new FileReader();

        reader.addEventListener('load', () => {
            // console.log(inputFile.files[0])
            const temp_read = reader.result;
            if (/^data:image\/\w+;/.test(temp_read) && /^data:image\/(png|jpg|jpeg);base64,/.test(temp_read)) {
                HiddenImageEvent();
                tempImg?.parentNode?.removeChild(tempImg) || tempImg?.remove();
                tempImg = document.createElement('img');
                divConImgCrop.appendChild(tempImg);
                tempImg.src = reader.result;
                // console.log(tempImg.src);
                cropperInit(tempImg);
            } else {
                btn_close.click();
                messages_container.appendChild(messageError('La imagen no es valida'));
                console.log('The file is not an image');
                return;
            }
        });

        reader.addEventListener('error', () => {
            btn_close.click();
            messages_container.appendChild(messageError('Hubo un problema al cargar su imagen, por favor intntelo de nuevo mas tarde'));
            console.log('Error: 1. Invalid file format 2. File not found 3. File too big 4. Network error 5. Other');
            return;
        });

        reader.readAsDataURL(file[0]);
    }
});

function HiddenImageEvent() {
    cropper.destroy();
    image.classList.add('hidden');
    if (tempImg) {
        tempImg.classList.add('hidden');
    }
};

 //========== CROP THE IMAGE AND PASS THE DATA IN THE FORM LOGIC ==========
btn_submit.addEventListener('click', () => {
    inputFileBlob.click();
});

inputFileBlob.addEventListener('click', e => {
    e.preventDefault();
    const canvas = cropper.getCroppedCanvas();
    canvas.toBlob((blob) => {
        url = URL.createObjectURL(blob);
        var readerBlob = new FileReader();
        readerBlob.readAsDataURL(blob);
        readerBlob.onloadend = function() {
            var base64data = readerBlob.result;
            // console.log(base64data);
            inputFileBlob.value = base64data;
            form.submit();
        }
    });
})

form.addEventListener('submit', e => {
    e.preventDefault();
    const formData = e.target.formData;

    fetch(form.action, {
        method: form.method,
        body: formData,
    }) .then(response => {
        console.log(response);
    }) .catch(error => {
        console.log(error);
    });
});

 //========== PROFILE EDIT FORM HIDE/SHOW ==========
const form_edit_profile = document.getElementById('info-section_form');
const parent_profile_info = document.querySelector('.info-section_labels.info-section_values');

const btn_edit_profile_show = document.getElementById('info-section_edit-btn');
const btn_edit_profile_hide = document.getElementById('btn-cancel_form_edit_profile');

btn_edit_profile_show.addEventListener('click', () => {
    parent_profile_info.style.justifyContent = 'space-around';
    showFamily(form_edit_profile ,form_edit_profileList);
});

btn_edit_profile_hide.addEventListener('click', (e) => {
    e.preventDefault();
    parent_profile_info.style.justifyContent = 'flex-start';
    hideFamily(form_edit_profile);
});

 //========== PROFILE FORM SUCCESS/ERROR POPUP/MESSAGE_CONTAINER ==========
const form_edit_profile_popUp = document.getElementById('info-section_form-popUp');
const overlay2 = document.querySelectorAll('#overlay2');

const btn_close_form_edit_profile_popUp = document.getElementById('btn-cancel_form_edit-popUp_profile');

const form_edit_profile_inputMode = document.getElementById('info-section_form-modes');
let edit_prifile_mode = form_edit_profile_inputMode.value;

const form_edit_profile_popUpList = hideFamily(form_edit_profile_popUp);
hide_eParent(overlay2);

parent_profile_info.style.justifyContent = 'flex-start';
const form_edit_profileList = hideFamily(form_edit_profile);

if (edit_prifile_mode === "mode1") { //Second mode: mean the edit is interrupted by error
    parent_profile_info.style.justifyContent = 'space-around';
    showFamily(form_edit_profile ,form_edit_profileList);
} if (edit_prifile_mode === "mode2") { //Third mode: mean the edit is successful
    parent_profile_info.style.justifyContent = 'space-around';
    showFamily(form_edit_profile ,form_edit_profileList);
    showFamily(form_edit_profile_popUp ,form_edit_profile_popUpList);
    show_eParent(overlay2);
}

btn_close_form_edit_profile_popUp.addEventListener('click', (e) => {
    e.preventDefault();
    location.reload();
});

overlay2.forEach(overlay => {
    overlay.addEventListener('click', () => {
        btn_close_form_edit_profile_popUp.click();
    });
});

// ========== COMMENTS IN SINGLE POSTS SCRIPTS ==========
// function GetEditMode(dataValue){
//     splits = dataValue.split(',');
//     mode = splits[0];
//     user_id = splits[1];
//     return [mode, user_id];
// }
// const edit_div = document.querySelector('#comment_body__form_edit-mode');

// const btn_edit_mode = document.getElementById('btn-editMode_Ini');
// let edit_modeArray = GetEditMode(edit_div.dataset.edit);
// let edit_mode = edit_modeArray[0];

// btn_edit_mode.addEventListener('click', (e) => {
//     e.preventDefault();
//     edit_div.dataset.edit = '1';
// });

// edit_div.forEach( e => {
//     switch (edit_mode){
//         case '0':
//             if (e.element === 'p'){
//                 e.style.display = '';
//             } if (e.element === 'form'){
//                 e.style.display = 'none';
//             }
//             break;
//         case '1':
//             if (e.element === 'p'){
//                 e.style.display = 'none';
//             } if (e.element === 'form'){
//                 e.style.display = '';
//             }
//             break;
//     }
// });


// NOTA:
// 1. PONGAN TODO LO QUE ESTE DEBAJO DE ESTE COMENTARIO, HASTA EL FINAL DEL ARCHIVO.
// 2. SI VAN A AGREGAR ALGO, AGREGUENLO ARRIBA DE ESTE COMENTARIO.
// 3. EN LA CONSOLA LES VA A SALIR UN ERROR, PERO NO SE PREOCUPEN, ES PORQUE EL 
// EVENTO LISTENER LO MARCA COMO VACIO, PERO VA BIEN.
// 4. SI VAN A AGREGAR ALGO DEBAJO, VA A PARAR DE LEER EL CODIGO POR EL ERROR DEL PUNTO 3
// HACIENDO QUE SU CODIGO NO FUNCIONE. SIGAN EL PUNTO 1 Y 2 PARA QUE FUNCIONE.
const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide__sidebar-btn');

// shows sidebar on small devices
const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}
// hides sidebar on small devices
const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click', showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);

