<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[1200px] mx-auto px-6">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <?php if (is_home()) : ?>
                <h1 class="text-5xl font-black mb-4">Latest News</h1>
                <p class="text-xl text-slate-600 dark:text-slate-400">Stay updated with the Vienna Gaels community</p>
            <?php elseif (is_category()) : ?>
                <h1 class="text-5xl font-black mb-4"><?php single_cat_title(); ?></h1>
                <p class="text-xl text-slate-600 dark:text-slate-400"><?php echo category_description(); ?></p>
            <?php elseif (is_tag()) : ?>
                <h1 class="text-5xl font-black mb-4">Tag: <?php single_tag_title(); ?></h1>
            <?php elseif (is_author()) : ?>
                <h1 class="text-5xl font-black mb-4">Posts by <?php the_author(); ?></h1>
            <?php elseif (is_archive()) : ?>
                <h1 class="text-5xl font-black mb-4"><?php the_archive_title(); ?></h1>
            <?php elseif (is_search()) : ?>
                <h1 class="text-5xl font-black mb-4">Search Results for: "<?php echo get_search_query(); ?>"</h1>
            <?php else : ?>
                <h1 class="text-5xl font-black mb-4">Blog</h1>
            <?php endif; ?>
        </div>

        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <?php if (have_posts()) : ?>
                    <div class="space-y-10">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden soft-lift hover:-translate-y-2 transition-all duration-300">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="aspect-video bg-cover bg-center hover:scale-105 transition-transform duration-500" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');"></div>
                                    </a>
                                <?php endif; ?>
                                
                                <div class="p-8">
                                    <!-- Meta Info -->
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase">
                                            <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo esc_html($categories[0]->name);
                                            }
                                            ?>
                                        </span>
                                        <span class="text-sm text-slate-500">
                                            <?php echo get_the_date('F j, Y'); ?>
                                        </span>
                                        <span class="text-sm text-slate-500">
                                            By <?php the_author(); ?>
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h2 class="text-3xl font-bold mb-4 leading-tight">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- Excerpt -->
                                    <p class="text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>

                                    <!-- Read More -->
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                                        Read Full Article
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if (paginate_links()) : ?>
                        <div class="mt-12 flex justify-center gap-2">
                            <?php
                            echo paginate_links(array(
                                'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                                'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
                                'type' => 'list',
                                'class' => 'flex gap-2'
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <!-- No Posts Found -->
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-12 text-center soft-lift">
                        <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">search_off</span>
                        <h2 class="text-2xl font-bold mb-4">No posts found</h2>
                        <p class="text-slate-600 dark:text-slate-400 mb-6">
                            <?php if (is_search()) : ?>
                                Sorry, no results found for your search. Try different keywords.
                            <?php else : ?>
                                There are no posts to display at the moment.
                            <?php endif; ?>
                        </p>
                        <a href="<?php echo home_url('/'); ?>" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-bold hover:scale-105 transition-transform">
                            Back to Home
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <!-- Search Widget -->
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift">
                        <h3 class="text-xl font-bold mb-4">Search</h3>
                        <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="relative">
                            <input type="search" name="s" placeholder="Search articles..." class="w-full px-4 py-3 pr-12 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-neutral-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-primary">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <?php
                    $categories = get_categories(array('hide_empty' => true));
                    if ($categories) :
                    ?>
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift">
                        <h3 class="text-xl font-bold mb-4">Categories</h3>
                        <ul class="space-y-3">
                            <?php foreach ($categories as $category) : ?>
                                <li>
                                    <a href="<?php echo get_category_link($category->term_id); ?>" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-primary/10 transition-colors group">
                                        <span class="font-semibold group-hover:text-primary"><?php echo $category->name; ?></span>
                                        <span class="text-xs bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded-full"><?php echo $category->count; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Recent Posts Widget -->
                    <?php
                    $recent_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 5,
                        'post__not_in' => array(get_the_ID())
                    ));
                    
                    if ($recent_posts->have_posts()) :
                    ?>
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift">
                        <h3 class="text-xl font-bold mb-4">Recent Posts</h3>
                        <ul class="space-y-4">
                            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" class="group block">
                                        <h4 class="font-bold text-sm mb-1 group-hover:text-primary transition-colors line-clamp-2">
                                            <?php the_title(); ?>
                                        </h4>
                                        <span class="text-xs text-slate-500">
                                            <?php echo get_the_date('M j, Y'); ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Tags Widget -->
                    <?php
                    $tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => 20));
                    if ($tags) :
                    ?>
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift">
                        <h3 class="text-xl font-bold mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="px-3 py-1 bg-slate-100 dark:bg-slate-900 rounded-full text-sm hover:bg-primary hover:text-white transition-colors">
                                    <?php echo $tag->name; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- CTA Widget -->
                    <div class="bg-gradient-to-br from-primary to-primary/80 text-white rounded-2xl p-8 soft-lift">
                        <div class="size-16 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">sports_rugby</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Join Vienna Gaels</h3>
                        <p class="mb-6 text-white/90">Become part of Austria's premier Gaelic Games club</p>
                        <a href="<?php echo home_url('/membership'); ?>" class="block w-full bg-white text-primary text-center px-6 py-3 rounded-lg font-bold hover:scale-105 transition-transform">
                            Learn More
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>