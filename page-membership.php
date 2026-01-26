<?php
/*
Template Name: Membership Page
*/
get_header();
?>

<main class="w-full">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 px-6 bg-gradient-to-br from-primary/10 to-transparent">
        <div class="max-w-[1200px] mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6"><?php the_title(); ?></h1>
            
            <?php 
            $subtitle = get_post_meta(get_the_ID(), 'page_subtitle', true);
            if ($subtitle) : 
            ?>
                <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-8">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Main Content Area - Fully Editable -->
    <section class="py-20 px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="prose prose-lg max-w-none dark:prose-invert mx-auto">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>