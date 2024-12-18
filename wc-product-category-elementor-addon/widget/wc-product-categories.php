<?php
class WC_Product_Categories extends \Elementor\Widget_Base {

	private function get_product_categories(): array {

		// Check if WooCommerce is active
		if (!class_exists('WooCommerce')) {
			// WooCommerce is not active; exit the method logic
			return [];
		}

		$categories = get_terms([
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		]);

		$options = [];
		if (!is_wp_error($categories)) {
			foreach ($categories as $category) {
				$options[$category->term_id] = $category->name;
			}
		}

		return $options;
	}

	public function get_name(): string {
		return 'WC_Product_Categories';
	}

	public function get_title(): string {
		return esc_html__( 'WC Product Categories', 'elementor-addon' );
	}

	public function get_icon(): string {
		return 'eicon-wordpress';
	}

	public function get_categories(): array {
		return [ 'wordpress' ];
	}

	public function get_keywords(): array {
		return [ 'woocommerce', 'categories', 'category', 'taxonomy', 'product category' ];
	}

	protected function register_controls(): void {

		// Content Tab Start
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Section', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'section_heading_tag',
			[
				'label' => esc_html__( 'Heading Tag', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => esc_html__( 'H1', 'elementor-addon' ),
					'h2' => esc_html__( 'H2', 'elementor-addon' ),
					'h3' => esc_html__( 'H3', 'elementor-addon' ),
					'h4' => esc_html__( 'H4', 'elementor-addon' ),
					'h5' => esc_html__( 'H5', 'elementor-addon' ),
					'h6' => esc_html__( 'H6', 'elementor-addon' ),
				],
				'default' => 'h2', // Default to H2
			]
		);

