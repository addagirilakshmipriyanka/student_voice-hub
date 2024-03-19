document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.sidebar ul li');

    sections.forEach(section => {
        section.addEventListener('click', async function() {
            const sectionId = this.id;
            const content = document.getElementById('main-content');

            try {
                const response = await fetch(`section${sectionId}.html`);
                const data = await response.text();
                content.innerHTML = data;
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
});
