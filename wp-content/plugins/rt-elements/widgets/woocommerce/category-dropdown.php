<?php
/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;

defined('ABSPATH') || die();

class Rsaddon_Elementor_Pro_Product_Category_Dropdown_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rt-product-category-dropdown';
    }

    public function get_title() {
        return __('RT Product Category Dropdown', 'rsaddon');
    }

    public function get_icon() {
        return 'glyph-icon flaticon-shopping-cart';
    }

    public function get_categories() {
        return ['rsaddon_category'];
    }

    public function get_keywords() {
        return ['product', 'list', 'category'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'rs_section_product_grid_settings',
            [
                'label' => esc_html__('Settings', 'rsaddon'),
            ]
        );

        $this->add_control(
            'rs_product_grid_categories',
            [
                'label'       => esc_html__('Product Categories', 'rsaddon'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => rselemetns_woocommerce_product_categories(),
            ]
        );

        $this->add_control(
            'pcat_all_cat_text',
            [
                'label'   => esc_html__('Top Title Text', 'rsaddon'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All Categories', 'rsaddon'),
            ]
        );

        $this->add_control(
            'pcat_show_count',
            [
                'label'        => esc_html__('Show Count', 'plugin-name'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'your-plugin'),
                'label_off'    => esc_html__('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_product_grid_styles',
            [
                'label' => esc_html__('Styles', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rt_category_name_color',
            [
                'label'     => esc_html__('Category Name Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_name_hover_color',
            [
                'label'     => esc_html__('Category Name Hover Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rt_category_count_color',
            [
                'label'     => esc_html__('Category Count Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_count_hover_color',
            [
                'label'     => esc_html__('Category Count Hover Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rt_category_arrow_color',
            [
                'label'     => esc_html__('Category Arrow Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rt_category_arrow_hover_color',
            [
                'label'     => esc_html__('Category Arrow Hover Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget nav ul li a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rt_catd_bg_heading',
            [
                'label' => esc_html__( 'Container Background', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'rt_category_dropdown_background',
                'label' => esc_html__( 'Container Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .category-dropdown-ewidget',
                'description' => 'Container Background',
            ]
        );

        $this->add_control(
            'rt_catd_bg_title_heading',
            [
                'label' => esc_html__( 'Title Section', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'rt_category_title_color',
            [
                'label'     => esc_html__('Category Title Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-dropdown-ewidget h2' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'rt_category_dropdown_title_background',
                'label' => esc_html__( 'Title Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .category-dropdown-ewidget h2',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $top_text   = $settings['pcat_all_cat_text'];
        $show_count = $settings['pcat_show_count'];
        $unique     = rand(2012, 35120);
        $taxonomies = $settings['rs_product_grid_categories'];
        ?>

        <!-- Desktop Version -->
        <div class="weiboo-pcat weiboo-pcat-desktop category-dropdown-ewidget">
            <div id="categories" class="pcats">
                <h2 class="accordion-header widget-title">
                    <?php echo esc_html($top_text); ?><i class="rt-angle-down"></i>
                </h2>
                <div>
                    <nav class='animated bounceInDown'>
                        <ul>
                            <?php
                            if ( is_array($taxonomies) || is_object($taxonomies) ) :
                                foreach ( $taxonomies as $pcat ) {

                                    if ( empty($pcat) || ! is_string($pcat) ) {
                                        continue;
                                    }

                                    $category = get_term_by('slug', $pcat, 'product_cat');

                                    if ( ! $category || is_wp_error($category) || ! isset($category->slug) ) {
                                        continue;
                                    }

                                    if ( $category->slug === 'uncategorized' ) {
                                        continue;
                                    }

                                    $name_count = ( $show_count === 'yes' )
                                        ? $category->name . ' <span>(' . $category->count . ')</span>'
                                        : $category->name;

                                    $clink = get_term_link($category);
                                    if ( is_wp_error($clink) ) {
                                        $clink = '#';
                                    }

                                    echo "<li><a href='" . esc_url($clink) . "'>" . wp_kses_post($name_count) . "<i class='rt rt-arrow-right-long'></i></a></li>";
                                }
                            endif;
                            ?>
                        </ul>
                    </nav>
                </div>        
            </div>
        </div>

        <!-- Mobile Version -->
        <div class="weiboo-pcat weiboo-pcat-mobile category-dropdown-ewidget">
            <div id="categories">
                <h2 class="accordion-header widget-title cursor-pointer collapsed" data-bs-toggle="collapse" data-bs-target="#pcat_dropdown<?php echo esc_attr($unique); ?>">
                    <?php echo esc_html($top_text); ?><i class="rt-angle-down"></i>
                </h2>
                <div id="pcat_dropdown<?php echo esc_attr($unique); ?>" class="collapse">
                    <nav class='animated bounceInDown'>
                        <ul>
                            <?php
                            if ( is_array($taxonomies) || is_object($taxonomies) ) :
                                foreach ( $taxonomies as $pcat ) {

                                    if ( empty($pcat) || ! is_string($pcat) ) {
                                        continue;
                                    }

                                    $category = get_term_by('slug', $pcat, 'product_cat');

                                    if ( ! $category || is_wp_error($category) || ! isset($category->slug) ) {
                                        continue;
                                    }

                                    if ( $category->slug === 'uncategorized' ) {
                                        continue;
                                    }

                                    $name_count = ( $show_count === 'yes' )
                                        ? $category->name . ' <span>(' . $category->count . ')</span>'
                                        : $category->name;

                                    $clink = get_term_link($category);
                                    if ( is_wp_error($clink) ) {
                                        $clink = '#';
                                    }

                                    echo "<li><a href='" . esc_url($clink) . "'>" . wp_kses_post($name_count) . "<i class='rt rt-arrow-right-long'></i></a></li>";
                                }
                            endif;
                            ?>
                        </ul>
                    </nav>
                </div>        
            </div>
        </div>

        <?php
    }
}
