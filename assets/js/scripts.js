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

    // Mobile Submenu Toggle
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const menuItem = this.closest('.mobile-menu-item');
            const submenu = menuItem.querySelector('.submenu-items');
            const icon = this.querySelector('.material-symbols-outlined');
            
            if (submenu) {
                const isCurrentlyOpen = !submenu.classList.contains('hidden');
                
                // Close all other submenus first
                document.querySelectorAll('.submenu-items').forEach(otherSubmenu => {
                    if (otherSubmenu !== submenu) {
                        otherSubmenu.classList.add('hidden');
                        const otherIcon = otherSubmenu.closest('.mobile-menu-item').querySelector('.submenu-toggle .material-symbols-outlined');
                        if (otherIcon) {
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
                
                // Toggle this submenu
                if (isCurrentlyOpen) {
                    submenu.classList.add('hidden');
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    submenu.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        });
    });

    // Prevent parent link from toggling on mobile
    document.querySelectorAll('.mobile-menu-item a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Allow normal link behavior - don't toggle
            e.stopPropagation();
        });
    });

    // Desktop Dropdown Hover Intent
    let hoverTimeout;
    const desktopMenuItems = document.querySelectorAll('nav.hidden.lg\\:flex .relative.group');
    
    desktopMenuItems.forEach(item => {
        const dropdown = item.querySelector('div[class*="absolute"]');
        
        if (dropdown) {
            // Mouse enter - delay showing dropdown
            item.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimeout);
                hoverTimeout = setTimeout(() => {
                    dropdown.style.opacity = '1';
                    dropdown.style.visibility = 'visible';
                }, 150); // 150ms delay before showing
            });
            
            // Mouse leave - immediate hide
            item.addEventListener('mouseleave', function() {
                clearTimeout(hoverTimeout);
                dropdown.style.opacity = '0';
                dropdown.style.visibility = 'hidden';
            });
            
            // Keep dropdown open when hovering over it
            dropdown.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimeout);
                this.style.opacity = '1';
                this.style.visibility = 'visible';
            });
        }
    });
});