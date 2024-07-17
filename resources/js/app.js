import './bootstrap';





// console.log('saCat halos');

// document.addEventListener("livewire:load", function (event) {
//     console.log('saCat load');
//     initFlowbite();

// });

document.addEventListener('livewire:navigated', () => { 
    // initFlowbite();

    document.body.setAttribute('data-new-gr-c-s-check-loaded', '14.1186.0');
    document.body.setAttribute('data-gr-ext-installed', '');
        // Fungsi untuk mengatur ulang atribut yang hilang
        // function setAttributes() {
        //     // Menemukan semua elemen yang membutuhkan atribut
        //     var menuItems = document.querySelectorAll('.menu-item');
    
        //     menuItems.forEach(function(item) {
        //         item.setAttribute('data-kt-menu-trigger', "{default: 'click', lg: 'hover'}");
        //         item.setAttribute('data-kt-menu-placement', 'right-start');
        //     });
        // }
    
        // // Panggil fungsi ini setiap kali navigasi terjadi
        // Livewire.hook('message.processed', function(message, component) {
        //     setAttributes();
        // });
    
        // // Panggil fungsi ini saat pertama kali halaman dimuat
        // setAttributes();
    // });
    function setAttributes() {
        var menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(function(item) {
            item.setAttribute('data-kt-menu-trigger', "{default: 'click', lg: 'hover'}");
            item.setAttribute('data-kt-menu-placement', 'right-start');
        });
    }

    // Membuat observer untuk memantau perubahan pada DOM
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'attributes') {
                setAttributes();
            }
        });
    });

    // Menentukan elemen yang akan dipantau oleh observer
    observer.observe(document.body, {
        attributes: true,
        childList: true,
        subtree: true
    });

    // Memanggil fungsi saat pertama kali halaman dimuat
    setAttributes();
});



