<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[800px] mx-auto px-6 text-center">
        <div class="mb-8">
            <span class="material-symbols-outlined text-[120px] text-primary">error</span>
        </div>
        
        <h1 class="text-6xl font-black mb-6">404</h1>
        <h2 class="text-3xl font-bold mb-6">Page Not Found</h2>
        
        <p class="text-xl text-slate-600 dark:text-slate-400 mb-10">
            Sorry, we couldn't find the page you're looking for. It might have been moved or deleted.
        </p>

        <div class="flex flex-wrap gap-4 justify-center">
            <a href="<?php echo home_url('/'); ?>" class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform">
                Back to Home
            </a>
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="border-2 border-primary text-primary px-8 py-4 rounded-xl font-bold text-lg hover:bg-primary/5 transition-colors">
                View Events
            </a>
        </div>

        <!-- Search -->
        <div class="mt-16">
            <h3 class="text-xl font-bold mb-6">Or try searching:</h3>
            <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="max-w-md mx-auto relative">
                <input type="search" name="s" placeholder="Search..." class="w-full px-6 py-4 pr-14 rounded-xl border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-lg">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-primary">
                    <span class="material-symbols-outlined text-2xl">search</span>
                </button>
            </form>
        </div>
    </div>
</main>

<?php get_footer(); ?>