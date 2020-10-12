// require('./bootstrap');

/* ==__ All Custom JS Goes Here For Minification __== */

/* -- Email Verification Page -- */

function verifyEmailPage() {

    var verifyTimeLeft = 60;
    var verifyElem = document.getElementById('verifyTime');
    var verifyTimerId = setInterval(verifyCountdown, 1000);

    var verifyBtn = document.getElementsByName('resend')[0];
    verifyBtn.classList.add('cursor-not-allowed');
    verifyBtn.classList.add('opacity-75');
    verifyBtn.disabled = true;
        
    function verifyCountdown() {
        if (verifyTimeLeft == -1) {
            clearTimeout(verifyTimerId);
            verifyBtn.disabled = false;
            verifyBtn.classList.remove('cursor-not-allowed');
            verifyBtn.classList.remove('opacity-75');
            verifyBtn.classList.add('hover:bg-indigo-600');
            verifyElem.classList.remove('lg:flex');
            verifyElem.classList.add('hidden');
        } else {
            verifyElem.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="animate-spin icon icon-tabler icon-tabler-loader inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <line x1="12" y1="6" x2="12" y2="3" /> <line x1="16.25" y1="7.75" x2="18.4" y2="5.6" /> <line x1="18" y1="12" x2="21" y2="12" /> <line x1="16.25" y1="16.25" x2="18.4" y2="18.4" /> <line x1="12" y1="18" x2="12" y2="21" /> <line x1="7.75" y1="16.25" x2="5.6" y2="18.4" /> <line x1="6" y1="12" x2="3" y2="12" /> <line x1="7.75" y1="7.75" x2="5.6" y2="5.6" /></svg> please wait ' + verifyTimeLeft + 's';
            verifyTimeLeft--;
        }
    }

}

/* -- Application Complete Page -- */

function completeApplicationPage() {

    var completeTimeLeft = 5;
    var completeElem = document.getElementById('time');
    var completeTimerId = setInterval(completeCountdown, 1000);

    var completeBtn = document.getElementsByName('manual')[0];
    completeBtn.classList.add('cursor-not-allowed');
    completeBtn.classList.add('opacity-75');
    completeBtn.disabled = true;
        
    function completeCountdown() {
        if (completeTimeLeft == -1) {
            clearTimeout(completeTimerId);
            window.location.replace('/');
            completeBtn.disabled = false;
            completeBtn.classList.remove('cursor-not-allowed');
            completeBtn.classList.remove('opacity-75');
            completeBtn.classList.add('hover:bg-indigo-600');
        } else {
            completeElem.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="animate-spin icon icon-tabler icon-tabler-loader inline-block w-4 mr-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <line x1="12" y1="6" x2="12" y2="3" /> <line x1="16.25" y1="7.75" x2="18.4" y2="5.6" /> <line x1="18" y1="12" x2="21" y2="12" /> <line x1="16.25" y1="16.25" x2="18.4" y2="18.4" /> <line x1="12" y1="18" x2="12" y2="21" /> <line x1="7.75" y1="16.25" x2="5.6" y2="18.4" /> <line x1="6" y1="12" x2="3" y2="12" /> <line x1="7.75" y1="7.75" x2="5.6" y2="5.6" /></svg> all done, redirecting in ' + completeTimeLeft + 's';
            completeTimeLeft--;
        }
    }

}
