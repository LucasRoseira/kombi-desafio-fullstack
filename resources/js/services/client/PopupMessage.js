export function showPopupMessage(message) {
    const popup = document.getElementById('popup-message');
    const text = document.getElementById('popup-text');
    if (!popup || !text) return;

    text.textContent = message;
    popup.style.display = 'flex';
}

export function closePopupMessage() {
    const popup = document.getElementById('popup-message');
    if (!popup) return;
    popup.style.display = 'none';
}

export function initPopupMessage() {
    const closeBtn = document.getElementById('popup-close');
    const popup = document.getElementById('popup-message');

    if (closeBtn) {
        closeBtn.addEventListener('click', closePopupMessage);
    }

    if (popup) {
        popup.addEventListener('click', (e) => {
            if (e.target.id === 'popup-message') {
                closePopupMessage();
            }
        });
    }
}
