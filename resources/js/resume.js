/*!
* Start Bootstrap - Resume v7.0.6 (https://startbootstrap.com/theme/resume)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const sideNav = document.body.querySelector('#sideNav');
    if (sideNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#sideNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});


// document.getElementById('downloadImage').addEventListener('click', function () {
//     let indicator = document.getElementById('loadingIndicator');
//
//     // Show loading indicator
//     indicator.style.display = 'block';
//
//     // Start file download
//     fetch("{{ route('resume.download') }}")
//         .then(response => response.blob())
//         .then(blob => {
//             let link = document.createElement("a");
//             link.href = URL.createObjectURL(blob);
//             link.download = "CV_CHEBOTNIKOV.pdf"; // Set correct file name
//             document.body.appendChild(link);
//             link.click();
//             document.body.removeChild(link);
//
//             // Hide indicator after download
//             indicator.style.display = 'none';
//         })
//         .catch(error => {
//             console.error("Download failed:", error);
//             indicator.style.display = 'none';
//         });
// });
