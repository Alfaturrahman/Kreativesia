const jumpToTopButton = document.getElementById('jump-to-top');

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        jumpToTopButton.style.display = 'block';
    }else {
        jumpToTopButton.style.display = 'none';
    }
});
jumpToTopButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

$(document).ready(function() {
    const currentPath = window.location.pathname;

    $('.nav-link').each(function() {
        const linkPath = $(this).attr('href');
        if (currentPath === linkPath) {
            $(this).addClass('active');
        }
    });
});

function enableinput() {
    var inputFields = document.getElementsByClassName("buka");
    var editButton = document.getElementById("editButton");
    var x = document.getElementsByClassName("unedit");
    if (inputFields[0].disabled) {
        // jika input field dalam keadaan non-aktif
        for (var y = 0; y < x.length; y++) {
            x[y].disabled = false;
        }
        for (var i = 0; i < inputFields.length; i++) {
            inputFields[i].disabled = false;
            inputFields[i].readOnly = false;
        }
        editButton.innerHTML = '<i class="fa-solid fa-times"></i> Cancel Edit';
    } else {
        // jika input field dalam keadaan aktif
        for (var y = 0; y < x.length; y++) {
            x[y].disabled = true;
        }
        for (var i = 0; i < inputFields.length; i++) {
            inputFields[i].disabled = true;
            inputFields[i].readOnly = true;
        }
        editButton.innerHTML = '<i class="fa-solid fa-gear"></i> Edit';
    }
}
