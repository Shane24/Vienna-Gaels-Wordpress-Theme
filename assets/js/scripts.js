// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            
            // Toggle icon
            const icon = this.querySelector('.material-symbols-outlined');
            if (mobileMenu.classList.contains('hidden')) {
                icon.textContent = 'menu';
            } else {
                icon.textContent = 'close';
            }
        });
    }

    // Contact Form Handler
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(contactForm);
            formData.append('action', 'vienna_gaels_contact');
            formData.append('nonce', viennaGaelsAjax.nonce);
            
            const messageDiv = document.getElementById('form-message');
            
            try {
                const response = await fetch(viennaGaelsAjax.ajaxurl, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                messageDiv.classList.remove('hidden');
                if (result.success) {
                    messageDiv.className = 'p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100';
                    messageDiv.textContent = 'Thank you! Your message has been sent successfully.';
                    contactForm.reset();
                } else {
                    messageDiv.className = 'p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100';
                    messageDiv.textContent = 'Oops! Something went wrong. Please try again.';
                }
                
                setTimeout(() => {
                    messageDiv.classList.add('hidden');
                }, 5000);
                
            } catch (error) {
                messageDiv.classList.remove('hidden');
                messageDiv.className = 'p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100';
                messageDiv.textContent = 'Error sending message. Please try again.';
            }
        });
    }

    // Dark Mode Toggle (optional)
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        });
        
        // Check for saved preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    }

    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});