<?php
/*
Template Name: Contact Page
*/
get_header();
?>

<main class="w-full py-20">
    <div class="max-w-[1200px] mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <div class="text-center mb-16">
            <h1 class="text-5xl font-black mb-6"><?php the_title(); ?></h1>
            <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                <?php the_content(); ?>
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 md:p-12 soft-lift">
                <h2 class="text-2xl font-bold mb-8">Send Us a Message</h2>
                
                <form id="contact-form" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold mb-2" for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2" for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2" for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2" for="interest">I'm Interested In</label>
                        <select id="interest" name="interest" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors">
                            <option value="">Select an option</option>
                            <option value="mens-football">Men's Football</option>
                            <option value="ladies-football">Ladies Football</option>
                            <option value="hurling">Hurling</option>
                            <option value="camogie">Camogie</option>
                            <option value="general">General Inquiry</option>
                            <option value="sponsorship">Sponsorship</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2" for="message">Message *</label>
                        <textarea id="message" name="message" required rows="6" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform">
                        Send Message
                    </button>

                    <div id="form-message" class="hidden p-4 rounded-lg"></div>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <!-- Email -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift">
                    <div class="size-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">mail</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Email Us</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">Get in touch via email for any inquiries</p>
                    <a href="mailto:secretary.vienna.europe@gaa.ie" class="text-primary font-bold hover:underline">
                        secretary.vienna.europe@gaa.ie
                    </a>
                </div>

                <!-- Location -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift">
                    <div class="size-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Training Location</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">Join us for training sessions at</p>
                    <p class="font-bold">Hauptallee, Prater<br>1020 Vienna, Austria</p>
                </div>

                <!-- Social Media -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift">
                    <div class="size-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">groups</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">Stay connected on social media</p>
                    <div class="flex gap-4">
                        <a href="#" class="size-12 bg-slate-100 dark:bg-slate-900 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <span class="material-symbols-outlined">social_leaderboard</span>
                        </a>
                        <a href="#" class="size-12 bg-slate-100 dark:bg-slate-900 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </a>
                        <a href="#" class="size-12 bg-slate-100 dark:bg-slate-900 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <span class="material-symbols-outlined">alternate_email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>