		// Add a control to add title
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Heading Here', 'elementor-addon' ),
				'placeholder' => esc_html__( 'Enter heading text', 'elementor-addon' ),
			]
		);

		// Add a control to add description
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Your Description Here', 'elementor-addon' ),
				'placeholder' => esc_html__( 'Enter Description text', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'show_product_count',
			[
				'label' => esc_html__( 'Show Product Count', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor-addon' ),
				'label_off' => esc_html__( 'Hide', 'elementor-addon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		// Add a control to hide empty categories
		$this->add_control(
			'hide_empty_categories',
			[
				'label'        => esc_html__( 'Hide Empty Categories', 'elementor-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'elementor-addon' ),
				'label_off'    => esc_html__( 'No', 'elementor-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// Add a control to sort product categories
		$this->add_control(
			'sort_order_by',
			[
				'label' => esc_html__( 'Order By', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title'      => esc_html__( 'Title', 'elementor-addon' ),
					'date'       => esc_html__( 'Date', 'elementor-addon' ),
					'menu_order' => esc_html__( 'Menu Order', 'elementor-addon' ),
					'parent'     => esc_html__( 'Parent ID', 'elementor-addon' ),
				],
			]
		);

		// Sorting Order (ASC or DESC)
		$this->add_control(
			'sort_order',
			[
				'label' => esc_html__( 'Order', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC' => 'Ascending',
					'DESC' => 'Descending',
				],
				'default' => 'ASC',
			]
		);

		// Add a control to select product categories
		$this->add_control(
			'selected_categories',
			[
				'label' => esc_html__('Manual Selection', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $this->get_product_categories(),
				'multiple' => true,
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// Content Tab End


		// Title - Style Tab Start
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color Control
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
				],
			]
		);

		// Typography Control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'elementor-addon' ),
				'selector' => '{{WRAPPER}} .section-title',
			]
		);

		// Text Alignment Control
		$this->add_control(
			'title_alignment',
			[
				'label' => esc_html__( 'Alignment', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// Title - Style Tab End

		// Description - Style Tab Start
		$this->start_controls_section(
			'section_description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Description Color Control
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .description' => 'color: {{VALUE}};',
				],
			]
		);

		// Description Typography Control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__( 'Typography', 'elementor-addon' ),
				'selector' => '{{WRAPPER}} .description',
			]
		);

		// Description Alignment Control
		$this->add_control(
			'description_alignment',
			[
				'label' => esc_html__( 'Alignment', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .description' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// Description - Style Tab End

		// Image Grid - Style Tab Start
		$this->start_controls_section(
			'section_image_grid_style',
			[
				'label' => esc_html__( 'Image Grid', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Image Grid Item Spacing Control
		$this->add_responsive_control(
			'image_grid_item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Image Grid Columns Control
		$this->add_responsive_control(
			'image_grid_columns',
			[
				'label' => esc_html__( 'Columns', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( '1 Column', 'elementor-addon' ),
					'2' => esc_html__( '2 Columns', 'elementor-addon' ),
					'3' => esc_html__( '3 Columns', 'elementor-addon' ),
					'4' => esc_html__( '4 Columns', 'elementor-addon' ),
					'5' => esc_html__( '5 Columns', 'elementor-addon' ),
					'6' => esc_html__( '6 Columns', 'elementor-addon' ),
				],
				'default' => '3',
				'selectors' => [
					'{{WRAPPER}} .image-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		// Image Grid Item Border Radius Control
		$this->add_responsive_control(
			'image_grid_item_border_radius',
			[
				'label' => esc_html__( 'Item Border Radius', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image-grid-item img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// Image Grid - Style Tab End

		// Image Caption - Style Tab Start
		$this->start_controls_section(
			'image_caption_style',
			[
				'label' => esc_html__( 'Image Caption', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Description Color Control
		$this->add_control(
			'image_caption_font_color',
			[
				'label' => esc_html__( 'Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-caption' => 'color: {{VALUE}};',
				],
			]
		);

		// Description Typography Control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'image_caption_typography',
				'label' => esc_html__( 'Typography', 'elementor-addon' ),
				'selector' => '{{WRAPPER}} .image-caption',
			]
		);

		// Description Alignment Control
		$this->add_control(
			'image_caption_alignment',
			[
				'label' => esc_html__( 'Alignment', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// Image Caption - Style Tab End
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>
		<style>
			.product-categories-grid {
				display: flex; /* Use Flexbox for centering */
				justify-content: center; /* Center horizontally */
				align-items: center; /* Center vertically */
			}

			.image-grid {
				display: grid;
				gap: <?php echo esc_attr( $settings['image_grid_item_spacing']['size'] . $settings['image_grid_item_spacing']['unit'] ); ?>;
				text-align: center;
			}

			.image-grid-item {
				position: relative;
				overflow: hidden;
				transition: transform 0.3s ease;
				display: flex; /* Ensures centering */
				justify-content: center; /* Centers horizontally */
			}

			.image-grid-item img {
				width: 100%; /* Allow natural width */
				height: auto; /* Maintain aspect ratio */
				max-width: 300px;
				object-fit: cover;
				border-radius: <?php echo esc_attr( $settings['image_grid_item_border_radius']['size'] . $settings['image_grid_item_border_radius']['unit'] ); ?>;
			}

			.image-grid-item:hover {
				transform: scale(1.02);
			}

			.image-grid p {
				margin: 10px auto;
			}
		</style><?php

		if ( !empty( $settings['title'] ) ) {
			$tag = $settings['section_heading_tag']; // Get selected heading tag (h1 to h6)
			?>
			<<?php echo esc_attr( $tag ); ?> class="section-title">
				<?php echo esc_html( $settings['title'] ); ?>
			</<?php echo esc_attr( $tag ); ?>>
			<?php
		}
		if ( !empty( $settings['description'] ) ) { ?>
			<p class="description">
				<?php echo esc_html($settings['description']); ?>
			</p><?php
		}

		if (class_exists('WooCommerce')) {	

			// Sorting parameters
			$sort_order_by = $settings['sort_order_by'];
			$sort_order   = $settings['sort_order'];
			$hide_empty_categories = ($settings['hide_empty_categories'] === 'yes');

			// Base query arguments
			$args = [
				'taxonomy'   => 'product_cat',
				'hide_empty' => $hide_empty_categories, // Only show categories with products
				'orderby'    => $sort_order_by === 'date' ? 'id' : $sort_order_by,
				'order'      => $sort_order,
			];

			// Handle manual category selection
			if ( !empty( $settings['selected_categories'] ) ) {
				$args['include'] = $settings['selected_categories']; // Only fetch selected categories
			}

			// Special sorting cases
			if ( $sort_order_by === 'date' ) {
				$args['orderby'] = 'id';
			}

			// Fetch categories
			$categories = get_terms( $args );

			// Render categories
			echo '<div class="product-categories-grid">';
				if (!empty($categories)) {
					// Start rendering the image grid section
					echo '<div class="image-grid">';
						foreach ($categories as $category_id) {
							$category = get_term($category_id, 'product_cat');

							if ($category) {
								$image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
								$image_url = $image_id ? wp_get_attachment_url($image_id) : wc_placeholder_img_src();
								$category_link = get_term_link($category);

								if (!is_wp_error($category_link)) {
									// Render each image item
									echo '<div class="image-grid-item">';
										echo '<a href="' . esc_url($category_link) . '">';
											echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
											echo '<div class="image-caption">';
												echo esc_html($category->name);
												if( 'yes' === $settings['show_product_count'] ) {
													echo '<span class="product-count"> (' . esc_html($category->count) . ')</span>';
												}
											echo '</div>';
										echo '</a>';
									echo '</div>';
								}
							}
						}
					echo '</div>';
				} else {
					echo '<p>' . esc_html__( 'No categories available.', 'elementor-addon' ) . '</p>';
				}
			echo '</div>';
		}
	}
}