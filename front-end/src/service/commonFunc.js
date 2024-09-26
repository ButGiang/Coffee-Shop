export const commonFunc = {
    // reload website
    reloadPage() {
        window.location.reload();
    },
    
    // display the loading bar
    showProgressBar() {
        document.getElementById('progressBar').style.display = 'block';
    },

    // hide the loading bar
    hideProgressBar() {
        document.getElementById('progressBar').style.display = 'none';
    },

    // display the alert popup
    showAlert(title, msg, callback = null) {
        const alertPopup = document.getElementById('alertPopup');
        const alertTitle = document.getElementById('alertPopup_title');
        const alertMsg = document.getElementById('alertPopup_msg');
        const alertBtn = document.getElementById('alertPopup_btn');

        alertTitle.innerHTML = title;
        alertMsg.innerHTML = msg;
        alertPopup.style.display = 'block';
        alertBtn.focus();

        alertBtn.addEventListener('click', () => {
            alertPopup.style.display = 'none';
            if (callback) 
                callback();         
        });
    },

    // display the confirm popup
    showConfirm(title, msg, callback = null) {
        const confirmPopup = document.getElementById('confirmPopup');
        const confirmTitle = document.getElementById('confirmPopup_title');
        const confirmMsg = document.getElementById('confirmPopup_msg');
        const confirmBtn = document.getElementById('confirmPopup_btn');
        const cancelBtn = document.getElementById('cancelConfirmPopup_btn');

        confirmTitle.innerHTML = title;
        confirmMsg.innerHTML = msg;
        confirmPopup.style.display = 'block';
        confirmBtn.focus();

        confirmBtn.addEventListener('click', () => {
            confirmPopup.style.display = 'none';
            if (callback) 
                callback();         
        });

        cancelBtn.addEventListener('click', () => {
            confirmPopup.style.display = 'none'; 
        });
    },

    // validate the email format 
    isValidEmail(email) {
        return email.match(/^[a-zA-Z0-9]+([-.\w])+\w+@([\w-]+\.)+[a-zA-Z0-9]{2,}$/g);
    },

    // validate the datetime format 
    formatDateTime(dateTime) {
        var dt = new Date(dateTime);
        var formattedDateTime = dt.toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh', hour12: false });
        return formattedDateTime;
    }
}