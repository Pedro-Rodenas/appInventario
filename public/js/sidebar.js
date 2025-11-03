const sidebar = document.getElementById('sidebar');

sidebar.addEventListener('mouseenter', () => {
    sidebar.classList.remove('minimized');
});

sidebar.addEventListener('mouseleave', () => {
    sidebar.classList.add('minimized');
});
