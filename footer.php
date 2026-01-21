<!-- Footer -->
<footer class="bg-[#1a1a1a] text-white pt-20 pb-10">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-lg font-black tracking-tight"><?php bloginfo('name'); ?></h2>
                </div>
                <p class="text-neutral-400 text-sm leading-relaxed mb-6">
                    Proudly promoting Gaelic Games and Irish culture in the heart of Vienna since 2004.
                </p>
                <div class="flex gap-4">
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">social_leaderboard</span>
                    </a>
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                    </a>
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">alternate_email</span>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Quick Links</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'ul',
                    'menu_class' => 'space-y-4 text-sm text-neutral-300'
                ));
                ?>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Contact</h4>
                <ul class="space-y-4 text-sm text-neutral-300">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-sm mt-0.5">mail</span>
                        <span>secretary.vienna.europe@gaa.ie</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-sm mt-0.5">location_on</span>
                        <span>Vienna, Austria</span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Our Sponsors</h4>
                <div class="grid grid-cols-2 gap-4 grayscale opacity-60">
                    <div class="h-12 bg-neutral-800 rounded flex items-center justify-center text-[10px] font-bold">FLANAGAN'S</div>
                    <div class="h-12 bg-neutral-800 rounded flex items-center justify-center text-[10px] font-bold">O'NEILLS</div>
                    <div class="h-12 bg-neutral-800 rounded flex items-center justify-center text-[10px] font-bold">GUINNESS</div>
                    <div class="h-12 bg-neutral-800 rounded flex items-center justify-center text-[10px] font-bold">WIFI WIEN</div>
                </div>
            </div>
        </div>
        <div class="pt-8 border-t border-neutral-800 text-center">
            <p class="text-neutral-500 text-xs">
                © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>