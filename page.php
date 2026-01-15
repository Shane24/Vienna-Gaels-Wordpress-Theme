<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[900px] mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article>
            <?php if (has_post_thumbnail()) : ?>
            <div class="rounded-2xl overflow-hidden mb-8 aspect-video">
                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
            </div>
            <?php endif; ?>

            <h1 class="text-5xl font-black mb-8 leading-tight">
                <?php the_title(); ?>
            </h1>

            <div class="prose prose-lg max-w-none dark:prose-invert prose-headings:font-bold prose-a:text-primary prose-img:rounded-xl">
                <?php the_content(); ?>
            </div>
        </article>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>