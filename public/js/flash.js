
document.addEventListener('livewire:navigated', () => {
let message = document.querySelector('.message');
let closeBtn = document.querySelector('.close-flash');
if (message) {


    let newspaperSpinning = [
        { transform: "scale(1)" },
        { transform: "scale(1)" },
        { transform: "scale(0)" },
        { transform: "scale(0)" },
        { transform: "scale(0)" },
        { transform: "scale(0)" },
    ];
    let newspaperTiming = {
        duration: 17000,
        iterations: 1,
    };

    setTimeout(() => {
        message.animate(newspaperSpinning, newspaperTiming);
    }, 1000)
    setTimeout(messageClose, 1000);

    let timerId;

    function messageClose() {
        message.animate(newspaperSpinning, newspaperTiming);
        timerId = setTimeout(() => {
            message.style.display = 'none';
        }, 8000);
    }
    function messagelive() {
        message.animate(newspaperSpinning, newspaperTiming);
        clearTimeout(timerId);
    }


    function messageCloseQuick() {
        message.style.display = 'none';
    }

    message.addEventListener('mousemove', messagelive);
    message.addEventListener('mouseleave', messageClose);
    closeBtn.addEventListener('click', messageCloseQuick);
}
});