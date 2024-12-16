<?php
class WooCommerce_Categories extends \Elementor\Widget_Base {

	private function get_product_categories(): array {
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
		return 'WooCommerce_Categories';
	}

	public function get_title(): string {
		return esc_html__( 'WooCommerce Categories', 'elementor-addon' );
	}

	public function get_icon(): string {
		return 'eicon-gallery-grid';
	}

	public function get_categories(): array {
		return [ 'general' ];
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

		// Add a control to add title
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Categories', 'elementor-addon' ),
			]
		);

		// Add a control to add description
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Loreum ipsum', 'elementor-addon' ),
			]
		);

		// Add a control to select product categories
		$this->add_control(
			'selected_categories',
			[
				'label' => esc_html__('Select Categories', 'elementor-addon'),
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
				'default' => 'left',
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
				'default' => 'left',
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
				'default' => 'left',
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
			.image-grid p {
				margin: 10px auto;
			}

			.image-grid {
				display: grid;
				gap: <?php echo esc_attr( $settings['image_grid_item_spacing']['size'] . $settings['image_grid_item_spacing']['unit'] ); ?>;
				grid-template-columns: repeat(<?php echo esc_attr( $settings['image_grid_columns'] ); ?>, 1fr);
				text-align: center;
			}

			.image-grid-item {
				position: relative;
				overflow: hidden;
				transition: transform 0.3s ease;
			}

			.image-grid-item img {
				width: 100%;
				height: auto;
				border-radius: <?php echo esc_attr( $settings['image_grid_item_border_radius']['size'] . $settings['image_grid_item_border_radius']['unit'] ); ?>;
			}

			.image-grid-item:hover {
				transform: scale(1.02);
			}
		</style><?php
		if ( !empty( $settings['title'] ) ) { ?>
			<div class="section-title">
				<?php echo $settings['title']; ?>
			</div><?php
		}
		if ( !empty( $settings['description'] ) ) { ?>
			<p class="description">
				<?php echo $settings['description']; ?>
			</p><?php
		}
		// Display selected categories
		if (!empty($settings['selected_categories'])) {
			$categories = $settings['selected_categories'];

			echo '<div class="product-categories-grid">';

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
								echo '<p class="image-caption">' . esc_html($category->name) . '</p>';
							echo '</a>';
						echo '</div>';
					}
				}
			}
			echo '</div>';
			echo '</div>';
		}
	}

	/*protected function content_template(): void {
		?>
		<#
		if ( '' === settings.title ) {
			return;
		}
		#>
		<p class="hello-world">
			{{ settings.title }}
		</p>
		<?php
	}*/
}