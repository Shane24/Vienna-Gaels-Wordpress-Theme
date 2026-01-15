
<?php
/*
Template Name: Membership Page
*/
get_header();
?>

<main class="w-full">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 px-6 bg-gradient-to-br from-primary/10 to-transparent">
        <div class="max-w-[1200px] mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6">Join Vienna Gaels</h1>
            <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-8">
                Become part of Austria's premier Gaelic Games community. All levels welcome.
            </p>
        </div>
    </section>

    <!-- Membership Tiers -->
    <section class="py-20 px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Player Membership -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift border-2 border-primary">
                    <div class="size-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">sports</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Player</h3>
                    <p class="text-4xl font-black text-primary mb-6">€100<span class="text-lg font-normal text-slate-500">/year</span></p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Full training access</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Match day participation</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Club jersey included</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Social events access</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Official GAA registration</span>
                        </li>
                    </ul>
                    <button class="w-full bg-primary text-white px-6 py-4 rounded-xl font-bold hover:scale-105 transition-transform">
                        Sign Up as Player
                    </button>
                </div>

                <!-- Social Membership -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift">
                    <div class="size-16 bg-vienna-gold/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-vienna-gold text-3xl">celebration</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Social</h3>
                    <p class="text-4xl font-black text-vienna-gold mb-6">€40<span class="text-lg font-normal text-slate-500">/year</span></p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-vienna-gold text-sm mt-1">check_circle</span>
                            <span class="text-sm">All social events</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-vienna-gold text-sm mt-1">check_circle</span>
                            <span class="text-sm">Club newsletter</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-vienna-gold text-sm mt-1">check_circle</span>
                            <span class="text-sm">Merchandise discounts</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-vienna-gold text-sm mt-1">check_circle</span>
                            <span class="text-sm">Match day spectator access</span>
                        </li>
                    </ul>
                    <button class="w-full bg-vienna-gold text-white px-6 py-4 rounded-xl font-bold hover:scale-105 transition-transform">
                        Join as Social Member
                    </button>
                </div>

                <!-- Student Membership -->
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 soft-lift">
                    <div class="size-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">school</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Student</h3>
                    <p class="text-4xl font-black text-primary mb-6">€60<span class="text-lg font-normal text-slate-500">/year</span></p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Full training access</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Match day participation</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Club jersey included</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                            <span class="text-sm">Social events access</span>
                        </li>
                        <li class="flex items-start gap-3 opacity-50">
                            <span class="material-symbols-outlined text-slate-400 text-sm mt-1">verified_user</span>
                            <span class="text-sm">Valid student ID required</span>
                        </li>
                    </ul>
                    <button class="w-full bg-primary text-white px-6 py-4 rounded-xl font-bold hover:scale-105 transition-transform">
                        Student Sign Up
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 px-6 bg-neutral-50 dark:bg-neutral-900">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black mb-4">Why Join Us?</h2>
                <p class="text-xl text-slate-600 dark:text-slate-400">More than just a sports club</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="size-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">diversity_3</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">International Community</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">20+ nationalities, one team spirit</p>
                </div>

                <div class="text-center">
                    <div class="size-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">fitness_center</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Professional Coaching</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Experienced coaches from Ireland</p>
                </div>

                <div class="text-center">
                    <div class="size-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">emoji_events</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Competitive Play</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Tournaments across Europe</p>
                </div>

                <div class="text-center">
                    <div class="size-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">local_bar</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Social Events</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Regular gatherings and celebrations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 px-6">
        <div class="max-w-[800px] mx-auto">
            <h2 class="text-4xl font-black text-center mb-12">Frequently Asked Questions</h2>

            <div class="space-y-4">
                <details class="bg-white dark:bg-neutral-800 rounded-xl p-6 soft-lift group">
                    <summary class="font-bold cursor-pointer flex items-center justify-between">
                        Do I need experience to join?
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </summary>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">
                        Not at all! We welcome complete beginners. Many of our members had never played Gaelic games before joining. We provide coaching for all skill levels.
                    </p>
                </details>

                <details class="bg-white dark:bg-neutral-800 rounded-xl p-6 soft-lift">
                    <summary class="font-bold cursor-pointer flex items-center justify-between">
                        When and where are training sessions?
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </summary>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">
                        We train twice weekly at Hauptallee in the Prater. Football on Tuesdays at 19:00 and Hurling/Camogie on Thursdays at 19:00. Check our events calendar for updates.
                    </p>
                </details>

                <details class="bg-white dark:bg-neutral-800 rounded-xl p-6 soft-lift">
                    <summary class="font-bold cursor-pointer flex items-center justify-between">
                        What equipment do I need?
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </summary>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">
                        For your first session, just bring sports clothes and running shoes. The club provides balls and hurling equipment. Once you join, you'll receive a club jersey. Hurling helmets are mandatory and can be purchased through the club.
                    </p>
                </details>

                <details class="bg-white dark:bg-neutral-800 rounded-xl p-6 soft-lift">
                    <summary class="font-bold cursor-pointer flex items-center justify-between">
                        Can I try before committing to membership?
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </summary>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">
                        Yes! Your first two training sessions are free. Come along and see if it's for you before signing up.
                    </p>
                </details>

                <details class="bg-white dark:bg-neutral-800 rounded-xl p-6 soft-lift">
                    <summary class="font-bold cursor-pointer flex items-center justify-between">
                        Do I need to be Irish to join?
                        <span class="material-symbols-outlined text-primary">expand_more</span>
                    </summary>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">
                        Absolutely not! We have members from over 20 countries. The club is open to anyone interested in Gaelic games and Irish culture.
                    </p>
                </details>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>