<?php get_header(); ?>

<?php
$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
$tax_query = array();

if ($current_filter !== 'all') {
    $tax_query = array(
            array(
                    'taxonomy' => 'type_projet',
                    'field'    => 'slug',
                    'terms'    => $current_filter,
            )
    );
}

global $wp_query;
if (!empty($tax_query)) {
    $wp_query->set('tax_query', $tax_query);
    $wp_query->get_posts();
}
?>

    <section class="projets-container">
        <h2 class="projets-titre"><?php echo get_the_archive_title(); ?></h2>

        <!-- FILTRES -->
        <div class="filtres">
            <?php
            $filtres = array('all' => 'Tous', 'web' => 'Web', '2d' => '2D', '3d' => '3D');
            $current_url = get_post_type_archive_link('projet');

            foreach ($filtres as $slug => $label) :
                $active_class = ($current_filter === $slug) ? 'active' : '';
                $filter_url = ($slug === 'all') ? $current_url : add_query_arg('filter', $slug, $current_url);
                ?>
                <a href="<?php echo esc_url($filter_url); ?>" class="filtre-link <?php echo $active_class; ?>">
                    <?php echo esc_html($label); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- GRILLE DES PROJETS -->
        <div class="grid-projets">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();
                    $terms = get_the_terms(get_the_ID(), 'type_projet');
                    $img_project = get_field('img_project');
                    $link_project = get_field('link_project');
                    $description_project = get_field('description_project');
                    ?>
                    <div class="carte">
                        <?php if ($img_project) : ?>
                            <div class="carte-image">
                                <img src="<?php echo esc_url($img_project['url']); ?>" alt="<?php echo esc_attr($img_project['alt']); ?>">
                            </div>
                        <?php else : ?>
                            <div class="carte-image carte-image--placeholder">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="carte-titre"><?php the_title(); ?></h3>

                        <?php if ($description_project) : ?>
                            <div class="carte-description"><?php echo wp_kses_post($description_project); ?></div>
                        <?php else : ?>
                            <p class="carte-excerpt"><?php the_excerpt(); ?></p>
                        <?php endif; ?>

                        <?php if ($link_project) : ?>
                            <a href="<?php echo esc_url($link_project['url']); ?>" class="btn" target="<?php echo esc_attr($link_project['target']); ?>">
                                <?php echo esc_html($link_project['title'] ?: 'Découvrir'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="btn">Découvrir</a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>

                <!-- PAGINATION -->
                <div class="pagination">
                    <?php echo paginate_links(array(
                            'prev_text' => '«',
                            'next_text' => '»',
                            'add_args'  => array('filter' => $current_filter),
                    )); ?>
                </div>

            <?php else : ?>
                <p class="projets-vide">Aucun projet trouvé.</p>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>